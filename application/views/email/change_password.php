
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
            Change Password
        </title>
        <meta name="description" content="Login">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link rel="stylesheet" media="screen, print" href="<?= base_url() ?>assets/internal/dist/css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="<?= base_url() ?>assets/internal/dist/css/app.bundle.css">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/internal/dist/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/internal/dist/img/logo-gym3.png">
        <link rel="mask-icon" href="<?= base_url() ?>assets/internal/dist/img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <!-- Optional: page related CSS-->
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
                                    <img src="<?= base_url() ?>assets/internal/dist/img/logo-gym3.png" class="img-fluid" style="height: 50px" alt="SmartAdmin WebApp" aria-roledescription="logo">
                                    <span class="page-logo-text mr-1"><img src="<?= base_url() ?>assets/internal/dist/img/logo-gym4.png" style="width: 150px" alt=""</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex-1" style="background: url(img/svg/pattern-1.svg) no-repeat center bottom fixed; background-size: cover;">
                        <div class="container py-4 py-lg-5 my-lg-5 px-4 px-sm-0">
                            <?php if(isset($id_user)) : ?>

                                <div class="row">
                                    <div class="col-xl-12">
                                        <h2 class="fs-xxl fw-500 mt-4 text-white text-center">
                                            Silahkan mengisi password baru anda
                                            <small class="h3 fw-300 mt-3 mb-5 text-white opacity-70 hidden-sm-down">
                                                Harap hubungi kami apabila anda mendapat masalah saat mengganti password anda.
                                            </small>
                                        </h2>
                                    </div>
                                    <div class="col-xl-6 ml-auto mr-auto">
                                        <div class="card p-4 rounded-plus bg-faded">
                                            <form id="form_password" method="POST" action="<?= base_url('ext/aktivasi/update_password') ?>">
                                                <div class="form-group">
                                                    <label for="">Password Baru</label>
                                                    <input type="password" id="new_password" name="new_password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="">Password Konfirmasi</label>
                                                    <input type="password" id="retype_password" name="retype_password" class="form-control">
                                                </div>
                                                <input type="hidden" name="id_user" id="id_user" value="<?= $id_user ?>">
                                                <button type="submit" class="btn btn-info btn-block">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            <?php else : ?>

                                <div class="row">
                                    <div class="col-xl-12">
                                        <h2 class="fs-xxl fw-500 mt-4 text-white text-center">
                                            Halaman Tidak Tersesdia
                                            <small class="h3 fw-300 mt-3 mb-5 text-white opacity-70 hidden-sm-down">
                                                Silahkan kembali ke halaman yang sudah ditentukan.
                                            </small>
                                        </h2>
                                    </div>
                                    <div class="col-xl-6 ml-auto mr-auto">
                                        <div class="card p-4 rounded-plus bg-faded">
                                            <div class="alert alert-primary text-dark" role="alert">
                                                <strong><?= $status ?> !</strong> <br> <?= $messages ?>.
                                            </div>
                                            <a href="<?= base_url('auth') ?>" class="h4">
                                                <i class="fal fa-chevron-right mr-2"></i> Kembali
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif ?>
                        </div>
                        <div class="position-absolute pos-bottom pos-left pos-right p-3 text-center text-white">
                            Made with <i class="fal fa-heart text-danger"></i> by Vicky Kurnia
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- base vendor bundle: 
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
        <script src="<?= base_url() ?>assets/internal/dist/js/vendors.bundle.js"></script>
        <script src="<?= base_url() ?>assets/internal/dist/js/app.bundle.js"></script>

        <script src="<?= base_url() ?>assets/internal/dist/js/block-ui/jquery.blockUI.js"></script>
        <script src="<?= base_url() ?>assets/internal/dist/js/formplugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="<?= base_url() ?>assets/internal/dist/js/notifications/toastr/toastr.js"></script>

        <script>
            $(function() {
                $('#form_password').validate({
                    rules: {
                        new_password: 'required',
                        retype_password: {
                            required: true,
                            equalTo: '#new_password'
                        }
                    },
                    messages: {
                        new_password: 'Silahkan isi password baru anda',
                        retype_password: {
                            required: 'Silahkan isi konfirmasi password',
                            equalTo: 'Password harus sama dengan Password baru'
                        }
                    },
                    submitHandler: form => {
                        $(form).submit()
                    }
                })
            })
        </script>
    </body>
</html>
