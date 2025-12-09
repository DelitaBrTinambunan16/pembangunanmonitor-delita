<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProgresProyekSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Asumsi: proyek_id dan tahap_id sudah ada di database
        $proyekIds = DB::table('proyek')->pluck('proyek_id')->toArray();
        $tahapIds  = DB::table('tahapan_proyek')->pluck('tahap_id')->toArray();

        foreach (range(1, 100) as $index) {
            DB::table('progres_proyek')->insert([
                'proyek_id'    => $faker->randomElement($proyekIds),
                'tahap_id'     => $faker->randomElement($tahapIds),
                'persen_real'  => $faker->randomFloat(2, 0, 100),
                'tanggal'      => $faker->date(),
                'catatan'      => $faker->sentence(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}
