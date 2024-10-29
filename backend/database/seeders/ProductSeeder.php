<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aidCategory = DB::table('aid_categories')->where('name', 'materialna')->first()->id;

        $productCategory = DB::table('product_categories')->where('name', 'Produkty spożywcze')->first()->id;
        DB::table('products')->insert([
            ['name' => 'Ryż', 'aid_category_id' => $aidCategory, 'product_category_id' => $productCategory ],
            ['name' => 'Mleko', 'aid_category_id' => $aidCategory, 'product_category_id' => $productCategory ],
            ['name' => 'Chleb', 'aid_category_id' => $aidCategory, 'product_category_id' => $productCategory ],
            ['name' => 'Mąka', 'aid_category_id' => $aidCategory, 'product_category_id' => $productCategory ],
            ['name' => 'Makaron', 'aid_category_id' => $aidCategory, 'product_category_id' => $productCategory ],
            ['name' => 'Jajka', 'aid_category_id' => $aidCategory, 'product_category_id' => $productCategory ],
        ]);

        $productCategory = DB::table('product_categories')->where('name', 'Artykuły dla zwierząt')->first()->id;
        DB::table('products')->insert([
            ['name' => 'Karma sucha', 'aid_category_id' => $aidCategory, 'product_category_id' => $productCategory ],
            ['name' => 'Karma mokra', 'aid_category_id' => $aidCategory, 'product_category_id' => $productCategory ],
            ['name' => 'Zabawka dla psa', 'aid_category_id' => $aidCategory, 'product_category_id' => $productCategory ],
            ['name' => 'Zabawka dla kota', 'aid_category_id' => $aidCategory, 'product_category_id' => $productCategory ],
        ]);

        $aidCategory = DB::table('aid_categories')->where('name', 'psychologiczna')->first()->id;

        DB::table('products')->insert([
            ['name' => 'Konsultacja psychologiczna', 'aid_category_id' => $aidCategory ],
            ['name' => 'Konsultacja psychologiczna', 'aid_category_id' => $aidCategory ],
        ]);

        $aidCategory = DB::table('aid_categories')->where('name', 'budowlana')->first()->id;
        DB::table('products')->insert([
            ['name' => 'Malowanie ścian', 'aid_category_id' => $aidCategory ],
            ['name' => 'Remont', 'aid_category_id' => $aidCategory ],
            ['name' => 'Sprzątanie podwórka', 'aid_category_id' => $aidCategory ],
        ]);
    }
}
