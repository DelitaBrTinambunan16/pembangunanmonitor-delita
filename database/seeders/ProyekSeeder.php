<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProyekSeeder extends Seeder
{
    public function run():void
    {
        //gunakan id_ID untuk data indonesia
        $faker = Faker::create('id_ID');

        foreach (range(1, 50) as $index) {
            DB::table('proyek')->insert([
                'kode_proyek' => 'PRJ-' . strtoupper($faker->unique()->bothify('??###')),
                'nama_proyek' => $faker->sentence(3),
                'tahun' => $faker->year(),
                'lokasi' => $faker->city(),
                'anggaran' => $faker->randomFloat(2, 10000000, 500000000),
                'sumber_dana' => $faker->randomElement(['APBD', 'APBN', 'Dana Desa', 'CSR']),
                'deskripsi' => $faker->text(100),
            ]);
        }
    }
}
