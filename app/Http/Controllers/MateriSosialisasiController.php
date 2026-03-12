<?php

namespace App\Http\Controllers;

use App\Models\MateriSosialisasi;
use Illuminate\Http\Request;

class MateriSosialisasiController extends Controller
{
    // index admin
    public function index()
    {
        $materis = MateriSosialisasi::orderBy('created_at', 'desc')->get();
        return view('admin.materi_sosialisasi.index', compact('materis'));
    }

    // show form create
    public function create()
    {
        return view('admin.materi_sosialisasi.create');
    }

    // store data
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_pdf' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->only(['judul', 'deskripsi']);

        if ($request->hasFile('file_pdf')) {
            $file = $request->file('file_pdf');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/materi_sosialisasi'), $filename);
            $data['file_pdf'] = $filename;
        }

        MateriSosialisasi::create($data);

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil ditambahkan.');
    }

    // show form edit
    public function edit(MateriSosialisasi $materi)
    {
        return view('admin.materi_sosialisasi.edit', compact('materi'));
    }

    // update data
    public function update(Request $request, MateriSosialisasi $materi)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file_pdf' => 'nullable|mimes:pdf|max:2048',
        ]);

        $data = $request->only(['judul', 'deskripsi']);

        if ($request->hasFile('file_pdf')) {
            // hapus file lama jika ada
            if ($materi->file_pdf && file_exists(public_path('uploads/materi_sosialisasi/' . $materi->file_pdf))) {
                unlink(public_path('uploads/materi_sosialisasi/' . $materi->file_pdf));
            }

            $file = $request->file('file_pdf');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/materi_sosialisasi'), $filename);
            $data['file_pdf'] = $filename;
        }

        $materi->update($data);

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil diperbarui.');
    }

    // delete data
    public function destroy(MateriSosialisasi $materi)
    {
        if ($materi->file_pdf && file_exists(public_path('uploads/materi_sosialisasi/' . $materi->file_pdf))) {
            unlink(public_path('uploads/materi_sosialisasi/' . $materi->file_pdf));
        }

        $materi->delete();

        return redirect()->route('admin.materi.index')->with('success', 'Materi berhasil dihapus.');
    }
}
