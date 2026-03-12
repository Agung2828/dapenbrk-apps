<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'order' => 'nullable|integer',
        ]);

        $path = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'title'       => $request->title,
            'description' => $request->description,
            'image'       => $path,
            'order'       => $request->order ?? 0,
            'is_active'   => true,
        ]);

        return redirect()->route('admin.slider.index')->with('success', 'Slider ditambahkan');
    }

    // ✅ INI YANG KAMU BUTUH BUAT HAPUS
    public function destroy(Slider $slider)
    {
        // hapus file gambar di storage
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }

        // hapus data
        $slider->delete();

        return redirect()->route('admin.slider.index')->with('success', 'Slider dihapus');
    }
}
