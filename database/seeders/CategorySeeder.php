<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{

    public function run()
    {
        DB::table('categories')->delete();
        DB::table('categories')->truncate();

        DB::table('categories')->insert([
            [
                'category' => 'Áo',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Quần',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Giày',  'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Túi xách',  'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Đồ lót',  'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Phụ kiện',  'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Đồ thể thao',  'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Đồ ngủ',  'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Đồ bơi',  'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category' => 'Đồ trẻ em',  'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
