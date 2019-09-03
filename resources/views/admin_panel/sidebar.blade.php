<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-primary">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">

          <span class="brand-text font-weight-bold align-content-center">Gestion Pedidos</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{asset('admin_panel/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="#" class="d-block">{{ auth()->user()->name }}</a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <li class="nav-item has-treeview ">
                <a href="#" class="nav-link active">
                  <i class="nav-icon fas fa-dolly-flatbed"></i>
                  <p>
                    Gestion Pedidos
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>

              </li>

              <li class="nav-item has-treeview ">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-users-cog"></i>
                    <p>
                      Gestion Usuarios
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  @can('usuarios_index')
                      <ul class="nav nav-treeview">
                        <li class="nav-item">
                          <a href="{{ route("admin.users.index") }}" class="nav-link">
                            <i class="far fa-user nav-icon"></i>
                            <p>Usuarios</p>
                          </a>
                        </li>
                      </ul>

                  @endcan
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="./index.html" class="nav-link">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p>Roles</p>
                      </a>
                    </li>
                  </ul>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="./index.html" class="nav-link">
                        <i class="fas fa-user-tag nav-icon"></i>
                        <p>Permisos</p>
                      </a>
                    </li>
                  </ul>
              </li>

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
