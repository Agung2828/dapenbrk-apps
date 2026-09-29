<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\HandlesWbsLaporanInput;
use App\Mail\WbsTokenMail;
use App\Models\WbsLaporan;
use App\Services\FonnteService;
use App\Support\WbsOptions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class WbsController extends Controller
{
    use HandlesWbsLaporanInput;

    public function index()
    {
        return view('wbs', [
            'kategoriPengaduan' => WbsOptions::kategoriPengaduan(),
            'jabatanTerlapor'   => WbsOptions::jabatanTerlapor(),
            'hubunganDapen'     => WbsOptions::hubunganDapen(),
            'buktiMaxFiles'     => WbsOptions::buktiMaxFiles(),
            'buktiMaxSizeMb'    => WbsOptions::buktiMaxSizeMb(),
            'buktiExt'          => WbsOptions::buktiExt(),
        ]);
    }

    public function store(Request $request)
    {
        $isAnonim  = $request->boolean('is_anonim');
        $validated = $request->validate($this->wbsLaporanRules($isAnonim));

        $laporan = WbsLaporan::create([
            'is_anonim'          => $isAnonim,
            'nama_lengkap'       => $validated['nama_lengkap'] ?? null,
            'hubungan_dapen'     => $validated['hubungan_dapen'] ?? null,
            'nomor_identitas'    => $validated['nomor_identitas'] ?? null,
            'no_kontak'          => $validated['no_kontak'] ?? null,
            'email_pribadi'      => $validated['email_pribadi'] ?? null,
            'kategori_pengaduan' => $validated['kategori_pengaduan'],
            'deskripsi_kejadian' => $validated['deskripsi_kejadian'],
            'deskripsi_kerugian' => $validated['deskripsi_kerugian'] ?? null,
        ]);

        $this->saveTerlaporDanBukti($laporan, $request);
        $this->kirimNotifikasiToken($laporan);

        return redirect()
            ->route('wbs.index')
            ->with('success_token', $laporan->ticket_token)
            ->with('open_tab', 'pelaporan');
    }

    public function lacak(Request $request)
    {
        $request->validate(['ticket_token' => ['required', 'string']]);

        $laporan = WbsLaporan::where('ticket_token', trim($request->ticket_token))->first();

        if (!$laporan) {
            return response()->json([
                'found'   => false,
                'message' => 'Nomor tiket tidak ditemukan. Periksa kembali token Anda.',
            ]);
        }

        return response()->json([
            'found'              => true,
            'ticket_token'       => $laporan->ticket_token,
            'kategori_pengaduan' => $laporan->kategori_pengaduan,
            'status'             => $laporan->status,
            'status_label'       => WbsLaporan::statusLabel($laporan->status),
            'catatan_admin'      => $laporan->catatan_admin,
            'tanggal_lapor'      => $laporan->created_at->translatedFormat('d F Y, H:i'),
        ]);
    }

    private function kirimNotifikasiToken(WbsLaporan $laporan): void
    {
        if (!empty($laporan->no_kontak)) {
            $pesan = "Terima kasih telah menyampaikan laporan melalui *Whistleblowing System* "
                . "Dana Pensiun Bank Riau Kepri.\n\nNomor Tiket Anda:\n*{$laporan->ticket_token}*\n\n"
                . "Simpan nomor tiket ini untuk melacak status laporan Anda melalui halaman "
                . "Lacak Pelaporan di situs resmi kami.\n\nKerahasiaan identitas dan laporan Anda kami jamin sepenuhnya.";

            FonnteService::sendMessage($laporan->no_kontak, $pesan);
        }

        if (!empty($laporan->email_pribadi)) {
            try {
                Mail::to($laporan->email_pribadi)->send(new WbsTokenMail($laporan));
            } catch (\Throwable $e) {
                Log::error('Gagal mengirim email token WBS: ' . $e->getMessage());
            }
        }
    }
}
