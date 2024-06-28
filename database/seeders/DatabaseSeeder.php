<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // Create Admin Master
        User::create([
            'name' => 'Admin Master',
            'email' => 'admin_master@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin_master',
            'departement' => 'PNB'
        ]);

        // Create Admin Jurusan
        User::create([
            'name' => 'Admin Jurusan',
            'email' => 'admin_jurusan@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin_jurusan',
            'departement' => 'jurusan PNB'
        ]);
    }
}
