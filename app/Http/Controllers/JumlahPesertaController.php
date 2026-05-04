<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JumlahPeserta;

class JumlahPesertaController extends Controller
{
    /**
     * Admin: Tampilkan data jumlah peserta
     */
    public function index()
    {
        // Ambil data terbaru berdasarkan tahun & bulan
        $data = JumlahPeserta::orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->first();

        // Jika belum ada → buat otomatis dengan bulan & tahun sekarang
        if (!$data) {
            $data = JumlahPeserta::create([
                'bulan'             => (int) date('n'),
                'tahun'             => (int) date('Y'),
                'peserta_aktif'     => 0,
                'pensiun_ditunda'   => 0,
                'pensiun_normal'    => 0,
                'pensiun_dipercepat' => 0,
                'pensiun_janda_duda' => 0,
                'pensiun_anak'      => 0,
            ]);
        }

        // Semua histori untuk tabel riwayat
        $histori = JumlahPeserta::orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->get();

        return view('admin.jumlahpeserta.index', compact('data', 'histori'));
    }

    /**
     * Admin: Form edit
     */
    public function edit($id)
    {
        $data = JumlahPeserta::findOrFail($id);
        return view('admin.jumlahpeserta.edit', compact('data'));
    }

    /**
     * Admin: Simpan update
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'bulan'              => 'required|integer|min:1|max:12',
            'tahun'              => 'required|integer|min:2000|max:2100',
            'peserta_aktif'      => 'required|integer|min:0',
            'pensiun_ditunda'    => 'required|integer|min:0',
            'pensiun_normal'     => 'required|integer|min:0',
            'pensiun_dipercepat' => 'required|integer|min:0',
            'pensiun_janda_duda' => 'required|integer|min:0',
            'pensiun_anak'       => 'required|integer|min:0',
        ]);

        $data = JumlahPeserta::findOrFail($id);
        $data->update($validated);

        return redirect()
            ->route('admin.jumlah-peserta.index')
            ->with('success', 'Data peserta bulan ' . $data->nama_bulan . ' ' . $data->tahun . ' berhasil diupdate!');
    }

    /**
     * Admin: Tambah data baru (bulan/tahun berbeda)
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bulan'              => 'required|integer|min:1|max:12',
            'tahun'              => 'required|integer|min:2000|max:2100',
            'peserta_aktif'      => 'required|integer|min:0',
            'pensiun_ditunda'    => 'required|integer|min:0',
            'pensiun_normal'     => 'required|integer|min:0',
            'pensiun_dipercepat' => 'required|integer|min:0',
            'pensiun_janda_duda' => 'required|integer|min:0',
            'pensiun_anak'       => 'required|integer|min:0',
        ]);

        // Cek apakah bulan+tahun sudah ada
        $exists = JumlahPeserta::where('bulan', $validated['bulan'])
            ->where('tahun', $validated['tahun'])
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->with('error', 'Data untuk bulan dan tahun tersebut sudah ada. Silakan edit data yang sudah ada.');
        }

        JumlahPeserta::create($validated);

        return redirect()
            ->route('admin.jumlah-peserta.index')
            ->with('success', 'Data peserta berhasil ditambahkan!');
    }

    /**
     * Admin: Hapus data
     */
    public function destroy($id)
    {
        $data = JumlahPeserta::findOrFail($id);
        $label = $data->nama_bulan . ' ' . $data->tahun;
        $data->delete();

        return redirect()
            ->route('admin.jumlah-peserta.index')
            ->with('success', "Data peserta {$label} berhasil dihapus!");
    }

    /**
     * User: Halaman kepesertaan — tampilkan data terbaru
     */
    public function kepesertaan()
    {
        $data = JumlahPeserta::orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->first();

        return view('kepesertaan', compact('data'));
    }
}
