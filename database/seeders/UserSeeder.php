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
            'email'    => 'kael@gmail.com',
            'password' => Hash::make('1234561'),
            'role'     => 'admin',
        ]);

        User::create([
            'name'     => 'lia staff',
            'email'    => 'lia@gmail.com',
            'password' => Hash::make('123456'),
            'role'     => 'staff',
        ]);

        User::create([
            'name'     => 'User aja1',
            'email'    => 'user2@gmail.com',
            'password' => Hash::make('123456'),
            'role'     => 'user',
        ]);
    }
}
