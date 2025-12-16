<?php

namespace Database\Seeders;
use App\Models\Media;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Media::create([
                'ref_table' => 'proyek',
                'ref_id' => $i,
                'file_url' => 'public/uploads'.$i.'.png',
                'mime_type' => 'image/jpeg/jpg/png',
                'caption' => 'Dokumentasi proyek ke-' . $i,
            ]);
        }
    }
}
