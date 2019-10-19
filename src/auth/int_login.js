console.log('Login is running...');

$(function() {
    const DOM = {
        form: '#form_login',
        container: '#container_login',
        input: {
            password: '#password',
            show_pass: '#show_pass'
        },
        loader: '.loader'
    }

    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-center",
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

    const loginController = (() => {
        const {form, input, container, loader} = DOM

        const submitLogin = () => {
            $(form).validate({
                rules: {
                    username: 'required',
                    password: 'required'
                },
                messages: {
                    username: 'Silahkan isi dengan username',
                    password: 'Silahkan isi dengan password'
                },
                submitHandler: form => {
                    $.ajax({
                        url: `${BASE_URL}int/auth/login`,
                        type: 'POST',
                        dataType: 'JSON',
                        data: $(form).serialize(),
                        beforeSend: xhr => {
                            xhr.setRequestHeader("Authorization", "Basic " + btoa(USERNAME + ":" + PASSWORD))
                            $(container).block({
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
                            });
                        },
                        success: ({data}) => {
                            localStorage.setItem('INT-SIPS-KEY', data.key);
                            window.location.replace(`${BASE_URL}${data.level}/`)
                        },
                        error: err => {
                            const {error} = err.responseJSON
                            toastr.error(error, 'Gagal')
                        },
                        complete: () => {
                            $(container).unblock();
                        }
                    })
                }
            });
        }

        const additionalListener = () => {
            $(loader).fadeOut()

            $(input.show_pass).click(function () {
                if ($(this).is(':checked')) {
                    $(input.password).attr('type', 'text');
                } else {
                    $(input.password).attr('type', 'password');
                };
            });
        }

        return {
            init : () => {
                submitLogin(); 
                additionalListener()       
            }
        }
    })()

    loginController.init();
})

