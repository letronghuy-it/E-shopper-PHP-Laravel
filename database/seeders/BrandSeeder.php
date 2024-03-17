<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{

    public function run()
    {
        DB::table('brands')->delete();
        DB::table('brands')->truncate();

        DB::table('brands')->insert([
            [
                'brand' => 'Gucci',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'brand' => 'Louis Vuitton',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'brand' => 'Prada',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'brand' => 'Armani',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'brand' => 'Versace',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'brand' => 'Dolce & Gabbana',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'brand' => 'Chanel',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'brand' => 'Burberry',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'brand' => 'Dior',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'brand' => 'Hermès',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
