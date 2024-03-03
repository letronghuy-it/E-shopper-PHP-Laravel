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
                ['category' => 'Áo'],
                ['category' => 'Quần'],
                ['category' => 'Giày'],
                ['category' => 'Túi xách'],
                ['category' => 'Đồ lót'],
                ['category' => 'Phụ kiện'],
                ['category' => 'Đồ thể thao'],
                ['category' => 'Đồ ngủ'],
                ['category' => 'Đồ bơi'],
                ['category' => 'Đồ trẻ em']
            ]);

    }
}
