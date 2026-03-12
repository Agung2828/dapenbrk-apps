<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $fillable = [
        'kategori',
        'jenis',
        'nama',
        'judul',
        'deskripsi',
        'tahun',
        'kode',
        'file_pdf',
    ];
}
