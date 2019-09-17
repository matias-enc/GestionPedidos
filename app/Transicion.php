<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transicion extends Model
{
    protected $fillable = [
        'nombre', 'flujoTrabajo_id', 'estadoInicial_id', 'estadoFinal_id',
    ];
    public function flujoTrabajo()
    {
        return $this->belongsTo(FlujoTrabajo::class, 'flujoTrabajo_id');
    }

    public function estadoInicial()
    {
        return $this->belongsTo(Estado::class, 'estadoInicial_id');
    }
    public function estadoFinal()
    {
        return $this->belongsTo(Estado::class, 'estadoFinal_id');
    }

}
