<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    public $table = "calificaciones";

    public function reputaciones(){
        return $this->hasMany(Reputacion::class);
    }
}
