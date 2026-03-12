<?php

namespace App\Imports;

use App\Models\Peserta;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PesertaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Peserta([
            'kode'             => $row['kode'],
            'nik'              => $row['nik'],
            'nama'             => $row['nama'],
            'phdp'             => (int) $row['phdp'],

            'tanggal_lahir'   => $this->parseTanggal($row['tanggal_lahir']   ?? null),
            'tanggal_jadi'    => $this->parseTanggal($row['tanggal_jadi']    ?? null),
            'tanggal_pensiun' => $this->parseTanggal($row['tanggal_pensiun'] ?? null),
        ]);
    }

    private function parseTanggal($value)
    {
        if (!$value) {
            return null;
        }

        try {
            // Kalau Excel kirim numeric date
            if (is_numeric($value)) {
                return Carbon::instance(
                    \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)
                )->format('Y-m-d');
            }

            // Kalau string (yyyy-mm-dd atau dd/mm/yyyy)
            return Carbon::parse($value)->format('Y-m-d');
        } catch (\Exception $e) {
            return null;
        }
    }
}
