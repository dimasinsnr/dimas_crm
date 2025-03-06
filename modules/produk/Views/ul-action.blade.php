@php
$menuRoles = session('menuRoles') ? unserialize(base64_decode(session('menuRoles'))) : null;
@endphp

@if ($menuRoles)
@foreach($menuRoles as $menu)
    @if($menu->menu_kode == 'produk-Update')
        <td class="text-center">
            <a href="javascript:void(0)" class="ms-5" data-bs-toggle="tooltip" data-bs-original-title="Edit user" onclick="onEdit('{{ strval($produk_id) }}', '{{ strval($produk_kode) }}', '{{ strval($produk_nama) }}', '{{ strval($produk_deskripsi) }}', '{{ strval($produk_harga) }}')">
                <i class="bi bi-pencil-square"></i>
            </a>
        </td>
    @endif
    @if($menu->menu_kode == 'produk-Delete')
        <td class="text-center">
            <a href="javascript:void(0)" class="ms-3" data-bs-toggle="tooltip" data-bs-original-title="Delete user" onclick="onDelete('{{ strval($produk_id) }}')">
                <i class="bi bi-trash"></i>
            </a>
        </td>
    @endif
@endforeach
@endif