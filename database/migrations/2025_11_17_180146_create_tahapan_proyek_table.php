<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tahapan_proyek', function (Blueprint $table) {
            $table->id('tahap_id'); // Primary key
            $table->unsignedBigInteger('proyek_id'); // Foreign key
            $table->string('nama_tahap');
            $table->decimal('target_persen', 5, 2); // Contoh: 50.00%
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('proyek_id')->references('proyek_id')->on('proyek')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tahapan_proyek');
    }
};
