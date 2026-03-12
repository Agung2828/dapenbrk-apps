<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeraturanPdf extends Model
{
    use HasFactory;
    protected $fillable = ['judul', 'deskripsi', 'tahun', 'file_pdf'];
}
