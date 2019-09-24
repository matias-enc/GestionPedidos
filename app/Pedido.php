<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
