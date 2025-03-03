<script type="text/javascript">

	$(() => {
        HELPER.api = {
            tableProduk: BASE_URL + 'produk/initTable',
            storeProduk: BASE_URL + 'produk/storeData',
            deleteProduk: BASE_URL + 'produk/deleteData',
        };

        init();
    });

    init = async () => {
		await initTable();
		await HELPER.unblock(100);
	}


    initTable = () => {
        $('#tableProduk').DataTable({
            processing: true,
            serverSide: true,
            ajax: HELPER.api.tableProduk,
            columns: [
                {
                    data: null,
                    searchable: false,
                    orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'produk_kode'},
                { data: 'produk_nama'},
                { data: 'produk_harga'},
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
        $('#tableProduk').DataTable().destroy(); 
        initTable();
    }

    onSave = () => {
        var formData = new FormData($('[name="formProduk"]')[0]);
        HELPER.confirm({
            message: 'Anda yakin ingin menyimpan data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.storeProduk,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false, 
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                $('#modalAddProduk').modal('hide');
                                $('#tableProduk').DataTable().destroy(); 
                                initTable();
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
                            } else {
                                $('#modalAddProduk').hide();
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

    onEdit = (produk_id, produk_kode, produk_nama, produk_deskripsi, produk_harga) => {
        $('#produk_id').val(produk_id);
        $('#produk_kode').val(produk_kode);
        $('#produk_nama').val(produk_nama);
        $('#produk_deskripsi').val(produk_deskripsi);
        $('#produk_harga').val(produk_harga);
        $('#modalAddProduk').modal('show');
    }

    onDelete = (produk_id) => {
        HELPER.confirm({
            message: 'Anda yakin ingin menghapus data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.deleteProduk,
                        type: 'POST',
                        data: {
                            produk_id: produk_id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                $('#modalAddProduk').modal('hide');
                                $('#tableProduk').DataTable().destroy(); 
                                initTable();
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
                            } else {
                                $('#modalAddProduk').hide();
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

    openModal = () => {
        $('#produk_id').val('');
        $('#produk_kode').val('');
        $('#produk_nama').val('');
        $('#produk_deskripsi').val('');
        $('#produk_harga').val('');
        $('#modalAddProduk').modal('show');
    }
</script>