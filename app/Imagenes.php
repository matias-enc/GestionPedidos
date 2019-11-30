<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagenes extends Model
{
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
