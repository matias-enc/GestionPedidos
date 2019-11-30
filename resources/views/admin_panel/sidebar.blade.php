<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-0 border-right sidebar-light-primary " >
    <!-- Brand Logo -->
    <a href="/" class="brand-link border-bottom-0 border-right">
        <img src="{{ asset("imagenes/logo-apostoles.png") }}" alt="AdminLTE Logo" class="brand-image img-circle"
            style="opacity: .8">


        <span class="brand-text font-weight-bold ">Gestion Pedidos</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(auth()->user()->validacion->aprobado != true)
                <li class="nav-header">VALIDACION DE USUARIO</li>
                <li class="nav-item">
                    <a href="{{route('validacion_datos')}}"
                        class="nav-link {{ request()->is('validacion')  ? 'active' : '' }}">
                        @if (!(request()->is('validacion')))
                        <span id="span-validacion" class=" badgem">!</span>
                        @endif
                        <i class="fal fa-address-card nav-icon"></i>
                        <p><span>Validacion</span></p>
                    </a>
                </li>
                @endif

                {{-- @can('sin_validacion')
                <li class="nav-item">
                    <a href="{{route('validacion_datos')}}"
                class="nav-link {{ request()->is('validacion')  ? 'active' : '' }}">
                @if (!(request()->is('validacion')))
                <span id="span-validacion" class=" badgem">!</span>
                @endif
                <i class="fal fa-address-card nav-icon"></i>
                <p><span>Validacion</span></p>
                </a>
                </li>
                @endcan --}}
                @can('usuario_pedido')
                <li class="nav-header pl-3">PEDIDOS</li>
                <li class="nav-item">
                    <a href="{{ route("pedidos.nuevo_pedido") }}"
                        class="nav-link align-items-center {{ request()->is('nuevo_pedido')  ? 'active' : '' }}">
                        @if (!(request()->is('nuevo_pedido')))
                        <span id="span-nuevo_pedido" class=" badgem" style="visibility: hidden">!</span>
                        @endif
                        <i class="fal fa-dolly-flatbed-alt nav-icon "></i>
                        <p class="align-self-center"><span>Nuevo Pedido</span></p>
                    </a>
                </li>
                @endcan
                @can('usuario_documentacion')
                <li class="nav-item" id="divpendientes">
                    <a href="{{ route("pedidos.pendientes") }}"
                        class="nav-link align-items-center {{ request()->is('pendientes')  ? 'active' : '' }}">
                        @if (!(request()->is('pendientes')))
                        <span id="span-pendientes" class=" badgem" style="visibility: hidden">!</span>
                        @endif
                        <i class="fal fa-file-alt nav-icon "></i>
                        <p class="align-self-center"><span>Documentacion</span></p>
                    </a>
                </li>
                @endcan

                @can('usuario_pagos')
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
                @endcan
                @can('usuario_mispedidos')
                <li class="nav-item">
                    <a href="{{ route("pedidos.mis_pedidos") }}"
                        class="nav-link {{ request()->is('mis_pedidos') || request()->is('mis_pedidos/*')   ? 'active' : '' }}">
                        <i class="fal fa-box-open nav-icon"></i>
                        <p><span>Mis Pedidos</span></p>
                    </a>
                </li>
                @endcan
                @can('empleado_solicitudes')
                <li class="nav-header">GESTION PEDIDOS</li>
                <li class="nav-item" id="divsolicitud">
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
                @endcan
                @can('empleado_pedidosIniciados')

                <li class="nav-item " id="diviniciados">
                    <a href="{{ route("pedidos.iniciados") }}"
                        class="nav-link {{ request()->is('iniciados')  ? 'active ' : '' }}">
                        @if (!(request()->is('iniciados')))
                        <span id="span-iniciados" class=" badgem bg-success" style="visibility: hidden"></span>
                        @endif
                        <i class="fal fa-calendar-exclamation nav-icon animated">
                        </i>
                        <p>
                            <span>Pedidos Iniciados</span></p>
                    </a>
                </li>
                @endcan
                @can('empleado_pedidosRevision')
                <li class="nav-item" id="divrevision">
                    <a href="{{ route("pedidos.revision") }}"
                        class="nav-link {{ request()->is('revision')  ? 'active' : '' }}">
                        @if (!(request()->is('revision')))
                        <span id="span-revision" class=" badgem bg-warning" style="visibility: hidden"></span>
                        @endif
                        <i class="fal fa-history nav-icon animated">
                        </i>
                        <p>
                            <span>Pedidos en Revision</span></p>
                    </a>
                </li>
                @endcan
                @can('empleado_gestionpedidos')
                <li class="nav-item has-treeview {{ request()->is('pedidos/*')  ? 'menu-open' : ''}}">
                    <a class="nav-link nav-dropdown-toggle {{ request()->is('pedidos/*')  ? 'active' : ''}}">
                        <i class="nav-icon fal fa-dolly-flatbed"></i>
                        <p>
                            Pedidos
                            <i class="right far fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route("pedidos.index") }}"
                                class="nav-link {{ request()->is('pedidos/index') || request()->is('pedidos/index/*') ? 'active' : '' }}">
                                <i class="fal fa-list nav-icon"></i>
                                <p><span>Listado</span></p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('pedidos.estadisticas')}}"
                                class="nav-link {{ request()->is('pedidos/estadisticas') || request()->is('pedidos/estadisticas/*') ? 'active' : '' }}">
                                <i class="fal fa-chart-pie nav-icon"></i>
                                <p><span>Estadisticas</span></p>
                            </a>
                        </li>

                    </ul>


                </li>
                @endcan
                @can('empleado_gestionusuarios')
                <li
                    class="nav-item has-treeview {{ request()->is('admin/*')||request()->is('validacion_pendiente')||request()->is('validacion_pendiente/*') ? 'menu-open' : ''}}">
                    <a
                        class="nav-link nav-dropdown-toggle {{ request()->is('admin/*')||request()->is('validacion_pendiente')||request()->is('validacion_pendiente/*') ? 'active' : ''}}">

                        @if(!(request()->is('admin/users')||request()->is('validacion_pendiente')||request()->is('validacion_pendiente/*')))
                        <span id="span-gestionUsuarios" class="bg-warning badgex" style="visibility: hidden">!</span>
                        @endif
                        <i class="nav-icon fal fa-users-cog  "></i>
                        <p>
                            Usuarios
                            <i class="right far fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @can('usuarios_index')
                        <li class="nav-item">
                            <a href="{{ route("admin.users.index") }}"
                                class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fal fa-list nav-icon"></i>
                                <p><span>Listado</span></p>
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

                        <li class="nav-item" id="divvalidaciones" style="visibility: hidden; display: none">
                            <a href="{{route("validacion_pendiente")}}"
                                class="nav-link {{ request()->is('validacion_pendiente') || request()->is('validacion_pendiente/*') ? 'active' : '' }}">
                                @if (!(request()->is('validacion_pendiente')))
                                <span id="span-validaciones" class="badgem bg-warning"
                                    style="visibility: hidden"></span>
                                @endif
                                <i class="fal fa-user-check nav-icon"></i>
                                <p>Validacion</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('empleado_gestionworkflow')
                <li class="nav-item has-treeview {{ request()->is('workflow/*') ? 'menu-open' : ''}}">
                    <a class="nav-link nav-dropdown-toggle {{ request()->is('workflow/*') ? 'active' : ''}}">
                        <i class="nav-icon fal fa-sitemap "></i>
                        <p>
                            Flujo de Trabajo
                            <i class="right far fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route("workflow.flujos.index") }}"
                                class="nav-link {{ request()->is('workflow/flujos') || request()->is('workflow/flujos/*') ? 'active' : '' }}">
                                <i class="fal fa-list nav-icon"></i>
                                <p><span>Listado</span></p>
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
                @endcan
                @can('empleado_gestionInventario')
                <li class="nav-item">
                    <a href="{{ route("item.index") }}"
                        class="nav-link {{ request()->is('item') || request()->is('item/*')  ? 'active' : '' }}">
                        <i class="fal fa-inventory nav-icon"></i>
                        <p><span>Inventario</span></p>
                    </a>
                </li>
                @endcan
                @can('auditor')
                <li class="nav-header">AUDITORIA</li>
                <li class="nav-item" id="divpendientes">
                    <a href="{{ route("auditoria.index") }}"
                        class="nav-link {{ request()->is('auditoria')  ? 'active' : '' }}">
                        <i class="fal fa-file-archive nav-icon "></i>
                        <p><span>Auditorias</span></p>
                    </a>
                </li>
                @endcan
                @if(auth()->user()->validacion->aprobado == true)
                <li class="nav-header pl-3">PANEL DE USUARIO</li>
                <li class="nav-item">
                    <a href="{{ route("mi_perfil") }}"
                        class="nav-link {{ request()->is('mi_perfil') ? 'active' : '' }}">
                        <i class="fal fa-user nav-icon"></i>
                        <p><span>Mi Perfil</span></p>
                    </a>
                </li>
                @endif
                {{-- @if(auth()->user()->validacion->aprobado == true) --}}
                @can('empleado_gestionworkflow')
                <li class="nav-header pl-3">CONFIGURACIONES</li>
                <li class="nav-item">
                    <a href="{{ route("configuraciones_sistema") }}"
                        class="nav-link {{ request()->is('configuraciones_sistema')  ? 'active' : '' }}">
                        <i class="fal fa-cog nav-icon"></i>
                        <p><span>Sistema</span></p>
                    </a>
                </li>
                @endcan
                {{-- @endif --}}
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
