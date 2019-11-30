<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Gestion Pedidos</title>

    <!-- Font Awesome Icons -->

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_panel/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_panel/plugins/animate/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_panel/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_panel/plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_panel/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_panel/plugins/dropzone/dropzone.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_panel/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_panel/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_panel/plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('admin_panel/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_panel/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    @stack('styles')

    <style>
        .card {
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075);
            transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
        }

        .card-hover:hover {
            box-shadow: 0 14px 28px rgba(0, 0, 0, 0.25), 0 10px 10px rgba(0, 0, 0, 0.22);
        }

        .nav-item .nav-link .badgem {
            position: absolute;
            font-size: .65rem;
            text-align: center;
            color: white;
            top: 0.95em;
            right: 0.85em;
            width: 1rem;
            z-index: 3333;
            border-radius: 50%;
            background-color: #EC547A;

        }

        /* .nav-item .nav-link .badgem {
            position: absolute;
            font-size: .65rem;
            text-align: center;
            color: white;
            top: -0.15em;
            right: 0.85em;
            width: 1.3rem;
            z-index: 3333;
            border-radius: 50%;
            background-color: #EC547A;
            border: solid 2px white;

        } */

        .nav-item .nav-link .badgex {
            position: absolute;
            font-size: .65rem;
            text-align: center;
            color: white;
            top: 0.95em;
            right: 2.5em;
            width: 1rem;
            z-index: 3333;
            border-radius: 50%;
            background-color: #EC547A;
            /* border: solid 2px white;  */

        }

        .sidebar-light-primary .nav-sidebar .nav-item .nav-link.active {
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .085);
            transition: all 0.3s cubic-bezier(.25, .8, .25, 1);
            /* border-radius: 1.30rem; */
        }

        .main-sidebar:hover .badgem {
            border: none;
            width: 1rem;
            /* border-color: #c7c5c5; */
            top: 0.95em;

        }

        /* .main-sidebar:hover .badgex {
            border: none;
            width: 1rem;
            /* border-color: #c7c5c5; */
        /* top: 0.95em;
            right: 2.5em;
        } */
        /* .menu-open .badgex   {
            border: none;
            width: 3rem;
            border-color: #c7c5c5;
            top: 0.95em;
            right: 2.5em;
            border: solid 2px #F7FAFC;
        } */

        /* .nav-sidebar > .nav-item.menu-open .badgex{
            border: solid 2px #F7FAFC;
        } */

        .nav-item .nav-link .badgeh {
            position: absolute;
            font-size: .65rem;
            text-align: center;
            padding-top: .06rem;
            padding-left: .06rem;
            color: black;
            top: 2px;
            right: 3px;
            width: 1.2rem;
            z-index: 3333;
            border-radius: 50%;
            background-color: #c4183c;
            border: solid 2px white;

        }

        .inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .inputfile+label {
            font-size: 1.25em;
            font-weight: 700;
            color: white;
            background-color: black;
            display: inline-block;
        }

        .inputfile:focus+label,
        .inputfile+label:hover {
            background-color: red;
        }

        .gradient-primary {
            background: rgb(67, 133, 245);
            background: linear-gradient(300deg, rgba(67, 133, 245, 1) 0%, rgba(69, 235, 157, 1) 100%);
        }

        .nav-sidebar .nav-item>.nav-link {
            margin-bottom: 0.65rem;
        }
    </style>
</head>


<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
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
            <div class="main-content-container container-fluid px-4">
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

    {{-- <script src="{{asset('admin_panel/plugins/jquery/jquery.min.js')}}"></script> --}}
    <script src="{{asset('admin_panel/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/chart.js/Chart.min.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/toastr/toastr.min.js')}}"></script>

    <!-- Bootstrap -->
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
    <script src="{{asset('admin_panel/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/select2/js/select2.min.js')}}"></script>

    <script src="{{asset('admin_panel/plugins/popper/popper.min.js')}}"></script>
    {{-- <script src="https://getbootstrap.com/docs/4.1/assets/js/vendor/popper.min.js"></script> --}}
    {{-- <script src="{{asset('admin_panel/plugins/daterangepicker/daterangepicker.js')}}"></script> --}}
    <!-- overlayScrollbars -->
    <script src="{{asset('admin_panel/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

    <!-- OPTIONAL SCRIPTS -->
    <script src="{{asset('admin_panel/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
    {{-- <script src="{{asset('admin_panel/plugins/datepicker/js/bootstrap-datepicker.min.js')}}"></script> --}}
    <script src="{{asset('admin_panel/plugins/datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/datepicker/locales/bootstrap-datepicker.es.min.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('admin_panel/plugins/dropzone/dropzone.js')}}"></script>
    <script src="{{asset('js/sweetalert.min.js')}}"></script>
    {{-- <script src="{{asset('admin_panel/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script> --}}

    {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
    {{-- {{-- <script src="https://js.pusher.com/5.0/pusher.min.js"></script> --}}


    <script>
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 5000
        });
    </script>
    <script>
        $(document).ready(function(){
        var carrito = "{{ url('/cantidad_carrito') }}";
        var pendientes = "{{ url('/cantidad_pendientes') }}";
        var pagopendiente = "{{ url('/cantidad_pagopendiente') }}";

        $.get(carrito, function(data){
            if(data > 0){
                $("#divcarrito").removeAttr("style").show()
                $("span#span-carrito").css('visibility','visible');
                $('#span-carrito').text(data);
            }
        });
        $.get(pagopendiente, function(data){
            if(data > 0){
                $("#divpagopendiente").removeAttr("style").show()
                $("span#span-pagopendiente").css('visibility','visible');
                $('#span-pagopendiente').text('!');
            }
        });
        $.get(pendientes, function(data){
            if(data > 0){
                $("#divpendientes").removeAttr("style").show()
                $("span#span-pendientes").css('visibility','visible');
                $('#span-pendientes').text('!');
            }
        });
    });

    </script>
    @can('usuarios_validate')
    <script>
        $(document).ready(function(){
        var validaciones = "{{ url('/cantidad_validaciones') }}";
        $.get(validaciones, function(data){
            if(data > 0){
                $("#divvalidaciones").removeAttr("style").show()
                $("span#span-validaciones").css('visibility','visible');
                $("span#span-gestionUsuarios").css('visibility','visible');
                $('#span-validaciones').text(data);
                $('#span-gestionUsuarios').text('!');
            }
        });
    });
    </script>
    <script>
        var validaciones = "{{ url('/cantidad_validaciones') }}";

        Echo.channel('gestionpedidos').listen('ValidacionSolicitada', (e) => {
            $(function() {
                Toast.fire({
                type: 'info',
                title: e.message
            }),
            $.get(validaciones, function(data){
                $("span#span-validaciones").css('visibility','visible');
                if(data>0){
                    $("#divvalidaciones").removeAttr("style").show()
                    $("span#span-validaciones").css('visibility','visible');
                    $("span#span-gestionUsuarios").css('visibility','visible');
                    $('#span-validaciones').text(data);
                    $('#span-gestionUsuarios').text('!');
                }
            });
        });
    });
    </script>
    @endcan

    @can('empleado_solicitudes')
    <script>
        $(document).ready(function(){
        var solicitudes = "{{ url('/cantidad_solicitudes') }}";
        $.get(solicitudes, function(data){
            if(data > 0){
                $("#divsolicitud").removeAttr("style").show()
                $("span#span-solicitudes").css('visibility','visible');
                $('#span-solicitudes').text(data);

            }
        });
        Echo.channel('gestionpedidos').listen('PedidoSolicitado', (e) => {
            $(function() {
                Toast.fire({
                type: 'info',
                title: e.message
            }),
            $.get(solicitudes, function(data){
                $("#divsolicitud").removeClass("heartBeat");
                $("span#span-solicitudes").css('visibility','visible');
                if(data>0){
                    $("#divsolicitud").removeAttr("style").show()
                    $('#span-solicitudes').text(data);
                    $("#divsolicitud").addClass("heartBeat");
                }
            });
        });
    });
    });
    </script>
    @endcan

    @can('empleado_pedidosIniciados')
    <script>
        $(document).ready(function(){
        var iniciados = "{{ url('/cantidad_iniciados') }}";
        $.get(iniciados, function(data){
            if(data > 0){
                $("#diviniciado").removeAttr("style").show()
                $("span#span-iniciados").css('visibility','visible');
                $('#span-iniciados').text(data);

            }
        });
        Echo.channel('gestionpedidos').listen('PedidoIniciado', (e) => {
            $(function() {
            Toast.fire({
                type: 'success',
                title: e.message
            }),

            $.get(iniciados, function(data){
            if(data > 0){
                $("#diviniciados").removeAttr("style").show()
                $("span#span-iniciados").css('visibility','visible');
                $('#span-iniciados').text(data);
            }
        });
        });
    });
    });
    </script>
    @endcan
    @can('empleado_pedidosRevision')
    <script>
        $(document).ready(function(){
        var revision = "{{ url('/cantidad_revision') }}";
        $.get(revision, function(data){
            if(data > 0){
                $("#divrevision").removeAttr("style").show()
                $("span#span-revision").css('visibility','visible');
                $('#span-revision').text(data);
            }
        });
        Echo.channel('gestionpedidos').listen('PedidoRevision', (e) => {
            console.log(e);
            $(function() {
            Toast.fire({
                type: 'warning',
                title: e.message
            }),

            $.get(revision, function(data){
            if(data > 0){
                $("#divrevision").removeAttr("style").show()
                $("span#span-revision").css('visibility','visible');
                $('#span-revision').text(data);
            }
        });
        });
    });
    });
    </script>
    @endcan




    {{-- <script>
        var solicitudes = "{{ url('/cantidad_solicitudes') }}";
    var iniciados = "{{ url('/cantidad_iniciados') }}";
    var revision = "{{ url('/cantidad_revision') }}";
    var carrito = "{{ url('/cantidad_carrito') }}";
    </script> --}}


    @include('sweet::alert')
    @stack('scripts')

</body>

</html>
