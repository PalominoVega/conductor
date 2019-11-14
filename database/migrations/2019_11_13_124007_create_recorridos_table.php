<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecorridosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recorrido', function (Blueprint $table) {
            $table->increments('id');
            $table->double('recorrido')->default('0');
            $table->double('recorrido_aux')->default('0');
            $table->enum('estado',["0","1"])->default('0'); // 0: sin cambio , 1: acepto que cambio aceite
            $table->enum('bandera',["0","1"])->default('0'); //0 no enviado notificacion push  1: enviado
            $table->unsignedInteger('vehiculo_id'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recorrido');
    }
}
