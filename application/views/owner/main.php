<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Owner | SIPS
        </title>
        <meta name="description" content="Page Titile">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="msapplication-tap-highlight" content="no">

        <link rel="stylesheet" media="screen, print" href="<?= base_url() ?>assets/internal/dist/css/vendors.bundle.css">
        <link rel="stylesheet" media="screen, print" href="<?= base_url() ?>assets/internal/dist/css/app.bundle.css">
        <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url() ?>assets/internal/dist/img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url() ?>assets/internal/dist/img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="<?= base_url() ?>assets/internal/dist/img/favicon/safari-pinned-tab.svg" color="#5bbad5">

        <link rel="stylesheet" media="screen, print" href="<?= base_url() ?>assets/internal/dist/css/notifications/toastr/toastr.css">
        <link rel="stylesheet" media="screen, print" href="<?= base_url() ?>assets/internal/dist/css/datagrid/datatables/datatables.bundle.css">
        <link rel="stylesheet" media="screen, print" href="<?= base_url() ?>assets/internal/dist/css/page-invoice.css">
        <link rel="stylesheet" media="screen, print" href="<?= base_url() ?>assets/internal/dist/css/statistics/chartjs/chartjs.css">
        
        <style>
            .error {
                color: red;
            }

            @media print{
                .no_print {
                    display: none !important
                }
            }
        </style>
    </head>
    <body class="mod-bg-1">
        <script>
            /**
             *	This script should be placed right after the body tag for fast execution 
             *	Note: the script is written in pure javascript and does not depend on thirdparty library
             **/
            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
                /** 
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /** 
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);
            }
            /** 
             * Save to localstorage 
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
            /** 
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

        </script>
        <div class="page-wrapper">
            <div class="page-inner">
            
                <aside class="page-sidebar">
                    <div class="page-logo">
                        <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                            <img src="<?= base_url() ?>assets/internal/dist/img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            <span class="page-logo-text mr-1">Duta Gym</span>
                            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                        </a>
                    </div>
                    
                    <nav id="js-primary-nav" class="primary-nav" role="navigation">
                        <div class="info-card">
                            <img src="<?= base_url() ?>assets/internal/dist/img/demo/avatars/avatar-m.png" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
                            <div class="info-card-text">
                                <a href="javascript:void(0)" class="d-flex align-items-center text-white">
                                    <span class="text-truncate text-truncate-sm d-inline-block header_name">
                                        ...
                                    </span>
                                </a>
                                <span class="d-inline-block text-truncate text-truncate-sm header_level">...</span>
                            </div>
                            <img src="<?= base_url() ?>assets/internal/dist/img/card-backgrounds/cover-2-lg.png" class="cover" alt="cover">
                        </div>
                        <ul id="js-nav-menu" class="nav-menu">
                            <li>
                                <a href="#/dashboard" title="Application Intel" data-filter-tags="application intel">
                                    <i class="fal fa-info-circle"></i>
                                    <span class="nav-link-text" data-i18n="nav.application_intel">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="#/user" title="Application Intel" data-filter-tags="application intel">
                                    <i class="fal fa-user"></i>
                                    <span class="nav-link-text" data-i18n="nav.application_intel">User</span>
                                </a>
                            </li>
                            <li>
                                <a href="#/laporan" title="Application Intel" data-filter-tags="application intel">
                                    <i class="fal fa-file"></i>
                                    <span class="nav-link-text" data-i18n="nav.application_intel">Laporan Penjualan</span>
                                </a>
                            </li>
                        </ul>
                        <div class="filter-message js-filter-message bg-success-600"></div>
                    </nav>
                </aside>
                
                <div class="page-content-wrapper">
                    <header class="page-header" role="banner">
                        <div class="page-logo">
                            <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                                <img src="<?= base_url() ?>assets/internal/dist/img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                                <span class="page-logo-text mr-1">Duta Gym</span>
                                <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                                <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                            </a>
                        </div>
                        
                        <div class="hidden-md-down dropdown-icon-menu position-relative">
                            <a href="javascript:void(0)" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
                                <i class="ni ni-menu"></i>
                            </a>
                            <ul>
                                <li>
                                    <a href="javascript:void(0)" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                                        <i class="ni ni-minify-nav"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                                        <i class="ni ni-lock-nav"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="hidden-lg-up">
                            <a href="javascript:void(0)" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                                <i class="ni ni-menu"></i>
                            </a>
                        </div>
                        <div class="ml-auto d-flex">
                            <div>
                                <a href="javascript:void(0)" data-toggle="dropdown" title="drlantern@gotbootstrap.com" class="header-icon d-flex align-items-center justify-content-center ml-2">
                                    <img src="<?= base_url() ?>assets/internal/dist/img/demo/avatars/avatar-m.png" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                    <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                        <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                            <span class="mr-2">
                                                <img src="<?= base_url() ?>assets/internal/dist/img/demo/avatars/avatar-m.png" class="rounded-circle profile-image" alt="Dr. Codex Lantern">
                                            </span>
                                            <div class="info-card-text">
                                                <div class="fs-lg text-truncate text-truncate-lg header_name">...</div>
                                                <span class="text-truncate text-truncate-md opacity-80 header_email">...</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="javascript:void(0)" class="dropdown-item access_profile" data-toggle="modal" data-target=".js-modal-settings">
                                        <span data-i18n="drpdwn.settings">Edit Profile</span>
                                    </a>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="javascript:void(0)" class="dropdown-item access_password" data-toggle="modal" data-target=".js-modal-settings">
                                        <span data-i18n="drpdwn.settings">Ganti Password</span>
                                    </a>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="javascript:void(0)" class="dropdown-item" data-action="app-fullscreen">
                                        <span data-i18n="drpdwn.fullscreen">Fullscreen</span>
                                        <i class="float-right text-muted fw-n">F11</i>
                                    </a>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item fw-500 pt-3 pb-3 access_logout">
                                        <span data-i18n="drpdwn.page-logout">Logout</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </header>

                    <main id="js-page-content" role="main" class="page-content">
                        
                    </main>

                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div>
                    <footer class="page-footer" role="contentinfo">
                        <div class="d-flex align-items-center flex-1 text-muted">
                            <span class="hidden-md-down fw-700">Made with <i class="fal fa-heart" style="color: pink"></i> by&nbsp;<a href='#' class='text-primary fw-500' title='gotbootstrap.com' target='_blank'>Vicky Kurnia - 30815166</a></span>
                        </div>
                    </footer>
                </div>
            </div>
        </div>

        <form id="form_profile">
            <div class="modal fade" id="modal_profile" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                Edit Profile
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" class="form-control" id="profile_nama_lengkap" name="nama_lengkap">
                            </div>
                            <div class="form-group">
                                <label for="">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="profile_jenis_kelamin" class="form-control">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="profile_tgl_lahir" name="tgl_lahir">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <textarea class="form-control" id="profile_alamat" name="alamat" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Telepon</label>
                                <input type="number" class="form-control" id="profile_telepon" name="telepon">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form id="form_password">
            <div class="modal fade" id="modal_password" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                Ganti Password
                            </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"><i class="fal fa-times"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="">Passoword Lama</label>
                                <input type="password" class="form-control" id="old_password" name="old_password">
                            </div>
                            <div class="form-group">
                                <label for="">Password Baru</label>
                                <input type="password" class="form-control" id="new_password" name="new_password">
                            </div>
                            <div class="form-group">
                                <label for="">Ulangi Password</label>
                                <input type="password" class="form-control" id="retype_password" name="retype_password">
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="">
                                        <input type="checkbox" id="show_pass">
                                        <label for="show_pass">Show Password</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        <nav class="shortcut-menu d-none d-sm-block">
            <input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
            <label for="menu_open" class="menu-open-button ">
                <span class="app-shortcut-icon d-block"></span>
            </label>
            <a href="javascript:void(0)" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
                <i class="fal fa-arrow-up"></i>
            </a>
            <a class="menu-item btn access_logout" data-toggle="tooltip" data-placement="left" title="Logout">
                <i class="fal fa-sign-out"></i>
            </a>
            <a href="javascript:void(0)" class="menu-item btn" data-action="app-fullscreen" data-toggle="tooltip" data-placement="left" title="Full Screen">
                <i class="fal fa-expand"></i>
            </a>
        </nav>
        
        <script src="<?= base_url() ?>assets/internal/dist/js/vendors.bundle.js"></script>
        <script src="<?= base_url() ?>assets/internal/dist/js/app.bundle.js"></script>
        
        <script src="<?= base_url() ?>assets/internal/dist/js/block-ui/jquery.blockUI.js"></script>
        <script src="<?= base_url() ?>assets/internal/dist/js/formplugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="<?= base_url() ?>assets/internal/dist/js/notifications/toastr/toastr.js"></script>
        <script src="<?= base_url() ?>assets/internal/dist/js/datagrid/datatables/datatables.bundle.js"></script>
        <script src="<?= base_url() ?>assets/internal/dist/js/statistics/chartjs/chartjs.bundle.js"></script>

        <script src="<?= base_url() ?>src/additional.js"></script>
        <script src="<?= base_url() ?>src/owner/verify_user.js"></script>
        <script src="<?= base_url() ?>src/owner/main.js"></script>
    </body>
</html>
