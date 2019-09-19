<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $guarded = [];

    public function seguimientos(){
        return $this->hasMany(Seguimiento::class);
    }
    public function tipoItem()
    {
        return $this->belongsTo(TipoItem::class, 'tipoItems_id');
    }
}
