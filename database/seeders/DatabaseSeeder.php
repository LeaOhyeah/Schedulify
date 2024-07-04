<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Meeting;
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

        //     // Create Admin Master
        //     User::create([
        //         'name' => 'Admin Master',
        //         'email' => 'admin_master@example.com',
        //         'password' => Hash::make('password'),
        //         'role' => 'admin_master',
        //         'departement' => 'PNB'
        //     ]);

        //     // Create Admin Jurusan
        //     User::create([
        //         'name' => 'Admin Jurusan',
        //         'email' => 'admin_jurusan@example.com',
        //         'password' => Hash::make('password'),
        //         'role' => 'admin_jurusan',
        //         'departement' => 'jurusan PNB'
        //     ]);


        // // Create Agenda
        // Meeting::create([
        //     'user_id' => 2, // admin jurusan 
        //     'activity' => 'kegiatan 1',
        //     'date' => '2024-07-13',
        //     'location' => 'gedung 1',
        //     'start_time' => '08:00:00',
        //     'pic' => 'John Smith, main director of the Bali State Polytechnic'
        // ]);
        // Meeting::create([
        //     'user_id' => 2, // admin jurusan 
        //     'activity' => 'kegiatan 2',
        //     'date' => '2024-07-14',
        //     'location' => 'gedung 2',
        //     'start_time' => '08:00:00',
        //     'pic' => 'John Smith, main director of the Bali State Polytechnic'
        // ]);
        // Meeting::create([
        //     'user_id' => 2, // admin jurusan 
        //     'activity' => 'kegiatan 3',
        //     'date' => '2024-07-13',
        //     'location' => 'gedung 3',
        //     'start_time' => '12:00:00',
        //     'pic' => 'John Smith, main director of the Bali State Polytechnic'
        // ]);
        // Meeting::create([
        //     'user_id' => 2, // admin jurusan 
        //     'activity' => 'kegiatan 4',
        //     'date' => '2024-07-13',
        //     'location' => 'gedung 4',
        //     'start_time' => '18:00:00',
        //     'pic' => 'John Smith, main director of the Bali State Polytechnic'
        // ]);


    }
}
