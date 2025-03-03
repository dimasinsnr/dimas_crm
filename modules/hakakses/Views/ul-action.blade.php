<div class="custom-dropdown" id="customDropdown">
    <button class="custom-dropdown-toggle" style=" border: none; background-color: transparent" type="button" onclick="toggleCustomDropdown(this)" aria-haspopup="true" aria-expanded="false">
        <i class="bi bi-three-dots" style="font-size: 20px;"></i>
    </button>
    <div class="custom-dropdown-menu" aria-labelledby="customDropdown" onclick="closeCustomDropdowns(event)">
        <a class="dropdown-item" href="javascript:void(0)" onclick="onAkses('{{ strval($hak_akses_id) }}', 'akses')">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            {{ __('Akses') }}
        </a>
        <a class="dropdown-item" href="javascript:void(0)" onclick="onEdit('{{ strval($hak_akses_id) }}', '{{ strval($hak_akses_nama) }}', '{{ strval($hak_akses_kode) }}', 'formHakakses')">
            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
            {{ __('Edit') }}
        </a>
        <a class="dropdown-item" href="javascript:void(0)" onclick="onDelete('{{ strval($hak_akses_id) }}')">
            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
            {{ __('Delete') }}
        </a>
    </div>
</div>