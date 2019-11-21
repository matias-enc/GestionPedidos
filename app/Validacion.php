<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validacion extends Model
{
    public $table = "validaciones";

    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function documentaciones()
    {
        return $this->hasMany(Documentacion::class, 'validacion_id');
    }
}
