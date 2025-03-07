<?php

namespace Modules\User\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Modules\Login\Models\UserModel;
use Modules\Hakakses\Models\HakaksesModel;
use Ramsey\Uuid\Uuid;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user::user', [
            'title' => 'Data Users'
        ]);
    }

    public function initTable()
    {
        $query = DB::table('v_users')
        ->whereNull('deleted_at')
        ->orderByDesc('created_at');

        return dataTables::of($query)
            ->addColumn('action', 'user::ul-action')
            ->rawColumns(['action'])
            ->addIndexColumn(function ($data) {
                return $data->firstItem();
            })
            ->make(true);
    }

    public function comboHakAkses()
    {
        $hakAkses = HakaksesModel::whereNull('hak_akses_deleted_at')->get();

        $response = [
            "success" => true,
            "code" => 200,
            "message" => "Successfully get Data",
            "error" => [],
            "data" => $hakAkses
        ];

        return response()->json($response);
    }

    public function storeData(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|unique:users,email,' . ($request->id ? $request->id : 'NULL') // 'users' adalah nama tabel, 'email' adalah nama kolom, dan $request->id digunakan untuk pengecekan update
            ]);
            
            if (!empty($request->id)) {
                $user = UserModel::find($request->id);
                
                if ($user) {
                    $user->name = $request->name;
                    $user->hak_akses_id = $request->hak_akses_id;
                    $user->phone = $request->phone;
                    $user->email = $request->email;
                    $user->updated_at = now();
                    
                    $user->save();
                    
                    return response()->json([
                        'success' => true,
                        'message' => 'Data User berhasil diperbarui.',
                        'user' => $user
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'User tidak ditemukan.'
                    ], 404);
                }
            } else {
                $userId = Uuid::uuid4()->toString();
                $userPass = bcrypt($request->password);
    
                $user = UserModel::create([
                    'id' => $userId,
                    'name' => $request->name,
                    'hak_akses_id' => $request->hak_akses_id,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'password' => $userPass,
                    'created_at' => now(),
                    'updated_at' => null,
                    'deleted_at' => null
                ]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Data User berhasil disimpan.',
                    'user' => $user
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data user.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteData(Request $request)
    {
        try {
            $user = UserModel::find($request->id);
    
            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User not found.'
                ], 404);
            }
    
            $user->delete();
    
            return response()->json([
                'success' => true,
                'message' => 'Data User berhasil dihapus.',
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}