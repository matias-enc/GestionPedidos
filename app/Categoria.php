<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public function tipoItems(){
        return $this->hasMany(TipoItem::class);
    }
}
