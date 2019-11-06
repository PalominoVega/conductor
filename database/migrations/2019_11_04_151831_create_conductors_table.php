<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConductorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conductor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('foto', 20)->nullable();           
            $table->string('dni',8);
            $table->string('nombre','50');
            $table->string('apellido','50');
            $table->string("tipo_sangre",4);
            $table->string('celular','22')->nullable();
            $table->string('direccion','100')->nullable();
            $table->string('categoria_licencia','10')->nullable();
            $table->date('fecha_licencia')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->enum('estado',['0','1']);
            $table->unsignedInteger('vehiculo_id')->nullable();
            $table->unsignedInteger('empresa_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conductor');
    }
}
