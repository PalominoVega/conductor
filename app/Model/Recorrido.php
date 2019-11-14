<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Recorrido extends Model
{
    protected $table="recorrido";
    public $timestamps = false;
    
    public function vehiculo()
    {
        return $this->belongsTo('App\Model\Vehiculo');
    }
}
