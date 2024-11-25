<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::firstOrCreate(['name' => 'admin']);

        $admin = User::firstOrCreate(
            ['email' => 'admin3@example.com'], 
            [
                'name' => 'Admin',
                'password' => Hash::make('Mkankm12@m'), 
                'age' => '1990-01-01',
                'phone_number' => '+48123456789',
                'city_id' => 1,
                'picture' => null,
                'is_picture_public' => false,
                'role_id' => $role->id, 
            ]
        );

        $this->command->info('Admin account created or updated successfully.');
    }
}
