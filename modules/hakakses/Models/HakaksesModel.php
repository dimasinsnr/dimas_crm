<?php

namespace Modules\Hakakses\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HakaksesModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'hak_akses';

    protected $primaryKey = 'hak_akses_id';

    public $incrementing = false;

    protected $fillable = [
        'hak_akses_id',
        'hak_akses_kode',
        'hak_akses_nama',
        'hak_akses_status',
        'hak_akses_keterangan',
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

    const CREATED_AT = 'hak_akses_created_at';
    const UPDATED_AT = 'hak_akses_updated_at';
    const DELETED_AT = 'hak_akses_deleted_at';
}