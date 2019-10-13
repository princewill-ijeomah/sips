console.log('Kriteria is running...')

$(function(){
    const DOM = {
        table: '#t_kriteria',
        modal: {
            add: '#modal_add',
            delete: '#modal_delete',
            subkriteria: '#modal_subkriteria',
            content: '.modal-content'
        },
        form: {
            add: '#form_add',
            delete: '#form_delete',
            subkriteria: '#form_subkriteria'
        },
        button: {
            add: '.btn_add',
            delete: '.btn_delete',
            subkriteria: '.btn_subkriteria',
            add_row: '.btn_add_row',
            remove_row: '.btn_remove_row'
        },
        delete_index: {
            id: '#delete_id_kriteria',
            code: '#code_delete'
        },
        sub_index: {
            id: '#sub_id_kriteria',
            nama: '#sub_nama_kriteria',
            container: '#sub_contaier'
        },
        sub_table: '#t_sub'
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

    const tableKriteria = $(DOM.table).DataTable({
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
            url: `${BASE_URL}int/kriteria`,
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
                data: "id_kriteria"
            },
            {
                data: "nama_kriteria"
            },
            {
                data: null, render: (data, type, row) => {
                    const {subkriteria} = row

                    if(subkriteria.length === 0){
                        return `<i class="text-danger">Silahkan input subkriteria</i>`
                    } else {
                        let html = `<ul>`

                        subkriteria.map(v => {
                            html += `
                            <li>${v.nama_subkriteria}</li>
                        `
                        })

                        html += `</ul>`

                        return html
                    }
                }
            },
            {
                data: null, render: (data, type, row) => {
                    return `
						<button class="btn btn-info btn-sm btn_subkriteria" data-id="${row.id_kriteria}"><i class="fal fa-plus"></i> Tambah Sub</button>	
						<button class="btn btn-danger btn-sm btn_delete" data-id="${row.id_kriteria}"><i class="fal fa-times"></i> Hapus</button>	
					`
                }
            }
        ],
        order: [[0, "desc"]]
    })

    const kriteriaUI = (() => {
        return {
            renderSub: (id, data) => {
                let html = '';

                if(data.length > 0){
                    data.map(v => {
                        id++ 

                        html += `
                            <tr id="row_${id}">
                                <td>
                                    <input type="hidden" name="id_subkriteria[]" value="${v.id_subkriteria}">
                                    <input type="text" name="nama_subkriteria[]" required class="form-control" value="${v.nama_subkriteria}">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger btn_remove_row" id="${id}"><i class="fal fa-times"></i></button>
                                </td>
                            </tr>
                        `
                    })
                }

                $(`${DOM.sub_table} tbody`).html(html)
            },
            renderRow: id => {
                let html = `
                    <tr id="row_${id}">
                        <td>
                            <input type="text" name="nama_subkriteria[]" required class="form-control">
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger btn_remove_row" id="${id}"><i class="fal fa-times"></i></button>
                        </td>
                    </tr>
                `

                $(`${DOM.sub_table} tbody`).append(html)
            },
            deleteRow: id => {
                $(`#row_${id}`).remove()
            }
        }
    })()

    const kriteriaController = ((UI) => {

        const {modal, form, button, table, delete_index, sub_index, sub_table} = DOM
        var count = 0;

        const fetchKriteria = (id, callback) => {
            $.ajax({
                url: `${BASE_URL}int/kriteria`,
                data: { id_kriteria: id },
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

        const addKriteria = () => {
            $(button.add).on('click', () => {
                $(form.add)[0].reset()
                $(modal.add).modal('show')
            })
        }

        const deleteKriteria = () => {
            $(table).on('click', button.delete, function(){
                let id = $(this).data('id');

                fetchKriteria(id, data => {
                    if (data.length === 1) {
                        data.map(v => {
                            $(delete_index.id).val(v.id_kriteria)
                            $(delete_index.code).text(`${v.id_kriteria} - ${v.nama_kriteria}`)
                        })

                        $(modal.delete).modal('show')
                    }
                })
            })
        }

        const addSubkriteria = () => {
            $(table).on('click', button.subkriteria, function(){
                let id = $(this).data('id');

                fetchKriteria(id, data => {
                    if (data.length === 1) {
                        data.map(v => {
                            $(sub_index.id).val(v.id_kriteria)
                            $(sub_index.nama).val(v.nama_kriteria)

                            UI.renderSub(count, v.subkriteria)
                        })

                        $(modal.subkriteria).modal('show')
                    }
                })
            })
        }

        const addRow = () => {
            $(button.add_row).on('click', () => {
                count += 1

                UI.renderRow(count)
            })
        }

        const removeRow = () => {
            $(sub_table).on('click', button.remove_row, function () {
                let id = $(this).attr('id')

                UI.deleteRow(id)
            })
        }

        const submitAdd = () => {
            $(form.add).validate({
                rules: {
                    nama_kriteria: 'required'
                },
                messages: {
                    nama_kriteria: 'Silahkan isi dengan nama kriteria'
                },
                submitHandler: form => {
                    $.ajax({
                        url: `${BASE_URL}int/kriteria/add`,
                        type: 'POST',
                        dataType: 'JSON',
                        data: $(form).serialize(),
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
                            $(modal.add).modal('hide')
                            tableKriteria.ajax.reload()
                        },
                        error: err => {
                            const { error } = err.responseJSON
                            toastr.error(error, 'Gagal')
                        },
                        complete: () => {
                            $(modal.content).unblock()
                        }
                    })
                }
            })
        }

        const submitDelete = () => {
            $(form.delete).on('submit', (e) => {
                e.preventDefault();

                $.ajax({
                    url: `${BASE_URL}int/kriteria/delete`,
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
                        tableKriteria.ajax.reload()
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

        const submitSubkriteria = () => {
            $(form.subkriteria).validate({
                rules: {
                    id_kriteria: 'required',
                    nama_kriteria: 'required'
                },
                messages: {
                    id_kriteria: 'Silahkan isi dengan id kriteria',
                    nama_kriteria: 'Silahkan isi dengan nama kriteria'
                },
                submitHandler: form => {
                    $.ajax({
                        url: `${BASE_URL}int/subkriteria/add`,
                        type: 'POST',
                        dataType: 'JSON',
                        data: $(form).serialize(),
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
                            $(modal.subkriteria).modal('hide')
                            tableKriteria.ajax.reload()
                        },
                        error: err => {
                            const { error } = err.responseJSON
                            toastr.error(error, 'Gagal')
                        },
                        complete: () => {
                            $(modal.content).unblock()
                        }
                    })
                }
            })
        }

        return {
            init: () => {
                addKriteria()
                deleteKriteria()
                addSubkriteria()

                addRow()
                removeRow()

                submitAdd()
                submitDelete()
                submitSubkriteria()
            }
        }
    })(kriteriaUI)

    kriteriaController.init()
})