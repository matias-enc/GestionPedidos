<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FlujoTrabajo extends Model
{
    public function transiciones()
    {
        return $this->hasMany(Transicion::class);
    }
}
