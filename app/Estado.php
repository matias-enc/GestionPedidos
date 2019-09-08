<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    public function tranInicial()
    {
        return $this->hasMany(Transicion::class, 'estadoInicial_id');
    }
    public function tranFinal()
    {
        return $this->hasMany(Transicion::class, 'estadoFinal_id');
    }
}
