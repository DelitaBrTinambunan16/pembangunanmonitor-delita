<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'     => 'Admin',
            'email'    => 'Delita@gmail.com',
            'password' => Hash::make('1234561'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'filbert staff',
            'email'    => 'staff1@gmail.com',
            'password' => Hash::make('123456'),
            'role'     => 'staff',
        ]);

        User::create([
            'name'     => 'User Biasa1',
            'email'    => 'user1@gmail.com',
            'password' => Hash::make('123456'),
            'role'     => 'user',
        ]);
    }
}
