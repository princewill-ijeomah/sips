console.log('Transaksi is running...');

$(function () {
    const DOM = {
        table: '#t_konfirmasi',
        button: {
            validasi: '.btn_validasi',
            batal: '.btn_batal'
        },
        modal: {
            validasi: '#modal_validasi',
            content: '.modal-content',
            batal: '#modal_batal'
        },
        form: {
            validasi: '#form_validasi',
            batal: '#form_batal'
        },
        validasi_index: {
            id: '#validasi_no_konfirmasi',
            code: '#code_validasi'
        },
        batal_index: {
            id: '#batal_no_konfirmasi',
            code: '#code_batal'
        }
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

    const tableKonfirmasi = $(DOM.table).DataTable({
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
            url: `${BASE_URL}int/konfirmasi`,
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
                data: "no_konfirmasi"
            },
            {
                data: null, render: (data, type, row) => {
                    return `
                        <a href="#/transaksi/${row.transaksi.no_transaksi}">${row.transaksi.no_transaksi}</a>
                    `
                }
            },
            {
                data: "bank"
            },
            {
                data: "bank_pengirim"
            },
            {
                data: "rekening_pengirim"
            },
            {
                data: "nama_pengirim"
            },
            {
                data: "tgl_transfer"
            },
            {
                data: null, render: (data, type, row) => {
                    if (row.valid === 'Y') {
                        return `<span class="badge badge-success">Valid</span> `
                    } else if(row.valid === 'T') {
                        return `<span class="badge badge-danger">Tidak Valid</span>`
                    } else {
                        return `<span class="badge badge-warning text-white">Dibatalkan</span>`
                    }
                }
            },
            {
                data: null, render: (data, type, row) => {
                    return `Rp. ${parseInt(row.jml_transfer).toLocaleString(['ban', 'id'])}`
                }
            },
            {
                data: null, render: (data, type, row) => {
                    return `
                        <a href="${row.foto}" target="__blank">
                            <img src="${row.foto}" class="img-fluid" alt="Gambar Bukti Konfirmasi">
                        </a>
                    `
                }
            },
            {
                data: "tgl_input"
            },
            {
                data: null, render: (data, type, row) => {
                    if(row.valid === 'T'){
                        return `
                            <button class="btn btn-danger btn-sm btn_batal" data-id="${row.no_konfirmasi}"><i class="fal fa-times"></i> Batalkan</button>
                            <button class="btn btn-success btn-sm btn_validasi" data-id="${row.no_konfirmasi}"><i class="fal fa-check"></i> Validasi</button>
                        `
                    } else {
                        return '';
                    }
                    
                }
            }
        ],
        order: [[0, "desc"]]
    });

    const konfirmasiController = (() => {
        const { button, modal, form, table, validasi_index, batal_index } = DOM

        const fetchKonfirmasi = (id, callback) => {
            $.ajax({
                url: `${BASE_URL}int/konfirmasi`,
                data: { no_konfirmasi: id },
                type: 'GET',
                dataType: 'JSON',
                beforeSend: xhr => {
                    xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                },
                success: ({ data }) => {
                    callback(data)
                },
                error: err => {
                    const { error } = err.responseJSON
                    toastr.error(error, 'Gagal')
                }
            })
        }

        const validasiKonfirmasi = () => {
            $(table).on('click', button.validasi, function () {
                let no_konfirmasi = $(this).data('id')

                fetchKonfirmasi(no_konfirmasi, data => {
                    if (data.length === 1) {
                        data.map(v => {
                            $(validasi_index.id).val(v.no_konfirmasi)
                            $(validasi_index.code).text(`${v.no_konfirmasi} - ${v.transaksi.no_transaksi}`)
                        })

                        $(modal.validasi).modal('show')
                    }
                })
            })
        }

        const batalKonfirmasi = () => {
            $(table).on('click', button.batal, function () {
                let no_konfirmasi = $(this).data('id')

                fetchKonfirmasi(no_konfirmasi, data => {
                    if (data.length === 1) {
                        data.map(v => {
                            $(batal_index.id).val(v.no_konfirmasi)
                            $(batal_index.code).text(`${v.no_konfirmasi} - ${v.transaksi.no_transaksi}`)
                        })

                        $(modal.batal).modal('show')
                    }
                })
            })
        }

        const submitValid = () => {
            $(form.validasi).on('submit', (e) => {
                e.preventDefault();

                $.ajax({
                    url: `${BASE_URL}int/konfirmasi/validasi`,
                    type: 'PUT',
                    dataType: 'JSON',
                    data: $(form.validasi).serialize(),
                    beforeSend: xhr => {
                        xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                        $(modal.content).block({
                            message: '<i class="fal fa-spinner fa-spin fa-5x"></i>',
                            overlayCSS: {
                                backgroundColor: '#fff',
                                opacity: 0.8,
                                cursor: 'wait'
                            },
                            css: {
                                border: 0,
                                padding: 0,
                                backgroundColor: 'transparent'
                            }
                        })
                    },
                    success: ({ message }) => {
                        toastr.success(message, 'Berhasil')
                        $(modal.validasi).modal('hide')
                        tableKonfirmasi.ajax.reload()
                    },
                    error: err => {
                        const { error } = err.responseJSON
                        toastr.error(error, 'Gagal')
                    },
                    complete: () => {
                        $(modal.content).unblock()
                    }
                })
            })
        }

        const submitBatal = () => {
            $(form.batal).on('submit', (e) => {
                e.preventDefault();

                $.ajax({
                    url: `${BASE_URL}int/konfirmasi/batal`,
                    type: 'PUT',
                    dataType: 'JSON',
                    data: $(form.batal).serialize(),
                    beforeSend: xhr => {
                        xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                        $(modal.content).block({
                            message: '<i class="fal fa-spinner fa-spin fa-5x"></i>',
                            overlayCSS: {
                                backgroundColor: '#fff',
                                opacity: 0.8,
                                cursor: 'wait'
                            },
                            css: {
                                border: 0,
                                padding: 0,
                                backgroundColor: 'transparent'
                            }
                        })
                    },
                    success: ({ message }) => {
                        toastr.success(message, 'Berhasil')
                        $(modal.batal).modal('hide')
                        tableKonfirmasi.ajax.reload()
                    },
                    error: err => {
                        const { error } = err.responseJSON
                        toastr.error(error, 'Gagal')
                    },
                    complete: () => {
                        $(modal.content).unblock()
                    }
                })
            })
        }

        return {
            init: () => {
                validasiKonfirmasi()
                batalKonfirmasi()

                submitValid()
                submitBatal()
            }
        }
    })()

    konfirmasiController.init();
})