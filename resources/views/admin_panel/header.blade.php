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
            <li class="nav-item">
                    <a href="{{ route("pedidos.listar_carrito") }}" class="nav-link">
                    <i class="far fa-shopping-cart nav-icon"></i>

                    <span class="badge badge-warning navbar-badge">{{sizeof($pedido->seguimientos)}}</span>
                    </a>
                </li>
            @endif
          @endforeach

          <li class="nav-item dropdown">
                <div class="user-panel d-flex">
                        <div class="image">
                          <img src="{{asset('imagenes/user.png')}}" class="img-circle" alt="User Image">
                        </div>
                        <div class="info">
                        <a href="{{ route('admin.users.show', auth()->user()->id) }}" class="d-block">{{ auth()->user()->name }}</a>
                        </div>
                      </div>
            </li>

        </ul>
      </nav>
      <!-- /.navbar -->
