<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
use Carbon\Carbon;
use Cardumen\ArgentinaProvinciasLocalidades\Models\Pais;
use Cardumen\ArgentinaProvinciasLocalidades\Models\Provincia;
use Cardumen\ArgentinaProvinciasLocalidades\Models\Localidad;

class User extends Authenticatable
{
    use Notifiable;
    use HasRolesAndPermissions;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'user_id');
    }

    public function pais()
    {
        return $this->belongsTo(Pais::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class);
    }
    public function localidad()
    {
        return $this->belongsTo(Localidad::class);
    }
    public function historiales()
    {
        return $this->hasMany(Historial::class, 'user_id');
    }


    public function validacion()
    {
        return $this->hasOne(Validacion::class, 'user_id');
    }
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getReputacion()
    {

        $pedidos = $this->pedidos;
        $reputaciones = collect();
        if (sizeof($pedidos) > 0) {
            foreach ($pedidos as $pedido) {
                if ($pedido->reputacion != null) {
                    $reputaciones->push($pedido->reputacion);
                }
            }
        }
        return $reputaciones->sortByDesc('created_at')->first();
    }
    public function getCalificacion()
    {
        $reputacion = $this->getReputacion();
        if ($reputacion == null) {
            return Calificacion::where('nombre', 'Buena')->firstOrFail();
        }
        return $this->getReputacion()->calificacion;
    }

    public function getPenalizacion()
    {
        if ($this->getReputacion() != null) {
            $reputacion = $this->getReputacion();
            $calificacion = $reputacion->calificacion;
            $fechaExpiracion = $reputacion->created_at->addDays($calificacion->penalizacion);
            if ($fechaExpiracion->lessThanOrEqualTo(Carbon::now())) {
                return 0;
            } else {
                return $fechaExpiracion->diffInDays(Carbon::now());
            }
        } else {
            return 0;
        }
    }
}
