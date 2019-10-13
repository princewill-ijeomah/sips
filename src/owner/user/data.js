console.log('User is running...')

$(function(){
    const DOM = {
        table: '#t_user',
        modal: {
            add: '#modal_add',
            edit: '#modal_edit',
            delete: '#modal_delete',
            content: '.modal-content'
        },
        form: {
            add: '#form_add',
            edit: '#form_edit',
            delete: '#form_delete'
        },
        button: {
            add: '.btn_add',
            edit: '.btn_edit',
            delete: '.btn_delete'
        },
        delete_index: {
            id: '#delete_id_user',
            code: '#code_delete'
        },
        edit_index: {
            id: '#edit_id_user',
            nama: '#edit_nama_lengkap',
            telepon: '#edit_telepon',
            email: '#edit_email',
            alamat: '#edit_alamat',
            tgl_lahir: '#edit_tgl_lahir',
            aktif: '#edit_aktif',
            email: '#edit_email',
            gender: '#edit_jenis_kelamin'
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

    const tableUser = $(DOM.table).DataTable({
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
            url: `${BASE_URL}int/user`,
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
            },
            {
                data: null, render: (data, type, row) => {
                    return `
						<button class="btn btn-success btn-sm btn_edit" data-id="${row.id_user}"><i class="fal fa-edit"></i> Edit</button>	
						<button class="btn btn-danger btn-sm btn_delete" data-id="${row.id_user}"><i class="fal fa-times"></i> Hapus</button>	
					`
                }
            }
        ],
        order: [[0, "desc"]]
    })

    const userUI = (() => {

    })()

    const userController = ((UI) => {

        const {button, modal, form, table, delete_index, edit_index} = DOM

        const fetchUser = (id, callback) => {
            $.ajax({
                url: `${BASE_URL}int/user`,
                data: {id_user: id},
                type: 'GET',
                dataType: 'JSON',
                beforeSend: xhr => {
                    xhr.setRequestHeader("INT-SIPS-KEY", INT_TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                },
                success: ({data}) => {
                    callback(data)
                },
                error: err => {
                    const {error} = err.responseJSON
                    toastr.error(error, 'Gagal')
                }
            })
        }

        const addUser = () => {
            $(button.add).on('click', () => {
                $(form.add)[0].reset()
                $(modal.add).modal('show')
            })
        }

        const editUser = () => {
            $(table).on('click', button.edit, () => {
                let id_user = $(this).data('id')

                fetchUser(id_user, data => {
                    if(data.length === 1){
                        data.map(v => {
                            $(edit_index.id).val(v.id_user)
                            $(edit_index.nama).val(v.nama_lengkap)
                            $(edit_index.alamat).val(v.alamat)
                            $(edit_index.telepon).val(v.telepon)
                            $(edit_index.tgl_lahir).val(v.tgl_lahir)
                            $(edit_index.email).val(v.email)
                            $(edit_index.gender).val(v.jenis_kelamin)
                            $(edit_index.aktif).val(v.aktif)
                        })

                        $(modal.edit).modal('show')
                    }
                })
            })
        }

        const deleteUser = () => {
            $(table).on('click', button.delete, function() {
                let id_user = $(this).data('id')

                fetchUser(id_user, data => {
                    if(data.length === 1){
                        data.map(v => {
                            $(delete_index.id).val(v.id_user)
                            $(delete_index.code).text(`${v.id_user} - ${v.nama_lengkap}`)
                        })

                        $(modal.delete).modal('show')
                    }
                })
            })
        }

        const submitAdd = () => {
            $(form.add).validate({
                rules: {
                    nama_lengkap: 'required',
                    telepon: 'required',
                    email: 'required',
                    username: 'required'
                },
                messages: {
                    nama_lengkap: 'Silahkan mengisi nama lengkap',
                    telepon: 'Silahkan mengisi no telepon',
                    email: 'Silahkan mengisi email',
                    username: 'Silahkan mengisi username'
                },
                submitHandler: form => {
                    $.ajax({
                        url: `${BASE_URL}int/user/add`,
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
                        success: ({message}) => {
                            toastr.success(message, 'Berhasil')
                            $(modal.add).modal('hide')
                            tableUser.ajax.reload()
                        },
                        error: err => {
                            const {error} = err.responseJSON
                            toastr.error(error, 'Gagal')
                        },
                        complete: () => {
                            $(modal.content).unblock()
                        }
                    })
                }
            })
        }

        const submitEdit = () => {
            $(form.edit).validate({
                rules: {
                    id_user: 'required',
                    nama_lengkap: 'required',
                    telepon: 'required',
                    email: 'required',
                    aktif: 'required'
                },
                messages: {
                    id_user: 'ID User tidak ditemukan',
                    nama_lengkap: 'Silahkan mengisi nama lengkap',
                    telepon: 'Silahkan mengisi no telepon',
                    email: 'Silahkan mengisi email',
                    aktif: 'Silahkan memilih status'
                },
                submitHandler: form => {
                    $.ajax({
                        url: `${BASE_URL}int/user/edit`,
                        type: 'PUT',
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
                        success: ({message}) => {
                            toastr.success(message, 'Berhasil')
                            $(modal.edit).modal('hide')
                            tableUser.ajax.reload()
                        },
                        error: err => {
                            const {error} = err.responseJSON
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
                    url: `${BASE_URL}int/user/delete`,
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
                    success: ({message}) => {
                        toastr.success(message, 'Berhasil')
                        $(modal.delete).modal('hide')
                        tableUser.ajax.reload()
                    },
                    error: err => {
                        const {error} = err.responseJSON
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
                addUser()
                editUser()
                deleteUser()

                submitAdd()
                submitEdit()
                submitDelete()
            }
        }
    })(userUI)

    userController.init()
})