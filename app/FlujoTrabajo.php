<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlujoTrabajo extends Model
{
    protected $guarded = [];


    public function transiciones()
    {
        return $this->hasMany(Transicion::class, 'flujoTrabajo_id');
    }
    public function pedidos(){
        return $this->hasMany(Pedido::class, 'flujoTrabajo_id');

    }
    public function tipoItems(){
        return $this->hasMany(TipoItem::class, 'flujoTrabajo_id');

    }
    public function estado_inicial(){
        $transiciones = $this->transiciones;
        $transicionesFiltadras = $this->transiciones;
        $disponible = true;
        foreach ($transicionesFiltadras as $t1 => $tran1) {
            foreach ($transiciones as $t2 => $tran2) {

                if($tran1->estadoInicial == $tran2->estadoFinal){
                    $disponible = false;
                }
            }
            if($disponible == true){
                return $tran1->estadoInicial;
            }
            $disponible = true;
        }
    }
    public function estado_final(){
        $transiciones = $this->transiciones;
        $transicionesFiltadras = $transiciones;
        $disponible = true;
        foreach ($transicionesFiltadras as $t1 => $tran1) {
            foreach ($transiciones as $t2 => $tran2) {

                if($tran1->estadoFinal == $tran2->estadoInicial){
                    $disponible = false;
                }
            }
            if($disponible == true){
                return $tran1->estadoFinal;
            }
            $disponible = true;
        }
    }
    public function estados_posibles(Estado $estado){
        $transiciones = $this->transiciones;
        $estados = collect();
        foreach ($transiciones as $key => $transicion) {
            if($transicion->estadoInicial == $estado){
                $estados->push($transicion->estadoFinal);
            }
        }
        return $estados;
    }
}
