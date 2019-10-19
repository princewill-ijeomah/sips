console.log('Add Product is running...')

$(function () {
    const DOM = {
        kategori: {
            container: '#category_content'
        },
        panel: {
            kriteria: '#panel_kriteria',
            add: '#panel_add'
        },
        form: {
            container: '#form_container',
            edit: '#form_edit'
        },
        input: {
            id_product: '#id_product',
            nama_product: '#nama_product',
            weight: '#weight',
            harga: '#harga',
            deskripsi: '#deskripsi'
        }
    }

    const editProductUI = (() => {
        const { kategori, form, input } = DOM

        return {
            setValue: (data, kriteria) => {
                let html = '';
                let no = 0;

                $(input.id_product).val(data.id_product);
                $(input.nama_product).val(data.nama_product);
                $(input.weight).val(data.weight);
                $(input.harga).val(data.harga);
                $(input.deskripsi).val(data.deskripsi);

                const subkriteria = data.kriteria.filter(v => v.subkriteria !== null).map(k => {
                    return k.subkriteria.id_subkriteria
                })

                console.log(subkriteria)

                kriteria.map(v => {
                    html += `
                        <div class="form-group">
                            <label>${v.nama_kriteria}</label>
                            <select class="form-control" name="id_subkriteria[${no++}]" id="id_kriteria[${v.id_kriteria}]" required>
                                <option value="">-</option>
                    `

                    v.subkriteria.map(sub => {
                        html += `<option value="${sub.id_subkriteria}" ${subkriteria.includes(sub.id_subkriteria) ? 'selected' : ''}>${sub.nama_subkriteria}</option>`
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

    const editProductController = ((UI) => {
        const { panel, form } = DOM
        const id_product = location.hash.substr(15)

        const fetchKriteria = () => {
            $.ajax({
                url: `${BASE_URL}int/kriteria`,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: xhr => {
                    xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                    $(panel.kriteria).block({
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
                    fetchProduct(id_product, data)
                },
                error: err => {
                    const { error } = err.responseJSON
                    toastr.error(error, 'Gagal')
                },
                complete: () => {
                    $(panel.kriteria).unblock()
                }
            })
        }

        const fetchProduct = (id, kriteria) => {
            $.ajax({
                url: `${BASE_URL}int/product`,
                type: 'GET',
                data: {id_product: id},
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
                    if(data.length === 1){
                        data.map(v => {
                            UI.setValue(v, kriteria)
                        })
                    }
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

        const submitEdit = () => {
            $(form.edit).validate({
                rules: {
                    'nama_product': 'required',
                    'weight': 'required',
                    'harga': 'required',
                    'deskripsi': 'required',
                },
                messages: {
                    'nama_product': 'Field wajib diisi',
                    'weight': 'Field wajib diisi',
                    'harga': 'Field wajib diisi',
                    'deskripsi': 'Field wajib diisi',
                },
                submitHandler: form => {
                    $.ajax({
                        url: `${BASE_URL}int/product/edit`,
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
                submitEdit()
            }
        }
    })(editProductUI)

    editProductController.init();
})