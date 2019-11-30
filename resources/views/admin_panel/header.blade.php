<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-stream"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('auto_gestion') }}" class="nav-link">Inicio</a>
        </li>
    </ul>



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        <li class="nav-item" >
            <a href="{{ route("pedidos.listar_carrito") }}" style="visibility: hidden" id="divcarrito" class="nav-link">
                <i class="fal fa-shopping-cart fa-lg nav-icon fa-pull-left mt-2" style="color:black"></i>

                <span class="badgeh bg-warning" id="span-carrito"></span>
            </a>
        </li>
        @can('usuario_pedido')
        <li class="nav-item pl-2">
            <a href="{{ route("pedidos.nuevo_pedido") }}" class="btn btn-pill btn-primary" style="color: white">
                <i class="fal fa-plus"></i>
                Nuevo Pedido
            </a>
        </li>
        @endcan
        <li class="nav-item dropdown d-flex justify-content-center">
            <div>
                <a href="#" class="nav-link navbar-brand" data-toggle="dropdown">
                    <img src="{{asset('imagenes/user.png')}}" class="brand-image img-circle">
                    {{-- <span class="hidden-xs">{{auth()->user()->name}}</span> --}}
                    <i class="right far fa-angle-down fa-xs"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-small dropdown-menu-right">
                    <h6 class="text-center pb-0"><strong class="">{{auth()->user()->name}} {{ucfirst(auth()->user()->apellido)}}</strong></h6>
                    <hr class="p-0 m-0">
                    @if(auth()->user()->validacion->aprobado == true)
                    <a class="dropdown-item text-center" href="{{ route('mi_perfil') }}"><i class="fal fa-user-cog"></i>
                        Configuración</a>
                        <div class="dropdown-divider"></div>
                        @endif
                    <a class="dropdown-item text-center text-danger" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                        <i class="fal fa-sign-out text-danger"></i> Cerrar Sesion </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>


        </li>
    </ul>
</nav>
<!-- /.navbar -->
