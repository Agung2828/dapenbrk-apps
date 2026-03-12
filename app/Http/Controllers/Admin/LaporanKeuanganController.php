<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaporanKeuangan;

class LaporanKeuanganController extends Controller
{
    // Tampilkan daftar laporan di admin
    public function index()
    {
        $laporans = LaporanKeuangan::latest()->get();
        return view('admin.laporan.index', compact('laporans'));
    }

    // Tampilkan form tambah laporan
    public function create()
    {
        return view('admin.laporan.create');
    }

    // Simpan laporan baru
    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
            'judul' => 'required',
            'file'  => 'required|mimes:pdf|max:5000',
        ]);

        $fileName = 'DPBRK-LKA-' . $request->tahun . '.' . $request->file->extension();
        $request->file->move(public_path('uploads/laporan'), $fileName);

        LaporanKeuangan::create([
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'file'  => $fileName,
        ]);

        return redirect()
            ->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil ditambahkan');
    }

    // Update laporan
    public function update(Request $request, LaporanKeuangan $laporan)
    {
        $request->validate([
            'tahun' => 'required',
            'judul' => 'required',
            'file'  => 'nullable|mimes:pdf|max:5000',
        ]);

        $fileName = $laporan->file;

        if ($request->hasFile('file')) {
            // hapus file lama
            if ($laporan->file && file_exists(public_path('uploads/laporan/' . $laporan->file))) {
                unlink(public_path('uploads/laporan/' . $laporan->file));
            }

            $fileName = 'DPBRK-LKA-' . $request->tahun . '.' . $request->file->extension();
            $request->file->move(public_path('uploads/laporan'), $fileName);
        }

        $laporan->update([
            'tahun' => $request->tahun,
            'judul' => $request->judul,
            'file'  => $fileName,
        ]);

        return redirect()
            ->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil diperbarui');
    }

    // Hapus laporan
    public function destroy(LaporanKeuangan $laporan)
    {
        if ($laporan->file && file_exists(public_path('uploads/laporan/' . $laporan->file))) {
            unlink(public_path('uploads/laporan/' . $laporan->file));
        }

        $laporan->delete();

        return redirect()
            ->route('admin.laporan.index')
            ->with('success', 'Laporan berhasil dihapus');
    }

    // Halaman publik / formulir
    public function tampilLaporan()
    {
        $laporans = LaporanKeuangan::latest()->get();
        return view('formulir', compact('laporans'));
    }
}
