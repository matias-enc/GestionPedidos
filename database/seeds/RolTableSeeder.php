<?php

use Caffeinated\Shinobi\Models\Role;
use Illuminate\Database\Seeder;


class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'special' => 'all-access',
            'description' => 'Administrador del sistema'
        ]);
        $empleado = Role::create([
            'name' => 'Empleado',
            'slug' => 'empleado',
            'description' => 'Empleado del sistema'
        ]);
        $empleado->permissions()->sync([26,27,29,31,28,32,33,1,2,3,4,5,6,20]);
        $usuario = Role::create([
            'name' => 'Usuario',
            'slug' => 'usuario',
            'description' => 'Usuario que utiliza el sistema'
        ]);
        $usuario->permissions()->sync([23,24,25,34]);
        $sin_val = Role::create([
            'name' => 'Sin Validacionn',
            'slug' => 'sin_validacion',
            'description' => 'Usuario que no esta validado dentro del Sistema'
        ]);
        $sin_val->permissions()->sync([19]);
        $auditor = Role::create([
            'name' => 'Auditor del Sistema',
            'slug' => 'auditor',
            'description' => 'Usuario con el rol de Auditor dentro del Sistema'
        ]);
        $auditor->permissions()->sync([30]);
    }
}
