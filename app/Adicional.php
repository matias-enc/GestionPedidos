<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adicional extends Model
{
    protected $table="adicionales";
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function historiales(){
        return $this->hasMany(HistorialAdicional::class);
    }
    public function seguimiento()
    {
        return $this->belongsTo(Seguimiento::class);
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }

    public function getCalculoPrecio(){
        return $this->item->precioUnitario*$this->cantidad;
    }
}
