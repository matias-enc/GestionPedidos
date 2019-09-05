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
            'description' => 'Administrador del sistema'
        ]);
        Role::create([
            'name' => 'Empleado',
            'slug' => 'empleado',
            'description' => 'Empleado del sistema'
        ]);
        Role::create([
            'name' => 'Usuario',
            'slug' => 'usuario',
            'description' => 'Usuario que utiliza el sistema'
        ]);
    }
}
