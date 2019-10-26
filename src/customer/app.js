const DOM = {
    main_page: {
        container: '#page_container',
        navbar: '#navbar_container',
        topbar: '#topbar_container',
        button: {
            logout: '.btn_logout'
        },
        backdrop: '.modal-backdrop'
    },
    auth_page: {
        row: {
            login: '#login_row',
            register: '#register_row'
        },
        container: {
            login: '#login_container',
            register: '#register_container'
        },
        form: {
            login: '#form_login',
            register: '#form_register',
            password: '#form_password'
        },
        input: {
            login: {
                username: '#login_username',
                password: '#login_password',
                show_pass: '#login_show_pass',
            },
            register: {
                nama_lengkap: '#register_nama_lengkap',
                jenis_kelamin: '#register_jenis_kelamin',
                tgl_lahir: '#register_tgl_lahir',
                alamat: '#register_alamat',
                telepon: '#register_telepon',
                email: '#register_email',
                username: '#register_username',
                password: '#register_password',
                retype: '#register_retype',
                show_pass: '#register_show_pass',
            }
        },
        button: {
            login: '.btn_login',
            register: '.btn_register',
            password: '#btn_password'
        },
        modal: {
            password: '#modal_password',
            content: '.modal-content'
        }
    },
    setting_page: {
        container: {
            profile: '#edit_profile_container',
            password: '#ganti_password_container'
        },
        link: {
            profile: '#link_profile',
            password: '#link_password'
        },
        form: {
            profile: '#form_profile',
            password: '#form_password'
        },
        input: {
            profile: {
                nama_lengkap: '#nama_lengkap',
                jenis_kelamin: '#jenis_kelamin',
                tgl_lahir: '#tgl_lahir',
                alamat: '#alamat',
                telepon: '#telepon'
            },
            password: {
                old_password: '#old_password',
                new_password: '#new_password',
                retype_password: '#retype_password',
                show_password: '#show_password'
            }
        }
    },
    transaksi_page: {
        table: '#t_transaksi'
    },
    product_page: {
        container: {
            form: '#form_product_container',
            result: '#result_container'
        },
        form: {
            product: '#form_product'
        },
        button: {
            cart: '.btn_to_cart',
            plus: '.plus',
            minus: '.minus'
        }
    },
    cart_page: {
        table: '#t_cart',
        form: '#form_transaksi',
        input: {
            alamat_kirim: '#alamat_kirim',
            telepon: '#telepon',
            total: '#total'
        },
        button: {
            remove: '.remove',
            plus: '.plus',
            minus: '.minus'
        },
        text: {
            total: '.total',
            grand_total: '.grand_total'
        }
    },
    checkout_page: {
        container: '#checkout_container',
        table: '#t_detail',
        form: {
            checkout: '#form_checkout',
            cancel: '#form_cancel'
        },
        input: {
            no_transaksi: '#no_transaksi',
            cancel_trx: '#cancel_no_transaksi'
        },
        text: {
            total: '.total',
            cancel: '.cancel_text'
        },
        button: {
            cancel: '.btn_cancel'
        },
        modal: {
            cancel: '#modal_cancel',
            container: '.modal-content'
        }
    },
    invoice_page: {
        container: {
            invoice: '#invoice_container',
            data: '#invoice_data'
        },
        button: {
            print: '.btn_print'
        }
    }
}

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": true,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
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

const mainUI = (() => {
    const { container, navbar, topbar } = DOM.main_page

    return {
        renderPrivateNavbar: (data) => {
            let domNavbar = `
                <div class="header-nav header-nav-links order-2 order-lg-1">
                    <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
                        <nav class="collapse">
                            <ul class="nav nav-pills" id="mainNav">
                                <li class="">
                                    <a class="dropdown-item dropdown-toggle" href="#/home">
                                        Halaman Utama
                                    </a>
                                </li>
                                <li class="">
                                    <a class="dropdown-item dropdown-toggle" href="#/product">
                                        Suplemen
                                    </a>
                                </li>
                                <li class="">
                                    <a class="dropdown-item dropdown-toggle" href="#/transaksi">
                                        Riwayat Pesanan
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
                <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
                    <div class="header-nav-feature header-nav-features-search d-inline-flex">
                        <a href="#/setting" class=""><i class="fas fa-cog header-nav-top-icon"></i></a>
                    </div>
                    <div class="header-nav-feature header-nav-features-cart d-inline-flex ml-2">
                        <a href="#/cart" class=""><i class="fas fa-shopping-bag"></i></a>
                    </div>
                    <div class="header-nav-feature header-nav-features-search d-inline-flex ml-2">
                        <a class="btn_logout" style="cursor: pointer"><i class="icon-power text-danger header-nav-top-icon"></i></a>
                    </div>
                </div>
            `

            let domTopbar = `
                <nav class="header-nav-top" >
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            Selamat datang <b>${data.nama_lengkap}</b>
                        </li>
                    </ul>					
                </nav>
            `

            $(navbar).html(domNavbar)
            $(topbar).html(domTopbar)
        },
        renderPublicNavbar: () => {
            let domNavbar = `
                <div class="header-nav header-nav-links order-2 order-lg-1">
                    <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
                        <nav class="collapse">
                            <ul class="nav nav-pills" id="mainNav">
                                <li class="">
                                    <a class="dropdown-item dropdown-toggle" href="#/home">
                                        Halaman Utama
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                    <button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            `

            let domTopbar = `
                <nav class="header-nav-top">
                    <ul class="nav nav-pills text-uppercase text-2">
                        <li class="nav-item nav-item-anim-icon d-none d-md-block">
                            <a class="nav-link pl-0" href="${BASE_URL}auth"><i class="fas fa-angle-right"></i> Login / Register</a>
                        </li>
                    </ul>
                </nav>
            `
            $(navbar).html(domNavbar)
            $(topbar).html(domTopbar)
        },
    }
})()

const mainController = ((UI) => {

    const {container, navbar, topbar, button, backdrop} = DOM.main_page
    const private_page = ['product', 'transaksi', 'cart', 'setting'];

    const verifyUser = () => {
        if (EXT_TOKEN) {
            $.ajax({
                url: `${BASE_URL}ext/setting/verify_user`,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                    xhr.setRequestHeader("EXT-SIPS-KEY", EXT_TOKEN)
                },
                success: function (res) {
                    if (res.status === true) {
                        const { level, aktif } = res.data;

                        if (aktif === 'T') {
                            localStorage.removeItem('EXT-SIPS-KEY')
                            UI.renderPublicNavbar()
                        } else {
                            auth = true
                            UI.renderPrivateNavbar(res.data)
                        }
                    } else {
                        localStorage.removeItem('EXT-SIPS-KEY')
                        UI.renderPublicNavbar()
                    }
                },
                error: function (err) {
                    localStorage.removeItem('EXT-SIPS-KEY')
                    UI.renderPublicNavbar()
                }
            })
        } else {
            UI.renderPublicNavbar()
        }
    }

    const loadContent = path => {
        $.ajax({
            url: `${BASE_URL}customer/${path}`,
            dataType: 'HTML',
            beforeSend: function () {
                $.blockUI({
                    message: '<i class="fas fa-spinner fa-spin fa-5x"></i>',
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
                });
            },
            success: function (response) {
                $(container).html(response)
                $(backdrop).remove()
                $.unblockUI();
            },
            error: function () {
                window.location.replace(`${BASE_URL}not_found`);
            }
        })
    }

    const setRoute = () => {
        let path;

        if (!location.hash) {
            location.hash = '#/home';
        } else {{
            path = location.hash.substr(2);

            loadContent(path);
        }}

        $(window).on('hashchange', function () {
            path = location.hash.substr(2);

            loadContent(path);
        });
    }

    const logout = () => {
        $(navbar).on('click', button.logout, function () {
            $.ajax({
                url: `${BASE_URL}ext/setting/logout`,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: xhr => {
                    xhr.setRequestHeader("EXT-SIPS-KEY", EXT_TOKEN)
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                    $.blockUI({
                        message: '<i class="fas fa-spinner fa-spin fa-5x"></i>',
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
                    localStorage.removeItem('EXT-SIPS-KEY')
                    window.location.replace(`${BASE_URL}auth`)
                },
                error: err => {
                    const { error } = err.responseJSON
                    toastr.error(error, 'Gagal')
                },
                complete: () => {
                    $.unblockUI()
                }
            })
        })
    }

    return {
        init: () => {
            verifyUser()
            setRoute()
            logout()
        }
    }
})(mainUI)

const authController = (() => {
    const {form, input, container, button, row, modal} = DOM.auth_page

    const verifyUser = () => {
        if (EXT_TOKEN) {
            $.ajax({
                url: `${BASE_URL}ext/setting/verify_user`,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                    xhr.setRequestHeader("EXT-SIPS-KEY", EXT_TOKEN)
                },
                success: function (res) {
                    if (res.data.length !== 0) {
                        const { level, aktif } = res.data;

                        if (aktif === 'Y') {
                            window.location.replace(`${BASE_URL}`)
                        } else {
                            localStorage.removeItem('EXT-SIPS-KEY')
                        }
                    } else {
                        localStorage.removeItem('EXT-SIPS-KEY')
                    }

                },
                error: function (err) {
                    localStorage.removeItem('EXT-SIPS-KEY')
                }
            })
        }
    }

    const submitLogin = () => {
        $(form.login).validate({
            rules: {
                username: 'required',
                password: 'required'
            },
            messages: {
                username: 'Silahkan mengisi username',
                password: 'Silahkan mengisi password'
            },
            submitHandler: form => {
                $.ajax({
                    url: `${BASE_URL}ext/auth/login`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: $(form).serialize(),
                    beforeSend: xhr => {
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                        $(container.login).block({
                            message: '<i class="fas fa-spinner fa-spin fa-5x"></i>',
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
                        });
                    },
                    success: ({ data }) => {
                        localStorage.setItem('EXT-SIPS-KEY', data.key);
                        window.location.replace(`${BASE_URL}`)
                    },
                    error: err => {
                        const { error } = err.responseJSON
                        toastr.error(error, 'Gagal')
                    },
                    complete: () => {
                        $(container.login).unblock();
                    }
                })
            }
        })
    }

    const submitRegister = () => {
        $(form.register).validate({
            rules: {
                nama_lengkap: 'required',
                jenis_kelamin: 'required',
                tgl_lahir: 'required',
                alamat: 'required',
                telepon: 'required',
                email: 'required',
                username: 'required',
                password: 'required',
                retype: {
                    required: true,
                    equalTo: input.register.retype
                },
            },
            messages: {
                nama_lengkap: 'Silahkan isi nama lengkap',
                jenis_kelamin: 'Silahkan pilih jenis kelamin',
                tgl_lahir: 'Silahkan pilih tanggal lahir',
                alamat: 'Silahkan isi alamat',
                telepon: 'Silahkan isi telepon',
                email: 'Silahkan isi email',
                username: 'Silahkan isi username',
                password: 'Silahkan isi password',
                retype: {
                    required: 'Silahkan isi field ini',
                    equalTo: 'Harus sama dengan passwword'
                },
            },
            submitHandler: form => {
                $.ajax({
                    url: `${BASE_URL}ext/auth/register`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: $(form).serialize(),
                    beforeSend: xhr => {
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                        $(container.register).block({
                            message: '<i class="fas fa-spinner fa-spin fa-5x"></i>',
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
                        });
                    },
                    success: ({ message }) => {
                        toastr.success(message, 'Berhasil');
                        $(button.login).click()
                    },
                    error: err => {
                        const { error } = err.responseJSON
                        toastr.error(error, 'Gagal')
                    },
                    complete: () => {
                        $(container.register).unblock();
                    }
                })
            }
        })
    }

    const submitPassword = () => {
        $(form.password).validate({
            rules: {
                email: 'required',
            },
            messages: {
                email: 'Silahkan mengisi email',
            },
            submitHandler: form => {
                $.ajax({
                    url: `${BASE_URL}ext/auth/forgot_password`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: $(form).serialize(),
                    beforeSend: xhr => {
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                        $(modal.content).block({
                            message: '<i class="fas fa-spinner fa-spin fa-5x"></i>',
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
                        });
                    },
                    success: ({ message }) => {
                        toastr.success(message, 'Berhasil')
                        $(modal.password).modal('hide')
                    },
                    error: err => {
                        const { error } = err.responseJSON
                        toastr.error(error, 'Gagal')
                    },
                    complete: () => {
                        $(modal.content).unblock();
                    }
                })
            }
        })
    }

    const showPassListener = () => {
        $(input.login.show_pass).click(function () {
            if ($(this).is(':checked')) {
                $(input.login.password).attr('type', 'text');
            } else {
                $(input.login.password).attr('type', 'password');
            };
        });
    }

    const openLogin = () => {
        $(button.login).on('click', function(){
            $(form.login)[0].reset()
            $(row.login).show();
            $(row.register).hide();
        })
    }

    const openRegister = () => {
        $(button.register).on('click', function () {
            $(form.register)[0].reset()
            $(row.login).hide();
            $(row.register).show();
        })
    }

    const openPassword = () => {
        $(button.password).on('click', function() {
            $(form.password)[0].reset();
            $(modal.password).modal('show')
        })
    }

    return {
        init: () => {
            verifyUser()

            submitLogin()
            submitRegister()
            submitPassword()

            showPassListener()
            
            openLogin()
            openRegister()
            openPassword()
        }
    }
})()

const settingController = (() => {
    const {container, form, link, input} = DOM.setting_page

    const openProfile = () => {
        $(link.profile).on('click', function(){
            $(container.profile).show()
            $(container.password).hide()
        })
    }

    const openPassword = () => {
        $(link.password).on('click', function () {
            $(form.password)[0].reset()
            $(container.profile).hide()
            $(container.password).show()
        })
    }

    const fetchUser = () => {
        $.ajax({
            url: `${BASE_URL}ext/setting/verify_user`,
            type: 'GET',
            dataType: 'JSON',
            beforeSend: xhr => {
                xhr.setRequestHeader("EXT-SIPS-KEY", EXT_TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                $(container.profile).block({
                    message: '<i class="fas fa-spinner fa-spin fa-5x"></i>',
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
                $(input.profile.nama_lengkap).val(data.nama_lengkap)
                $(input.profile.jenis_kelamin).val(data.jenis_kelamin)
                $(input.profile.tgl_lahir).val(data.tgl_lahir)
                $(input.profile.alamat).val(data.alamat)
                $(input.profile.telepon).val(data.telepon)
            },
            error: err => {
                const { error } = err.responseJSON
                toastr.error(error, 'Gagal')
            },
            complete: () => {
                $(container.profile).unblock()
            }
        })
    }

    const submitProfile = () => {
        $(form.profile).validate({
            rules: {
                nama_lengkap: 'required',
                jenis_kelamin: 'required',
                tgl_lahir: 'required',
                alamat: 'required',
                telepon: 'required',
            },
            messages: {
                nama_lengkap: 'Field harus diisi',
                jenis_kelamin: 'Field harus diisi',
                tgl_lahir: 'Field harus diisi',
                alamat: 'Field harus diisi',
                telepon: 'Field harus diisi',
            },
            submitHandler: form => {
                $.ajax({
                    url: `${BASE_URL}ext/setting/edit_profile`,
                    type: 'PUT',
                    dataType: 'JSON',
                    data: $(form).serialize(),
                    beforeSend: xhr => {
                        xhr.setRequestHeader("EXT-SIPS-KEY", EXT_TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                        $(container.profile).block({
                            message: '<i class="fas fa-spinner fa-spin fa-5x"></i>',
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
                        fetchUser()
                        toastr.success(message, 'Berhasil')
                    },
                    error: err => {
                        const { error } = err.responseJSON
                        toastr.error(error, 'Gagal')
                    },
                    complete: () => {
                        $(container.profile).unblock()
                    }
                })
            }
        })
    }

    const submitPassword = () => {
        $(form.password).validate({
            rules: {
                old_password: 'required',
                new_password: 'required',
                retype_password: {
                    required: true,
                    equalTo: input.password.new_password
                }
            },
            messages: {
                old_password: 'Field harus diisi',
                new_password: 'Field harus diisi',
                retype_password: {
                    required: 'Field harus diisi',
                    equalTo: 'Password harus sama dengan password baru'
                }
            },
            submitHandler: form => {
                $.ajax({
                    url: `${BASE_URL}ext/setting/change_password`,
                    type: 'PUT',
                    dataType: 'JSON',
                    data: $(form).serialize(),
                    beforeSend: xhr => {
                        xhr.setRequestHeader("EXT-SIPS-KEY", EXT_TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                        $(container.password).block({
                            message: '<i class="fas fa-spinner fa-spin fa-5x"></i>',
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
                        $(form)[0].reset()
                        toastr.success(message, 'Berhasil')
                    },
                    error: err => {
                        const { error } = err.responseJSON
                        toastr.error(error, 'Gagal')
                    },
                    complete: () => {
                        $(container.password).unblock()
                    }
                })
            }
        })
    }

    const showPass = () => {
        $(input.password.show_password).click(function () {
            if ($(this).is(':checked')) {
                $(input.password.old_password).attr('type', 'text');
                $(input.password.new_password).attr('type', 'text');
                $(input.password.retype_password).attr('type', 'text');
            } else {
                $(input.password.old_password).attr('type', 'password');
                $(input.password.new_password).attr('type', 'password');
                $(input.password.retype_password).attr('type', 'password');
            };
        });
    }

    return {
        init: () => {
            fetchUser()
            openProfile()
            openPassword()

            submitProfile()
            submitPassword()
            showPass()
        }
    }
})()

const transaksiController = (() => {
    const { table } = DOM.transaksi_page

    const transaksiDatatable = () => {
        const tableTransaksi = $(table).DataTable({
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
                url: `${BASE_URL}ext/transaksi`,
                type: 'GET',
                dataType: 'JSON',
                beforeSend: xhr => {
                    xhr.setRequestHeader("EXT-SIPS-KEY", EXT_TOKEN)
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
                    data: "id",
                    render: (data, type, row, meta) => {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                {
                    data: "no_transaksi",
                    render: (data, type, row) => {
                        return `
                            <div class="text-info"><a href="#/transaksi/${row.no_transaksi}">${row.no_transaksi}</a></div>
                            <div class="text-muted">${row.alamat_kirim}</div>
                        `
                    }
                },
                {
                    data: "tgl_transaksi"
                },
                {
                    data: "status",
                    render: (data, type, row) => {
                        if (row.status === 'Dibayar') {
                            return `<span class="badge badge-success">${row.status}</span> `
                        } else {
                            return `<span class="badge badge-danger">${row.status}</span>`
                        }
                    }
                },
                {
                    data: "detail",
                    render: (data, type, row) => {
                        let { detail } = row

                        let total = detail.reduce((a, b) => a + parseInt(b.total_harga), 0)
                        return `Rp. ${total.toLocaleString(['ban', 'id'])}`;
                    }
                },
                {
                    data: null,
                    render: (data, type, row) => {
                        if(row.status === 'Dibayar'){
                            return `
                                <a href="#/transaksi/${row.no_transaksi}" class="btn btn-info btn-sm">Cetak</a>
                            `
                        } else if(row.status === 'Batal'){
                            return `
                                <div class="text-danger">Dibatalkan</div>
                            `
                        } else {
                            return `
                                <a href="#/checkout/${row.no_transaksi}" class="btn btn-success btn-sm">Konfirmasi Pembayaran</a>
                            `
                        }
                    }
                }
            ],
            order: [[1, "desc"]]
        })

        return tableTransaksi
    }

    return {
        init: () => {
            transaksiDatatable()
        }
    }
})()

const productUI = (() => {
    const {container, form} = DOM.product_page

    return {
        renderForm: data => {
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

            $(container.form).html(html);
        },
        renderResult: data => {
            let html = '';

            data.map(v => {
                let kriteria_dom = v.kriteria.map(k => {
                    return `
                        ${k.subkriteria.nama_subkriteria}
                    `
                })

                html += `
                    <div class="row">
                        <div class="col-lg-6">

                            <div class="">
                                <img alt="" style="height: 300px" class="img-fluid" src="${v.foto}">
                            </div>

                        </div>

                        <div class="col-lg-6">

                            <div class="summary entry-summary">

                                <h1 class="mb-0 font-weight-bold text-7">${v.nama_product}</h1>

                                <p class="price">
                                    <span class="amount">Rp. ${parseInt(v.harga).toLocaleString(['ban', 'id'])}</span>
                                </p>

                                <p class="mb-5">${v.deskripsi.replace(/(\r\n|\n|\r)/gm, '<br>')}</p>

                                <form class="cart">
                                    <div class="quantity quantity-lg">
                                        <input type="button" class="minus" value="-" data-id="${v.id_product}">
                                        <input type="number" class="input-text qty text" title="Qty" value="1" name="qty" id="qty-${v.id_product}" required min="1" step="1">
                                        <input type="button" class="plus" value="+" data-id="${v.id_product}">
                                    </div>
                                    <button type="button" class="btn btn-primary btn-modern text-uppercase btn_to_cart" data-id="${v.id_product}">Tambah ke keranjang</button>
                                </form>

                                <div class="product-meta">
                                    <span class="posted-in">Kriteria: <a class="text-info">${kriteria_dom}.</a></span>
                                </div>

                            </div>

                        </div>
                    </div>
                `
            })

            $(container.result).html(html)
        },
        renderNoData: () => {
            let html = `
                <div class="text-center mt-5">
                        <h2 class="text-muted">Kami tidak menemukan product yang anda inginkan.</h2>
                        <h4 class="text-muted">Silahkan cari dengan kriteria lainnya</h4>
                </div>
            `

            $(container.result).html(html)
        }
    }
})()

const productController = ((UI) => {
    const {container, form, button} = DOM.product_page

    const fetchKriteria = () => {
        $.ajax({
            url: `${BASE_URL}ext/kriteria`,
            type: 'GET',
            dataType: 'JSON',
            beforeSend: xhr => {
                xhr.setRequestHeader("EXT-SIPS-KEY", EXT_TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                $(container.form).block({
                    message: '<i class="fas fa-spinner fa-spin fa-5x"></i>',
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
                UI.renderForm(data)
            },
            error: err => {
                const { error } = err.responseJSON
                toastr.error(error, 'Gagal')
            },
            complete: () => {
                $(container.form).unblock()
            },
            statusCode: {
                401: () => {
                    window.location.replace(`${BASE_URL}auth`)
                }
            }
        })
    }

    const submitProduct = () => {
        $(form.product).validate({
            submitHandler: form => {
                $.ajax({
                    url: `${BASE_URL}ext/product/search`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: $(form).serialize(),
                    beforeSend: xhr => {
                        xhr.setRequestHeader("EXT-SIPS-KEY", EXT_TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                        $(container.result).block({
                            message: '<i class="fas fa-spinner fa-spin fa-5x"></i>',
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
                        if(data.length !== 0){
                            UI.renderResult(data)
                        } else {
                            UI.renderNoData()
                        }
                    },
                    error: err => {
                        const { error } = err.responseJSON
                        toastr.error(error, 'Gagal')
                    },
                    complete: () => {
                        $(container.result).unblock()
                    }
                })
            }
        })
    }

    const plusQty = () => {
        $(container.result).on('click', button.plus, function () {
            let id_product = $(this).data('id');
            let qty = $(`#qty-${id_product}`).val()
            let new_qty = parseInt(qty) + 1

            $(`#qty-${id_product}`).val(new_qty);
        })
    }

    const minusQty = () => {
        $(container.result).on('click', button.minus, function () {
            let id_product = $(this).data('id');
            let qty = $(`#qty-${id_product}`).val()
            let new_qty = parseInt(qty) - 1

            $(`#qty-${id_product}`).val(new_qty);
        })
    }

    const addToChart = () => {
        $(container.result).on('click', button.cart, function(){
            let id_product = $(this).data('id');
            let qty = $(`#qty-${id_product}`).val()

            if(parseInt(qty) <= 0){
                toastr.warning('Harap masukkan qty dengan benar', 'Warning')
            } else {
                $.ajax({
                    url: `${BASE_URL}ext/cart/add`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: {
                        id_product,
                        qty
                    },
                    beforeSend: xhr => {
                        xhr.setRequestHeader("EXT-SIPS-KEY", EXT_TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                        $(container.result).block({
                            message: '<i class="fas fa-spinner fa-spin fa-5x"></i>',
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
                        toastr.success(message, 'Success')
                    },
                    error: err => {
                        const { error } = err.responseJSON
                        toastr.error(error, 'Gagal')
                    },
                    complete: () => {
                        $(container.result).unblock()
                    }
                })
            }
        })
    }

    return {
        init: () => {
            fetchKriteria()
            submitProduct()
            addToChart()

            plusQty()
            minusQty()
        }
    }
})(productUI)

const cartUI = (() => {
    const {table, input, button, form, text} = DOM.cart_page

    return {
        renderDetail: data => {
            let html = ''
            let customer = {}
            let grand_total = 0;

            data.map(v => {
                let subtotal = parseInt(v.product.harga) * parseInt(v.qty);

                customer = v.customer
                grand_total += subtotal

                html += `
                    <tr class="cart_table_item">
                        <td class="product-remove">
                            <a title="Remove this item" class="remove text-danger" id="${v.id}">
                                <i class="fas fa-times"></i>
                            </a>
                        </td>
                        <td class="product-thumbnail">
                            <a href="${v.product.foto}" target="__blank">
                                <img width="100" height="100" alt="" class="img-fluid" src="${v.product.foto}">
                            </a>
                        </td>
                        <td>
                            <a class="text-info">${v.product.nama_product}</a>
                        </td>
                        <td class="product-price">
                            <span class="amount">Rp. ${parseInt(v.product.harga).toLocaleString(['ban', 'id'])}</span>
                        </td>
                        <td class="product-quantity">
                            <div class="quantity">
                                <input type="button" class="minus" value="-" data-id="${v.id}" data-harga="${v.product.harga}" required>
                                <input type="hidden" name="id_product[${v.id}]" id="id_product-${v.id}" value="${v.product.id_product}" required>
                                <input type="hidden" name="harga_satuan[${v.id}]" id="harga_satuan-${v.id}" value="${v.product.harga}" required>
                                <input type="hidden" name="total_harga[${v.id}]" id="total_harga-${v.id}"  value="${subtotal}" required>
                                <input type="number" name="qty[${v.id}]" id="qty-${v.id}" class="input-text qty text" title="Qty" value="${v.qty}" min="1" required>
                                <input type="button" class="plus" value="+" data-id="${v.id}" data-harga="${v.product.harga}">
                            </div>
                        </td>
                        <td class="product-subtotal">
                            <span class="amount" id="total-${v.id}">Rp. ${subtotal.toLocaleString(['ban', 'id'])}</span>
                        </td>
                    </tr>
                `
            })

            $(`${table} tbody`).html(html)
            $(input.alamat_kirim).val(customer.alamat)
            $(input.telepon).val(customer.telepon)
            $(input.total).val(grand_total)
            $(text.total).text(`Rp. ${grand_total.toLocaleString(['ban', 'id'])}`)
            $(text.grand_total).text(`Rp. ${grand_total.toLocaleString(['ban', 'id'])}`)
        },
        renderNoData: () => {
            let html = `
                <tr>
                    <td colspan="6" class="text-center">Silahkan lakukan pembelanjaan</td>
                </tr>
            `

            $(`${table} tbody`).html(html);
        }
    }
})()

const cartController = ((UI) => {
    const {table, input, button, form, text} = DOM.cart_page

    const fetchCart = () => {
        $.ajax({
            url: `${BASE_URL}ext/cart`,
            type: 'GET',
            dataType: 'JSON',
            beforeSend: xhr => {
                xhr.setRequestHeader("EXT-SIPS-KEY", EXT_TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                $.blockUI({
                    message: '<i class="fas fa-spinner fa-spin fa-5x"></i>',
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
                if(data.length !== 0){
                    UI.renderDetail(data)
                } else {
                    UI.renderNoData()
                }
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

    const plusQty = () => {
        $(table).on('click', button.plus, function () {
            let id = $(this).data('id');
            let harga = $(this).data('harga');
            let qty = $(`#qty-${id}`).val()
            let total = $(input.total).val()

            let new_qty = parseInt(qty) + 1
            let new_total = parseInt(harga) * new_qty
            total = parseInt(total) + parseInt(harga)


            $(`#qty-${id}`).val(new_qty);
            $(`#total_harga-${id}`).val(new_total);
            $(`#total-${id}`).text(`Rp. ${new_total.toLocaleString(['ban', 'id'])}`);
            $(text.total).text(`Rp. ${total.toLocaleString(['ban', 'id'])}`);
            $(text.grand_total).text(`Rp. ${total.toLocaleString(['ban', 'id'])}`);
            $(input.total).val(total);
        })
    }

    const minusQty = () => {
        $(table).on('click', button.minus, function () {
            let id = $(this).data('id');
            let harga = $(this).data('harga');
            let qty = $(`#qty-${id}`).val()
            let total = $(input.total).val()

            let new_qty = parseInt(qty) - 1
            let new_total = parseInt(harga) * new_qty
            total = parseInt(total) - parseInt(harga)

            $(`#qty-${id}`).val(new_qty);
            $(`#total_harga-${id}`).val(new_total);
            $(`#total-${id}`).text(`Rp. ${new_total.toLocaleString(['ban', 'id'])}`);
            $(text.total).text(`Rp. ${total.toLocaleString(['ban', 'id'])}`);
            $(text.grand_total).text(`Rp. ${total.toLocaleString(['ban', 'id'])}`);
            $(input.total).val(total);
        })
    }

    const submitForm = () => {
        $(form).validate({
            submitHandler: form => {
                $.ajax({
                    url: `${BASE_URL}ext/transaksi/add`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: $(form).serialize(),
                    beforeSend: xhr => {
                        xhr.setRequestHeader("EXT-SIPS-KEY", EXT_TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                        $.blockUI({
                            message: '<i class="fas fa-spinner fa-spin fa-5x"></i>',
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
                    success: ({ message, id }) => {
                        toastr.success(message, 'Berhasil')
                        location.hash = `#/checkout/${id}`
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
            fetchCart()
            plusQty()
            minusQty()

            submitForm()
        }
    }
})(cartUI)

const checkoutUI = (() => {
    const {table, text, input, button, container} = DOM.checkout_page

    return {
        renderData: data => {
            let html = '';

            data.detail.map(v => {
                html += `
                    <tr class="cart_table_item">
                        <td class="product-thumbnail">
                            <a href="${v.product.foto}" target="__blank">
                                <img width="100" height="100" alt="" class="img-fluid" src="${v.product.foto}">
                            </a>
                        </td>
                        <td class="product-name">
                            <a class="text-info">${v.product.nama_product}</a>
                        </td>
                        <td class="product-price">
                            <span class="amount">Rp. ${parseInt(v.harga_satuan).toLocaleString(['ban', 'id'])}</span>
                        </td>
                        <td class="product-quantity text-center">
                            ${v.qty}
                        </td>
                        <td class="product-subtotal">
                            <span class="amount">Rp. ${parseInt(v.total_harga).toLocaleString(['ban', 'id'])}</span>
                        </td>
                    </tr>
                `
            })

            $(`${table} tbody`).html(html)
            $(input.no_transaksi).val(data.no_transaksi)
            $(button.cancel).attr('id', data.no_transaksi)
            $(text.total).text(`Rp. ${parseInt(data.total).toLocaleString(['ban', 'id'])}`)
        },
        renderNoData: () => {
            let html = `
                <div class="text-center mt-5">
                    <h2 class="text-muted">Data tidak ditemukan.</h2>
                    <h4 class="text-muted">Silahkan cari transaksi lainnya</h4>
                </div>
            `

            $(container).html(html)
        }
    }
})()

const checkoutController = ((UI) => {
    const { form, button, input, modal, text } = DOM.checkout_page
    
    const fetchTransaksi = () => {
        let no_transaksi = location.hash.substr(11)

        $.ajax({
            url: `${BASE_URL}ext/transaksi`,
            type: 'GET',
            data: {no_transaksi: no_transaksi},
            dataType: 'JSON',
            beforeSend: xhr => {
                xhr.setRequestHeader("EXT-SIPS-KEY", EXT_TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                $.blockUI({
                    message: '<i class="fas fa-spinner fa-spin fa-5x"></i>',
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
                if (data.length === 1) {
                    data.map(v => {
                        if(v.status === 'Belum Dibayar'){
                            UI.renderData(v)
                        } else {
                            UI.renderNoData()
                        }
                    })
                } else {
                    UI.renderNoData()
                }
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

    const submitCheckout = () => {
        $(form.checkout).validate({
            rules: {
                no_transaksi: 'required',
                bank: 'required',
                bank_pengirim: 'required',
                no_rekening: 'required',
                nama_pengirim: 'required',
                tgl_transfer: 'required',
                jml_transfer: 'required',
                foto: 'required'
            },
            messages: {
                no_transaksi: 'Field wajib diisi',
                bank: 'Field wajib diisi',
                bank_pengirim: 'Field wajib diisi',
                no_rekening: 'Field wajib diisi',
                nama_pengirim: 'Field wajib diisi',
                tgl_transfer: 'Field wajib diisi',
                jml_transfer: 'Field wajib diisi',
                foto: 'Field wajib diisi'
            },
            submitHandler: form => {
                $.ajax({
                    url: `${BASE_URL}ext/konfirmasi/add`,
                    type: 'POST',
                    dataType: 'JSON',
                    data: new FormData(form),
                    contentType: false,
                    processData: false,
                    beforeSend: xhr => {
                        xhr.setRequestHeader("EXT-SIPS-KEY", EXT_TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                        $.blockUI({
                            message: '<i class="fas fa-spinner fa-spin fa-5x"></i>',
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
                        location.hash = '#/transaksi'
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

    const cancelTransaksi = () => {
        $(button.cancel).on('click', function(){
            let no_transaksi = $(this).attr('id');

            $(input.cancel_trx).val(no_transaksi)
            $(text.cancel).text(no_transaksi)
            $(modal.cancel).modal('show');
        })
    }

    const submitCancel = () => {
        $(form.cancel).validate({
            submitHandler: form => {
                $.ajax({
                    url: `${BASE_URL}ext/transaksi/batal`,
                    type: 'PUT',
                    dataType: 'JSON',
                    data: $(form).serialize(),
                    beforeSend: xhr => {
                        xhr.setRequestHeader("EXT-SIPS-KEY", EXT_TOKEN)
                        xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                        $(modal.container).block({
                            message: '<i class="fas fa-spinner fa-spin fa-5x"></i>',
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
                        location.hash = '#/transaksi'
                    },
                    error: err => {
                        const { error } = err.responseJSON
                        toastr.error(error, 'Gagal')
                    },
                    complete: () => {
                        $(modal.container).unblock()
                    }
                })
            }
        })
    }

    return {
        init: () => {
            fetchTransaksi()
            submitCheckout()
            submitCancel()
            cancelTransaksi()
        }
    }
})(checkoutUI)

const invoiceUI = (() => {
    const { container, button } = DOM.invoice_page

    return {
        renderData: data => {
            console.log(data)
            let no = 1;
            let dibayar = 0

            let row_data = data.detail.map(v => {
                return `
                    <tr>
                        <td>${no++}</td>
                        <td>${v.product.nama_product}</td>
                        <td>Rp. ${parseInt(v.harga_satuan).toLocaleString(['ban', 'id'])}</td>
                        <td>${v.qty}</td>
                        <td>Rp. ${parseInt(v.total_harga).toLocaleString(['ban', 'id'])}</td>
                    </tr>
                `
            }).join('')

            let pembayaran_dom = data.pembayaran.map(v => {
                dibayar += parseInt(v.jml_transfer);
                
                return `
                    <h6>No Payment: <b>${v.no_konfirmasi}</b></h6>
                    <h6>${v.bank_pengirim} - ${v.rekening_pengirim} To ${v.bank}</h6>
                `
            })
            
            let html = `
                <div class="mb-2 mt-2">
                    <h4>Duta Gym</h4>
                    <div>Jl. Blablabla</div>
                </div>

                <div class="mb-2 mt-4">
                    <table class="w-100">
                        <tr>
                            <td class="w-50">
                                <h2>Transaksi #<span class="text-info">${data.no_transaksi}</span></h2>
                                <table class="w-100">
                                    <tr>
                                        <td>Tgl Transaksi</td>
                                        <td>${data.tgl_transaksi}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td>${data.status}</td>
                                    </tr>
                                </table>
                            </td>
                            <td class="w-50 text-right">
                                <b>Customer :</b>
                                <div>${data.customer.nama_lengkap}</div>
                                <div>${data.alamat_kirim}</div>
                                <div>${data.customer.email}</div>
                                <div>${data.customer.telepon}</div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="mb-2 mt-2">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>Harga Satuan</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>${row_data}</tbody>
                    </table>
                </div>

                <div class="mb-2 mt-2">
                    <table class="w-100">
                        <tr>
                            <td style="width: 60%" valign="bottom">
                                ${pembayaran_dom}
                            </td>
                            <td style="width: 40%" class="text-right">
                                <hr>
                                <h3>Total <span class="text-info">Rp. ${parseInt(data.total).toLocaleString(['ban', 'id'])}</span></h3>
                                <h4 style="color: black">Dibayar <span class="text-success">Rp. ${parseInt(dibayar).toLocaleString(['ban', 'id'])}</span></h4>
                            </td>
                        </tr>
                    </table>
                </div>
            `

            $(container.data).html(html)
        },
        renderNoData: () => {
            let html = `
                <div class="text-center mt-5">
                    <h2 class="text-muted">Data tidak ditemukan.</h2>
                    <h4 class="text-muted">Silahkan cari transaksi lainnya</h4>
                </div>
            `
            
            $(container.invoice).html(html)
        }
    }
})()

const invoiceController = ((UI) => {
    const { container, button } = DOM.invoice_page

    const fetchInvoice = () => {
        let no_transaksi = location.hash.substr(12)

        $.ajax({
            url: `${BASE_URL}ext/transaksi`,
            type: 'GET',
            data: { no_transaksi: no_transaksi },
            dataType: 'JSON',
            beforeSend: xhr => {
                xhr.setRequestHeader("EXT-SIPS-KEY", EXT_TOKEN)
                xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))

                $(container.invoice).block({
                    message: '<i class="fas fa-spinner fa-spin fa-5x"></i>',
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
                if (data.length === 1) {
                    data.map(v => {
                        if (v.status === 'Dibayar') {
                            UI.renderData(v)
                        } else {
                            UI.renderNoData()
                        }
                    })
                } else {
                    UI.renderNoData()
                }
            },
            error: err => {
                const { error } = err.responseJSON
                toastr.error(error, 'Gagal')
            },
            complete: () => {
                $(container.invoice).unblock()
            }
        })
    }

    const printInvoice = () => {
        $(button.print).on('click', function() {
            var mode = 'iframe'; //popup
            var close = mode == "popup";
            var options = {
                mode: mode,
                popClose: close
            };

            $(container.data).printArea(options);
        })
    }

    return {
        init: () => {
            fetchInvoice()
            printInvoice()
        }
    }
})(invoiceUI)

