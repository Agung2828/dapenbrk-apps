<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penerima_pensiuns', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->enum('jenis', ['normal', 'dipercepat', 'janda', 'anak']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerima_pensiuns');
    }
};
