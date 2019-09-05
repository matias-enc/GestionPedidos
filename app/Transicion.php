<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transicion extends Model
{
    public function flujoTrabajo()
    {
        return $this->belongsTo(FlujoTrabajo::class);
    }

    public function estadoInicial()
    {
        return $this->hasMany(Estado::class);
    }
    public function estadoFinal()
    {
        return $this->hasMany(Estado::class);
    }
}
