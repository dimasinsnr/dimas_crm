<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2',
                'name' => 'admin',
                'email' => 'superadmin@mail.com',
                'password' => Hash::make('secret'),
                'phone' => null,
                'location' => null,
                'about_me' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'hak_akses_id' => 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2',
                'name' => 'sales 1',
                'email' => 'sales1@mail.com',
                'password' => Hash::make('password123'),
                'phone' => 23523523423,
                'location' => null,
                'about_me' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'id' => 3,
                'hak_akses_id' => 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2',
                'name' => 'sales 2',
                'email' => 'sales2@mail.com',
                'password' => Hash::make('password123'),
                'phone' => 7864356356735,
                'location' => null,
                'about_me' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ],
            [
                'id' => 4,
                'hak_akses_id' => 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2',
                'name' => 'Manager',
                'email' => 'manager@mail.com',
                'password' => Hash::make('password123'),
                'phone' => 63562346345,
                'location' => null,
                'about_me' => null,
                'remember_token' => null,
                'created_at' => now(),
                'updated_at' => now(),
                'deleted_at' => null,
            ]
        ]);
    }
}
