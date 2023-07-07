<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="SIEMAS">
    <meta name="author" content="IPDS 1600">
    <meta name="keywords"
        content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('assets/images/brand/favicon.ico') }}" />

    <!-- TITLE -->
    <title>SIEMAS</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ url('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ url('assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/dark-style.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/skin-modes.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/transparent-style.css') }}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ url('assets/css/icons.css') }}" rel="stylesheet" />
    @yield('css')
    <style>
        .select2-container--open {
            z-index: 9000;
        }

        .select2-dropdown {
            z-index: 9001;
        }
    </style>
</head>

<body class="app sidebar-mini ltr light-mode sidenav-toggled color-header color-menu sidebar-gone">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{ url('assets/images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            {{-- <div class="app-header header sticky">
                <div class="container-fluid main-container">
                    <div class="d-flex align-items-center">
                        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar"
                            href="javascript:void(0);"></a>
                        <div class="d-flex order-lg-2 ms-auto header-right-icons">
                            <div class="navbar navbar-collapse responsive-navbar p-0">
                                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                    @if ($auth)
                                        <div class="d-flex order-lg-2">
                                            <h5 class="text-dark mb-0"> Hai, {{ $auth->name }}</h5>
                                            <div class="dropdown d-md-flex">
                                                <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                                    <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                                    <span class="light-layout"><i class="fe fe-sun"></i></span>
                                                </a>
                                            </div>
                                            <div class="dropdown d-md-flex profile-1">
                                                <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                    class="nav-link leading-none d-flex px-1">
                                                    <span>
                                                        <img src="{{ url('assets/images/users/8.png') }}"
                                                            alt="profile-user"
                                                            class="avatar  profile-user brround cover-image">
                                                    </span>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                    <div class="drop-heading">
                                                        <div class="text-center">
                                                            <h5 class="text-dark mb-0">{{ $auth->name }}</h5>
                                                            <small class="text-muted">{{ $auth->level }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="dropdown-divider m-0"></div>
                                                    <a class="dropdown-item"
                                                        href="{{ url('users/' . \Crypt::encryptString($auth->id)) }}">
                                                        <i class="dropdown-icon fe fe-user"></i> Profile
                                                    </a>
                                                    <a class="dropdown-item" href="{{ url('logout') }}">
                                                        <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="dropdown d-md-flex header-settings">
                                                <a href="javascript:void(0);" class="nav-link icon "
                                                    data-bs-toggle="sidebar-right" data-target=".sidebar-right">
                                                    <i class="fe fe-menu"></i>
                                                </a>
                                            </div>

                                        </div>
                                    @else
                                        <button class="btn btn-info" href="{{ url('login') }}">Login</button>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="app-header header sticky">
                <div class="container-fluid main-container">
                    <div class="d-flex align-items-center">
                        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar"
                            href="javascript:void(0);"></a>
                        <div class="responsive-logo">
                            <a href="index.html" class="header-logo">
                                <img src="{{ url('assets/images/brand/logo-3.png') }}" class="mobile-logo logo-1"
                                    alt="logo">
                                <img src="{{ url('assets/images/brand/logo.png') }}" class="mobile-logo dark-logo-1"
                                    alt="logo">
                            </a>
                        </div>
                        <!-- sidebar-toggle-->
                        <a class="logo-horizontal " href="index.html">
                            <img src="{{ url('assets/images/brand/logo.png') }}" class="header-brand-img desktop-logo"
                                style="width: 100%" alt="logo">
                            <img src="{{ url('assets/images/brand/logo-3.png') }}" class="header-brand-img light-logo1"
                                alt="logo">
                        </a>
                        <!-- LOGO -->

                        <div class="d-flex order-lg-2 ms-auto header-right-icons">
                            <!-- SEARCH -->
                            <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                                aria-controls="navbarSupportedContent-4" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon fe fe-more-vertical text-dark"></span>
                            </button>
                            <div class="navbar navbar-collapse responsive-navbar p-0">
                                <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                                    <div class="d-flex order-lg-2">
                                        @if ($auth)
                                            <h5 class="text-dark mb-0"> Hai, {{ $auth->name }}</h5>
                                        @endif

                                        <div class="dropdown d-md-flex">
                                            <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                                <span class="dark-layout"><i class="fe fe-moon"></i></span>
                                                <span class="light-layout"><i class="fe fe-sun"></i></span>
                                            </a>
                                        </div>
                                        <!-- Theme-Layout -->
                                        <div class="dropdown d-md-flex">
                                            <a class="nav-link icon full-screen-link nav-link-bg">
                                                <i class="fe fe-minimize fullscreen-button" id="myvideo"></i>
                                            </a>
                                        </div>

                                        @if ($auth)
                                            <div class="d-flex order-lg-2">


                                                <div class="dropdown d-md-flex profile-1">
                                                    <a href="javascript:void(0);" data-bs-toggle="dropdown"
                                                        class="nav-link leading-none d-flex px-1">
                                                        <span>
                                                            <img src="{{ url('assets/images/users/8.png') }}"
                                                                alt="profile-user"
                                                                class="avatar  profile-user brround cover-image">
                                                        </span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                                        <div class="drop-heading">
                                                            <div class="text-center">
                                                                <h5 class="text-dark mb-0">{{ $auth->name }}</h5>
                                                                <small class="text-muted">{{ $auth->level }}</small>
                                                            </div>
                                                        </div>
                                                        <div class="dropdown-divider m-0"></div>
                                                        <a class="dropdown-item"
                                                            href="{{ url('users/' . \Crypt::encryptString($auth->id)) }}">
                                                            <i class="dropdown-icon fe fe-user"></i> Profile
                                                        </a>
                                                        <a class="dropdown-item" href="{{ url('logout') }}">
                                                            <i class="dropdown-icon fe fe-alert-circle"></i> Sign out
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="dropdown d-md-flex header-settings">
                                                    <a href="javascript:void(0);" class="nav-link icon "
                                                        data-bs-toggle="sidebar-right" data-target=".sidebar-right">
                                                        <i class="fe fe-menu"></i>
                                                    </a>
                                                </div>

                                            </div>
                                        @else
                                            <div class="dropdown d-md-flex">
                                                <a class="nav-link  btn-primary full-screen-link nav-link-bg"
                                                    style="border-radius:10%" href="{{ url('login') }}">
                                                    Login
                                                </a>
                                            </div>
                                        @endif


                                        {{-- <div class="dropdown d-md-flex header-settings">
                                            <a href="javascript:void(0);" class="nav-link icon "
                                                data-bs-toggle="sidebar-right" data-target=".sidebar-right">
                                                <i class="fe fe-menu"></i>
                                            </a>
                                        </div> --}}
                                        <!-- SIDE-MENU -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- /app-Header -->

            <!--APP-SIDEBAR-->
            <div class="sticky">
                <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
                <aside class="app-sidebar">
                    <div class="side-header text-center py-0">
                        <a class="header-brand1 text-center" href="{{ url('/') }}">
                            <img src="{{ url('assets/images/brand/logo.png') }}"
                                class="header-brand-img desktop-logo mt-2" alt="logo"
                                style="height: fit-content">
                            <img src="{{ url('assets/images/brand/logo-1.png') }}"
                                class="header-brand-img toggle-logo mt-4" alt="logo">
                            <img src="{{ url('assets/images/brand/logo-2.png') }}"
                                class="header-brand-img light-logo" alt="logo">
                            <img src="{{ url('assets/images/brand/logo-3.png') }}"
                                class="header-brand-img light-logo1" alt="logo">
                        </a>
                        <!-- LOGO -->
                    </div>
                    <div class="main-sidemenu">
                        <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                            </svg>
                        </div>
                        <ul class="side-menu">
                            <li class="sub-category">
                                <h3>Main</h3>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="{{ url('/') }}"><i
                                        class="side-menu__icon fe fe-home"></i><span
                                        class="side-menu__label">Home</span></a>
                            </li>
                            <li class="slide">
                                <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                                    <i class="side-menu__icon fa fa-television"></i>
                                    <span class="side-menu__label">Monitoring</span>
                                    <i class="angle fa fa-angle-right"></i></a>
                                <ul class="slide-menu">
                                    <li class="side-menu-label1">
                                        <a href="javascript:void(0)">Submenus</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('mon_users') }}" class="slide-item">User</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('mon_dsrt?tahun_filter=' . $periode->tahun . '&semester_filter=' . $periode->semester) }}"
                                            class="slide-item">DSRT</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('mon_212') }}" class="slide-item">Laporan 212</a>
                                    </li>
                                </ul>
                            </li>
                            @hasanyrole('SUPER ADMIN|ADMIN PROVINSI|ADMIN KABKOT')
                                <li class="slide">
                                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                                        <i class="side-menu__icon fe fe-database"></i>
                                        <span class="side-menu__label">Alokasi & DSRT</span><i
                                            class="angle fa fa-angle-right"></i></a>
                                    <ul class="slide-menu">
                                        <li class="side-menu-label1"><a href="javascript:void(0)">Submenus</a></li>
                                        <li><a href="{{ url('alokasi') }}" class="slide-item">Alokasi DSBS-USER</a>
                                        </li>
                                        <li><a href="{{ url('dsrt') }}" class="slide-item">DS RT</a>
                                        </li>
                                    </ul>
                                </li>
                            @endrole
                            @hasanyrole('SUPER ADMIN|ADMIN PROVINSI')
                                <li class="slide">
                                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                                        <i class="side-menu__icon fe fe-map"></i>
                                        <span class="side-menu__label">Master WIlayah</span><i
                                            class="angle fa fa-angle-right"></i></a>
                                    <ul class="slide-menu">
                                        <li class="side-menu-label1"><a href="javascript:void(0)">Submenus</a></li>
                                        <li><a href="{{ url('kecamatan') }}" class="slide-item">Kecamatan</a>
                                        </li>
                                        <li><a href="{{ url('desa') }}" class="slide-item">Desa</a>
                                        </li>
                                        <li><a href="{{ url('dsbs') }}" class="slide-item">DS BS</a>
                                        </li>
                                    </ul>
                                </li>
                            @endrole
                            @hasanyrole('SUPER ADMIN|ADMIN PROVINSI|ADMIN KABKOT')
                                <li class="slide">
                                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);">
                                        <i class="side-menu__icon fa fa-user-o"></i>
                                        <span class="side-menu__label">Manajemen User</span><i
                                            class="angle fa fa-angle-right"></i></a>
                                    <ul class="slide-menu">
                                        <li class="side-menu-label1"><a href="javascript:void(0)">Submenus</a></li>
                                        <li><a href="{{ url('users') }}" class="slide-item">Users</a></li>
                                        @hasanyrole('SUPER ADMIN')
                                            <li><a href="{{ url('roles') }}" class="slide-item">Roles</a></li>
                                            <li><a href="{{ url('permissions') }}" class="slide-item">Permission</a></li>
                                        @endrole
                                    </ul>
                                </li>
                            @endrole
                        </ul>
                        <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg"
                                fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                            </svg></div>
                    </div>
                </aside>
            </div>
            <!--/APP-SIDEBAR-->

            <!--app-content open-->
            @yield('content')

            <!--app-content end-->
        </div>

    </div>
    <div class="sidebar sidebar-right sidebar-animate">
        <div class="panel panel-primary card mb-0 shadow-none border-0">
            <div class="tab-menu-heading border-0 d-flex p-3">
                <div class="card-title mb-0">Aktivitas Terkini</div>
                <div class="card-options ms-auto">
                    <a href="javascript:void(0);" class="sidebar-icon text-end float-end me-1"
                        data-bs-toggle="sidebar-right" data-target=".sidebar-right"><i
                            class="fe fe-x text-white"></i></a>
                </div>
            </div>
            <div class="panel-body tabs-menu-body latest-tasks p-0 border-0">
                <div class="tab-content">
                    <div class="tab-pane active" id="side1">
                        <button class="dropdown-item d-flex border-bottom border-top" href="profile.html">
                            <div class="d-flex"><i class="fe fe-user me-3 tx-20 text-muted"></i>
                                <div class="pt-1">
                                    <h6 class="mb-0">Nama User</h6>
                                    <p class="tx-12 mb-0 text-muted">Update Capaian</p>
                                    <p>data</p>
                                </div>
                            </div>
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="footer" style="background: var(--background)">
        <div class="container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-md-12 col-sm-12 text-center">
                    Copyright © 2022 <a href="javascript:void(0);">BPS Sumsel</a>. Designed with <span
                        class="fa fa-heart text-danger"></span> by <a href="javascript:void(0);"> IPDS </a>
                    All rights reserved
                </div>
            </div>
        </div>
    </footer>
    <!-- FOOTER END -->
    </div>

    <!-- BACK-TO-TOP -->
    <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>
    <!-- JQUERY JS -->
    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <!-- BOOTSTRAP JS -->
    <script src="{{ url('assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ url('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>

    <script src="{{ url('assets/js/jquery.sparkline.min.js') }}"></script>

    <!-- CHART-CIRCLE JS-->
    <script src="{{ url('assets/js/circle-progress.min.js') }}"></script>

    <!-- CHARTJS CHART JS-->
    <script src="{{ url('/assets/plugins/chart/Chart.bundle.js') }}"></script>
    <script src="{{ url('assets/plugins/chart/utils.js') }}"></script>

    <!-- PIETY CHART JS-->
    <script src="{{ url('assets/plugins/peitychart/jquery.peity.min.js') }}"></script>
    <script src="{{ url('assets/plugins/peitychart/peitychart.init.js') }}"></script>

    <!-- INPUT MASK JS-->
    <script src="{{ url('assets/plugins/input-mask/jquery.mask.min.js') }}"></script>

    <!-- SIDE-MENU JS-->
    <script src="{{ url('assets/plugins/sidemenu/sidemenu.js') }}"></script>

    <!-- Sticky js -->
    <script src="{{ url('assets/js/sticky.js') }}"></script>

    <!-- SIDEBAR JS -->
    <script src="{{ url('assets/plugins/sidebar/sidebar.js') }}"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="{{ url('assets/plugins/p-scroll/perfect-scrollbar.js') }}"></script>
    <script src="{{ url('assets/plugins/p-scroll/pscroll.js') }}"></script>
    <script src="{{ url('assets/plugins/p-scroll/pscroll-1.js') }}"></script>

    <!-- FILE UPLOADES JS -->
    <script src="{{ url('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ url('assets/plugins/fileuploads/js/file-upload.js') }}"></script>

    <!-- INTERNAL Bootstrap-Datepicker js-->
    <script src="{{ url('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- INTERNAL File-Uploads Js-->
    <script src="{{ url('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ url('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ url('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ url('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ url('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>

    <!-- SELECT2 JS -->
    <script src="{{ url('assets/plugins/select2/select2.full.min.js') }}"></script>

    <!-- INTERNAL Data tables js-->
    <script src="{{ url('assets/plugins/datatable/js/jquery.dataTables.min.j') }}s"></script>
    <script src="{{ url('assets/plugins/datatable/js/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ url('assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>

    <!-- ECHART JS-->
    <script src="{{ url('assets/plugins/echarts/echarts.js') }}"></script>

    <!-- BOOTSTRAP-DATERANGEPICKER JS -->
    <script src="{{ url('assets/plugins/bootstrap-daterangepicker/moment.min.js') }}"></script>
    <script src="{{ url('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <!-- INTERNAL Bootstrap-Datepicker js-->
    <script src="{{ url('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>

    <!-- INTERNAL Sumoselect js-->
    <script src="{{ url('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>

    <!-- TIMEPICKER JS -->
    <script src="{{ url('assets/plugins/time-picker/jquery.timepicker.js') }}"></script>
    <script src="{{ url('assets/plugins/time-picker/toggles.min.js') }}"></script>

    <!-- INTERNAL intlTelInput js-->
    <script src="{{ url('assets/plugins/intl-tel-input-master/intlTelInput.js') }}"></script>
    <script src="{{ url('assets/plugins/intl-tel-input-master/country-select.js') }}"></script>
    <script src="{{ url('assets/plugins/intl-tel-input-master/utils.js') }}"></script>

    <!-- INTERNAL jquery transfer js-->
    <script src="{{ url('assets/plugins/jQuerytransfer/jquery.transfer.js') }}"></script>



    <!-- DATEPICKER JS -->
    <script src="{{ url('assets/plugins/date-picker/date-picker.js') }}"></script>
    <script src="{{ url('assets/plugins/date-picker/jquery-ui.js') }}"></script>
    <script src="{{ url('assets/plugins/input-mask/jquery.maskedinput.js') }}"></script>

    <!-- MULTI SELECT JS-->
    <script src="{{ url('assets/plugins/multipleselect/multiple-select.js') }}"></script>
    <script src="{{ url('assets/plugins/multipleselect/multi-select.js') }}"></script>
    <!-- INTERNAL multi js-->
    <script src="{{ url('assets/plugins/multi/multi.min.js') }}"></script>

    <!-- FORMELEMENTS JS -->
    <script src="{{ url('assets/js/formelementadvnced.js') }}"></script>
    <script src="{{ url('assets/js/form-elements.js') }}"></script>

    <!-- APEXCHART JS -->
    <script src="{{ url('assets/js/apexcharts.js') }}"></script>

    <!-- INDEX JS -->
    {{-- <script src="{{ url('assets/js/index1.js') }}"></script> --}}

    <!-- Color Theme js -->
    <script src="{{ url('assets/js/themeColors.js') }}"></script>

    <!-- CUSTOM JS -->
    <script src="{{ url('assets/js/custom.js') }}"></script>

    @yield('script')
</body>

</html>
