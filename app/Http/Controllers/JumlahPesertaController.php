<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JumlahPeserta;

class JumlahPesertaController extends Controller
{
    public function index()
    {
        // AMBIL DATA PERTAMA
        $data = JumlahPeserta::first();

        // JIKA BELUM ADA → BUAT OTOMATIS
        if (!$data) {
            $data = JumlahPeserta::create([
                'peserta_aktif' => 0,
                'pensiun_ditunda' => 0,
                'pensiun_normal' => 0,
                'pensiun_dipercepat' => 0,
                'pensiun_janda_duda' => 0,
                'pensiun_anak' => 0,
            ]);
        }

        return view('admin.jumlahpeserta.index', compact('data'));
    }

    public function edit($id)
    {
        $data = JumlahPeserta::findOrFail($id);
        return view('admin.jumlahpeserta.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'peserta_aktif' => 'required|integer|min:0',
            'pensiun_ditunda' => 'required|integer|min:0',
            'pensiun_normal' => 'required|integer|min:0',
            'pensiun_dipercepat' => 'required|integer|min:0',
            'pensiun_janda_duda' => 'required|integer|min:0',
            'pensiun_anak' => 'required|integer|min:0',
        ]);

        $data = JumlahPeserta::findOrFail($id);
        $data->update($validated);

        return redirect()
            ->route('admin.jumlah-peserta.index')
            ->with('success', 'Data peserta berhasil diupdate!');
    }

    public function kepesertaan()
    {
        $data = JumlahPeserta::first();
        return view('kepesertaan', compact('data'));
    }
}
