{{-- <td class="text-center">
    <a href="javascript:void(0)" class="ms-5" data-bs-toggle="tooltip" data-bs-original-title="Edit user" onclick="onEdit('{{ strval($customer_id) }}', '{{ strval($customer_produk_id) }}', '{{ strval($customer_nama) }}', '{{ strval($customer_status) }}', '{{ strval($customer_nik) }}', '{{ strval($customer_phone) }}', '{{ strval($customer_email) }}', '{{ strval($customer_address) }}')">
        <i class="fas fa-user-edit text-secondary"></i>
    </a>
    <a href="javascript:void(0)" class="ms-3" data-bs-toggle="tooltip" data-bs-original-title="Delete user" onclick="onDelete('{{ strval($customer_id) }}')">
        <i class="cursor-pointer fas fa-trash text-secondary"></i>
    </a>
</td> --}}

@php
    $menuRoles = session('menuRoles') ? unserialize(base64_decode(session('menuRoles'))) : null;
@endphp

<td class="text-center">
    @if ($customer_status !== 0)
        @if ($menuRoles)
            @php
                $hasApproveMenu = false;
            @endphp

            @foreach($menuRoles as $menu)
                @if($menu->menu_kode == 'customer-Approve')
                    <!-- Tombol Approve dan Reject hanya jika menu_kode == 'customer-Approve' -->
                    <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-original-title="Approve" onclick="onApprove('{{ strval($customer_id) }}')">
                        <i class="bi bi-check-circle-fill text-success fs-4"></i>
                    </a>
                    <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-original-title="Reject" onclick="onReject('{{ strval($customer_id) }}')">
                        <i class="bi bi-x-circle-fill text-danger text-danger fs-4"></i>
                    </a>
                    @php
                        $hasApproveMenu = true;
                    @endphp
                    @break
                @endif
            @endforeach

            @if (!$hasApproveMenu)
                <a href="javascript:void(0)" class="ms-5" data-bs-toggle="tooltip" data-bs-original-title="History" onclick="onHistory('{{ strval($customer_id) }}')">
                    <i class="bi bi-clock-history"></i>
                </a>
            @endif
        @endif
    @else
        <a href="javascript:void(0)" class="ms-5" data-bs-toggle="tooltip" data-bs-original-title="Edit user" onclick="onEdit('{{ strval($customer_id) }}', '{{ strval($customer_produk_id) }}', '{{ strval($customer_nama) }}', '{{ strval($customer_status) }}', '{{ strval($customer_nik) }}', '{{ strval($customer_phone) }}', '{{ strval($customer_email) }}', '{{ strval($customer_address) }}')">
            <i class="bi bi-pencil-square"></i>
        </a>
        <a href="javascript:void(0)" class="ms-3" data-bs-toggle="tooltip" data-bs-original-title="Delete user" onclick="onDelete('{{ strval($customer_id) }}')">
            <i class="bi bi-trash"></i>
        </a>
    @endif
</td>