<script type="text/javascript">

	$(() => {
        HELPER.api = {
            tableCustomer: BASE_URL + 'customer/initTable',
            storeCustomer: BASE_URL + 'customer/storeData',
            deleteCustomer: BASE_URL + 'customer/deleteData',
            comboProduk: BASE_URL + 'customer/comboProduk',
            ajukanCustomer: BASE_URL + 'customer/ajukanCustomer',
            getHistoryApproval: BASE_URL + 'customer/getHistoryApproval',
            onApprove: BASE_URL + 'customer/onApprove',
            onReject: BASE_URL + 'customer/onReject',
        };

        init();
    });

    init = async () => {
		await initTable();
		await HELPER.unblock(100);
	}


    initTable = () => {
        $('#tableCustomer').DataTable({
            processing: true,
            serverSide: true,
            ajax: HELPER.api.tableCustomer,
            columns: [
                {
                    data: null,
                    searchable: false,
                    orderable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                { data: 'customer_nama'},
                { data: 'produk_nama'},
                {
                    data: 'customer_status',
                    render: function(data, type, row) {
                        var badgeColor = '';
                        var statusText = '';

                        if (data === 0) {
                            badgeColor = 'bg-secondary';
                            statusText = 'Draf';
                        } else if (data === 1) {
                            badgeColor = 'bg-success';
                            statusText = 'Disetujui';
                        } else if (data === 2) {
                            badgeColor = 'bg-warning';
                            statusText = 'Proses Review';
                        } else if (data === 3) {
                            badgeColor = 'bg-danger';
                            statusText = 'Ditolak';
                        } else {
                            badgeColor = 'bg-secondary';
                            statusText = 'Tidak Diketahui';
                        }

                        return '<span class="badge ' + badgeColor + '">' + statusText + '</span>';
                    }
                },
                {
                    data: 'customer_created_at',
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
        $('#tableCustomer').DataTable().destroy(); 
        initTable();
    }

    onSave = () => {
        var formData = new FormData($('[name="formCustomer"]')[0]);
        HELPER.confirm({
            message: 'Anda yakin ingin menyimpan data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.storeCustomer,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false, 
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                $('#modalAddCustomer').modal('hide');
                                $('#tableCustomer').DataTable().destroy(); 
                                initTable();
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
                            } else {
                                $('#modalAddCustomer').hide();
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

    onAjukan = () => {
        var formData = new FormData($('[name="formCustomer"]')[0]);
        HELPER.confirm({
            message: 'Anda yakin ingin mengajukan data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.ajukanCustomer,
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false, 
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                $('#modalAddCustomer').modal('hide');
                                $('#tableCustomer').DataTable().destroy(); 
                                initTable();
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
                            } else {
                                $('#modalAddCustomer').hide();
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

    onEdit = (customer_id, customer_produk_id, customer_nama, customer_status, customer_nik, customer_phone, customer_email, customer_address) => {
        HELPER.createCombo({
            el: ['customer_produk_id'],
            valueField: 'produk_id',
            displayField: 'produk_nama',
            url: HELPER.api.comboProduk,
            placeholder: '-Pilih Produk-',
            isSelect2: true,
            selectedField: customer_produk_id,
            type: "POST",
            callback: function(data) {
                $('#customer_produk_id').val(produk_id).trigger('change');
            }
        });
        $('#customer_id').val(customer_id);
        // $('#customer_produk_id').val(customer_produk_id);
        $('#customer_nama').val(customer_nama);
        $('#customer_status').val(customer_status);
        $('#customer_nik').val(customer_nik);
        $('#customer_phone').val(customer_phone);
        $('#customer_email').val(customer_email);
        $('#customer_address').val(customer_address);
        $('#btn_ajukan').show();
        $('#modalAddCustomer').modal('show');
    }

    onDelete = (customer_id) => {
        HELPER.confirm({
            message: 'Anda yakin ingin menghapus data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.deleteCustomer,
                        type: 'POST',
                        data: {
                            customer_id: customer_id,
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                $('#modalAddCustomer').modal('hide');
                                $('#tableCustomer').DataTable().destroy(); 
                                initTable();
                                HELPER.showMessage({
                                    success: true,
                                    message: response.message,
                                    title: 'Success'
                                });
                            } else {
                                $('#modalAddCustomer').hide();
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
        HELPER.createCombo({
			el: ['customer_produk_id'],
			valueField: 'produk_id',
			grouped: false,
			displayField: 'produk_nama',
			placeholder: '-Pilih Produk-',
			url: HELPER.api.comboProduk,
            csrf: $('meta[name="csrf-token"]').attr('content'),
			type: "POST"
		});
        $('#customer_id').val('');
        // $('#customer_produk_id').val('');
        $('#customer_nama').val('');
        $('#customer_status').val('');
        $('#customer_nik').val('');
        $('#customer_phone').val('');
        $('#customer_email').val('');
        $('#customer_address').val('');
        $('#modalAddCustomer').modal('show');
    }

    

    function onHistory(customerId) {
        HELPER.block();
        $.ajax({
            url: HELPER.api.getHistoryApproval,
            type: 'POST',
            data: {
                customer_id: customerId,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                if (response.success == true) {
                    const historyData = response.history;

                    $('#historyTableBody').empty();

                    historyData.forEach((history, index) => {
                        const formattedDate = moment(history.history_approval_created_at).format('DD-MM-YYYY');
                        
                        // const row = `
                        //     <tr>
                        //         <td>${index + 1}</td>
                        //         <td>${history.customer_nama}</td>
                        //         <td>${history.name}</td>
                        //         <td>${formattedDate}</td>
                        //     </tr>
                        // `;
                        const row = `
                            <tr>
                                <td>${history.customer_nama}</td>
                                <td>${history.name}</td>
                                <td>${formattedDate}</td>
                            </tr>
                        `;
                        $('#historyTableBody').append(row);
                    });

                } else {
                    console.log("Failed to fetch menu");
                }
            },
            complete: (response) => {
                $('#historyModal').modal('show');
                HELPER.unblock(500);
            }
        });
    }

    onApprove = (customer_id) => {
        HELPER.confirm({
            message: 'Anda yakin ingin Menyetujui data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.onApprove,
                        type: 'POST',
                        data: {
                            customer_id: customer_id,
                        },                        
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                $('#tableCustomer').DataTable().destroy(); 
                                initTable();
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

    onReject = (customer_id) => {
        HELPER.confirm({
            message: 'Anda yakin ingin Menolak data ?',
            callback: (result) => {
                if (result) {
                    HELPER.block();
                    $.ajax({
                        url: HELPER.api.onReject,
                        type: 'POST',
                        data: {
                            customer_id: customer_id,
                        },                        
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: (response) => {
                            if (response.success == true) {
                                $('#tableCustomer').DataTable().destroy(); 
                                initTable();
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
</script>