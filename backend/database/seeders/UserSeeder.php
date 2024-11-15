<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
             // Tworzenie użytkowników
        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('Mkan!2mkanj#2mkanj'),
            'city' => 'Warsaw',
            'age' => '1990-09-12',
            'phone_number' => '500900100'
        ]);
        
        $user2 = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => bcrypt('Mkan!2mkanj#2mkanj'),
            'city' => 'Warsaw',
            'age' => '1990-09-12',
            'phone_number' => '500900100'
        ]);
        
        $user3 = User::create([
            'name' => 'Alice Brown',
            'email' => 'alice@example.com',
            'password' => bcrypt('Mkan!2mkanj#2mkanj'),
            'city' => 'Warsaw',
            'age' => '1990-09-12',
            'phone_number' => '500900100'
        ]);

        // Pobranie id kategorii pomocy
        $materialAidCategoryId = DB::table('aid_categories')->where('name', 'materialna')->first()->id;
        $psychologicalAidCategoryId = DB::table('aid_categories')->where('name', 'psychologiczna')->first()->id;
        $constructionAidCategoryId = DB::table('aid_categories')->where('name', 'budowlana')->first()->id;

        // Przypisanie produktów do użytkowników
        // Produkty "materialna"
        $product1 = Product::create([
            'name' => 'Ryż',
            'aid_category_id' => $materialAidCategoryId,
        ]);
        
        $product2 = Product::create([
            'name' => 'Mleko',
            'aid_category_id' => $materialAidCategoryId,
        ]);
        
        $product3 = Product::create([
            'name' => 'Konsultacja psychologiczna',
            'aid_category_id' => $psychologicalAidCategoryId,
        ]);
        
        $product4 = Product::create([
            'name' => 'Malowanie ścian',
            'aid_category_id' => $constructionAidCategoryId,
        ]);
        
        // Możesz dodać inne produkty dla innych użytkowników, jeśli chcesz.

        // Linkowanie produktów do użytkowników (jeśli nie przypisano już w procesie tworzenia)
        $user1->products()->attach([$product1->id, $product2->id]); // Przypisanie produktów do użytkownika
        $user2->products()->attach([$product3->id]);
        $user3->products()->attach([$product3->id, $product4->id]);

    }
}
