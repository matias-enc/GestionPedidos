<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;


class Item extends Model implements Auditable
{
    protected $guarded = [];
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public function seguimientos(){
        return $this->hasMany(Seguimiento::class);
    }
    public function tipoItem()
    {
        return $this->belongsTo(TipoItem::class, 'tipoItems_id');
    }
    public function adicionales(){
        return $this->hasMany(Adicional::class);
    }
    public function historial_adicionales(){
        return $this->hasMany(HistorialAdicional::class);
    }
    public function historial_seguimientos(){
        return $this->hasMany(HistorialSeguimiento::class);
    }
    public function imagenes()
    {
        return $this->hasMany(Imagenes::class);
    }


}
