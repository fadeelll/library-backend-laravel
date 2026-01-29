<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void 
    {
        // Data Admin
        User::create([
            'name' => 'Admin Perpus',
            'email' => 'admin@mail.com',
            'password' => 'password', // Plain text karena di Model sudah ada 'hashed' cast
            'role' => 'admin',
        ]);

        // Data Siswa
        User::create([
            'name' => 'Siswa Ganteng',
            'email' => 'siswa@mail.com',
            'password' => 'password', // Samakan agar tidak bingung saat login
            'role' => 'siswa',
        ]);
    } // Penutup fungsi run
} // Penutup class UserSeeder