<?php

namespace Modules\Customer\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use Modules\Customer\Models\CustomerModel;
use Modules\Produk\Models\ProdukModel;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customer::customer', [
            'title' => 'Data Customer'
        ]);
    }

    public function indexMember()
    {
        return view('customer::member', [
            'title' => 'Data Member'
        ]);
    }

    public function initTable()
    {
        // Ambil data menuRoles dari session dan decode
        $menuRolesEncoded = session('menuRoles'); // Misalnya data yang ada di session
        $menuRolesDecoded = base64_decode($menuRolesEncoded);
        $menuRoles = unserialize($menuRolesDecoded); // Mendapatkan array/objek menuRoles

        // Cek apakah ada hak_akses_id yang cocok
        $hakAksesId = 'e3z6p2be-3b8b-4f8f-8d3d-d4b6d9d7a8b2';
        $hasAccess = false;

        foreach ($menuRoles as $menuRole) {
            if ($menuRole->menu_role_hak_akses_id === $hakAksesId) {
                $hasAccess = true;
                break;
            }
        }

        // Bangun query dasar
        $query = DB::table('v_customer')
            ->whereNull('customer_deleted_at')
            ->whereNotIn('customer_status', [1]) // Exclude customer_status 1
            ->orderByDesc('customer_created_at');

        // Jika ada hak_akses_id yang cocok, filter customer_status 2 atau 3
        if ($hasAccess) {
            $query->whereIn('customer_status', [2]);
        }

        // Jalankan query dan return data
        return dataTables::of($query)
            ->addColumn('action', 'customer::ul-action')
            ->rawColumns(['action'])
            ->addIndexColumn(function ($data) {
                return $data->firstItem();
            })
            ->make(true);
    }

    public function initTableMember()
    {
        $query = DB::table('v_customer')
        ->whereNull('customer_deleted_at')
        ->where('customer_status', 1)
        ->orderByDesc('customer_created_at');

        return dataTables::of($query)
            ->addColumn('action', 'customer::ul-action')
            ->rawColumns(['action'])
            ->addIndexColumn(function ($data) {
                return $data->firstItem();
            })
            ->make(true);
    }

    public function onApprove(Request $request)
    {
        $customerId = $request->customer_id;
        $customer = CustomerModel::where('customer_id', $customerId)->first();

        if ($customer) {
            $customer->customer_status = 1;
            $customer->save();

            $this->storeHistoryApproval($request->customer_id, auth()->id());

            return response()->json([
                'success' => true,
                'message' => 'Customer status berhasil diubah menjadi approved.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Customer tidak ditemukan.'
            ], 404);
        }    
    }

    public function onReject(Request $request)
    {
        $customerId = $request->customer_id;
        $customer = CustomerModel::where('customer_id', $customerId)->first();

        if ($customer) {
            $customer->customer_status = 3;
            $customer->save();

            $this->storeHistoryApproval($request->customer_id, auth()->id());

            return response()->json([
                'success' => true,
                'message' => 'Customer status berhasil diubah menjadi Rejected.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Customer tidak ditemukan.'
            ], 404);
        }    
    }

    public function comboProduk ()
    {
        $produk = ProdukModel::whereNull('produk_deleted_at')->get();

        $response = [
            "success" => true,
            "code" => 200,
            "message" => "Successfully get Data",
            "error" => [],
            "data" => $produk
        ];

        return response()->json($response);
    }

    public function storeData(Request $request)
    {
        try {
            if (!empty($request->customer_id)) {
                $customer = CustomerModel::find($request->customer_id);
                
                if ($customer) {
                    $customer->customer_produk_id = $request->customer_produk_id;
                    $customer->customer_nama = $request->customer_nama;
                    $customer->customer_status = $request->customer_status;
                    $customer->customer_nik = $request->customer_nik;
                    $customer->customer_phone = $request->customer_phone;
                    $customer->customer_email = $request->customer_email;
                    $customer->customer_address = $request->customer_address;
                    $customer->customer_updated_at = now();
                    
                    $customer->save();
                    
                    return response()->json([
                        'success' => true,
                        'message' => 'Data Customer berhasil diperbarui.',
                        'user' => $customer
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Customer tidak ditemukan.'
                    ], 404);
                }
            } else {
                $customerId = Uuid::uuid4()->toString();
    
                $customer = CustomerModel::create([
                    'customer_id' => $customerId,
                    'customer_produk_id' => $request->customer_produk_id,
                    'customer_nama' => $request->customer_nama,
                    'customer_status' => 0,
                    'customer_nik' => $request->customer_nik,
                    'customer_phone' => $request->customer_phone,
                    'customer_email' => $request->customer_email,
                    'customer_address' => $request->customer_address,
                    'customer_by_user_id' => auth()->id(),
                    'created_at' => now(),
                    'updated_at' => null,
                    'deleted_at' => null
                ]);

                $this->storeHistoryApproval($customer->customer_id, auth()->id());
                
                return response()->json([
                    'success' => true,
                    'message' => 'Data Customer berhasil disimpan.',
                    'user' => $customer
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data customer.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function storeHistoryApproval($customerId, $userId)
    {
        $historyId = Uuid::uuid4()->toString();
        DB::table('history_approval')->insert([
            'history_approval_id' => $historyId,
            'history_approval_customer_id' => $customerId,
            'history_approval_by_user_id' => $userId,
            'history_approval_created_at' => now()
        ]);
    }

    public function getHistoryApproval(Request $request)
    {
        $customerId = $request->customer_id;

        $history = DB::table('v_history_approval')
            ->where('history_approval_customer_id', $customerId)
            ->orderByDesc('history_approval_created_at')
            ->get();

        // Mengembalikan response JSON dengan data riwayat
        return response()->json([
            'success' => true,
            'history' => $history
        ]);
    }

    public function deleteData(Request $request)
    {
        try {
            $customer = CustomerModel::find($request->customer_id);
    
            if (!$customer) {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer not found.'
                ], 404);
            }
    
            $customer->delete();
    
            return response()->json([
                'success' => true,
                'message' => 'Data Customer berhasil dihapus.',
                'user' => $customer
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function ajukanCustomer(Request $request)
    {
        try {
            $customer = CustomerModel::find($request->customer_id);
            
            if ($customer) {
                $customer->customer_produk_id = $request->customer_produk_id;
                $customer->customer_nama = $request->customer_nama;
                $customer->customer_status = 2;
                $customer->customer_nik = $request->customer_nik;
                $customer->customer_phone = $request->customer_phone;
                $customer->customer_email = $request->customer_email;
                $customer->customer_address = $request->customer_address;
                $customer->customer_updated_at = now();
                
                $customer->save();

                $this->storeHistoryApproval($request->customer_id, auth()->id());
                
                return response()->json([
                    'success' => true,
                    'message' => 'Data Customer berhasil diperbarui.',
                    'user' => $customer
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Customer tidak ditemukan.'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data customer.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}