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
            'nombre' => 'Carrito'
        ]);
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
        Estado::create([
            'nombre' => 'Solicitado'
        ]);
        Estado::create([
            'nombre' => 'Espera de Pago'
        ]);
        Estado::create([
            'nombre' => 'Pagado'
        ]);
        Estado::create([
            'nombre' => 'Pago Rechazado'
        ]);
        Estado::create([
            'nombre' => 'Revision'
        ]);
        Estado::create([
            'nombre' => 'Entregado'
        ]);
        Estado::create([
            'nombre' => 'Devuelto'
        ]);
        Estado::create([
            'nombre' => 'Terminado'
        ]);
        Estado::create([
            'nombre' => 'Pendiente'
        ]);
    }

}
