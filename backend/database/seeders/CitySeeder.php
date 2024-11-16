<?php

namespace Database\Seeders;

use App\Models\Voivodeship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("database/data/cities.csv"), "r");

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            DB::table('cities')->insert(
                [
                    'name' => $data[0],
                    'voivodeship_id' => $data[1],
                    'district_id' => $data[2],
                    'commune_id' => $data[3]
                ]
            );
        }
    }
}
