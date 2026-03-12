<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jumlah_pesertas', function (Blueprint $table) {
            $table->id();
            $table->integer('peserta_aktif')->default(0);
            $table->integer('pensiun_ditunda')->default(0);
            $table->integer('pensiun_normal')->default(0);
            $table->integer('pensiun_dipercepat')->default(0);
            $table->integer('pensiun_janda_duda')->default(0);
            $table->integer('pensiun_anak')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jumlah_pesertas');
    }
};
