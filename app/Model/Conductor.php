<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    protected $table="conductor";
    public $timestamps = false;

    public function vehiculo()
    {
        return $this->belongsTo('App\Model\Vehiculo');
    }
    
    public function empresa()
    {
        return $this->belongsTo('App\Model\Empresa');
    }
}
