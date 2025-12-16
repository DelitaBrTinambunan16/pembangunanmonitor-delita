<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin default (anti duplicate)
        User::firstOrCreate(
            ['email' => 'kael15@gmail.com'],
            [
                'name' => 'kael',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Dummy user lain
        $faker = Faker::create('id_ID');

        foreach (range(1, 30) as $i) {
            User::firstOrCreate(
                ['email' => $faker->unique()->safeEmail()],
                [
                    'name' => $faker->name(),
                    'password' => Hash::make('password'),
                    'role' => $faker->randomElement(['admin', 'staff', 'user']),
                ]
            );
        }
    }
}
