<div class="custom-dropdown" id="customDropdown">
    <button class="custom-dropdown-toggle" style=" border: none; background-color: transparent" type="button" onclick="toggleCustomDropdown(this)" aria-haspopup="true" aria-expanded="false">
        <i class="bi bi-three-dots" style="font-size: 20px;"></i>
    </button>
    <div class="custom-dropdown-menu" aria-labelledby="customDropdown" onclick="closeCustomDropdowns(event)">
        <a class="dropdown-item" href="javascript:void(0)" onclick="onAkses('{{ strval($hak_akses_id) }}', 'akses')">
            <i class="bi bi-universal-access text-secondary"></i>
            {{ __('Akses') }}
        </a>
        <a class="dropdown-item" href="javascript:void(0)" onclick="onEdit('{{ strval($hak_akses_id) }}', '{{ strval($hak_akses_nama) }}', '{{ strval($hak_akses_kode) }}', 'formHakakses')">
            <i class="bi bi-pencil-square text-secondary"></i> 
            {{ __('Edit') }}
        </a>
        <a class="dropdown-item" href="javascript:void(0)" onclick="onDelete('{{ strval($hak_akses_id) }}')">
            <i class="bi bi-trash text-secondary"></i>
            {{ __('Delete') }}
        </a>
    </div>
</div>