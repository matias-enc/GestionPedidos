<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('auto_gestion') }}" class="nav-link">Home</a>
        </li>
    </ul>



    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->

        </li>
        @foreach (auth()->user()->pedidos as $pedido)
        @if ($pedido->estado->nombre == 'Carrito')
        <li class="nav-item border-left">
            <a href="{{ route("pedidos.listar_carrito") }}" class="nav-link">
                <i class="fal fa-shopping-cart fa-lg nav-icon fa-pull-left" style="color:black"></i>

                <span class="badge badge-warning navbar-badge">{{sizeof($pedido->seguimientos)}}</span>
            </a>
        </li>
        @endif
        @endforeach
        <li class="nav-item dropdown user user-menu  border-left border-right d-flex justify-content-center " >
                <div>
                        <a href="#" class="nav-link " data-toggle="dropdown">
                                <img src="{{asset('imagenes/user.png')}}" class="user-image img-circle" alt=" User Image">
                                <span class="hidden-xs">{{auth()->user()->name}}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-small dropdown-menu-right">
                                <a class="dropdown-item text-center" href="user-profile-lite.html"><i class="fal fa-user-cog"></i> Perfil</a>
                                <div class="dropdown-divider"></div>
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
