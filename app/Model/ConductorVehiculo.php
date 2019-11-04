<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ConductorVehiculo extends Model
{
    protected $table="conductor_vehiculo";

    public function vehiculo()
    {
        return $this->belongsTo('App\Model\Vehiculo');
    }
}
