<?php

use App\Transicion;
use Illuminate\Database\Seeder;

class TransicionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transicion::create([
            'nombre' => 'Generar Pedido',
            'flujoTrabajo_id' => 1,
            'estadoInicial_id' => 1,
            'estadoFinal_id' => 14,
        ]);
        Transicion::create([
            'nombre' => 'Solicitar Pedido',
            'flujoTrabajo_id' => 1,
            'estadoInicial_id' => 14,
            'estadoFinal_id' => 6,
        ]);
        Transicion::create([
            'nombre' => 'Esperar Pago',
            'flujoTrabajo_id' => 1,
            'estadoInicial_id' => 6,
            'estadoFinal_id' => 7,
        ]);
        Transicion::create([
            'nombre' => 'Aprobar pedido',
            'flujoTrabajo_id' => 1,
            'estadoInicial_id' => 6,
            'estadoFinal_id' => 4,
        ]);
        Transicion::create([
            'nombre' => 'Iniciar',
            'flujoTrabajo_id' => 1,
            'estadoInicial_id' => 4,
            'estadoFinal_id' => 2,
        ]);
        Transicion::create([
            'nombre' => 'Pagar Pedido',
            'flujoTrabajo_id' => 1,
            'estadoInicial_id' => 7,
            'estadoFinal_id' => 8,
        ]);
        Transicion::create([
            'nombre' => 'Periodo de Revision',
            'flujoTrabajo_id' => 1,
            'estadoInicial_id' => 2,
            'estadoFinal_id' => 10,
        ]);
        Transicion::create([
            'nombre' => 'Terminar Revision',
            'flujoTrabajo_id' => 1,
            'estadoInicial_id' => 10,
            'estadoFinal_id' => 3,
        ]);
        Transicion::create([
            'nombre' => 'Pedido Finalizado Correctamente',
            'flujoTrabajo_id' => 1,
            'estadoInicial_id' => 3,
            'estadoFinal_id' => 5,
        ]);


        //WORKFLOW COMPLEJOS
        Transicion::create([
            'nombre' => 'Entrega de Complejo a Usuario Solicitante',
            'flujoTrabajo_id' => 3,
            'estadoInicial_id' => 2,
            'estadoFinal_id' => 11,
        ]);
        Transicion::create([
            'nombre' => 'En espera por devolucion de Complejo',
            'flujoTrabajo_id' => 3,
            'estadoInicial_id' => 11,
            'estadoFinal_id' => 13,
        ]);

        //WORKFLOW Albergues
        Transicion::create([
            'nombre' => 'Entrega de Habitacion a Usuario Solicitante',
            'flujoTrabajo_id' => 2,
            'estadoInicial_id' => 2,
            'estadoFinal_id' => 11,
        ]);
        Transicion::create([
            'nombre' => 'En espera por devolucion de Habitacion',
            'flujoTrabajo_id' => 2,
            'estadoInicial_id' => 11,
            'estadoFinal_id' => 13,
        ]);
        //WORKFLOW Salon de Eventos
        Transicion::create([
            'nombre' => 'Entrega de Salon a Usuario Solicitante',
            'flujoTrabajo_id' => 4,
            'estadoInicial_id' => 2,
            'estadoFinal_id' => 11,
        ]);
        Transicion::create([
            'nombre' => 'En espera por devolucion del Salon',
            'flujoTrabajo_id' => 4,
            'estadoInicial_id' => 11,
            'estadoFinal_id' => 13,
        ]);

        //WORKFLOW SECUNDARIOS
        Transicion::create([
            'nombre' => 'Entrega del Adicional Solicitado',
            'flujoTrabajo_id' => 5,
            'estadoInicial_id' => 2,
            'estadoFinal_id' => 11,
        ]);
        Transicion::create([
            'nombre' => 'Devolución del Adicional Solicitado',
            'flujoTrabajo_id' => 5,
            'estadoInicial_id' => 11,
            'estadoFinal_id' => 13,
        ]);
    }
}
