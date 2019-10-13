<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Cashier | SIPS
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

        <script src="<?= base_url() ?>src/additional.js"></script>

        <style>
            .error {
                color: red;
            }
        </style>
    </head>
    <body class="mod-bg-1 ">
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
                <!-- BEGIN Left Aside -->
                <aside class="page-sidebar">
                    <div class="page-logo">
                        <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center position-relative">
                            <img src="<?= base_url() ?>assets/internal/dist/img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                            <span class="page-logo-text mr-1">Duta Gym</span>
                            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                        </a>
                    </div>
                    <!-- BEGIN PRIMARY NAVIGATION -->
                    <nav id="js-primary-nav" class="primary-nav" role="navigation">
                        <div class="info-card">
                            <img src="<?= base_url() ?>assets/internal/dist/img/demo/avatars/avatar-m.png" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
                            <div class="info-card-text">
                                <a href="javascript:void(0)" class="d-flex align-items-center text-white">
                                    <span class="text-truncate text-truncate-sm d-inline-block">
                                        Dr. Codex Lantern
                                    </span>
                                </a>
                                <span class="d-inline-block text-truncate text-truncate-sm">Toronto, Canada</span>
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
                                <a href="#/kriteria" title="Application Intel" data-filter-tags="application intel">
                                    <i class="fal fa-bars"></i>
                                    <span class="nav-link-text" data-i18n="nav.application_intel">Kriteria</span>
                                </a>
                            </li>
                            <li>
                                <a href="#/product" title="Application Intel" data-filter-tags="application intel">
                                    <i class="fal fa-shopping-bag"></i>
                                    <span class="nav-link-text" data-i18n="nav.application_intel">Product</span>
                                </a>
                            </li>
                            <li>
                                <a href="#/customer" title="Application Intel" data-filter-tags="application intel">
                                    <i class="fal fa-user"></i>
                                    <span class="nav-link-text" data-i18n="nav.application_intel">Customer</span>
                                </a>
                            </li>
                            <li>
                                <a href="#/transaksi" title="Application Intel" data-filter-tags="application intel">
                                    <i class="fal fa-shopping-cart"></i>
                                    <span class="nav-link-text" data-i18n="nav.application_intel">Transaksi</span>
                                </a>
                            </li>
                            <li>
                                <a href="#/konfirmasi" title="Application Intel" data-filter-tags="application intel">
                                    <i class="fal fa-money-bill-alt"></i>
                                    <span class="nav-link-text" data-i18n="nav.application_intel">Konfirmasi</span>
                                </a>
                            </li>
                        </ul>
                        <div class="filter-message js-filter-message bg-success-600"></div>
                    </nav>
                </aside>
                <!-- END Left Aside -->
                <div class="page-content-wrapper">
                    <!-- BEGIN Page Header -->
                    <header class="page-header" role="banner">
                        <!-- we need this logo when user switches to nav-function-top -->
                        <div class="page-logo">
                            <a href="javascript:void(0)" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                                <img src="<?= base_url() ?>assets/internal/dist/img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
                                <span class="page-logo-text mr-1">Duta Gym</span>
                                <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
                                <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
                            </a>
                        </div>
                        <!-- DOC: nav menu layout change shortcut -->
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
                        <!-- DOC: mobile button appears during mobile width -->
                        <div class="hidden-lg-up">
                            <a href="javascript:void(0)" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
                                <i class="ni ni-menu"></i>
                            </a>
                        </div>
                        <div class="ml-auto d-flex">
                            <div>
                                <a href="javascript:void(0)" data-toggle="dropdown" title="drlantern@gotbootstrap.com" class="header-icon d-flex align-items-center justify-content-center ml-2">
                                    <img src="<?= base_url() ?>assets/internal/dist/img/demo/avatars/avatar-m.png" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
                                    <!-- you can also add username next to the avatar with the codes below:
									<span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down">Me</span>
									<i class="ni ni-chevron-down hidden-xs-down"></i> -->
                                </a>
                                <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                                    <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                                        <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                                            <span class="mr-2">
                                                <img src="<?= base_url() ?>assets/internal/dist/img/demo/avatars/avatar-m.png" class="rounded-circle profile-image" alt="Dr. Codex Lantern">
                                            </span>
                                            <div class="info-card-text">
                                                <div class="fs-lg text-truncate text-truncate-lg">Dr. Codex Lantern</div>
                                                <span class="text-truncate text-truncate-md opacity-80">drlantern@gotbootstrap.com</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="javascript:void(0)" class="dropdown-item" data-toggle="modal" data-target=".js-modal-settings">
                                        <span data-i18n="drpdwn.settings">Settings</span>
                                    </a>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="javascript:void(0)" class="dropdown-item" data-action="app-fullscreen">
                                        <span data-i18n="drpdwn.fullscreen">Fullscreen</span>
                                        <i class="float-right text-muted fw-n">F11</i>
                                    </a>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item fw-500 pt-3 pb-3" href="page_login-alt.html">
                                        <span data-i18n="drpdwn.page-logout">Logout</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </header>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
                        
                    </main>
                    <!-- this overlay is activated only when mobile menu is triggered -->
                    <div class="page-content-overlay" data-action="toggle" data-class="mobile-nav-on"></div> <!-- END Page Content -->
                    <!-- BEGIN Page Footer -->
                    <footer class="page-footer" role="contentinfo">
                        <div class="d-flex align-items-center flex-1 text-muted">
                            <span class="hidden-md-down fw-700">Made with <i class="fal fa-heart" style="color: pink"></i> by&nbsp;<a href='#' class='text-primary fw-500' title='gotbootstrap.com' target='_blank'>Vicky Kurnia - 30815166</a></span>
                        </div>
                    </footer>
                </div>
            </div>
        </div>
        <!-- END Page Wrapper -->
        <!-- BEGIN Quick Menu -->
        <!-- to add more items, please make sure to change the variable '$menu-items: number;' in your _page-components-shortcut.scss -->
        <nav class="shortcut-menu d-none d-sm-block">
            <input type="checkbox" class="menu-open" name="menu-open" id="menu_open" />
            <label for="menu_open" class="menu-open-button ">
                <span class="app-shortcut-icon d-block"></span>
            </label>
            <a href="javascript:void(0)" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Scroll Top">
                <i class="fal fa-arrow-up"></i>
            </a>
            <a href="page_login-alt.html" class="menu-item btn" data-toggle="tooltip" data-placement="left" title="Logout">
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
        
        <script src="<?= base_url() ?>src/cashier/main.js"></script>
    </body>
</html>
