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
}
