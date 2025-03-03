<?php

namespace Modules\Customer\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customer';

    protected $primaryKey = 'customer_id';

    public $incrementing = false;

    protected $fillable = [
        'customer_id',
        'customer_produk_id',
        'customer_nama',
        'customer_status',
        'customer_nik',
        'customer_phone',
        'customer_email',
        'customer_address',
        'customer_by_user_id',
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

    const CREATED_AT = 'customer_created_at';
    const UPDATED_AT = 'customer_updated_at';
    const DELETED_AT = 'customer_deleted_at';
}