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
                // Flag untuk mengetahui apakah menu 'customer-Approve' ada
                $hasApproveMenu = false;
            @endphp

            @foreach($menuRoles as $menu)
                @if($menu->menu_kode == 'customer-Approve')
                    <!-- Tombol Approve dan Reject hanya jika menu_kode == 'customer-Approve' -->
                    <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-original-title="Approve" onclick="onApprove('{{ strval($customer_id) }}')">
                        <i class="fas fa-check-circle text-success fa-2x"></i>
                    </a>
                    <a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-original-title="Reject" onclick="onReject('{{ strval($customer_id) }}')">
                        <i class="fas fa-times-circle text-danger fa-2x"></i>
                    </a>
                    @php
                        $hasApproveMenu = true;
                    @endphp
                    @break  <!-- Keluar dari loop jika menu 'customer-Approve' ditemukan -->
                @endif
            @endforeach

            <!-- Jika tidak ada menu 'customer-Approve', tampilkan History -->
            @if (!$hasApproveMenu)
                <a href="javascript:void(0)" class="ms-5" data-bs-toggle="tooltip" data-bs-original-title="History" onclick="onHistory('{{ strval($customer_id) }}')">
                    <i class="fas fa-history text-secondary"></i>
                </a>
            @endif
        @endif
    @else
        <!-- Tombol Edit dan Delete jika customer_status == 0 -->
        <a href="javascript:void(0)" class="ms-5" data-bs-toggle="tooltip" data-bs-original-title="Edit user" onclick="onEdit('{{ strval($customer_id) }}', '{{ strval($customer_produk_id) }}', '{{ strval($customer_nama) }}', '{{ strval($customer_status) }}', '{{ strval($customer_nik) }}', '{{ strval($customer_phone) }}', '{{ strval($customer_email) }}', '{{ strval($customer_address) }}')">
            <i class="fas fa-user-edit text-secondary"></i>
        </a>
        <a href="javascript:void(0)" class="ms-3" data-bs-toggle="tooltip" data-bs-original-title="Delete user" onclick="onDelete('{{ strval($customer_id) }}')">
            <i class="cursor-pointer fas fa-trash text-secondary"></i>
        </a>
    @endif
</td>