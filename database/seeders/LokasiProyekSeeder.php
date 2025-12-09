<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LokasiProyekSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $proyekIds = DB::table('proyek')->pluck('proyek_id');

        foreach ($proyekIds as $id) {
            DB::table('lokasi_proyek')->insert([
                'proyek_id' => $id,
                'lat'       => $faker->latitude(-8.0, 6.0),
                'lng'       => $faker->longitude(95.0, 141.0),
                'geojson'   => json_encode([
                    'type' => 'Point',
                    'coordinates' => [(float)$faker->longitude(95.0, 141.0), (float)$faker->latitude(-8.0, 6.0)]
                ]),
            ]);
        }
    }
}
