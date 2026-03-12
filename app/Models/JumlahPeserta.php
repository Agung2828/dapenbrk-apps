<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JumlahPeserta extends Model
{
    use HasFactory;

    protected $table = 'jumlah_pesertas'; // nama tabel di database

    protected $fillable = [
        'peserta_aktif',
        'pensiun_ditunda',
        'pensiun_normal',
        'pensiun_dipercepat',
        'pensiun_janda_duda',
        'pensiun_anak',
    ];
}
