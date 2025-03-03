<script type="text/javascript">

	$(() => {
        HELPER.api = {
            tableHakakses: BASE_URL + 'hakakses/initTable',
            storeHakakses: BASE_URL + 'hakakses/storeData',
            deleteHakakses: BASE_URL + 'hakakses/deleteData',
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
        $('#tableHakakses').DataTable({
            processing: true,
            serverSide: true,
            ajax: HELPER.api.tableHakakses,
            columns: [
                {
                    data: null,
                    searchable: false,
                    orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'hak_akses_nama'},
                { data: 'hak_akses_kode'},
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
        var formData = new FormData($('[name="formHakakses"]')[0]);
        HELPER.confirm({
            message: 'Anda yakin ingin menyimpan data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.storeHakakses,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false, 
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                $('#modalAddHakakses').modal('hide');
                                $('#tableHakakses').DataTable().destroy(); 
                                initTable();
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
                            } else {
                                $('#modalAddHakakses').hide();
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

    onEdit = (id, nama, kode) => {
        $('#hak_akses_id').val(id);
        $('#hak_akses_nama').val(nama);
        $('#hak_akses_kode').val(kode);
        $('#modalAddHakakses').modal('show');
    }

    onDelete = (id) => {
        HELPER.confirm({
            message: 'Anda yakin ingin menghapus data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.deleteHakakses,
                        type: 'POST',
                        data: {
                            hak_akses_id: id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                $('#modalAddHakakses').modal('hide');
                                $('#tableHakakses').DataTable().destroy(); 
                                initTable();
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
                            } else {
                                $('#modalAddHakakses').hide();
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
        $('#hak_akses_id').val('');
        $('#hak_akses_nama').val('');
        $('#hak_akses_kode').val('');
        $('#modalAddHakakses').modal('show');
    }
</script>