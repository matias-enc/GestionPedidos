<?php

use App\FlujoTrabajo;
use Illuminate\Database\Seeder;

class FlujoTrabajosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FlujoTrabajo::create([
            'nombre' => 'Pedidos'
        ]);
        FlujoTrabajo::create([
            'nombre' => 'Albergues'
        ]);
        FlujoTrabajo::create([
            'nombre' => 'Complejos'
        ]);
        FlujoTrabajo::create([
            'nombre' => 'Salon de Eventos'
        ]);
        FlujoTrabajo::create([
            'nombre' => 'Secundarios'
        ]);

    }
}
