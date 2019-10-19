
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Login
        </title>
        <meta name="description" content="Login">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="msapplication-tap-highlight" content="no">

        <link rel="stylesheet" media="screen, print" href="<?= base_url() ?>assets/internal/dist/css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="<?= base_url() ?>assets/internal/dist/css/app.bundle.css">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/internal/dist/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/internal/dist/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="<?= base_url() ?>assets/internal/dist/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="<?= base_url() ?>assets/internal/dist/css/fa-brands.css">

        <link rel="stylesheet" media="screen, print" href="<?= base_url() ?>assets/internal/dist/css/notifications/toastr/toastr.css">
        <style>
            .error {
                color: red;
            }
        </style>
    </head>
    <body>
        <div class="page-wrapper">
            <div class="page-inner bg-brand-gradient">
                <div class="page-content-wrapper bg-transparent m-0">
                    <div class="height-10 w-100 shadow-lg px-4 bg-brand-gradient">
                        <div class="d-flex align-items-center container p-0">
                            <div class="page-logo width-mobile-auto m-0 align-items-center justify-content-center p-0 bg-transparent bg-img-none shadow-0 height-9">
                                <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                                    <img src="<?= base_url() ?>assets/internal/dist/img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                                    <span class="page-logo-text mr-1">Duta Gym Administrator</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1" style="background: url(<?= base_url() ?>assets/internal/dist/img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
                        <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                            <div class="row">
                                <div class="col col-md-6 col-lg-7 hidden-sm-down">
                                    <h2 class="fs-xxl fw-500 mt-4 text-white">
                                        Selamat Datang
                                        <small class="h3 fw-300 mt-3 mb-5 text-white opacity-60">
                                            Ini merupakan halaman untuk mengakses Sistem Administrator dari Duta Gym.
                                            Silahkan masukkan Username dan Password anda untuk dapat mengelola Product, Transaksi, dll.
                                        </small>
                                    </h2>
                                </div>
                                <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 ml-auto">
                                    <h1 class="text-white fw-300 mb-3 d-sm-block d-md-none">
                                        Secure login
                                    </h1>
                                    <div class="card p-4 rounded-plus bg-faded" id="container_login">
                                        <form id="form_login">
                                            <div class="form-group">
                                                <label class="form-label" for="username">Username</label>
                                                <input type="text" name="username" id="username" class="form-control form-control-lg" placeholder="Your username">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="password">Password</label>
                                                <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Your password">
                                            </div>
                                            <div class="form-group text-left">
                                                <div class="ml-2">
                                                    <input type="checkbox" id="show_pass">
                                                    <label for="rememberme"> Lihat Password</label>
                                                </div>
                                            </div>
                                            <div class="row no-gutters">
                                                <div class="col-lg-6 pl-lg-1 my-2">
                                                    <button id="js-login-btn" type="submit" class="btn btn-danger btn-block btn-lg">Login</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                                Made with <i class="fal fa-heart text-danger"></i> by Vicky Kurnia
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="<?= base_url() ?>assets/internal/dist/js/vendors.bundle.js"></script>
        <script src="<?= base_url() ?>assets/internal/dist/js/app.bundle.js"></script>
        
        <script src="<?= base_url() ?>assets/internal/dist/js/block-ui/jquery.blockUI.js"></script>
        <script src="<?= base_url() ?>assets/internal/dist/js/formplugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="<?= base_url() ?>assets/internal/dist/js/notifications/toastr/toastr.js"></script>

        <script src="<?= base_url() ?>src/additional.js"></script>
        <script src="<?= base_url() ?>src/auth/verify_int_login.js"></script>
        <script src="<?= base_url() ?>src/auth/int_login.js"></script>
    </body>
</html>
