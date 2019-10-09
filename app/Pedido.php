<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Pedido extends Model
{
    public function flujoTrabajo()
    {
        return $this->belongsTo(FlujoTrabajo::class, 'flujoTrabajo_id');
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function historiales(){
        return $this->hasMany(Historial::class);
    }
    public function seguimientos(){
        return $this->hasMany(Seguimiento::class);
    }

    public function getFechaSolicitud(){
        return $this->created_at;

    }

    public function getFechaInicial(){
        $fechaInicial = Carbon::createFromFormat('d/m/Y', '1/1/2050');
        foreach ($this->seguimientos as $seguimiento) {
            if($seguimiento->getFechaLlegada()->lessThan($fechaInicial)){
                $fechaInicial = $seguimiento->getFechaLlegada();
            }
        }
        return $fechaInicial;
    }
    public function getFechaInicialAttribute(){
        $fechaInicial = Carbon::createFromFormat('d/m/Y', '1/1/2050');
        foreach ($this->seguimientos as $seguimiento) {
            if($seguimiento->getFechaLlegada()->lessThan($fechaInicial)){
                $fechaInicial = $seguimiento->getFechaLlegada();
            }
        }
        return $fechaInicial;
    }
    public function getFechaFinal(){
        $fechaFinal = Carbon::createFromFormat('d/m/Y', '1/1/2010');
        foreach ($this->seguimientos as $seguimiento) {
            // $fechaSeguimiento = Carbon::createFromFormat()
            if($seguimiento->getFechaSalida()->greaterThan($fechaFinal)){
                $fechaFinal = $seguimiento->getFechaSalida();
            }
        }
        return $fechaFinal;
    }

}
