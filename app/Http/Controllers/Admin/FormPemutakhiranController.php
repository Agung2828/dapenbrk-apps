<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FormPemutakhiran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FormPemutakhiranController extends Controller
{
    /**
     * ============================
     * ADMIN AREA
     * ============================
     */

    // List data di admin
    public function index()
    {
        $data = FormPemutakhiran::latest()->get();
        return view('admin.form_pemutakhiran.index', compact('data'));
    }

    // Form tambah
    public function create()
    {
        return view('admin.form_pemutakhiran.create');
    }

    // Simpan data
    public function store(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'file_pdf' => 'required|mimes:pdf|max:2048',
        ]);

        // Pastikan folder upload ada
        $path = public_path('uploads/form_pemutakhiran');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        // Upload file
        $file = $request->file('file_pdf');
        $namaFile = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
        $file->move($path, $namaFile);

        // Simpan ke database (TANPA STATUS)
        FormPemutakhiran::create([
            'judul'    => $request->judul,
            'file_pdf' => $namaFile,
        ]);

        return redirect()
            ->route('admin.form-pemutakhiran.index')
            ->with('success', 'Form Pemutakhiran berhasil ditambahkan');
    }

    // Hapus data
    public function destroy($id)
    {
        $data = FormPemutakhiran::findOrFail($id);

        $filePath = public_path('uploads/form_pemutakhiran/' . $data->file_pdf);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }

        $data->delete();

        return back()->with('success', 'Form Pemutakhiran berhasil dihapus');
    }

    /**
     * ============================
     * USER / PUBLIK AREA
     * ============================
     */

    // Tampil di halaman formulir publik
    public function listPublik()
    {
        $formPemutakhiran = FormPemutakhiran::orderBy('judul', 'asc')->get();

        return view('formulir', compact('formPemutakhiran'));
    }
}
