const DOM = {
    main_page: {
        container: '#page_container',
        navbar: '#navbar_container',
        topbar: '#topbar_container',
        button: {
            logout: '.btn_logout'
        }
    },
    auth_page: {
        container: {
            login: '#login_container',
            register: '#register_container'
        },
        form: {
            login: '#form_login',
            register: '#form_register'
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
            register: '.btn_register'
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
                                        Home
                                    </a>
                                </li>
                                <li class="">
                                    <a class="dropdown-item dropdown-toggle" href="#/tentang">
                                        Tentang
                                    </a>
                                </li>
                                <li class="">
                                    <a class="dropdown-item dropdown-toggle" href="#/product">
                                        Cari Produk
                                    </a>
                                </li>
                                <li class="">
                                    <a class="dropdown-item dropdown-toggle" href="#/transaksi">
                                        History Transaksi
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
                        <a class="btn_logout" style="cursor: pointer"><i class="fas fa-times header-nav-top-icon"></i></a>
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
                                        Home
                                    </a>
                                </li>
                                <li class="">
                                    <a class="dropdown-item dropdown-toggle" href="#/tentang">
                                        Tentang
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

    const {container, navbar, topbar, button} = DOM.main_page

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
    const {form, input, container, button} = DOM.auth_page

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
            $(container.login).show();
            $(container.register).hide();
        })
    }

    const openRegister = () => {
        $(button.register).on('click', function () {
            $(form.register)[0].reset()
            $(container.login).hide();
            $(container.register).show();
        })
    }

    return {
        init: () => {
            verifyUser()
            submitLogin()
            submitRegister()
            showPassListener()
            openLogin()
            openRegister()
        }
    }
})()

