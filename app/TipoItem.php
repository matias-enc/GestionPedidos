<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoItem extends Model
{
    public function flujoTrabajo()
    {
        return $this->belongsTo(FlujoTrabajo::class, 'flujoTrabajo_id');
    }
    public function items()
    {
        return $this->hasMany(Item::class, 'tipoItems_id');

    }
}
