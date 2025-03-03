<script type="text/javascript">

	$(() => {
        HELPER.api = {
            tableUser: BASE_URL + 'user/initTable',
            comboHakAkses: BASE_URL + 'user/comboHakAkses',
            storeUser: BASE_URL + 'user/storeData',
            deleteUser: BASE_URL + 'user/deleteData',
            controlHakakses: BASE_URL + 'hakakses/controlHakakses',
            updateHakakses: BASE_URL + 'hakakses/updateHakakses',
            showAnggota: BASE_URL + 'hakakses/showData',
        };

        init();
    });

    init = async () => {
		await initTable();
		await HELPER.unblock(100);
	}


    initTable = () => {
        $('#tableUser').DataTable({
            processing: true,
            serverSide: true,
            ajax: HELPER.api.tableUser,
            columns: [
                {
                    data: null,
                    searchable: false,
                    orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'name'},
                { data: 'email'},
                { data: 'hak_akses_nama'},
                {
                    data: 'created_at',
                    render: function(data, type, row) {
                        return moment(data).format('DD-MM-YYYY');
                    }
                },
                { data: 'action', name: 'action', orderable: false},
            ],
            order: [[1, 'asc']]
        });
        $('.dropdown-toggle').dropdown();
    }

    onRefresh = () => {
        $('#tableHakakses').DataTable().destroy(); 
        initTable();
    }

    onSave = () => {
        var formData = new FormData($('[name="formUser"]')[0]);
        HELPER.confirm({
            message: 'Anda yakin ingin menyimpan data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.storeUser,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false, 
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                $('#modalAddUser').modal('hide');
                                $('#tableUser').DataTable().destroy(); 
                                initTable();
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
                            } else {
                                $('#modalAddUser').hide();
                                HELPER.showMessage({
                                    success: false,
                                    message: response.message,
                                    title: 'False'
                                });
                            }
                        },
                        complete: (response) => {
                            HELPER.unblock(500);
                        }
                    });
                }
            }
        })
    }

    onEdit = (id, nama, hak_akses_id, phone, email) => {
        $('#password').removeAttr('required');
        HELPER.createCombo({
            el: ['hak_akses_id'],
            valueField: 'hak_akses_id',
            displayField: 'hak_akses_nama',
            url: HELPER.api.comboHakAkses,
            placeholder: '-Pilih Unit-',
            isSelect2: true,
            selectedField: hak_akses_id,
            type: "POST",
            callback: function(data) {
                $('#hak_akses_id').val(hak_akses_id).trigger('change');
            }
        });
        $('#id').val(id);
        $('#name').val(nama);
        $('#phone').val(phone);
        $('#email').val(email);
        $('#password_id').hide();
        $('#modalAddUser').modal('show');
    }

    onDelete = (id) => {
        HELPER.confirm({
            message: 'Anda yakin ingin menghapus data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.deleteUser,
                        type: 'POST',
                        data: {
                            id: id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                $('#modalAddUser').modal('hide');
                                $('#tableUser').DataTable().destroy(); 
                                initTable();
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
                            } else {
                                $('#modalAddUser').hide();
                                HELPER.showMessage({
                                    success: false,
                                    message: response.message,
                                    title: 'False'
                                });
                            }
                        },
                        complete: (response) => {
                            HELPER.unblock(500);
                        }
                    });
                }
            }
        })
    }

    onAkses = (id) => {
        HELPER.block();
        $.ajax({
            url: HELPER.api.controlHakakses,
            type: 'POST',
            data: {
                hak_akses_id: id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                if (response.success == true) {
                    $('#akses_hak_akses_id').val(id);
                    const menuContainer = $('#menu-container');
                    menuContainer.empty();  // Clear existing menu items

                    response.menu.forEach(menu => {
                        let indentClass = (menu.menu_level === 2) ? 'ms-4' : '';  // Add margin-left (indentation)

                        let inputName = `${menu.menu_id}`;

                        let switchHtml = `
                            <div class="list-group-item d-flex justify-content-between align-items-center ${indentClass} border-start" style="border: 0;">
                                <span>${menu.menu_title}</span>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" value="1" id="menu-switch-${menu.id}" name="${inputName}" ${menu.is_active ? 'checked' : ''}>
                                </div>
                            </div>
                        `;
                        menuContainer.append(switchHtml);
                        $('#btnSaveAkses').show();
                    });
                } else {
                    console.log("Failed to fetch menu");
                }
            },
            complete: (response) => {
                HELPER.unblock(500);
            }
        });
    }

    onSaveAkses = () => {
        var formData = new FormData($('[name="formAkses"]')[0]);
        HELPER.confirm({
            message: 'Anda yakin ingin menyimpan data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.updateHakakses,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false, 
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
                            } else {
                                HELPER.showMessage({
                                    success: false,
                                    message: response.message,
                                    title: 'False'
                                });
                            }
                        },
                        complete: (response) => {
                            HELPER.unblock(500);
                        }
                    });
                }
            }
        })
    }

    toggleCustomDropdown = (event) => {
        var dropdownMenu = $(event).next('.custom-dropdown-menu');
        $('.custom-dropdown-menu').not(dropdownMenu).removeClass('show');
        dropdownMenu.toggleClass('show');
        if (event.stopPropagation) {
            event.stopPropagation();
        } else if (event.cancelBubble !== undefined) {
            event.cancelBubble = true;
        }
    }

    closeCustomDropdowns = (event) => {
        if (!$('.custom-dropdown').is(event.target) && $('.custom-dropdown-menu').has(event.target).length === 0) {
            $('.custom-dropdown-menu').removeClass('show');
        }
    }

    openModal = () => {
        $('#password').attr('required', true);
        HELPER.createCombo({
			el: ['hak_akses_id'],
			valueField: 'hak_akses_id',
			grouped: false,
			displayField: 'hak_akses_nama',
			placeholder: '-Pilih Unit-',
			url: HELPER.api.comboHakAkses,
            csrf: $('meta[name="csrf-token"]').attr('content'),
			type: "POST"
		});
        $('#id').val('');
        $('#hak_akses_nama').val('');
        $('#name').val('');
        $('#phone').val('');
        $('#email').val('');
        $('#password').val('');
        $('#modalAddUser').modal('show');
    }
</script>