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
            ['brand' => 'Gucci'],
            ['brand' => 'Louis Vuitton'],
            ['brand' => 'Prada'],
            ['brand' => 'Armani'],
            ['brand' => 'Versace'],
            ['brand' => 'Dolce & Gabbana'],
            ['brand' => 'Chanel'],
            ['brand' => 'Burberry'],
            ['brand' => 'Dior'],
            ['brand' => 'Hermès']
        ]);

    }
}
