<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiculosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unidad','10');
            $table->string('placa','10')->nullable();
            $table->string('marca','20')->nullable();
            $table->string('modelo','20')->nullable();
            $table->string('color','30')->nullable();
            $table->string('anio','4')->nullable();

            /**
             * documentacion 
             */
            $table->string('empresa_soat','20')->nullable(); 
            $table->date('fecha_soat')->nullable();
            $table->string('empresa_tecnica', 20)->nullable()->after('fecha_licencia');           
            $table->date('fecha_tecnica')->nullable()->after('fecha_licencia'); 
            $table->enum('estado',['0','1']);
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
        Schema::dropIfExists('vehiculo');
    }
}
