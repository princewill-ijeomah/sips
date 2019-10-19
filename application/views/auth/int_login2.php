
<!DOCTYPE html>
<!-- 
Template Name:  SmartAdmin Responsive WebApp - Template build with Twitter Bootstrap 4
Version: 4.0.0
Author: Sunnyat Ahmmed
Website: http://gootbootstrap.com
Purchase: https://wrapbootstrap.com/theme/smartadmin-responsive-webapp-WB0573SK0
License: You must have a valid license purchased only from wrapbootstrap.com (link above) in order to legally use this theme for your project.
-->
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Login | Duta Gym
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
        <link rel="stylesheet" media="screen, print" href="<?= base_url() ?>assets/internal/dist/css/page-login.css">

        <link rel="stylesheet" media="screen, print" href="<?= base_url() ?>assets/internal/dist/css/notifications/toastr/toastr.css">
        <style>
            .error {
                color: red;
            }
        </style>
    </head>
    <body>
        <div class="blankpage-form-field" id="container_login">
            <div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
                <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center">
                    <img src="<?= base_url() ?>assets/internal/dist/img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                    <span class="page-logo-text mr-1">Duta Gym Administrator</span>
                </a>
            </div>
            <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
                <form id="form_login">
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Silahkan isi dengan username">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Silahkan isi dengan password">
                    </div>
                    <div class="form-group text-left">
                        <div class="ml-2">
                            <input type="checkbox" id="show_pass">
                            <label for="rememberme"> Lihat Password</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default float-right">Login</button>
                </form>
            </div>
        </div>
        <video poster="<?= base_url() ?>assets/internal/dist/img/backgrounds/clouds.png" id="bgvid" playsinline autoplay muted loop>
            <source src="<?= base_url() ?>assets/internal/dist/media/video/cc.webm" type="video/webm">
            <source src="<?= base_url() ?>assets/internal/dist/media/video/cc.mp4" type="video/mp4">
        </video>

        <script src="<?= base_url() ?>assets/internal/dist/js/vendors.bundle.js"></script>
        <script src="<?= base_url() ?>assets/internal/dist/js/app.bundle.js"></script>
        <script src="<?= base_url() ?>assets/internal/dist/js/block-ui/jquery.blockUI.js"></script>
        <script src="<?= base_url() ?>assets/internal/dist/js/formplugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="<?= base_url() ?>assets/internal/dist/js/notifications/toastr/toastr.js"></script>

        <script src="<?= base_url() ?>src/additional.js"></script>
        <script src="<?= base_url() ?>src/auth/verify_int_login.js"></script>
        <script src="<?= base_url() ?>src/auth/int_login.js"></script>
        <!-- Page related scripts -->
    </body>
</html>
