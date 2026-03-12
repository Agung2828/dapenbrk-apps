<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;

class PeraturanController extends Controller
{
    public function index()
    {
        return view('Peraturan', [
            // ================= PENSIUN =================
            'normal' => Dokumen::where('kategori', 'pensiun')
                ->where('jenis', 'normal')
                ->orderBy('nama')
                ->get(),

            'dipercepat' => Dokumen::where('kategori', 'pensiun')
                ->where('jenis', 'dipercepat')
                ->orderBy('nama')
                ->get(),

            'janda' => Dokumen::where('kategori', 'pensiun')
                ->where('jenis', 'janda')
                ->orderBy('nama')
                ->get(),

            'anak' => Dokumen::where('kategori', 'pensiun')
                ->where('jenis', 'anak')
                ->orderBy('nama')
                ->get(),

            // ================= PERATURAN PDF =================
            'peraturans' => Dokumen::where('kategori', 'peraturan')
                ->orderByDesc('tahun')
                ->get(),

            // ================= PEDOMAN =================
            'pedomans' => Dokumen::where('kategori', 'pedoman')
                ->orderBy('kode')
                ->get(),

            // ================= PSO =================
            'psos' => Dokumen::where('kategori', 'pso')
                ->orderBy('kode')
                ->get(),
        ]);
    }
}
