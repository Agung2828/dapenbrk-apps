<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\GalleryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * LIST GALLERY
     * GET /admin/gallery
     */
    public function index()
    {
        $galleries = Gallery::with('items')->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * FORM CREATE
     * GET /admin/gallery/create
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * STORE GALLERY + FOTO
     * POST /admin/gallery
     */
    public function store(Request $request)
    {
        // VALIDASI
        $request->validate([
            'judul'     => 'required|string|max:255',
            'lokasi'    => 'nullable|string|max:255',
            'images'    => 'required|array',
            'images.*'  => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // SIMPAN GALLERY
        $gallery = Gallery::create([
            'judul'  => $request->judul,
            'lokasi' => $request->lokasi,
        ]);

        // SIMPAN FOTO
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $i => $image) {
                $path = $image->store('gallery', 'public');

                GalleryItem::create([
                    'gallery_id' => $gallery->id,
                    'image'      => $path,
                    'caption'    => $request->captions[$i] ?? null,
                ]);
            }
        }

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery berhasil ditambahkan');
    }

    /**
     * DELETE SATU FOTO
     * DELETE /admin/gallery-item/{id}
     */
    public function destroyItem($id)
    {
        $item = GalleryItem::findOrFail($id);

        // HAPUS FILE
        if (Storage::disk('public')->exists($item->image)) {
            Storage::disk('public')->delete($item->image);
        }

        // HAPUS DB
        $item->delete();

        return back()->with('success', 'Foto berhasil dihapus');
    }

    /**
     * DELETE GALLERY + SEMUA FOTO
     * DELETE /admin/gallery/{id}
     */
    public function destroy($id)
    {
        $gallery = Gallery::with('items')->findOrFail($id);

        // HAPUS SEMUA FOTO
        foreach ($gallery->items as $item) {
            if (Storage::disk('public')->exists($item->image)) {
                Storage::disk('public')->delete($item->image);
            }
            $item->delete();
        }

        // HAPUS GALLERY
        $gallery->delete();

        return redirect()
            ->route('admin.gallery.index')
            ->with('success', 'Gallery dan semua fotonya berhasil dihapus');
    }
}
