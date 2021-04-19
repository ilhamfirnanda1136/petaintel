<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>map intelijen Gorontalo</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('')}}/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{asset('')}}/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="{{asset('')}}/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="{{asset('')}}/assets/vendors/typicons/typicons.css">
    <link rel="stylesheet" href="{{asset('')}}/assets/vendors/css/vendor.bundle.base.css">
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('')}}/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{asset('')}}/assets/vendors/datatables.net-fixedcolumns-bs4/fixedColumns.bootstrap4.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End Plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('')}}/assets/css/shared/style.css">
    <!-- endinject -->
     <link rel="stylesheet" href="{{asset('')}}/assets/vendors/font-awesome/css/font-awesome.min.css" />
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('')}}/assets/css/demo_1/style.css">
    <link rel="stylesheet" href="{{asset('css')}}/preloader.css">
    <link rel="stylesheet" href="{{asset('css/leaflet_awesome_number_markers.css')}}">
    <!-- End Layout styles -->
    {{-- <link rel="shortcut icon" href="{{asset('')}}/assets/images/favicon.png" /> --}}
          <style>
        .sidebar,.navbar.default-layout .navbar-brand-wrapper,.btn-primary  {
            background: #028100 !important;
        }
        .sidebar > .nav:not(.sub-menu) > .nav-item:hover:not(.nav-profile):not(.hover-open) > .nav-link:not([aria-expanded="true"]) {
            background: #36d104 !important;
            padding-left: 65px;
        }
    </style>
    @yield('header')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:{{asset('')}}/partials/_navbar.html -->
        @include('layouts.include.header')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:{{asset('')}}/partials/_settings-panel.html -->
          
             <form id="logout" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
            <!-- partial -->
            @include('layouts.include.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper"> @yield('content')</div>
                <!-- content-wrapper ends -->
                <!-- partial:{{asset('')}}/partials/_footer.html -->
                <footer class="footer">
                    <div class="container-fluid clearfix">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019 <a
                                href="http://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights
                            reserved.</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made
                            with <i class="mdi mdi-heart text-danger"></i>
                        </span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <div class="div-loading">
        <div id="loader" style="display: none;"></div>
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('')}}/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
     <!-- Plugin js for this page -->
    <script src="{{asset('')}}/assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{asset('')}}/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="{{asset('')}}/assets/vendors/datatables.net-fixedcolumns/dataTables.fixedColumns.min.js"></script>
    <!-- inject:js -->
    <script src="{{asset('')}}/assets/js/shared/off-canvas.js"></script>
    <script src="{{asset('')}}/assets/js/shared/hoverable-collapse.js"></script>
    <script src="{{asset('')}}/assets/js/shared/misc.js"></script>
    <script src="{{asset('')}}/assets/js/shared/settings.js"></script>
    <script src="{{asset('')}}/assets/js/shared/todolist.js"></script>
    <script src="{{asset('')}}/assets/vendors/sweetalert/sweetalert.min.js"></script>
    <script src="{{asset('js/input.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/gorontalo.js')}}"></script>
    <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
    integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
    crossorigin=""></script>
    <script src="{{asset('js/leaflet_awesome_number_markers.js')}}"></script>
    <script> 
        const process_env_url = "{{url('')}}";
        @if(Session::has('sukses'))
       swal({
              title: "Pesan!",
              text: "{{Session::get('sukses')}}",
              icon: "success",
          });
      @endif
    </script>
    @yield('footer')
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
</body>

</html>
