<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lokasi_proyek', function (Blueprint $table) {
            $table->id('lokasi_id');
            $table->unsignedBigInteger('proyek_id');
            $table->double('lat', 15, 8)->nullable();
            $table->double('lng', 15, 8)->nullable();
            $table->longText('geojson')->nullable();
            $table->timestamps();

            $table->foreign('proyek_id')->references('proyek_id')->on('proyek')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lokasi_proyek');
    }
};
