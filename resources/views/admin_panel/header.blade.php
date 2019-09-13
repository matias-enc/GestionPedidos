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

          {{-- </li>
          <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                class="fas fa-th-large"></i></a>
          </li> --}}
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
