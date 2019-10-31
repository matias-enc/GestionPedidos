<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-0 border-right sidebar-light-primary" style="min-height: 917px;">
    <!-- Brand Logo -->
    <a href="/" class="brand-link border-bottom-0 border-right">
        <img src="{{ asset("imagenes/logo-apostoles.png") }}" alt="AdminLTE Logo" class="brand-image img-circle"
            style="opacity: .8">


        <span class="brand-text font-weight-bold ">Gestion Pedidos</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <br><br>
        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->
                {{-- @if (sizeof(auth()->user()->pedidos->where('estado_id', 14))>0) --}}

                <li class="nav-item" >
                    <a href=""
                        class="nav-link {{ request()->is('validacion')  ? 'active' : '' }}">
                        @if (!(request()->is('validacion')))
                        <span id="span-validacion" class=" badgem">!</span>
                        @endif
                        <i class="fal fa-address-card nav-icon"></i>
                        <p><span>Validacion</span></p>
                    </a>
                </li>
                <li class="nav-item" id="divpendientes">
                    <a href="{{ route("pedidos.pendientes") }}"
                        class="nav-link {{ request()->is('pendientes')  ? 'active' : '' }}">
                        @if (!(request()->is('pendientes')))
                        <span id="span-pendientes" class=" badgem" style="visibility: hidden">!</span>
                        @endif
                        <i class="fal fa-file-alt nav-icon "></i>
                        <p><span>Documentacion</span></p>
                    </a>
                </li>
                {{-- @endif --}}
                {{-- @if (sizeof(auth()->user()->pedidos->where('estado_id', 7))>0) --}}
                <li class="nav-item" id="divpagopendiente">
                    <a href="{{route("pedidos.pago_pendiente")}}"
                        class="nav-link {{ request()->is('pago_pendiente') || request()->is('pago_pendiente/*')  ? 'active' : '' }}">
                        @if (!(request()->is('pago_pendiente') || (request()->is('pago_pendiente/*'))))
                        <span id="span-pagopendiente" class="badgem bg-success" style="visibility: hidden"></span>
                        @endif
                        <i class="fal fa-wallet nav-icon"></i>
                        <p><span>Pagos Pendientes</span></p>
                    </a>
                </li>
                {{-- @endif --}}
                {{-- <li class="nav-item">
                    <a href="{{ route("pedidos.nuevo_pedido") }}"
                class="nav-link
                {{ request()->is('nuevo_pedido') || request()->is('nuevo_pedido') || request()->is('consultar_disponibilidad')  || request()->is('detalle_pedido')  ? 'active' : '' }}">
                <i class="fal fa-box-open nav-icon "></i>
                <p><span>Nuevo Pedido</span></p>
                </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ route("pedidos.mis_pedidos") }}"
                        class="nav-link {{ request()->is('mis_pedidos') || request()->is('mis_pedidos/*')   ? 'active' : '' }}">
                        <i class="fal fa-box-open nav-icon"></i>
                        <p><span>Mis Pedidos</span></p>
                    </a>
                </li>

                <li class="nav-item" id="divsolicitud" style="display: none">
                    <a href="{{ route("pedidos.solicitudes") }}"
                        class="nav-link {{ request()->is('solicitudes')  ? 'active' : '' }}">
                        @if (!(request()->is('solicitudes')))
                        <span id="span-solicitudes" class=" badgem" style="visibility: hidden"></span>
                        @endif
                        <i class="fal fa-file-exclamation nav-icon animated">
                        </i>
                        <p>
                            <span>Solicitudes</span></p>
                    </a>
                </li>
                <li class="nav-item " id="diviniciados" style="display: none">
                    <a href="{{ route("pedidos.iniciados") }}"
                        class="nav-link {{ request()->is('iniciados')  ? 'active ' : '' }}">
                        @if (!(request()->is('iniciados')))
                        <span id="span-iniciados bg-success" class=" badgem" style="visibility: hidden"></span>
                        @endif
                        <i class="fal fa-calendar-exclamation nav-icon animated">
                        </i>
                        <p>
                            <span>Pedidos Iniciados</span></p>
                    </a>
                </li>
                <li class="nav-item" id="divrevision" style="display: none">
                    <a href="{{ route("pedidos.revision") }}"
                        class="nav-link {{ request()->is('revision')  ? 'active' : '' }}">
                        @if (!(request()->is('revision')))
                        <span id="span-revision bg-warning" class=" badgem" style="visibility: hidden"></span>
                        @endif
                        <i class="fal fa-history nav-icon animated">
                        </i>
                        <p>
                            <span>Pedidos en Revision</span></p>
                    </a>
                </li>
                <li class="nav-item has-treeview {{ request()->is('pedidos/*')  ? 'menu-open' : ''}}">
                    <a class="nav-link nav-dropdown-toggle {{ request()->is('pedidos/*')  ? 'active' : ''}}">
                        <i class="nav-icon fal fa-dolly-flatbed"></i>
                        <p>
                            Gestion Pedidos
                            <i class="right far fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('pedidos.estadisticas')}}"
                                class="nav-link {{ request()->is('pedidos/estadisticas') || request()->is('pedidos/estadisticas/*') ? 'active' : '' }}">
                                <i class="fal fa-chart-pie nav-icon"></i>
                                <p><span>Estadisticas</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("pedidos.index") }}"
                                class="nav-link {{ request()->is('pedidos/index') || request()->is('pedidos/index/*') ? 'active' : '' }}">
                                <i class="fal fa-box-alt nav-icon"></i>
                                <p><span>Pedidos</span></p>
                            </a>
                        </li>
                    </ul>


                </li>


                <li class="nav-item has-treeview {{ request()->is('admin/*') ? 'menu-open' : ''}}">
                    <a class="nav-link nav-dropdown-toggle {{ request()->is('admin/*') ? 'active' : ''}}">
                        <i class="nav-icon fal fa-users-cog  "></i>
                        <p>
                            Gestion Usuarios
                            <i class="right far fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('usuarios_index')
                        <li class="nav-item">
                            <a href="{{ route("admin.users.index") }}"
                                class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fal fa-user nav-icon"></i>
                                <p><span>Usuarios</span></p>
                            </a>
                        </li>
                        @endcan
                        @can('roles_index')
                        <li class="nav-item">
                            <a href="{{route("admin.roles.index")}}"
                                class="nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <i class="fal fa-user-lock nav-icon"></i>
                                <p><span>Roles</span></p>
                            </a>
                        </li>
                        @endcan
                        @can('permisos_index')
                        <li class="nav-item">
                            <a href="{{route("admin.permisos.index")}}"
                                class="nav-link {{ request()->is('admin/permisos') || request()->is('admin/permisos/*') ? 'active' : '' }}">
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
                            <i class="right far fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route("workflow.flujos.index") }}"
                                class="nav-link {{ request()->is('workflow/flujos') || request()->is('workflow/flujos/*') ? 'active' : '' }}">
                                <i class="fal fa-cog nav-icon"></i>
                                <p><span>Flujos de Trabajo</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route("workflow.estados.index") }}"
                                class="nav-link {{ request()->is('workflow/estados') || request()->is('estados/*') ? 'active' : '' }}">
                                <i class="fal fa-project-diagram nav-icon"></i>
                                <p><span>Estados</span></p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route("item.index") }}"
                        class="nav-link {{ request()->is('item') || request()->is('item/*')  ? 'active' : '' }}">
                        <i class="fal fa-inventory nav-icon"></i>
                        <p><span>Gestion Inventario</span></p>
                    </a>
                </li>

                <li class="nav-item" id="divpendientes">
                    <a href="{{ route("auditoria.index") }}"
                        class="nav-link {{ request()->is('auditoria')  ? 'active' : '' }}">
                        <i class="fal fa-file-archive nav-icon "></i>
                        <p><span>Auditorias</span></p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
