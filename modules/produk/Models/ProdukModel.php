<?php

namespace Modules\Produk\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProdukModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'produk';

    protected $primaryKey = 'produk_id';

    public $incrementing = false;

    protected $fillable = [
        'produk_id',
        'produk_kode',
        'produk_nama',
        'produk_deskripsi',
        'produk_harga',
    ];

    protected $hidden = [
        'updated_at', 'deleted_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    public $timestamps = true;

    const CREATED_AT = 'produk_created_at';
    const UPDATED_AT = 'produk_updated_at';
    const DELETED_AT = 'produk_deleted_at';
}