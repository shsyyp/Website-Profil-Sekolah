<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Membuat akun admin SMAN Pintar
        User::create([
            'name'     => 'Administrator',
            'email'    => 'admin@smanpintar.sch.id',
            'password' => bcrypt('password123'),
        ]);
    }
}