<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">


<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!--Swiper slider css-->
    <link href="{{ url('assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Select2 css -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Layout config Js -->
    <script src="{{ url('assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />


    <!-- custom Css-->
    <link href="{{ url('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />


</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        {{-- @include('layouts.partials._header') --}}
        <!-- ========== App Menu ========== -->
        {{-- @include('layouts.partials._sidebar') --}}
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        {{-- <div class="vertical-overlay"></div> --}}

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        {{-- <div class="main-content"> --}}

            <!-- Content -->
            @yield('content')
            <!-- End Page-content -->

            {{-- @include('layouts.partials._footer') --}}
        {{-- </div> --}}
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->




    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>



    <!-- JAVASCRIPT -->
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ url('assets/js/plugins.js') }}"></script>
    {{-- <script src="{{ url('assets/js/select2.min.js') }}"></script> --}}
    <script src="{{ url('assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script src="{{ url('assets/libs/flatpickr/flatpickr.min.js') }}"></script>



    <!--datatable js-->
    <script src="{{ url('assets/libs/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/libs/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ url('assets/libs/datatable/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('assets/libs/datatable/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('assets/libs/datatable/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('assets/libs/datatable/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('assets/libs/datatable/js/vfs_fonts.js') }}"></script>
    <script src="{{ url('assets/libs/datatable/js/pdfmake.min.js') }}"></script>
    <script src="{{ url('assets/libs/datatable/js/jszip.min.js') }}"></script>

    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- App js -->
    <script src="{{ url('assets/js/app.js') }}"></script>
    <script src="{{ url('assets/js/custom.js') }}"></script>
    <script src="{{ url('assets/js/custom_toastr.js') }}"></script>
    <!-- ckeditor -->
    <script src="{{ url('assets/libs/%40ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    <!--Swiper slider js-->
    <script src="{{ url('assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script>
        window.spinner = '<div class="spinner-border" role="status">' +
            '<span class="visually-hidden">Loading...</span>' +
            '</div>';
        window.small_spinner = '<div class="spinner-border spinner-small" role="status">' +
            '<span class="visually-hidden">Loading...</span>' +
            '</div>';

        function preloaderEnable() {
            $('#preloader').css('visibility', 'visible');
            $('#preloader').css('opacity', '1');

        }

        function preloaderDisable() {
            $('#preloader').css('visibility', 'hidden');
            $('#preloader').css('opacity', '0');
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // SET GLOBAL VARIABLE
        window.startDate = "{{ date('Y-m-d', strtotime('-1 days')) }}";
        window.endDate = "{{ date('Y-m-d') }}";

        // reset select2 select box
        $('[type=reset]').click(function() {
            $('.form-control').val("").change();
        });
    </script>
    <script>
        function isNumber(evt) {
            evt = evt ? evt : window.event;
            var charCode = evt.which ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
    </script>
    @yield('modal')
    @section('offcanvas')
    @show
    @stack('scripts')
</body>




</html>
