<script type="text/javascript">

	$(() => {
        HELPER.api = {
            tableMember: BASE_URL + 'customer/initTableMember',
        };

        init();
    });

    init = async () => {
		await initTableMember();
		await HELPER.unblock(100);
	}


    initTableMember = () => {
        $('#tableMember').DataTable({
            processing: true,
            serverSide: true,
            ajax: HELPER.api.tableMember,
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
                        var badgeColor = ''; // Menentukan warna badge
                        var statusText = ''; // Menentukan teks status

                        if (data === 0) {
                            badgeColor = 'bg-secondary'; // Warna abu-abu untuk Draf
                            statusText = 'Draf';
                        } else if (data === 1) {
                            badgeColor = 'bg-success'; // Warna hijau untuk Disetujui
                            statusText = 'Disetujui';
                        } else if (data === 2) {
                            badgeColor = 'bg-warning'; // Warna kuning untuk Proses Review
                            statusText = 'Proses Review';
                        } else if (data === 3) {
                            badgeColor = 'bg-danger'; // Warna merah untuk Ditolak
                            statusText = 'Ditolak';
                        } else {
                            badgeColor = 'bg-secondary'; // Default warna abu-abu jika status tidak diketahui
                            statusText = 'Tidak Diketahui';
                        }

                        // Mengembalikan badge dengan warna dan teks sesuai dengan status
                        return '<span class="badge ' + badgeColor + '">' + statusText + '</span>';
                    }
                },
                {
                    data: 'customer_created_at',
                    render: function(data, type, row) {
                        return moment(data).format('DD-MM-YYYY');
                    }
                },
                // { data: 'action', name: 'action', orderable: false},
            ],
            order: [[1, 'asc']]
        });
        $('.dropdown-toggle').dropdown();
    }

</script>