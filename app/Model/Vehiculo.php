<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table="vehiculo";
    public $timestamps = false;
    
    public function empresa()
    {
        return $this->belongsTo('App\Model\Empresa');
    }

    public function conductor()
    {
        // return $this->hasMany('App\Costo_fijo');
        return $this->hasMany('App\Model\Conductor');
    }
}
