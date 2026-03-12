<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $fillable = [
        'kode',
        'nik',
        'nama',
        'tanggal_lahir',      // ✅ tambah
        'tanggal_jadi',
        'tanggal_pensiun',    // ✅ tambah
        'phdp',
    ];

    protected $casts = [
        'tanggal_lahir'   => 'date',   // ✅ tambah
        'tanggal_jadi'    => 'date',
        'tanggal_pensiun' => 'date',   // ✅ tambah
    ];
}
