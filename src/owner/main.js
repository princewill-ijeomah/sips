$(function () {
    const DOM = {
        page_content: '.page-content'
    }

    const mainUI = (() => {

    })()

    const mainController = ((UI) => {

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

        const loadContent = path => {
            $.ajax({
                url: `${BASE_URL}owner/${path}`,
                dataType: 'HTML',
                beforeSend: function () {
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
                    });
                },
                success: function (response) {
                    $(DOM.page_content).html(response)
                    $.unblockUI();
                },
                error: function () {
                    window.location.replace(`${BASE_URL}not_found`);
                }
            })
        }

        const setRoute = () => {
            let path;

            if (location.hash) {
                path = location.hash.substr(2);
                loadContent(path);
            } else {
                location.hash = '#/dashboard';
            }

            $(window).on('hashchange', function () {
                path = location.hash.substr(2);

                loadContent(path);
            });
        }

        return {
            init: () => {
                console.log('Main is running...')
                setRoute()
            }
        }
    })(mainUI)

    mainController.init();
})

