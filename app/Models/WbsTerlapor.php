<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WbsTerlapor extends Model
{
    protected $table = 'wbs_terlapors';

    protected $fillable = [
        'wbs_laporan_id',
        'nama_terlapor',
        'jabatan_terlapor',
        'info_tambahan_terlapor',
    ];

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(WbsLaporan::class, 'wbs_laporan_id');
    }
}
