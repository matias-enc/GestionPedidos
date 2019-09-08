<?php

use App\Estado;
use Illuminate\Database\Seeder;

class EstadosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Estado::create([
            'nombre' => 'Iniciado'
        ]);
        Estado::create([
            'nombre' => 'Revisado'
        ]);
        Estado::create([
            'nombre' => 'Aprobado'
        ]);
        Estado::create([
            'nombre' => 'Finalizado'
        ]);
    }

}
