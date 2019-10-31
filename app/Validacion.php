<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validacion extends Model
{
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function documentaciones()
    {
        return $this->hasMany(User::class, 'validacion_id');
    }
}
