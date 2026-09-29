<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wbs_laporans', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_token', 30)->unique();

            // Identitas Pelapor
            $table->boolean('is_anonim')->default(false);
            $table->string('nama_lengkap')->nullable();
            $table->string('hubungan_dapen')->nullable(); // karyawan, peserta_pensiunan, vendor, masyarakat_umum
            $table->string('nomor_identitas')->nullable(); // NIK / NIP / No. Kepesertaan
            $table->string('no_kontak')->nullable();       // WhatsApp / telepon
            $table->string('email_pribadi')->nullable();

            // Kategori & Deskripsi Laporan
            $table->string('kategori_pengaduan');
            $table->text('deskripsi_kejadian');
            $table->text('deskripsi_kerugian')->nullable();

            // Identitas Terlapor
            $table->string('nama_terlapor');
            $table->string('jabatan_terlapor')->nullable();
            $table->text('info_tambahan_terlapor')->nullable();

            // Status & Tindak Lanjut (diisi/diupdate admin nanti)
            $table->enum('status', [
                'diajukan',
                'diterima',
                'dalam_antrian',
                'diproses',
                'ditolak',
                'selesai',
            ])->default('diajukan');
            $table->text('catatan_admin')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wbs_laporans');
    }
};
