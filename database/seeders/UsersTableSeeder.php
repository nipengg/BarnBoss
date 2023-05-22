<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'role' => 1,
            'phone' => '085217295708',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@example.com',
            'role' => 0,
            'phone' => '082419204951',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'seller',
            'email' => 'seller@example.com',
            'role' => 2,
            'phone' => '082491502151',
            'password' => bcrypt('12345678'),
        ]);
    }
}
