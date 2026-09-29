<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class WbsLaporan extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_token',
        'is_anonim',
        'nama_lengkap',
        'hubungan_dapen',
        'nomor_identitas',
        'no_kontak',
        'email_pribadi',
        'kategori_pengaduan',
        'deskripsi_kejadian',
        'deskripsi_kerugian',
        'status',
        'catatan_admin',
    ];

    protected $casts = [
        'is_anonim' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function (WbsLaporan $laporan) {
            if (empty($laporan->ticket_token)) {
                $laporan->ticket_token = self::generateUniqueToken();
            }
        });
    }

    public function terlapors(): HasMany
    {
        return $this->hasMany(WbsTerlapor::class, 'wbs_laporan_id');
    }

    public function bukti(): HasMany
    {
        return $this->hasMany(WbsBuktiLaporan::class, 'wbs_laporan_id');
    }

    public static function generateUniqueToken(): string
    {
        do {
            $token = 'dapenbrk-' . Str::random(6);
        } while (self::where('ticket_token', $token)->exists());

        return $token;
    }

    public static function statusLabel(string $status): string
    {
        return match ($status) {
            'diajukan'      => 'Diajukan',
            'diterima'      => 'Diterima',
            'dalam_antrian' => 'Dalam Antrian',
            'diproses'      => 'Diproses',
            'ditolak'       => 'Ditolak',
            'selesai'       => 'Selesai',
            default         => ucfirst($status),
        };
    }
}
