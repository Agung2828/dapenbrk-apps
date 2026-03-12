<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormPemutakhiran extends Model
{
    protected $table = 'form_pemutakhiran';

    protected $fillable = [
        'judul',
        'file_pdf',
    ];
}
