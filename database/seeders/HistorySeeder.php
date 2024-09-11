<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HistorySeeder extends Seeder
{

    public function run()
    {
        DB::table('histories')->truncate();

        DB::table('histories')->insert([
            [
                'email' => 'user1@example.com',
                'phone' => '1234567890',
                'name' => 'User One',
                'id_user' => 1,
                'price' => 15000,
                'created_at' => now(),
                'updated_at' => now(),
                'slug_history' => 1,
                'approve' => 1,
            ],
            [
                'email' => 'user2@example.com',
                'phone' => '0987654321',
                'name' => 'User Two',
                'id_user' => 2,
                'price' => 20000,
                'created_at' => now(),
                'updated_at' => now(),
                'slug_history' => 0,
                'approve' => 2,
            ],
            [
                'email' => 'user3@example.com',
                'phone' => '1122334455',
                'name' => 'User Three',
                'id_user' => 3,
                'price' => 25000,
                'created_at' => now(),
                'updated_at' => now(),
                'slug_history' => 0,
                'approve' => 2,
            ],
        ]);
    }
}
