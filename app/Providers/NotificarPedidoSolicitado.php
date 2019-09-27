<?php

namespace App\Providers;

use App\Events\PedidoSolicitado;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificarPedidoSolicitado
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PedidoSolicitado  $event
     * @return void
     */
    public function handle(PedidoSolicitado $event)
    {

    }
}
