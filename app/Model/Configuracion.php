<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table="configuracion";
    public $timestamps = false;

    public function empresa()
    {
        return $this->belongsTo('App\Model\Empresa');
    }
}
