<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class usermakeSeed extends Seeder
{

    public function run()
    {
         // Clear the users table
         DB::table('users')->delete();
         DB::table('users')->truncate();


         DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'email' => 'letronghuyit@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'phone' => '123-456-7890',
                'address' => '123 Admin Street',
                'id_country' => 1,
                'avatar' => 'admin-avatar.jpg',
                'remember_token' => Str::random(10),
                'level' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Regular User',
                'email' => 'letronghuy@gmial.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'phone' => '098-765-4321',
                'address' => '456 User Avenue',
                'id_country' => 2,
                'avatar' => 'user-avatar.jpg',
                'remember_token' => Str::random(10),
                'level' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
