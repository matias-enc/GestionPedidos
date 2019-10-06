<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $guarded = [];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function adicionales(){
        return $this->hasMany(Adicional::class);
    }

    public function getFechaLlegada(){
        $fecha = Carbon::create($this->fechaInicial);
        return $fecha;
    }
    public function getFechaSalida(){
        $fecha = Carbon::create($this->fechaFinal);
        return $fecha;
//         ->format('d/m/Y')
// ->format('d/m/Y')
    }
}
