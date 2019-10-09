<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialAdicional extends Model
{
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
