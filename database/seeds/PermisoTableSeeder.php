<?php

use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Database\Seeder;

class PermisoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'Listar usuarios',
            'slug' => 'usuarios_index',
            'description' => 'Capacidad de Listar los usuarios'
        ]);
        Permission::create([
            'name' => 'Crear usuarios',
            'slug' => 'usuarios_create',
            'description' => 'Capacidad de Crear los usuarios'
        ]);
        Permission::create([
            'name' => 'Modificar usuarios',
            'slug' => 'usuarios_update',
            'description' => 'Capacidad de Modificar los usuarios'
        ]);
        Permission::create([
            'name' => 'Crear usuarios',
            'slug' => 'usuarios_show',
            'description' => 'Capacidad de Crear los usuarios'
        ]);
        Permission::create([
            'name' => 'Eliminar usuarios',
            'slug' => 'usuarios_destroy',
            'description' => 'Capacidad de Eliminar los usuarios'
        ]);
        Permission::create([
            'name' => 'Editar usuarios',
            'slug' => 'usuarios_edit',
            'description' => 'Capacidad de Editar los usuarios'
        ]);
        Permission::create([
            'name' => 'Validar usuarios',
            'slug' => 'usuarios_validate',
            'description' => 'Capacidad de Validar los usuarios dentro del sistema'
        ]);
        Permission::create([
            'name' => 'Listar roles',
            'slug' => 'roles_index',
            'description' => 'Capacidad de Listar los roles'
        ]);
        Permission::create([
            'name' => 'Crear roles',
            'slug' => 'roles_create',
            'description' => 'Capacidad de Crear los roles'
        ]);
        Permission::create([
            'name' => 'Modificar roles',
            'slug' => 'roles_update',
            'description' => 'Capacidad de Modificar los roles'
        ]);
        Permission::create([
            'name' => 'Crear roles',
            'slug' => 'roles_show',
            'description' => 'Capacidad de Crear los roles'
        ]);
        Permission::create([
            'name' => 'Eliminar roles',
            'slug' => 'roles_destroy',
            'description' => 'Capacidad de Eliminar los roles'
        ]);
        Permission::create([
            'name' => 'Editar roles',
            'slug' => 'roles_edit',
            'description' => 'Capacidad de Editar los roles'
        ]);
        Permission::create([
            'name' => 'Listar Permisos',
            'slug' => 'permisos_index',
            'description' => 'Capacidad de Listar los Permisos'
        ]);
        Permission::create([
            'name' => 'Crear Permisos',
            'slug' => 'permisos_create',
            'description' => 'Capacidad de Crear los Permisos'
        ]);
        Permission::create([
            'name' => 'Modificar Permisos',
            'slug' => 'permisos_update',
            'description' => 'Capacidad de Modificar los Permisos'
        ]);
        Permission::create([
            'name' => 'Crear Permisos',
            'slug' => 'permisos_show',
            'description' => 'Capacidad de Crear los Permisos'
        ]);
        Permission::create([
            'name' => 'Eliminar Permisos',
            'slug' => 'permisos_destroy',
            'description' => 'Capacidad de Eliminar los Permisos'
        ]);
        Permission::create([
            'name' => 'Editar Permisos',
            'slug' => 'permisos_edit',
            'description' => 'Capacidad de Editar los Permisos'
        ]);
        Permission::create([
            'name' => 'Usuario sin Validacion',
            'slug' => 'sin_validacion',
            'description' => 'Unicamente un usuario sin validacion puede realizar estas acciones'
        ]);
        Permission::create([
            'name' => 'Validar Usuario',
            'slug' => 'usuarios_validate',
            'description' => 'Se encarga de la validacion de los usuarios dentro del sistema'
        ]);
        Permission::create([
            'name' => 'Documentacion',
            'slug' => 'usuarios_documentacion',
            'description' => 'Permiso para enviar la documentacion de los usuarios'
        ]);
        Permission::create([
            'name' => 'Ver Pagos Pendientes',
            'slug' => 'usuarios_pagos',
            'description' => 'Permiso para ver y pagar los pedidos'
        ]);
        Permission::create([
            'name' => 'Ver Mis Pedidos',
            'slug' => 'usuarios_mispedidos',
            'description' => 'Permiso para ver Mis Pedidos'
        ]);
        Permission::create([
            'name' => 'Solicitudes de Empleados',
            'slug' => 'empleado_solicitudes',
            'description' => 'Permiso para solicitudes de empleados'
        ]);
        Permission::create([
            'name' => 'Gestion de Pedidos',
            'slug' => 'empleado_gestionpedidos',
            'description' => 'Permiso para toda la gestion de pedidos'
        ]);
        Permission::create([
            'name' => 'Gestion de Workflow',
            'slug' => 'empleado_gestionworkflow',
            'description' => 'Permiso gestion de los flujos de trabajo'
        ]);
        Permission::create([
            'name' => 'Gestion de Inventario',
            'slug' => 'empleado_gestionInventario',
            'description' => 'Permiso gestion del inventario'
        ]);
        Permission::create([
            'name' => 'Auditor',
            'slug' => 'auditor',
            'description' => 'Permisos de Auditor'
        ]);
        Permission::create([
            'name' => 'Pedidos Iniciados del Sistema',
            'slug' => 'empleado_pedidosIniciados',
            'description' => 'Permisos para ver los pedidos iniciados'
        ]);
        Permission::create([
            'name' => 'Pedidos en Revision del Sistema',
            'slug' => 'empleado_pedidosRevision',
            'description' => 'Permisos para ver los pedidos en revision'
        ]);
        Permission::create([
            'name' => 'Nuevo Pedido',
            'slug' => 'usuario_pedido',
            'description' => 'Permiso para realizar pedidos en el sistema'
        ]);

    }
}
