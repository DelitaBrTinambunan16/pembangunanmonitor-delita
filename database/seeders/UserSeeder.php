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
            'name'     => 'kael',
            'email'    => 'kael15@gmail.com',
            'password' => Hash::make('12345'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'lia staff',
            'email'    => 'lia24@gmail.com',
            'password' => Hash::make('123456'),
            'role'     => 'staff',
        ]);

        User::create([
            'name'     => 'User1',
            'email'    => 'user1@gmail.com',
            'password' => Hash::make('123456'),
            'role'     => 'user',
        ]);
    }
}
