<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Gestion Pedidos</title>

  <!-- Font Awesome Icons -->

<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
<link rel="stylesheet" href="{{ asset('admin_panel/plugins/fontawesome/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin_panel/plugins/select2/css/select2.css') }}">
<link rel="stylesheet" href="{{ asset('admin_panel/plugins/toastr/toastr.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin_panel/plugins/sweetalert2/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin_panel/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
{{-- <link rel="stylesheet" href="{{ asset('admin_panel/plugins/datepicker/css/bootstrap-datepicker.min.css') }}"> --}}

<!-- Tempusdominus Bbootstrap 4 -->
{{-- <link rel="stylesheet" href="{{ asset('admin_panel/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}"> --}}
<!-- iCheck -->
<link rel="stylesheet" href="{{ asset('admin_panel/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<!-- JQVMap -->
<link rel="stylesheet" href="{{ asset('admin_panel/plugins/jqvmap/jqvmap.min.css') }}">
<!-- overlayScrollbars -->
<link rel="stylesheet" href="{{ asset('admin_panel/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
<!-- Daterange picker -->
{{-- <link rel="stylesheet" href="{{ asset('admin_panel/plugins/daterangepicker/daterangepicker.css') }}"> --}}
<!-- summernote -->
{{-- <link rel="stylesheet" href="{{ asset('admin_panel/plugins/summernote/summernote-bs4.css') }}"> --}}
@stack('styles')
</head>


<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed sidebar-collapse">
        <div class="wrapper">
            <!-- Inicio Header -->
            @include('admin_panel/header')
            <!-- Fin Header -->
            <!-- Inicio SideBar -->
            @include('admin_panel/sidebar')
            <!-- Fin SideBar -->
            <!-- Inicio ContentWrapper -->

            <div class="content-wrapper">

                    <!-- Content Header (Page header) -->
                    <div class="content-header">
                      <div class="container-fluid">
                        <div class="row mb-2">
                          <div class="col-sm-6">
                            <h1 class="m-0 text-dark"></h1>
                          </div><!-- /.col -->

                        </div><!-- /.row -->
                      </div><!-- /.container-fluid -->
                    </div>
                    <div class="content">
                        @yield('content')
                    </div>
            </div>


            <!-- Fin ContentWrapper -->
            <!-- Inicio Footer -->
            @include('admin_panel/footer')
            <!-- Fin Footer -->

        </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <!-- jQuery -->
    <script src="{{asset('admin_panel/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/toastr/toastr.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('admin_panel/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE -->
    <script src="{{asset('admin_panel/dist/js/adminlte.js')}}"></script>
    <!-- DataTables -->
    <script src="{{asset('admin_panel/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script> --}}


    <!-- JQVMap -->
    <script src="{{asset('admin_panel/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/jqvmap/maps/jquery.vmap.world.js')}}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{asset('admin_panel/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
    <!-- daterangepicker -->
    <script src="{{asset('admin_panel/plugins/moment/moment.min.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/select2/js/select2.min.js')}}"></script>
    {{-- <script src="{{asset('admin_panel/plugins/daterangepicker/daterangepicker.js')}}"></script> --}}
    <!-- overlayScrollbars -->
    <script src="{{asset('admin_panel/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{asset('admin_panel/plugins/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
    {{-- <script src="{{asset('admin_panel/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script> --}}

    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
@include('sweet::alert')
@stack('scripts')

</body>
</html>
