<?php

namespace Modules\Produk\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Modules\Produk\Services\ProdukService;

class ProdukController extends Controller
{
    protected $produkService;

    public function __construct(ProdukService $produkService)
    {
        $this->produkService = $produkService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('produk::produk', [
            'title' => 'Data Produk'
        ]);
    }

    public function initTable()
    {
        $produk = $this->produkService->getAllProduk();

        return DataTables::of($produk)
            ->addColumn('action', 'produk::ul-action')
            ->rawColumns(['action'])
            ->addIndexColumn(function ($data) {
                return $data->firstItem();
            })
            ->make(true);
    }

    public function storeData(Request $request)
    {
        try {
            $data = $request->only(['produk_id', 'produk_kode', 'produk_nama', 'produk_deskripsi', 'produk_harga']);
            $produk = $this->produkService->storeOrUpdateProduk($data);

            return response()->json([
                'success' => true,
                'message' => $data['produk_id'] ? 'Data Produk berhasil diperbarui.' : 'Data Produk berhasil disimpan.',
                'user' => $produk
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data produk.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleteData(Request $request)
    {
        try {
            $produk = $this->produkService->deleteProdukById($request->produk_id);

            return response()->json([
                'success' => true,
                'message' => 'Data Produk berhasil dihapus.',
                'user' => $produk
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