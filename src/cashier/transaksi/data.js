console.log('Transaksi is running...');

$(function(){
    const DOM = {
        table: '#t_transaksi'
    }

    const tableTransaksi = $(DOM.table).DataTable({
        columnDefs: [
            {
                targets: [],
                searchable: false
            },
            {
                targets: [],
                orderable: false
            }
        ],
        autoWidth: true,
        responsive: true,
        processing: true,
        ajax: {
            url: `${BASE_URL}int/transaksi`,
            type: 'GET',
            dataType: 'JSON',
            beforeSend: xhr => {
                xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
            },
            dataSrc: res => {
                return res.data
            },
            error: err => {

            }
        },
        columns: [
            {
                data: null, render: (data, type, row) => {
                    return `
                        <a href="#/transaksi/${row.no_transaksi}">${row.no_transaksi}</a>
                    `
                }
            },
            {
                data: "customer.nama_lengkap"
            },
            {
                data: "alamat_kirim"
            },
            {
                data: null, render: (data, type, row) => {
                    if (row.status === 'Dibayar') {
                        return `<span class="badge badge-success">${row.status}</span> `
                    } else {
                        return `<span class="badge badge-danger">${row.status}</span>`
                    }
                }
            },
            {
                data: null, render: (data, type, row) => {
                    let {detail} = row

                    let total = detail.reduce((a, b) => a + parseInt(b.total_harga), 0)
                    return total;
                }
            },
            {
                data: "tgl_transaksi"
            }
        ],
        order: [[0, "desc"]]
    });
})