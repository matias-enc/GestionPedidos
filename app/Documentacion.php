<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documentacion extends Model
{
    public $table = "documentaciones";

    public function validacion()
    {
        return $this->belongsTo(Validacion::class, 'validacion_id');
    }
}
