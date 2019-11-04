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
}
