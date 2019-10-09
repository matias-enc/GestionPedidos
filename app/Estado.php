<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $guarded = [];

    public function tranInicial()
    {
        return $this->hasMany(Transicion::class, 'estadoInicial_id');
    }
    public function tranFinal()
    {
        return $this->hasMany(Transicion::class, 'estadoFinal_id');
    }
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }
    public function historiales()
    {
        return $this->hasMany(Historial::class);
    }
    public function adicionales()
    {
        return $this->hasMany(Adicional::class);
    }
    public function historiales_seguimientos()
    {
        return $this->hasMany(HistorialSeguimiento::class);
    }
    public function historiales_adicionale()
    {
        return $this->hasMany(HistorialAdicional::class);
    }
}
