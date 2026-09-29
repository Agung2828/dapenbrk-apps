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

            // NB: identitas terlapor sekarang di tabel wbs_terlapors (bisa lebih dari satu
            // orang per laporan), jadi kolom nama_terlapor/jabatan_terlapor/info_tambahan_terlapor
            // milik versi lama TIDAK dibuat lagi di sini.

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

        // Multi-terlapor: satu laporan bisa punya lebih dari satu pihak yang dilaporkan
        // (mis. kasus kolusi/kerja sama antar-divisi atau dengan pihak luar).
        Schema::create('wbs_terlapors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wbs_laporan_id')
                ->constrained('wbs_laporans')
                ->cascadeOnDelete();
            $table->string('nama_terlapor');
            $table->string('jabatan_terlapor')->nullable();
            $table->text('info_tambahan_terlapor')->nullable();
            $table->timestamps();
        });

        // Bukti pendukung: satu laporan bisa melampirkan lebih dari satu file
        // (PDF, Word, gambar, audio, atau video).
        Schema::create('wbs_bukti_laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wbs_laporan_id')
                ->constrained('wbs_laporans')
                ->cascadeOnDelete();
            $table->string('nama_file_asli');
            $table->string('path_file');
            $table->string('mime_type')->nullable();
            $table->string('ekstensi', 10)->nullable();
            $table->unsignedBigInteger('ukuran_bytes')->nullable();
            $table->enum('jenis_bukti', ['dokumen', 'gambar', 'audio', 'video', 'lainnya'])
                ->default('lainnya');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wbs_bukti_laporans');
        Schema::dropIfExists('wbs_terlapors');
        Schema::dropIfExists('wbs_laporans');
    }
};
