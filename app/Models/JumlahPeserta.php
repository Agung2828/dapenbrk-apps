<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JumlahPeserta extends Model
{
    use HasFactory;

    protected $table = 'jumlah_pesertas';

    protected $fillable = [
        'bulan',
        'tahun',
        'peserta_aktif',
        'pensiun_ditunda',
        'pensiun_normal',
        'pensiun_dipercepat',
        'pensiun_janda_duda',
        'pensiun_anak',
    ];

    // Helper: nama bulan dalam Bahasa Indonesia
    public function getNamaBulanAttribute(): string
    {
        $bulan = [
            1  => 'Januari',
            2  => 'Februari',
            3  => 'Maret',
            4  => 'April',
            5  => 'Mei',
            6  => 'Juni',
            7  => 'Juli',
            8  => 'Agustus',
            9  => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];

        return $bulan[$this->bulan] ?? '-';
    }

    // Helper: total semua kategori
    public function getTotalPesertaAttribute(): int
    {
        return $this->peserta_aktif
            + $this->pensiun_ditunda
            + $this->pensiun_normal
            + $this->pensiun_dipercepat
            + $this->pensiun_janda_duda
            + $this->pensiun_anak;
    }
}
