console.log('Product is running...')

$(function(){
    const DOM = {
        table: '#t_product',
        button: {
            delete: '.btn_delete'
        },
        modal: {
            delete: '#modal_delete',
            content: '.modal-content'
        },
        form: {
            delete: '#form_delete'
        },
        delete_index: {
            id: '#delete_id_product',
            code: '#code_delete'
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

    const tableProduct = $(DOM.table).DataTable({
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
            url: `${BASE_URL}int/product`,
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
                data: "id_product"
            },
            {
                data: "nama_product"
            },
            {
                data: "weight"
            },
            {
                data: "harga"
            },
            {
                data: null, render: (data, type, row) => {
                    return `
                        <a href="${row.foto}" target="__blank">
                            <img src="${row.foto}" alt="Gambar Product">
                        </a>
                    `
                }
            },
            {
                data: "deskripsi"
            },
            {
                data: null, render: (data, type, row) => {
                    let html = ''
                    let {kriteria} = row
                    
                    kriteria.map(v => {
                        if(v.subkriteria !== null){
                            html += `<span class="badge badge-primary">${v.subkriteria.nama_subkriteria}</span> `
                        }
                    })

                    return html;
                }
            },
            {
                data: null, render: (data, type, row) => {
                    return `
						<a href="#/product/edit/${row.id_product}" class="btn btn-success btn-sm"><i class="fal fa-edit"></i> Edit</a>	
						<button class="btn btn-danger btn-sm btn_delete" data-id="${row.id_product}"><i class="fal fa-times"></i> Hapus</button>	
					`
                }
            }
        ],
        order: [[0, "desc"]]
    });

    const productController = (() => {

        const {table, button, form, modal, delete_index} = DOM

        const fetchProduct = (id, callback) => {
            $.ajax({
                url: `${BASE_URL}int/product`,
                data: { id_product: id },
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

        const deleteProduct = () => {
            $(table).on('click', button.delete, function () {
                let id_product = $(this).data('id')

                fetchProduct(id_product, data => {
                    if (data.length === 1) {
                        data.map(v => {
                            $(delete_index.id).val(v.id_product)
                            $(delete_index.code).text(`${v.id_product} - ${v.nama_product}`)
                        })

                        $(modal.delete).modal('show')
                    }
                })
            })
        }

        const submitDelete = () => {
            $(form.delete).on('submit', (e) => {
                e.preventDefault();

                $.ajax({
                    url: `${BASE_URL}int/product/delete`,
                    type: 'DELETE',
                    dataType: 'JSON',
                    data: $(form.delete).serialize(),
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
                        $(modal.delete).modal('hide')
                        tableProduct.ajax.reload()
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
                deleteProduct()
                submitDelete()
            }
        }
    })()

    productController.init()
})