<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AidCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // remote
        $remoteId = DB::table('type_of_aid')->where('name', 'zdalna')->first()->id;
        DB::table('aid_categories')->insert([
            ['type_of_aid_id' => $remoteId, 'name' => 'medyczna/teleporada'],
            ['type_of_aid_id' => $remoteId, 'name' => 'psychologiczna'],
        ]);

        // personal
        $personalId = DB::table('type_of_aid')->where('name', 'osobista')->first()->id;
        DB::table('aid_categories')->insert([
            ['type_of_aid_id' => $personalId, 'name' => 'materialna/żywność'],
            ['type_of_aid_id' => $personalId, 'name' => 'materialna/środki czystości'],
            ['type_of_aid_id' => $personalId, 'name' => 'materialna/odzież'],
            ['type_of_aid_id' => $personalId, 'name' => 'psychologiczna'],
            ['type_of_aid_id' => $personalId, 'name' => 'medyczna/osobista'],
            ['type_of_aid_id' => $personalId, 'name' => 'budowlana'],
            ['type_of_aid_id' => $personalId, 'name' => 'logistyczna'],
        ]);
    }
}
