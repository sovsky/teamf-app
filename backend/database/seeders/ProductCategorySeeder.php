<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public static function run(): void
    {
        DB::table('product_categories')->insert([
            ['name' => 'Produkty spożywcze'],
            ['name' => 'Artykuły dla zwierząt'],
            ['name' => 'Książki'],
            ['name' => 'Utrzymanie czystości'],
            ['name' => 'Odzież męska'],
            ['name' => 'Odzież damska'],
            ['name' => 'Zabawki'],
            ['name' => 'Elektronika'],
            ['name' => 'Zdrowie'],
            ['name' => 'Uroda'],
        ]);
    }
}
