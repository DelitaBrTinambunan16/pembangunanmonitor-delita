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
        Schema::create('media', function (Blueprint $table) {
            $table->bigIncrements('media_id');   // Primary Key
            $table->string('ref_table');         // Nama tabel referensi (ex: users)
            $table->unsignedBigInteger('ref_id'); // ID dari tabel referensi
            $table->string('file_url');          // Lokasi file disimpan
            $table->string('caption')->nullable();
            $table->string('mime_type')->nullable();
            $table->integer('sort_order')->nullable();

            // Tidak pakai timestamps karena model kamu mematikan timestamps
            // $table->timestamps();  <-- tidak digunakan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
