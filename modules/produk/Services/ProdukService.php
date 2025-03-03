<?php

namespace Modules\Produk\Services;

use Modules\Produk\Models\ProdukModel;
use Ramsey\Uuid\Uuid;
use Exception;

class ProdukService
{
    /**
     * Get all products that are not deleted.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllProduk()
    {
        return ProdukModel::query()
            ->whereNull('produk_deleted_at')
            ->orderByDesc('produk_created_at')
            ->get();
    }

    /**
     * Store or update a product.
     *
     * @param  array  $data
     * @return \Modules\Produk\Models\ProdukModel
     */
    public function storeOrUpdateProduk(array $data)
    {
        try {
            if (!empty($data['produk_id'])) {
                // Update existing product
                $produk = ProdukModel::find($data['produk_id']);

                if (!$produk) {
                    throw new Exception('Produk tidak ditemukan.');
                }

                $produk->produk_nama = $data['produk_nama'];
                $produk->produk_kode = $data['produk_kode'];
                $produk->produk_harga = $data['produk_harga'];
                $produk->produk_deskripsi = $data['produk_deskripsi'];
                $produk->produk_updated_at = now();

                $produk->save();

                return $produk;
            } else {
                // Create new product
                $produkId = Uuid::uuid4()->toString();

                return ProdukModel::create([
                    'produk_id' => $produkId,
                    'produk_kode' => $data['produk_kode'],
                    'produk_nama' => $data['produk_nama'],
                    'produk_deskripsi' => $data['produk_deskripsi'],
                    'produk_harga' => $data['produk_harga'],
                    'created_at' => now(),
                    'updated_at' => null,
                    'deleted_at' => null
                ]);
            }
        } catch (Exception $e) {
            throw new Exception('Gagal menyimpan data produk: ' . $e->getMessage());
        }
    }

    /**
     * Delete a product by its ID.
     *
     * @param  string  $produk_id
     * @return \Modules\Produk\Models\ProdukModel
     */
    public function deleteProdukById($produk_id)
    {
        $produk = ProdukModel::find($produk_id);

        if (!$produk) {
            throw new Exception('Produk tidak ditemukan.');
        }

        $produk->delete();

        return $produk;
    }
}