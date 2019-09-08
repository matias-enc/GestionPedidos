<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transicion extends Model
{
    protected $fillable = [
        'nombre', 'flujoTrabajo', 'estadoInicial', 'estadoFinal',
    ];
    public function flujoTrabajo()
    {
        return $this->belongsTo(FlujoTrabajo::class, 'flujoTrabajo_id');
    }

    public function estadoInicial()
    {
        return $this->belongsTo(Estado::class, 'estadoInicial_id');
    }
    public function estadoFinal()
    {
        return $this->belongsTo(Estado::class, 'estadoFinal_id');
    }

    // public function asignarEstadoInicial(Estado $estado){
    //     $this->estadoInicial = $estado->id;
    //     return true;
    // }
    // public function asignarEstadoFinal(Estado $estado){
    //     // $transiciones = Transicion::all();
    //     // foreach ($transiciones as $transicion) {
    //     //     if ($transicion->estadoInicial==$this->estadoInicial && $transicion->estadoFinal==$estado->id) {
    //     //         return 'ya existe una transicion con dichos estados';
    //     //     }
    //     // }
    //     if ($this->estadoInicial!=$estado->id) {
    //         $this->estadoFinal = $estado->id;
    //         return true;
    //     }
    //     return false;
    // }
}
