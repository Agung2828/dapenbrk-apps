<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WbsBuktiLaporan extends Model
{
    protected $table = 'wbs_bukti_laporans';

    protected $fillable = [
        'wbs_laporan_id',
        'nama_file_asli',
        'path_file',
        'mime_type',
        'ekstensi',
        'ukuran_bytes',
        'jenis_bukti',
    ];

    public function laporan(): BelongsTo
    {
        return $this->belongsTo(WbsLaporan::class, 'wbs_laporan_id');
    }

    public static function jenisDariEkstensi(string $ext): string
    {
        $ext = strtolower($ext);

        return match (true) {
            in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp', 'heic'])           => 'gambar',
            in_array($ext, ['mp3', 'wav', 'ogg', 'm4a', 'aac', 'amr', 'opus', 'flac'])     => 'audio',
            in_array($ext, ['mp4', 'mov', 'avi', 'mkv', 'webm', '3gp', 'wmv', 'flv'])      => 'video',
            in_array($ext, ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'csv', 'rtf', 'odt']) => 'dokumen',
            default                                                                        => 'lainnya',
        };
    }
}
