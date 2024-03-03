<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{

    public function run()
    {

        Schema::disableForeignKeyConstraints();
        $this->call(CountrySeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);
    }
}
