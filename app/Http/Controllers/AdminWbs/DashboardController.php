<?php

namespace App\Http\Controllers\AdminWbs;

use App\Http\Controllers\Concerns\HandlesWbsLaporanInput;
use App\Http\Controllers\Controller;
use App\Models\WbsLaporan;
use App\Support\WbsOptions;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use HandlesWbsLaporanInput;

    public function index(Request $request)
    {
        $query = WbsLaporan::with('terlapors')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('ticket_token', 'like', '%' . $request->q . '%')
                    ->orWhere('nama_lengkap', 'like', '%' . $request->q . '%')
                    ->orWhere('kategori_pengaduan', 'like', '%' . $request->q . '%');
            });
        }

        return view('adminwbs.dashboard', [
            'laporans'   => $query->paginate(10)->withQueryString(),
            'statusList' => WbsOptions::statusList(),
        ]);
    }

    public function show(WbsLaporan $laporan)
    {
        $laporan->load(['terlapors', 'bukti']);
        return view('adminwbs.show', ['laporan' => $laporan]);
    }

    public function updateStatus(Request $request, WbsLaporan $laporan)
    {
        $validated = $request->validate([
            'status'        => ['required', 'in:diajukan,diterima,dalam_antrian,diproses,ditolak,selesai'],
            'catatan_admin' => ['nullable', 'string'],
        ]);

        $laporan->update($validated);

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function create()
    {
        return view('adminwbs.create', [
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
            'status'             => 'diterima', // laporan dari admin dianggap langsung diterima
        ]);

        $this->saveTerlaporDanBukti($laporan, $request);

        return redirect()
            ->route('adminwbs.laporan.show', $laporan)
            ->with('success', 'Laporan berhasil dibuat oleh admin.');
    }

    public function downloadPdf(WbsLaporan $laporan)
    {
        $laporan->load(['terlapors', 'bukti']);

        $pdf = Pdf::loadView('adminwbs.pdf', ['laporan' => $laporan])->setPaper('a4');

        return $pdf->download('Laporan-WBS-' . $laporan->ticket_token . '.pdf');
    }
}
