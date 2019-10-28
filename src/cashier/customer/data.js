console.log('User is running...')

$(function () {
    const DOM = {
        table: '#t_customer',
    }

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 300,
        "hideDuration": 100,
        "timeOut": 5000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "slideDown",
        "hideMethod": "slideUp"
    }

    const tableCustomer = $(DOM.table).DataTable({
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
            url: `${BASE_URL}int/customer`,
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
                data: "id_user"
            },
            {
                data: "nama_lengkap"
            },
            {
                data: "username"
            },
            {
                data: "jenis_kelamin"
            },
            {
                data: "email"
            },
            {
                data: "telepon"
            },
            {
                data: "tgl_lahir"
            },
            {
                data: "alamat"
            },
            {
                data: null, render: (data, type, row) => {
                    if (row.aktif === 'Y') {
                        return `<span class="badge badge-success">Aktif</span> `
                    } else {
                        return `<span class="badge badge-danger">Tidak Aktif</span>`
                    }
                }
            },
            {
                data: "tgl_registrasi"
            }
        ],
        order: [[0, "desc"]]
    })
})