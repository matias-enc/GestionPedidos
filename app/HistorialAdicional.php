<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistorialAdicional extends Model
{
    public $table = "historial_adicionales";
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function adicional()
    {
        return $this->belongsTo(Adicional::class);
    }
}
