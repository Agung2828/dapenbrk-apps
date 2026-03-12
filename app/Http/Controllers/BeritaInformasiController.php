<?php

namespace App\Http\Controllers;

use App\Models\BeritaInformasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\Slider;

class BeritaInformasiController extends Controller
{
    /**
     * LIST / INDEX ADMIN
     * route: GET /admin/berita
     */
    public function index()
    {
        $berita = BeritaInformasi::orderByDesc('tanggal')->get();
        return view('admin.berita.index', compact('berita'));
    }

    /**
     * FORM CREATE ADMIN
     * route: GET /admin/berita/create
     */
    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * DASHBOARD USER
     * route: GET /  atau /dashboard
     */
    public function dashboard()
    {
        $berita = BeritaInformasi::orderByDesc('tanggal')->get();

        $sliders = Slider::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('Dashboard', compact('berita', 'sliders'));
    }

    public function detail($id)
    {
        $berita = BeritaInformasi::findOrFail($id);
        return view('admin.berita.detail', compact('berita'));
    }

    /**
     * STORE (CREATE) - MULTI INPUT
     * route: POST /admin/berita
     */
    public function store(Request $request)
    {
        $request->validate([
            'kategori'    => 'required|array',
            'kategori.*'  => 'required|string',
            'tanggal'     => 'required|array',
            'tanggal.*'   => 'required|date',
            'foto'        => 'nullable|array',
            'foto.*'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'judul'       => 'required|array',
            'judul.*'     => 'required|string|max:255',
            'deskripsi'   => 'required|array',
            'deskripsi.*' => 'required',
        ]);

        foreach ($request->kategori as $index => $kategori) {
            $namaFoto = null;

            if ($request->hasFile("foto.$index")) {
                $file = $request->file("foto.$index");

                $original     = $file->getClientOriginalName();
                $safeOriginal = preg_replace('/\s+/', '_', $original);

                $namaFoto = (string) Str::uuid() . '_' . $safeOriginal;

                $file->move(public_path('uploads/berita'), $namaFoto);
            }

            BeritaInformasi::create([
                'kategori'  => $kategori,
                'tanggal'   => $request->tanggal[$index],
                'foto'      => $namaFoto,
                'judul'     => $request->judul[$index],
                'deskripsi' => $request->deskripsi[$index],
            ]);
        }

        // ✅ admin resource berada di /admin/berita
        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    /**
     * FORM EDIT ADMIN
     * route: GET /admin/berita/{berita}/edit
     */
    public function edit($id)
    {
        $berita = BeritaInformasi::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * UPDATE (EDIT)
     * route: PUT/PATCH /admin/berita/{berita}
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori'  => 'required|string',
            'tanggal'   => 'required|date',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required',
        ]);

        $berita = BeritaInformasi::findOrFail($id);

        // upload foto baru jika ada
        if ($request->hasFile('foto')) {

            // hapus foto lama
            if (!empty($berita->foto)) {
                $oldFotoName = basename(str_replace('\\', '/', $berita->foto));
                $oldPath = public_path('uploads/berita/' . $oldFotoName);

                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            $file = $request->file('foto');

            $original     = $file->getClientOriginalName();
            $safeOriginal = preg_replace('/\s+/', '_', $original);

            $namaFoto = (string) Str::uuid() . '_' . $safeOriginal;
            $file->move(public_path('uploads/berita'), $namaFoto);

            $berita->foto = $namaFoto;
        }

        $berita->update([
            'kategori'  => $request->kategori,
            'tanggal'   => $request->tanggal,
            'judul'     => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto'      => $berita->foto, // bisa null atau nama foto baru
        ]);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * SHOW (DETAIL BERITA - PUBLIC)
     * route: GET /berita/{id}
     */


    public function show($id)
    {
        $berita = BeritaInformasi::findOrFail($id);
        return view('show', compact('berita'));
    }

    /**
     * DELETE
     * route: DELETE /admin/berita/{berita}
     */
    public function destroy($id)
    {
        $berita = BeritaInformasi::findOrFail($id);

        // hapus foto jika ada
        if (!empty($berita->foto)) {
            $fotoName = basename(str_replace('\\', '/', $berita->foto));
            $path = public_path('uploads/berita/' . $fotoName);

            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $berita->delete();

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }
}
