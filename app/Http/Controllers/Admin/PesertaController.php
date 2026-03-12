<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PesertaImport;

class PesertaController extends Controller
{
    /* ======================================================
       LIST + SEARCH
    ====================================================== */
    public function index(Request $request)
    {
        $q = $request->get('q');

        $pesertas = Peserta::query()
            ->when($q, function ($query) use ($q) {
                $query->where('kode', 'like', "%$q%")
                    ->orWhere('nik', 'like', "%$q%")
                    ->orWhere('nama', 'like', "%$q%");
            })
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        return view('admin.peserta.index', compact('pesertas', 'q'));
    }

    /* ======================================================
       CREATE
    ====================================================== */
    public function create()
    {
        return view('admin.peserta.create');
    }

    /* ======================================================
       STORE
    ====================================================== */
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode'            => 'required|string|max:50|unique:pesertas,kode',
            'nik'             => 'required|string|max:30|unique:pesertas,nik',
            'nama'            => 'required|string|max:150',
            'tanggal_lahir'   => 'nullable|date',
            'tanggal_jadi'    => 'nullable|date',
            'tanggal_pensiun' => 'nullable|date',
            'phdp'            => 'required|integer|min:0',
        ]);

        Peserta::create($data);

        return redirect()
            ->route('admin.peserta.index')
            ->with('success', 'Peserta berhasil ditambahkan.');
    }

    /* ======================================================
       EDIT
    ====================================================== */
    public function edit(Peserta $pesertum)
    {
        $peserta = $pesertum;
        return view('admin.peserta.edit', compact('peserta'));
    }

    /* ======================================================
       UPDATE
    ====================================================== */
    public function update(Request $request, Peserta $pesertum)
    {
        $peserta = $pesertum;

        $data = $request->validate([
            'kode'            => 'required|string|max:50|unique:pesertas,kode,' . $peserta->id,
            'nik'             => 'required|string|max:30|unique:pesertas,nik,' . $peserta->id,
            'nama'            => 'required|string|max:150',
            'tanggal_lahir'   => 'nullable|date',
            'tanggal_jadi'    => 'nullable|date',
            'tanggal_pensiun' => 'nullable|date',
            'phdp'            => 'required|integer|min:0',
        ]);

        $peserta->update($data);

        return redirect()
            ->route('admin.peserta.index')
            ->with('success', 'Peserta berhasil diupdate.');
    }

    /* ======================================================
       DELETE
    ====================================================== */
    public function destroy(Peserta $pesertum)
    {
        $pesertum->delete();

        return back()->with('success', 'Peserta berhasil dihapus.');
    }

    /* ======================================================
       DELETE ALL
    ====================================================== */
    public function destroyAll()
    {
        Peserta::truncate();

        return redirect()
            ->route('admin.peserta.index')
            ->with('success', 'Semua peserta berhasil dihapus.');
    }

    /* ======================================================
       IMPORT EXCEL
    ====================================================== */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        Excel::import(new PesertaImport, $request->file('file'));

        return back()->with('success', 'Data peserta berhasil diimport dari Excel.');
    }

    /* ======================================================
       SHOW
    ====================================================== */
    public function show(Peserta $pesertum)
    {
        //
    }

    /* ======================================================
       API SEARCH PESERTA (UNTUK AJAX / SIMULASI LAMA)
    ====================================================== */
    public function search(Request $request)
    {
        $q = $request->get('q');

        if (!$q) {
            return response()->json([
                'found'   => false,
                'message' => 'Query tidak boleh kosong',
            ], 400);
        }

        $peserta = Peserta::where('kode', $q)
            ->orWhere('nik', $q)
            ->first();

        if (!$peserta) {
            return response()->json([
                'found'   => false,
                'message' => 'Data peserta tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'found'           => true,
            'kode'            => $peserta->kode,
            'nik'             => $peserta->nik,
            'nama'            => $peserta->nama,
            'phdp'            => $peserta->phdp,
            'tanggal_lahir'   => optional($peserta->tanggal_lahir)->format('Y-m-d'),
            'tanggal_jadi'    => optional($peserta->tanggal_jadi)->format('Y-m-d'),
            'tanggal_pensiun' => optional($peserta->tanggal_pensiun)->format('Y-m-d'),
        ]);
    }

    /* ======================================================
       🔥 VERIFY PESERTA (UNTUK SIMULASI BARU)
       Cukup NIK/Kode + Tanggal Lahir
       → otomatis return: nama, phdp, tanggal_jadi, tanggal_pensiun
    ====================================================== */
    public function verify(Request $request)
    {
        $key          = $request->get('key');
        $tanggalLahir = $request->get('tanggal_lahir');

        if (!$key || !$tanggalLahir) {
            return response()->json([
                'found'   => false,
                'message' => 'Mohon isi Kode/NIK dan Tanggal Lahir.',
            ]);
        }

        $peserta = Peserta::where(function ($q) use ($key) {
            $q->where('kode', $key)
                ->orWhere('nik', $key);
        })
            ->whereDate('tanggal_lahir', $tanggalLahir)
            ->first();

        if (!$peserta) {
            return response()->json([
                'found'   => false,
                'message' => 'Data tidak ditemukan atau tanggal lahir tidak sesuai.',
            ]);
        }

        return response()->json([
            'found'           => true,
            'nama'            => $peserta->nama,
            'phdp'            => $peserta->phdp,
            'tanggal_jadi'    => optional($peserta->tanggal_jadi)->format('Y-m-d'),
            'tanggal_pensiun' => optional($peserta->tanggal_pensiun)->format('Y-m-d'),
        ]);
    }
}
