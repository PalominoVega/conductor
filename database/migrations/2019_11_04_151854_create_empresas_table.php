<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre','150');
            $table->string('ruc','11');
            $table->string('direccion', '100')->nullable();
            $table->string('telefono','15')->nullable();
            $table->string('email','100')->nullable();
            $table->string('logo','15')->nullable();
            $table->enum('tipo',['0','1'])->default('0');
        });

        DB::table('empresa')->insert([
            'nombre'=>'Ves Pro',
            'direccion'=>'av. Agusto D. Legia 420',
            'telefono'=>997627162,
            'logo'=>'itemtlU.gif',
            'email'=>'vespro@corporacionvespro.com',
            'tipo'=>'0',
            'codSeguridad'=>'hola',
            'paquete'=>"Estandar",
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresa');
    }
}
