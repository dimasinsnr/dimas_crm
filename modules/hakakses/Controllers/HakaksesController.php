<?php

namespace Modules\Hakakses\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Modules\Hakakses\Services\HakaksesService;

class HakaksesController extends Controller
{
    protected $hakaksesService;

    public function __construct(HakaksesService $hakaksesService)
    {
        $this->hakaksesService = $hakaksesService;
    }

    public function index()
    {
        return view('hakakses::hakakses', [
            'title' => 'Data Hak Akses'
        ]);
    }

    public function initTable(Request $request)
    {
        $query = $this->hakaksesService->getHakaksesQuery();

        return dataTables::of($query)
            ->addColumn('action', 'hakakses::ul-action')
            ->rawColumns(['action'])
            ->addIndexColumn(function ($data) {
                return $data->firstItem();
            })
            ->make(true);
    }

    public function storeData(Request $request)
    {
        try {
            if (!empty($request->hak_akses_id)) {
                $hakakses = $this->hakaksesService->updateHakakses($request->hak_akses_id, $request->all());
                return response()->json([
                    'success' => true,
                    'message' => 'Data Hak Akses berhasil diperbarui.',
                    'unitLatihan' => $hakakses
                ]);
            } else {
                $hakakses = $this->hakaksesService->storeHakakses($request->all());
                return response()->json([
                    'success' => true,
                    'message' => 'Data Hak Akses berhasil disimpan.',
                    'hakakses' => $hakakses
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteData(Request $request)
    {
        try {
            $hakakses = $this->hakaksesService->deleteHakakses($request->hak_akses_id);
            if ($hakakses) {
                return response()->json([
                    'success' => true,
                    'message' => 'Data Hak Akses berhasil dihapus.',
                    'hakakses' => $hakakses
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Data tidak ditemukan.'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function controlHakakses(Request $request)
    {
        try {
            $menu = $this->hakaksesService->getMenuRoles($request->hak_akses_id);
            return response()->json([
                'success' => true,
                'message' => 'Berhasil',
                'menu' => $menu
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function updateHakakses(Request $request)
    {
        $aksesHakAksesId = $request->input('akses_hak_akses_id');

        $result = $this->hakaksesService->updateHakaksesMenuRoles($aksesHakAksesId, $request->all());

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'message' => $result['message'],
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => $result['message'],
            ], 500);
        }
    }
}