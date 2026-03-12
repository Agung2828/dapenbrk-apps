<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Warta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WartaController extends Controller
{
    // ================= ADMIN =================

    public function index()
    {
        $wartas = Warta::latest()->get();
        return view('admin.warta.index', compact('wartas'));
    }

    public function create()
    {
        return view('admin.warta.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'    => 'required',
            'kategori' => 'required',
            'tanggal'  => 'required',
            'file_pdf' => 'required|mimes:pdf|max:10240',
        ]);

        $path = $request->file('file_pdf')->store('warta', 'public');

        Warta::create([
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori'  => $request->kategori,
            'tanggal'   => $request->tanggal,
            'file_pdf'  => $path,
        ]);

        return redirect()->route('admin.warta.index')
            ->with('success', 'Warta berhasil ditambahkan');
    }

    // ✅ HAPUS DATA
    public function destroy($id)
    {
        $warta = Warta::findOrFail($id);

        // hapus file pdf kalau ada
        if ($warta->file_pdf && Storage::disk('public')->exists($warta->file_pdf)) {
            Storage::disk('public')->delete($warta->file_pdf);
        }

        $warta->delete();

        return redirect()->route('admin.warta.index')
            ->with('success', 'Warta berhasil dihapus');
    }

    // ================= USER =================

    public function warta()
    {
        $wartas = Warta::latest()->get();
        return view('Warta', compact('wartas'));
    }
}
