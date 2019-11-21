<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reputacion extends Model
{
    public $table = "reputaciones";

    public function pedido(){
        return $this->belongsTo(Pedido::class);
    }
    public function calificacion(){
        return $this->belongsTo(Calificacion::class);
    }
}
