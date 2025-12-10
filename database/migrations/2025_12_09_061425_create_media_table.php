<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id('media_id');
            $table->string('ref_table'); // proyek, progres_proyek, lokasi_proyek
            $table->unsignedBigInteger('ref_id'); // id record terkait
            $table->string('file_url'); // path file di uploads
            $table->string('caption')->nullable();
            $table->string('mime_type');
            $table->integer('sort_order')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
