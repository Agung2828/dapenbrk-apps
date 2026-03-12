<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BeritaInformasi extends Model
{
    use HasFactory;

    protected $table = 'beritainformasi';

    protected $fillable = [
        'kategori',
        'tanggal',
        'foto',
        'judul',
        'deskripsi',
    ];
}
