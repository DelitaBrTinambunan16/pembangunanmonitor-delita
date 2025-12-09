<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KontraktorSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $jenisKontraktor = ['CV', 'PT', 'Firma', 'Koperasi'];

        foreach (range(1, 20) as $index) {
            DB::table('kontraktor')->insert([
                'proyek_id'        => $faker->numberBetween(1, 100), // pastikan ada id proyek
                'nama'             => $faker->company . ' ' . $faker->randomElement($jenisKontraktor),
                'penanggung_jawab' => $faker->name,
                'kontak'           => $faker->phoneNumber,
                'alamat'           => $faker->address,
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }
    }
}
