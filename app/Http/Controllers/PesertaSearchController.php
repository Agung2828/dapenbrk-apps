<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PesertaSearchController extends Controller
{
    public function __invoke(Request $request)
    {
        $key          = trim($request->get('key', ''));
        $tanggalLahir = $request->get('tanggal_lahir');

        /* =========================================
           VALIDASI — cukup NIK + tanggal lahir
        ========================================= */
        if (!$key || !$tanggalLahir) {
            return response()->json([
                'found'   => false,
                'message' => 'Mohon isi Kode/NIK dan Tanggal Lahir.',
            ], 422);
        }

        /* =========================================
           CARI PESERTA BERDASARKAN KODE ATAU NIK
        ========================================= */
        $peserta = Peserta::where('kode', $key)
            ->orWhere('nik', $key)
            ->first();

        if (!$peserta) {
            return response()->json([
                'found'   => false,
                'message' => 'Peserta tidak ditemukan.',
            ]);
        }

        /* =========================================
           COCOKKAN TANGGAL LAHIR SAJA
        ========================================= */
        $dbTanggalLahir = $peserta->tanggal_lahir
            ? Carbon::parse($peserta->tanggal_lahir)->format('Y-m-d')
            : null;

        if ($dbTanggalLahir !== $tanggalLahir) {
            return response()->json([
                'found'   => false,
                'message' => 'Tanggal lahir tidak sesuai dengan data peserta.',
            ]);
        }

        /* =========================================
           COCOK → return nama, phdp, tanggal_jadi, tanggal_pensiun
        ========================================= */
        return response()->json([
            'found'           => true,
            'nama'            => $peserta->nama,
            'phdp'            => (int) $peserta->phdp,
            'tanggal_jadi'    => $peserta->tanggal_jadi
                ? Carbon::parse($peserta->tanggal_jadi)->format('Y-m-d')
                : null,
            'tanggal_pensiun' => $peserta->tanggal_pensiun
                ? Carbon::parse($peserta->tanggal_pensiun)->format('Y-m-d')
                : null,
        ]);
    }
}
