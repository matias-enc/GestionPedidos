<?php

namespace App\Console\Commands;

use App\Pedido;
use App\Estado;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Events\PedidoIniciado;

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
        foreach ($pedidos as $pedido) {
            $fechaInicial = $pedido->getFechaInicial();
            if ($pedido->getFechaInicial()->lessThanOrEqualTo(Carbon::now())) {
                $pedido->estado_id = $pedido->flujoTrabajo->estado_siguiente($pedido->estado)->id;
                $pedido->save();
                event(new PedidoIniciado('Hay un nuevo Pedido Iniciado'));
                \Log::info('Pedido'. $pedido->id. ' ha sido iniciado');
            }

        }

        // $this->info('Funcionando correctamente!');
    }
}
