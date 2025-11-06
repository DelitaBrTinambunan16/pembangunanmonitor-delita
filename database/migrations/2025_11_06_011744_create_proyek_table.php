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
        Schema::create('proyek', function (Blueprint $table) {
            $table->id('proyek_id');
            $table->string('kode_proyek')->unique();
            $table->string('nama_proyek');
            $table->year('tahun');
            $table->string('lokasi');
            $table->decimal('anggaran', 15, 2);
            $table->string('sumber_dana');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyek');
    }
};
