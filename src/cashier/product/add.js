console.log('Add Product is running...')

$(function(){
    const DOM = {
        kategori: {
            container: '#category_content'
        },
        panel: {
            add: '#panel-add'
        },
        form: {
            container: '#form_container',
            add: '#form_add'
        }
    }

    const addProductUI = (() => {
        const { kategori, form} = DOM

        return {
            renderContainer: (data) => {
                let html = '';
                let no = 0;

                data.map(kriteria => {
                    html += `
                        <div class="form-group">
                            <label>${kriteria.nama_kriteria}</label>
                            <select class="form-control" name="id_subkriteria[${no++}]" required>
                                <option value="">-</option>
                    `

                    kriteria.subkriteria.map(subkriteria => {
                        html += `<option value="${subkriteria.id_subkriteria}">${subkriteria.nama_subkriteria}</option>`
                    })

                    html += `
                            </select>
                        </div>
                    `;
                })

                $(kategori.container).html(html)
            }
        }
    })()

    const addProductController = ((UI) => {
        const { panel, form } = DOM

        const fetchKriteria = () => {
            $.ajax({
                url: `${BASE_URL}int/kriteria`,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: xhr => {
                    xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                    $(panel.add).block({
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
                success: ({ data }) => {
                    UI.renderContainer(data)
                },
                error: err => {
                    const { error } = err.responseJSON
                    toastr.error(error, 'Gagal')
                },
                complete: () => {
                    $(panel.add).unblock()
                }
            })
        }

        const submitAdd = () => {
            $(form.add).validate({
                rules: {
                    'nama_product': 'required',
                    'weight': 'required',
                    'harga': 'required',
                    'deskripsi': 'required',
                    'stok': 'required',
                    'foto': 'required',
                },
                messages: {
                    'nama_product': 'Field wajib diisi',
                    'weight': 'Field wajib diisi',
                    'harga': 'Field wajib diisi',
                    'deskripsi': 'Field wajib diisi',
                    'stok': 'Field wajib diisi',
                    'foto': 'Field wajib diisi',
                },
                submitHandler: form => {
                    $.ajax({
                        url: `${BASE_URL}int/product/add`,
                        type: 'POST',
                        dataType: 'JSON',
                        data: new FormData(form),
                        contentType: false,
                        processData: false,
                        beforeSend: xhr => {
                            xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                            xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                            $.blockUI({
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
                            location.hash = '#/product'
                        },
                        error: err => {
                            const { error } = err.responseJSON
                            toastr.error(error, 'Gagal')
                        },
                        complete: () => {
                            $.unblockUI()
                        }
                    })
                }
            })
        }

        return {
            init: () => {
                fetchKriteria()
                submitAdd()
            }
        }
    })(addProductUI)

    addProductController.init();
})