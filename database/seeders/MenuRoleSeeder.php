<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['menu_role_id' => '016559fa-d571-4a1b-bda0-eebf6ad44527', 'menu_role_menu_id' => 'f1e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '110bcc77-dfa3-4059-90ad-3b0496f4e824', 'menu_role_menu_id' => '41e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '111fb8a7-298e-4c6c-8d25-ff1a51300d83', 'menu_role_menu_id' => 'p0h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '133b15a7-7336-4ee6-898c-7bedb275cbbf', 'menu_role_menu_id' => '13h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '13bcfbde-acc6-46c8-8660-c2af61ed652c', 'menu_role_menu_id' => 'a4m12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '1915f1b7-fcc4-4d33-bc14-0a01399a10b5', 'menu_role_menu_id' => '81e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '26fd61fb-62e2-4ca3-ba77-9d8c3419a62a', 'menu_role_menu_id' => 'p0h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '27c71d47-5dd6-484b-9ab7-8ea9819dd7cc', 'menu_role_menu_id' => 'p3h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '394d11b1-1036-4987-8960-43bd349897fe', 'menu_role_menu_id' => '81e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '44de220e-eaf9-43d4-b8d8-1f1786ad936d', 'menu_role_menu_id' => '91h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '46230b54-8496-4a49-a57e-2a9402568fdd', 'menu_role_menu_id' => '41e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '4877b660-0cc0-408c-a7bf-56e9b282b8f5', 'menu_role_menu_id' => '10h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '4fcd3610-9671-46cb-bdf8-d4ff6f259eb3', 'menu_role_menu_id' => '25w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '533dbc1f-f013-46a7-bb0d-82bddbb82a53', 'menu_role_menu_id' => '71h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '596ce251-a988-409b-923c-3011b90004aa', 'menu_role_menu_id' => '01e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '5ec30e00-2eab-4592-a722-2b29b8dc950d', 'menu_role_menu_id' => 'p3h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '6518851c-6c7b-45ab-9cae-7eb6a840b47e', 'menu_role_menu_id' => 'k5w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '7747e947-6eba-45f9-a969-d74960ff03b5', 'menu_role_menu_id' => 'f1e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '79a0faea-7cec-4f4b-82b7-4c1f1f230377', 'menu_role_menu_id' => '43h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '7f94915a-176a-48ba-86f8-717f560311af', 'menu_role_menu_id' => 'k5w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '87565aed-c0a0-4888-8c07-30dfcea07c30', 'menu_role_menu_id' => '43h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '88e318d5-7db6-4f1d-b5f3-440573707652', 'menu_role_menu_id' => 'q0h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '899c53e0-9769-4090-b1a1-aed1f8111033', 'menu_role_menu_id' => 'a4m12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '8b3b086a-8313-489b-b682-22b329195f84', 'menu_role_menu_id' => '05w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '8e095030-5d76-4cd0-8940-bbeef2ce9789', 'menu_role_menu_id' => 'm3h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => '90a79a99-9964-4804-9a5e-92aadca22a3f', 'menu_role_menu_id' => '25w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'a665609a-bc61-4148-a20e-abef807140d0', 'menu_role_menu_id' => 'z1h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'addcdffa-b1ca-4842-aaf7-0971e0a98304', 'menu_role_menu_id' => 'b5w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'b02575a9-396d-4418-a614-ba15ec2feea6', 'menu_role_menu_id' => 'a4m12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'b50e353d-6474-4730-8a33-74b35c363001', 'menu_role_menu_id' => '60h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'be657fc0-c7c6-4527-98d8-d6e817d978f6', 'menu_role_menu_id' => '53h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'bf8f2827-0a40-43cf-bda5-60526488d4d8', 'menu_role_menu_id' => '8ih69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'c08f304c-8f1d-4596-89dd-c909a71d2fa4', 'menu_role_menu_id' => '13h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'c80f1716-e248-40d6-95f1-c94249a641fc', 'menu_role_menu_id' => 'q0h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'c8ed2053-7747-4595-a391-b424307b0760', 'menu_role_menu_id' => '71h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'ccb8ef9c-c4a7-429c-bf0a-60f512021336', 'menu_role_menu_id' => '13h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'cf375bd5-ba00-4f74-a6cc-6ae701ea20ee', 'menu_role_menu_id' => 'p3h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'd451f7c7-d5d9-4169-ba7d-4a7ecd7678f4', 'menu_role_menu_id' => 'm3h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'e2b7998f-bdad-4c36-b4fa-f30b014bb7f3', 'menu_role_menu_id' => '10h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'ebf504f5-9e85-4ce4-b157-a50112645a48', 'menu_role_menu_id' => '8ih69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'ef7f2717-cf20-4ae0-8b9c-b537de0f2245', 'menu_role_menu_id' => '41e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'f02fab85-8046-479c-ad10-a1bca82fcbb0', 'menu_role_menu_id' => 'f1e12a1a-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'x6m2l6fe-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'fc7581c2-15ce-4fb8-8c4b-311235a17f16', 'menu_role_menu_id' => 'b5w82d3p-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
            ['menu_role_id' => 'ffec3296-b5ae-461c-bd33-f003a79a5cec', 'menu_role_menu_id' => 'z1h69n1j-67cd-408e-b4a8-e6c6ee1d6aa7', 'menu_role_hak_akses_id' => 'b0f5e2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2'],
        ];

        DB::table('menu_role')->insert($data);
    }
}
