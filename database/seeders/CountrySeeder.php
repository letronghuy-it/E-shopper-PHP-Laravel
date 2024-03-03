<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{

    public function run()
    {
        DB::table('countrys')->delete();
        DB::table('countrys')->truncate();

        DB::table('countrys')->insert([
            // Các quốc gia ở Châu Âu
            ['title' => 'Albania'],
            ['title' => 'Andorra'],
            ['title' => 'Austria'],
            ['title' => 'Belarus'],
            ['title' => 'Belgium'],
            ['title' => 'Bosnia and Herzegovina'],
            ['title' => 'Bulgaria'],
            ['title' => 'Croatia'],
            ['title' => 'Cyprus'],
            ['title' => 'Czech Republic'],
            ['title' => 'Denmark'],
            ['title' => 'Estonia'],
            ['title' => 'Finland'],
            ['title' => 'France'],
            ['title' => 'Germany'],
            ['title' => 'Greece'],
            ['title' => 'Hungary'],
            ['title' => 'Iceland'],
            ['title' => 'Ireland'],
            ['title' => 'Italy'],
            ['title' => 'Kosovo'],
            ['title' => 'Latvia'],
            ['title' => 'Liechtenstein'],
            ['title' => 'Lithuania'],
            ['title' => 'Luxembourg'],
            ['title' => 'Malta'],
            ['title' => 'Moldova'],
            ['title' => 'Monaco'],
            ['title' => 'Montenegro'],
            ['title' => 'Netherlands'],
            ['title' => 'North Macedonia'],
            ['title' => 'Norway'],
            ['title' => 'Poland'],
            ['title' => 'Portugal'],
            ['title' => 'Romania'],
            ['title' => 'Russia'],
            ['title' => 'San Marino'],
            ['title' => 'Serbia'],
            ['title' => 'Slovakia'],
            ['title' => 'Slovenia'],
            ['title' => 'Spain'],
            ['title' => 'Sweden'],
            ['title' => 'Switzerland'],
            ['title' => 'Turkey'],
            ['title' => 'Ukraine'],
            ['title' => 'United Kingdom'],
            ['title' => 'Vatican City (Holy See)'],

            // Các quốc gia ở Đông Nam Á
            ['title' => 'Brunei'],
            ['title' => 'Cambodia'],
            ['title' => 'East Timor (Timor-Leste)'],
            ['title' => 'Indonesia'],
            ['title' => 'Laos'],
            ['title' => 'Malaysia'],
            ['title' => 'Myanmar (Burma)'],
            ['title' => 'Philippines'],
            ['title' => 'Singapore'],
            ['title' => 'Thailand'],
            ['title' => 'Vietnam']
        ]);

    }
}
