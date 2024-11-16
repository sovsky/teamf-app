<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\AidTypeSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\AidCategorySeeder;
use Database\Seeders\ProductCategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AidTypeSeeder::class,
            AidCategorySeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            VoivodeshipSeeder::class,
            DistrictSeeder::class,
            CommuneSeeder::class,
            CitySeeder::class,
        ]);
    }
}
