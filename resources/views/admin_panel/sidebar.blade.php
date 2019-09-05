<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-primary" style="min-height: 917px;">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">

          <span class="brand-text font-weight-bold offset-2">Gestion Pedidos</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{asset('admin_panel/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
            <a href="{{ route('admin.users.show', auth()->user()->id) }}" class="d-block">{{ auth()->user()->name }}</a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
              <li class="nav-item has-treeview active">
                <a href="#" class="nav-link ">
                  <i class="nav-icon fas fa-dolly-flatbed"></i>
                  <p>
                    Gestion Pedidos
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>

              </li>

              <li class="nav-item has-treeview {{ request()->is('admin/*') ? 'menu-open' : ''}}">
                <a class="nav-link nav-dropdown-toggle {{ request()->is('admin/*') ? 'active' : ''}}">
                    <i class="nav-icon fas fa-users-cog  "></i>
                    <p>
                      Gestion Usuarios
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                  @can('usuarios_index')
                    <li class="nav-item">
                        <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                        <i class="far fa-user nav-icon"></i>
                        <p><span>Usuarios</span></p>
                        </a>
                    </li>
                  @endcan
                    @can('roles_index')
                    <li class="nav-item">
                    <a href="{{route("admin.roles.index")}}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                        <i class="fas fa-user-lock nav-icon"></i>
                        <p><span>Roles</span></p>
                      </a>
                    </li>
                    @endcan
                    @can('permisos_index')
                    <li class="nav-item">
                      <a href="{{route("admin.permisos.index")}}" class="nav-link {{ request()->is('admin/permisos') || request()->is('admin/permisos/*') ? 'active' : '' }}">
                        <i class="fas fa-user-tag nav-icon"></i>
                        <p>Permisos</p>
                      </a>
                    </li>
                    @endcan
                </ul>
              </li>

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
