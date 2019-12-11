<?php

use App\User;
use App\Validacion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = New User();
        $user->name = 'Matias';
        $user->email = 'matusalemn8@gmail.com';
        $user->apellido = 'Nuñez Crippa';
        $user->password = Hash::make('197132mm');
        $user->direccion = '';
        $user->dni = '40.150.954';
        $user->telefono = '(3758)42-3719';
        $user->celular = '(3758)15-488298';
        $user->pais_id = null;
        $user->provincia_id = null;
        $user->localidad_id = null;
        $user->postal = '3350';
        $user->save();
        $user->assignRoles('auditor', 'empleado');
        $user->save();
        $validacion = new Validacion();
        $validacion->user_id = $user->id;
        $validacion->estado = 'Aprobado';
        $validacion->aprobado = true;
        $validacion->save();
    }
}
