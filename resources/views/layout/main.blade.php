<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('vendor/src/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/src/assets/vendors/ti-icons/css/themify-icons.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/src/assets/vendors/css/vendor.bundle.base.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/src/assets/vendors/font-awesome/css/font-awesome.min.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('vendor/src/assets/vendors/font-awesome/css/font-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{asset('vendor/src/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('vendor/dist/assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('Logo TML.png')}}" />
  </head>
  <body>
    <div class="container-scroller">
      
      <!-- partial:partials/_navbar.html -->
      @include('layout.topbar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @if (Auth::user()->role == 1)
            @include('layout.sidebar') 
        @else
            @include('layout.pegawai.sidebar')
        @endif
        <!-- partial -->
        @yield('content')
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{asset('vendor/src/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('vendor/src/assets/vendors/chart.js/chart.umd.js')}}"></script>
    <script src="{{asset('vendor/src/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('vendor/src/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('vendor/src/assets/js/misc.js')}}"></script>
    <script src="{{asset('vendor/src/assets/js/settings.js')}}"></script>
    <script src="{{asset('vendor/src/assets/js/todolist.js')}}"></script>
    <script src="{{asset('vendor/src/assets/js/jquery.cookie.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{asset('vendor/src/assets/js/dashboard.js')}}"></script>
    <!-- End custom js for this page -->
  </body>
</html>