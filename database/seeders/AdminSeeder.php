<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Membuat akun admin SMAN Pintar
        User::updateOrCreate(
            ['email' => 'admin@smanpintar.sch.id'],
            [
                'name'     => 'Administrator',
                'password' => bcrypt('password123'),
            ]
        );
    }
}
