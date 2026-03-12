<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Dokumen;

class DokumenController extends Controller
{
    public function index()
    {
        return view('admin.dokumen.index', [
            'pensiuns'   => Dokumen::where('kategori', 'pensiun')->latest()->get(),
            'peraturans' => Dokumen::where('kategori', 'peraturan')->latest()->get(),
            'pedomans'   => Dokumen::where('kategori', 'pedoman')->latest()->get(),
            'psos'       => Dokumen::where('kategori', 'pso')->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.dokumen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori' => 'required|in:pensiun,peraturan,pedoman,pso'
        ]);

        $data = $request->only([
            'kategori',
            'jenis',
            'nama',
            'judul',
            'deskripsi',
            'tahun',
            'kode'
        ]);

        if ($request->kategori === 'peraturan' && $request->hasFile('file_pdf')) {
            $data['file_pdf'] = $request->file('file_pdf')
                ->store('peraturan', 'public');
        }

        Dokumen::create($data);

        return redirect()
            ->route('admin.dokumen.index')
            ->with('success', 'Data berhasil disimpan');
    }

    public function destroy($id)
    {
        $doc = Dokumen::findOrFail($id);

        if ($doc->file_pdf) {
            Storage::disk('public')->delete($doc->file_pdf);
        }

        $doc->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }
}
