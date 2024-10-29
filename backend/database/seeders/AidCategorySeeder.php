<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AidCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // remote
        $remoteId = DB::table('aid_types')->where('name', 'zdalna')->first()->id;
        DB::table('aid_categories')->insert([
            ['aid_type_id' => $remoteId, 'name' => 'medyczna'],
            ['aid_type_id' => $remoteId, 'name' => 'psychologiczna'],
        ]);

        // personal
        $personalId = DB::table('aid_types')->where('name', 'osobista')->first()->id;
        DB::table('aid_categories')->insert([
            ['aid_type_id' => $personalId, 'name' => 'materialna'],
            ['aid_type_id' => $personalId, 'name' => 'psychologiczna'],
            ['aid_type_id' => $personalId, 'name' => 'medyczna'],
            ['aid_type_id' => $personalId, 'name' => 'budowlana'],
            ['aid_type_id' => $personalId, 'name' => 'logistyczna'],
        ]);
    }
}
