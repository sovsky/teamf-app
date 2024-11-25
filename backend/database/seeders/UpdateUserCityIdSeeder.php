<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UpdateUserCityIdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::all()->each(function ($user) {
            $city = City::where('name', $user->city)->first(); 
            if ($city) {
                $user->city_id = $city->id;
                $user->save();
            }
        });
    }
}
