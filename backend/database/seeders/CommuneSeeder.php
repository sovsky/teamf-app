<?php

namespace Database\Seeders;

use App\Models\Voivodeship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommuneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(base_path("database/data/communes.csv"), "r");

        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            DB::table('communes')->insert(
                [
                    'name' => $data[0],
                    'district_id' => $data[1]
                ]
            );
        }
    }
}
