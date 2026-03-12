<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('pesertas', function (Blueprint $table) {
            $table->id();

            /* =========================
               DATA UTAMA
            ========================== */
            $table->string('kode', 50)->unique();
            $table->string('nik', 30)->unique();
            $table->string('nama', 150);

            /* =========================
               TANGGAL-TANGGAL (🔥 BARU)
            ========================== */
            $table->date('tanggal_lahir')->nullable();     // 🔥 baru
            $table->date('tanggal_jadi')->nullable();      // peserta aktif
            $table->date('tanggal_pensiun')->nullable();   // 🔥 baru

            /* =========================
               KEUANGAN
            ========================== */
            $table->unsignedBigInteger('phdp'); // angka murni (tanpa Rp)

            $table->timestamps();

            /* =========================
               INDEX (biar search cepat)
            ========================== */
            $table->index(['kode', 'nik']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pesertas');
    }
};
