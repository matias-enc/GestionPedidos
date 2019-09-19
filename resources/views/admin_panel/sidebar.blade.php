<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 sidebar-light-primary" style="min-height: 917px;">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <img src="{{ asset("imagenes/logo-apostoles.png") }}"
           alt="AdminLTE Logo"
           class="brand-image img-circle"
           style="opacity: .8">

          <span class="brand-text font-weight-bold">Gestion Pedidos</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <br>
              <br>
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route("pedidos.nuevo_pedido") }}" class="nav-link {{ request()->is('nuevo_pedido') || request()->is('nuevo_pedido') || request()->is('consultar_disponibilidad')  || request()->is('detalle_pedido')  ? 'active' : '' }}">
                    <i class="fal fa-box-open nav-icon"></i>
                    <p><span>Nuevo Pedido</span></p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route("pedidos.mis_pedidos") }}" class="nav-link {{ request()->is('mis_pedidos') || request()->is('mis_pedidos/*')   ? 'active' : '' }}">
                    <i class="fal fa-boxes nav-icon"></i>
                    <p><span>Mis Pedidos</span></p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ request()->is('pedidos/*') ||request()->is('solicitudes') ? 'menu-open' : ''}}">
                    <a class="nav-link nav-dropdown-toggle {{ request()->is('pedidos/*') ||request()->is('solicitudes') ? 'active' : ''}}">
                        <i class="nav-icon fal fa-dolly-flatbed"></i>
                        <p>
                            Gestion Pedidos
                            <i class="right fal fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route("pedidos.index") }}" class="nav-link {{ request()->is('pedidos/index') || request()->is('admin/users/*') ? 'active' : '' }}">
                            <i class="fal fa-box-alt nav-icon"></i>
                            <p><span>Pedidos</span></p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route("pedidos.solicitudes") }}" class="nav-link {{ request()->is('solicitudes')  ? 'active' : '' }}">
                            <i class="fal fa-exclamation-circle nav-icon"></i>
                            <p><span>Solicitudes</span></p>
                            </a>
                        </li>
                    </ul>

                </li>

              <li class="nav-item has-treeview {{ request()->is('admin/*') ? 'menu-open' : ''}}">
                <a class="nav-link nav-dropdown-toggle {{ request()->is('admin/*') ? 'active' : ''}}">
                    <i class="nav-icon fal fa-users-cog  "></i>
                    <p>
                      Gestion Usuarios
                      <i class="right fal fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                  @can('usuarios_index')
                    <li class="nav-item">
                        <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                        <i class="fal fa-user nav-icon"></i>
                        <p><span>Usuarios</span></p>
                        </a>
                    </li>
                  @endcan
                    @can('roles_index')
                    <li class="nav-item">
                    <a href="{{route("admin.roles.index")}}" class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                        <i class="fal fa-user-lock nav-icon"></i>
                        <p><span>Roles</span></p>
                      </a>
                    </li>
                    @endcan
                    @can('permisos_index')
                    <li class="nav-item">
                      <a href="{{route("admin.permisos.index")}}" class="nav-link {{ request()->is('admin/permisos') || request()->is('admin/permisos/*') ? 'active' : '' }}">
                        <i class="fal fa-user-tag nav-icon"></i>
                        <p>Permisos</p>
                      </a>
                    </li>
                    @endcan
                </ul>
              </li>

              <li class="nav-item has-treeview {{ request()->is('workflow/*') ? 'menu-open' : ''}}">
                <a class="nav-link nav-dropdown-toggle {{ request()->is('workflow/*') ? 'active' : ''}}">
                    <i class="nav-icon fal fa-sitemap "></i>
                    <p>
                      Gestion Workflow
                      <i class="right fal fa-angle-left"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                            <a href="{{ route("workflow.flujos.index") }}" class="nav-link {{ request()->is('workflow/flujos') || request()->is('workflow/flujos/*') ? 'active' : '' }}">
                            <i class="fal fa-cog nav-icon"></i>
                            <p><span>Flujos de Trabajo</span></p>
                            </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route("workflow.transiciones.index") }}" class="nav-link {{ request()->is('workflow/transiciones') || request()->is('transiciones/*') ? 'active' : '' }}">
                        <i class="fal fa-project-diagram nav-icon"></i>
                        <p><span>Transiciones</span></p>
                        </a>
                    </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{ route("item.index") }}" class="nav-link {{ request()->is('index')  ? 'active' : '' }}">
                <i class="fal fa-inventory nav-icon"></i>
                <p><span>Gestion Inventario</span></p>
                </a>
              </li>

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
