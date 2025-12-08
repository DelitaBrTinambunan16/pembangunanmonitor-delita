<?php
namespace Database\Seeders;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProyekSeeder extends Seeder
{
    public function run(): void
    {
        //gunakan id_ID untuk data indonesia
        $faker = Faker::create('id_ID');

        // Tambahkan jenis proyek di sini
        $jenisProyek = [
            'Pembangunan Jalan',
            'Renovasi Gedung',
            'Pembangunan Jembatan',
            'Perbaikan Drainase',
            'Pembangunan Sekolah',
            'Pembangunan Pasar',
            'Pengadaan Fasilitas Umum',
        ];

        foreach (range(1, 100) as $index) {
            DB::table('proyek')->insert([
                'kode_proyek' => 'PRJ-' . strtoupper($faker->unique()->bothify('??###')),
                'nama_proyek' => $faker->randomElement($jenisProyek) . ' ' . $faker->city(),
                'tahun'       => $faker->year(),
                'lokasi'      => $faker->city(),
                'anggaran'    => $faker->randomFloat(2, 10000000, 500000000),
                'sumber_dana' => $faker->randomElement(['APBD', 'APBN', 'Dana Desa', 'CSR']),
                'deskripsi'   => $faker->text(100),
            ]);
        }
    }
}
