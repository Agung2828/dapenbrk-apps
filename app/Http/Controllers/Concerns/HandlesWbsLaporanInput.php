<?php

namespace App\Http\Controllers\Concerns;

use App\Models\WbsBuktiLaporan;
use App\Models\WbsLaporan;
use App\Support\WbsOptions;
use Illuminate\Http\Request;

trait HandlesWbsLaporanInput
{
    protected function wbsLaporanRules(bool $isAnonim): array
    {
        return [
            'kategori_pengaduan'                  => ['required', 'string'],
            'deskripsi_kejadian'                  => ['required', 'string'],
            'deskripsi_kerugian'                  => ['nullable', 'string'],
            'nama_lengkap'                         => [$isAnonim ? 'nullable' : 'required', 'string', 'max:255'],
            'hubungan_dapen'                       => [$isAnonim ? 'nullable' : 'required', 'string'],
            'nomor_identitas'                      => ['nullable', 'string', 'max:50'],
            'no_kontak'                            => [$isAnonim ? 'nullable' : 'required', 'string', 'max:20'],
            'email_pribadi'                        => ['nullable', 'email', 'max:255'],
            'terlapor'                             => ['required', 'array', 'min:1'],
            'terlapor.*.nama_terlapor'             => ['required', 'string', 'max:255'],
            'terlapor.*.jabatan_terlapor'          => ['nullable', 'string'],
            'terlapor.*.info_tambahan_terlapor'    => ['nullable', 'string'],
            'bukti'                                => ['nullable', 'array', 'max:' . WbsOptions::buktiMaxFiles()],
            'bukti.*'                              => [
                'file',
                'max:' . (WbsOptions::buktiMaxSizeMb() * 1024),
                'mimes:' . implode(',', WbsOptions::buktiExt()),
            ],
        ];
    }

    protected function saveTerlaporDanBukti(WbsLaporan $laporan, Request $request): void
    {
        foreach ($request->input('terlapor', []) as $t) {
            if (empty(trim($t['nama_terlapor'] ?? ''))) {
                continue;
            }
            $laporan->terlapors()->create([
                'nama_terlapor'          => $t['nama_terlapor'],
                'jabatan_terlapor'       => $t['jabatan_terlapor'] ?? null,
                'info_tambahan_terlapor' => $t['info_tambahan_terlapor'] ?? null,
            ]);
        }

        foreach ($request->file('bukti', []) as $file) {
            if (!$file || !$file->isValid()) {
                continue;
            }
            $ext  = strtolower($file->getClientOriginalExtension());
            $path = $file->store('wbs-bukti', 'public');

            $laporan->bukti()->create([
                'nama_file_asli' => $file->getClientOriginalName(),
                'path_file'      => $path,
                'mime_type'      => $file->getMimeType(),
                'ekstensi'       => $ext,
                'ukuran_bytes'   => $file->getSize(),
                'jenis_bukti'    => WbsBuktiLaporan::jenisDariEkstensi($ext),
            ]);
        }
    }
}
