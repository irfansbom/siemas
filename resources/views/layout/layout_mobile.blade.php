<!doctype html>
<html lang="en" dir="ltr">

<head>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
        integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
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
    <div class="page" style="min-height: 87vh;">
        <div class="page-main">
            @yield('content')
        </div>

    </div>

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
