<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

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
    public function historiales(){
        return $this->hasMany(HistorialSeguimiento::class);
    }

    public function getFechaLlegada(){
        $fecha = Carbon::create($this->fechaInicial);
        return $fecha;
    }

    public function getFechaLlegadaDoc(){
        $fecha = Date::create($this->fechaInicial)->format('l d F Y H:i A');
        return $fecha;
    }

    public function getFechaSalida(){
        $fecha = Carbon::create($this->fechaFinal);
        return $fecha;
    }
    public function getFechaSalidaDoc(){
        $fecha = Date::create($this->fechaFinal)->format('l d F Y H:i A');
        return $fecha;
    }

    public function getCalculoPrecio(){
        if ($this->item->tipoItem->calculo == true) {
            //calculo en horas
            $horas = $this->getFechaLlegada()->diffInMinutes($this->getFechaSalida())/60;
            $horas = ceil($horas);
            return $this->item->precioUnitario * $horas;
        }else{
            $dias = $this->getFechaLlegada()->diffInHours($this->getFechaSalida())/24;
            $dias = ceil($dias);
            return $this->item->precioUnitario * $dias;
        }
    }

    public function getCalculoAdicionales(){
        $adicionales = $this->adicionales;
        $resultado = 0;
        if(sizeof($adicionales)>0){
            foreach ($adicionales as $adicional) {
                $resultado += $adicional->item->precioUnitario * $adicional->cantidad;
            }
        }
        return $resultado;
    }

}
