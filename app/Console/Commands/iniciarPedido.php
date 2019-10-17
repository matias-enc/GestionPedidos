<?php

namespace App\Console\Commands;

use App\Pedido;
use App\Estado;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Events\PedidoIniciado;
use App\Events\PedidoRevision;
use App\Historial;
use App\HistorialSeguimiento;
use App\HistorialAdicional;

class iniciarPedido extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'iniciar:pedido';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $estado = Estado::where('nombre', 'Aprobado')->firstOrFail();
        $pedidos = Pedido::all()->where('estado_id', $estado->id);
        //INICIAR UN PEDIDO
        if (sizeof($pedidos) > 0) {
            foreach ($pedidos as $pedido) {
                $fechaInicial = $pedido->getFechaInicial();
                if ($pedido->getFechaInicial()->lessThanOrEqualTo(Carbon::now())) {
                    $pedido->estado_id = $pedido->flujoTrabajo->estado_siguiente($pedido->estado)->id;
                    $pedido->save();
                    $historial = Historial::create();
                    $historial->pedido_id = $pedido->id;
                    $historial->estado_id = $pedido->estado_id;
                    $historial->save();
                    event(new PedidoIniciado('Hay un nuevo Pedido Iniciado'));
                }

                foreach ($pedido->seguimientos as $seguimiento) {
                    if ($seguimiento->getFechaLlegada()->lessThanOrEqualTo(Carbon::now())) {
                        $seguimiento->estado_id = $seguimiento->item->tipoItem->flujoTrabajo->estado_inicial()->id;
                        $seguimiento->save();
                        $historial = HistorialSeguimiento::create();
                        $historial->estado_id = $seguimiento->estado_id;
                        $historial->seguimiento_id = $seguimiento->id;
                        $historial->item_id = $seguimiento->item->id;
                        $historial->save();

                        if (sizeof($seguimiento->adicionales) > 0) {
                            foreach ($seguimiento->adicionales as $adicional) {
                                $adicional->estado_id = $adicional->item->tipoItem->flujoTrabajo->estado_inicial()->id;
                                $adicional->save();
                                $historialAd = HistorialAdicional::create();
                                $historialAd->estado_id = $adicional->estado_id;
                                $historialAd->adicional_id = $adicional->id;
                                $historialAd->item_id = $adicional->item->id;
                                $historialAd->save();
                            }
                        }
                    }
                }
            }
        }
        //INICIAR SEGUIMIENTOS DE UN PEDIDO YA INICIADO
        $estado = Estado::where('nombre', 'Iniciado')->firstOrFail();
        $pedidos = Pedido::all()->where('estado_id', $estado->id);
        $terminado = false;
        if (sizeof($pedidos) > 0) {
            foreach ($pedidos as  $pedido) {
                foreach ($pedido->seguimientos as $seguimiento) {
                    if ($seguimiento->getFechaLlegada()->lessThanOrEqualTo(Carbon::now()) && $seguimiento->estado_id == null) {
                        $terminado = false;
                        $seguimiento->estado_id = $seguimiento->item->tipoItem->flujoTrabajo->estado_inicial()->id;
                        $seguimiento->save();
                        $historial = HistorialSeguimiento::create();
                        $historial->estado_id = $seguimiento->estado_id;
                        $historial->seguimiento_id = $seguimiento->id;
                        $historial->item_id = $seguimiento->item->id;
                        $historial->save();

                        if (sizeof($seguimiento->adicionales) > 0) {

                            foreach ($seguimiento->adicionales as $adicional) {
                                $adicional->estado_id = $adicional->item->tipoItem->flujoTrabajo->estado_inicial()->id;
                                $adicional->save();
                                $historialAd = HistorialAdicional::create();
                                $historialAd->estado_id = $adicional->estado_id;
                                $historialAd->adicional_id = $adicional->id;
                                $historialAd->item_id = $adicional->item->id;
                                $historialAd->save();
                            }
                        }
                    }
                    if ($seguimiento->estado->nombre == 'Terminado') {
                        foreach ($seguimiento->adicionales as $adicional)
                            if ($adicional->estado->nombre == 'Terminado') {
                                $terminado = true;
                            } else {
                                $terminado = false;
                            }
                    }
                }


            }
            //FINALIZACION DE UN PEDIDO TERMINADO COMPLETAMENTE
            if ($terminado == true) {
                $pedido->estado_id = $pedido->flujoTrabajo->estado_siguiente($pedido->estado)->id;
                $pedido->save();
                $historial = Historial::create();
                $historial->pedido_id = $pedido->id;
                $historial->estado_id = $pedido->estado_id;
                $historial->save();
                event(new PedidoRevision('Hay un nuevo Pedido en Revision'));
            }
        }
    }
}
