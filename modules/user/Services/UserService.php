<?php

namespace Modules\Hakakses\Services;

use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Modules\Hakakses\Models\HakaksesModel;
use Modules\Login\Models\UserModel;

class HakaksesService
{
    public function getHakaksesById($id)
    {
        return HakaksesModel::find($id);
    }

    public function getHakaksesQuery()
    {
        return HakaksesModel::query()
            ->whereNull('hak_akses_deleted_at')
            ->orderByDesc('hak_akses_created_at');
    }

    public function storeHakakses($data)
    {
        try {
            $hakaksesId = Uuid::uuid4()->toString();
            $hakAkses = HakaksesModel::create([
                'hak_akses_id' => $hakaksesId,
                'hak_akses_kode' => $data['hak_akses_kode'],
                'hak_akses_nama' => $data['hak_akses_nama'],
                'hak_akses_status' => 1,
                'hak_akses_keterangan' => null,
                'hak_akses_created_at' => now(),
                'hak_akses_updated_at' => null,
                'hak_akses_deleted_at' => null
            ]);

            return $hakAkses;
        } catch (\Exception $e) {
            throw new \Exception('Gagal menyimpan data hak akses: ' . $e->getMessage());
        }
    }

    public function updateHakakses($id, $data)
    {
        try {
            $readHakakses = HakaksesModel::find($id);

            if ($readHakakses) {
                $readHakakses->hak_akses_nama = $data['hak_akses_nama'];
                $readHakakses->hak_akses_kode = $data['hak_akses_kode'];
                $readHakakses->hak_akses_updated_at = now();
                $readHakakses->save();

                return $readHakakses;
            }

            return null;
        } catch (\Exception $e) {
            throw new \Exception('Gagal memperbarui data hak akses: ' . $e->getMessage());
        }
    }

    public function deleteHakakses($id)
    {
        try {
            $hakakses = HakaksesModel::find($id);
            if ($hakakses) {
                $hakakses->delete();
                return $hakakses;
            }

            return null;
        } catch (\Exception $e) {
            throw new \Exception('Gagal menghapus data hak akses: ' . $e->getMessage());
        }
    }

    public function getMenuRoles($hakAksesId)
    {
        $menu = DB::table('menu')
            ->orderBy('menu_order', 'asc')
            ->get();

        $menuRoles = DB::table('v_menu_role')
            ->where('menu_role_hak_akses_id', $hakAksesId)
            ->orderBy('menu_order', 'asc')
            ->select('menu_role_menu_id')
            ->get();

        $menuRolesArray = $menuRoles->pluck('menu_role_menu_id')->toArray();

        $menu = $menu->map(function ($menuItem) use ($menuRolesArray) {
            $menuItem->is_active = in_array($menuItem->menu_id, $menuRolesArray);
            return $menuItem;
        });

        return $menu;
    }

    public function updateHakaksesMenuRoles($aksesHakAksesId, $requestData)
    {
        try {
            DB::beginTransaction();

            DB::table('menu_role')
                ->where('menu_role_hak_akses_id', $aksesHakAksesId)
                ->delete();

            $menuIds = array_keys($requestData);
            $menuIds = array_filter($menuIds, function ($key) {
                return $key !== 'akses_hak_akses_id';
            });

            $menuIds = array_filter($menuIds, function ($value) use ($requestData) {
                return $requestData[$value] == 1;
            });

            $menuRoleData = [];
            foreach ($menuIds as $menuId) {
                $menuRoleData[] = [
                    'menu_role_id' => Uuid::uuid4()->toString(),
                    'menu_role_hak_akses_id' => $aksesHakAksesId,
                    'menu_role_menu_id' => $menuId,
                ];
            }

            if (count($menuRoleData) > 0) {
                DB::table('menu_role')->insert($menuRoleData);
            }

            DB::commit();

            return ['success' => true, 'message' => 'Menu roles berhasil diperbarui'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}