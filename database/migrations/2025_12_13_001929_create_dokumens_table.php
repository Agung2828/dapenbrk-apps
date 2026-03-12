<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dokumens', function (Blueprint $table) {
            $table->id();

            // kategori utama
            $table->string('kategori');
            // pensiun: normal | dipercepat | janda | anak
            $table->string('jenis')->nullable();

            // umum
            $table->string('nama')->nullable();
            $table->string('judul')->nullable();
            $table->text('deskripsi')->nullable();

            // khusus peraturan
            $table->year('tahun')->nullable();
            $table->string('file_pdf')->nullable();

            // pedoman / pso
            $table->string('kode')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumens');
    }
};
