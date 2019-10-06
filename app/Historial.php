<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Historial extends Model
{
    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
    public function estado()
    {
        return $this->belongsTo(Estado::class);
    }
    public function getCreado()
    {
        return $this->created_at;
    }
}
