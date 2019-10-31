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

    }
}
