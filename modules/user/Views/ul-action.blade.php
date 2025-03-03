<td class="text-center">
    <a href="javascript:void(0)" class="ms-5" data-bs-toggle="tooltip" data-bs-original-title="Edit user" onclick="onEdit('{{ strval($id) }}', '{{ strval($name) }}', '{{ strval($hak_akses_id) }}', '{{ strval($phone) }}', '{{ strval($email) }}', 'formHakakses')">
        <i class="fas fa-user-edit text-secondary"></i>
    </a>
    <a href="javascript:void(0)" class="ms-3" data-bs-toggle="tooltip" data-bs-original-title="Delete user" onclick="onDelete('{{ strval($id) }}')">
        <i class="cursor-pointer fas fa-trash text-secondary"></i>
    </a>
</td>