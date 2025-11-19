<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Proyek;

class TahapanProyekSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Ambil semua proyek_id dari tabel proyek
        $proyekIDs = Proyek::pluck('proyek_id')->toArray();

        // Jika tidak ada proyek, hentikan
        if (empty($proyekIDs)) {
            dd("Seeder gagal: Tidak ada data proyek. Jalankan ProyekSeeder dulu.");
        }

        foreach (range(1, 20) as $inde) {

            $mulai = $faker->dateTimeBetween('-1 years', 'now');
            $selesai = $faker->dateTimeBetween($mulai, '+6 months');

            DB::table('tahapan_proyek')->insert([   // <-- FIX NAMA TABEL
                'proyek_id' => $faker->randomElement($proyekIDs),
                'nama_tahap' => $faker->randomElement([
                    'Perencanaan', 'Pengajuan', 'Proses', 'Monitoring', 'Selesai'
                ]),
                'target_persen' => $faker->randomFloat(2, 10, 100), // Decimal 5,2
                'tgl_mulai' => $mulai,
                'tgl_selesai' => $selesai,
            ]);
        }
    }
}
