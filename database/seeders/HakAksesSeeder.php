<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HakAksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hak_akses')->insert([
            [
                'hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2',
                'hak_akses_kode' => 'SUP',
                'hak_akses_nama' => 'Super Admin',
                'hak_akses_status' => 1,
                'hak_akses_keterangan' => 'all menu',
                'hak_akses_created_at' => now(),
                'hak_akses_updated_at' => now(),
                'hak_akses_deleted_at' => null,
            ],
            [
                'hak_akses_id' => 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2',
                'hak_akses_kode' => 'MN',
                'hak_akses_nama' => 'Manager',
                'hak_akses_status' => 1,
                'hak_akses_keterangan' => 'approval',
                'hak_akses_created_at' => now(),
                'hak_akses_updated_at' => now(),
                'hak_akses_deleted_at' => null,
            ],
            [
                'hak_akses_id' => 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2',
                'hak_akses_kode' => 'SL-1',
                'hak_akses_nama' => 'Sales',
                'hak_akses_status' => 1,
                'hak_akses_keterangan' => 'manage customer',
                'hak_akses_created_at' => now(),
                'hak_akses_updated_at' => now(),
                'hak_akses_deleted_at' => null,
            ]
        ]);
    }
}
