<?php

namespace App\Http\Controllers;

use App\Models\WbsLaporan;
use Illuminate\Http\Request;
use App\Mail\WbsTokenMail;
use App\Services\FonnteService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class WbsController extends Controller
{
    protected array $kategoriPengaduan = [
        'Kecurangan Laporan Keuangan' =>
        'Kesalahan penyajian yang disengaja atau kelalaian dalam jumlah/pengungkapan laporan keuangan yang tidak sesuai praktik akuntansi yang berlaku umum.',
        'Korupsi' =>
        'Penyalahgunaan wewenang atau jabatan untuk keuntungan pribadi/kelompok yang merugikan Dapen.',
        'Pembocoran Informasi/Data Rahasia' =>
        'Tindakan sengaja memberikan, meneruskan, atau menyebarkan data dan informasi rahasia Dapen kepada pihak yang tidak berhak.',
        'Penipuan' =>
        'Perbuatan tidak jujur atau tipu muslihat yang menimbulkan kerugian bagi Dapen, peserta, atau pihak lain.',
        'Penyalahgunaan Aset' =>
        'Penggunaan aset Dapen di luar peruntukan resmi atau untuk kepentingan pribadi.',
        'Tindakan Lain yang Dapat Dipersamakan dengan Fraud' =>
        'Pelanggaran lain di luar kategori di atas yang berpotensi merugikan Dapen, peserta, atau pihak lain.',
    ];

    protected array $jabatanTerlapor = [
        'Pengurus (Direksi)',
        'Dewan Pengawas',
        'Departemen Investasi',
        'Departemen Kepesertaan',
        'Departemen Akuntansi',
        'Departemen SI',
        'Departemen Umum',
        'Pihak Eksternal (Pihak Ketiga)',
    ];

    protected array $hubunganDapen = [
        'karyawan'           => 'Karyawan Internal DAPEN',
        'peserta_pensiunan'  => 'Peserta / Pensiunan (Penerima Manfaat)',
        'vendor'             => 'Vendor / Pihak Ketiga (Mitra Investasi, IT, dll)',
        'masyarakat_umum'    => 'Masyarakat Umum',
    ];

    public function index()
    {
        return view('wbs', [
            'kategoriPengaduan' => $this->kategoriPengaduan,
            'jabatanTerlapor'   => $this->jabatanTerlapor,
            'hubunganDapen'     => $this->hubunganDapen,
        ]);
    }

    public function store(Request $request)
    {
        $isAnonim = $request->boolean('is_anonim');

        $rules = [
            'kategori_pengaduan'      => ['required', 'string'],
            'deskripsi_kejadian'      => ['required', 'string'],
            'deskripsi_kerugian'      => ['nullable', 'string'],
            'nama_terlapor'           => ['required', 'string', 'max:255'],
            'jabatan_terlapor'        => ['nullable', 'string'],
            'info_tambahan_terlapor'  => ['nullable', 'string'],
            'nama_lengkap'            => [$isAnonim ? 'nullable' : 'required', 'string', 'max:255'],
            'hubungan_dapen'          => [$isAnonim ? 'nullable' : 'required', 'string'],
            'nomor_identitas'         => ['nullable', 'string', 'max:50'],
            'no_kontak'               => [$isAnonim ? 'nullable' : 'required', 'string', 'max:20'],
            'email_pribadi'           => ['nullable', 'email', 'max:255'],
        ];

        $validated = $request->validate($rules);

        $laporan = WbsLaporan::create(array_merge($validated, [
            'is_anonim' => $isAnonim,
        ]));

        // Kirim notifikasi token ke WA & Email jika pelapor mengisi identitas (non-anonim)
        $this->kirimNotifikasiToken($laporan);

        return redirect()
            ->route('wbs.index')
            ->with('success_token', $laporan->ticket_token)
            ->with('open_tab', 'pelaporan');
    }

    private function kirimNotifikasiToken(WbsLaporan $laporan): void
    {
        // Kirim WhatsApp via Fonnte
        if (!empty($laporan->no_kontak)) {
            $pesan = "Terima kasih telah menyampaikan laporan melalui *Whistleblowing System* "
                . "Dana Pensiun Bank Riau Kepri.\n\n"
                . "Nomor Tiket Anda:\n*{$laporan->ticket_token}*\n\n"
                . "Simpan nomor tiket ini untuk melacak status laporan Anda melalui halaman "
                . "Lacak Pelaporan di situs resmi kami.\n\n"
                . "Kerahasiaan identitas dan laporan Anda kami jamin sepenuhnya.";

            FonnteService::sendMessage($laporan->no_kontak, $pesan);
        }

        // Kirim Email
        if (!empty($laporan->email_pribadi)) {
            try {
                Mail::to($laporan->email_pribadi)->send(new WbsTokenMail($laporan));
            } catch (\Throwable $e) {
                Log::error('Gagal mengirim email token WBS: ' . $e->getMessage());
            }
        }
    }
    public function lacak(Request $request)
    {
        $request->validate([
            'ticket_token' => ['required', 'string'],
        ]);

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
}
