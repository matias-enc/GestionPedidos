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
}
