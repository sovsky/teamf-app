<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Pobranie użytkowników
         $user1 = User::find(1);
         $user2 = User::find(2);
 
         // Sprawdzenie, czy użytkownicy istnieją
         if ($user1 && $user2) {
             // Pobranie produktów
             $product1 = Product::find(1);
             $product2 = Product::find(2);
             $product3 = Product::find(3);
             $product4 = Product::find(4);
 
             // Sprawdzenie, czy produkty istnieją
             if ($product1 && $product2) {
                 $user1->products()->attach([$product1->id, $product2->id]); // Przywiązanie produktów do użytkownika 1
             }
 
             if ($product3 && $product4) {
                 $user2->products()->attach([$product3->id, $product4->id]); // Przywiązanie produktów do użytkownika 2
             }
         }
    }
}
