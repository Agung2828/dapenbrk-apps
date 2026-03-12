<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MateriSosialisasi extends Model
{
    use HasFactory;

    protected $table = 'materi_sosialisasis';

    protected $fillable = [
        'judul',
        'deskripsi',
        'file_pdf'
    ];
}
