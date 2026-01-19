<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin Panda',
            'email' => 'admin@panda.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kasir Cantik',
            'email' => 'kasir@panda.com',
            'password' => Hash::make('123456'),
            'role' => 'kasir',
        ]);
    }
}