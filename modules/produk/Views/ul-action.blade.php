<td class="text-center">
    <a href="javascript:void(0)" class="ms-5" data-bs-toggle="tooltip" data-bs-original-title="Edit user" onclick="onEdit('{{ strval($produk_id) }}', '{{ strval($produk_kode) }}', '{{ strval($produk_nama) }}', '{{ strval($produk_deskripsi) }}', '{{ strval($produk_harga) }}')">
        <i class="fas fa-user-edit text-secondary"></i>
    </a>
    <a href="javascript:void(0)" class="ms-3" data-bs-toggle="tooltip" data-bs-original-title="Delete user" onclick="onDelete('{{ strval($produk_id) }}')">
        <i class="cursor-pointer fas fa-trash text-secondary"></i>
    </a>
</td>