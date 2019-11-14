<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre',30)->nullable();
            $table->string('apellido',50)->nullable();
            $table->string('dni',8)->nullable();
            $table->string('email',100);
            $table->string('numero',12)->nullable();
            $table->string('direccion',100)->nullable();
            $table->string('password',100);
            $table->string('api_token',25);
            $table->enum('estado',["0","1","2"]);//0:activo , 1:inactivo, 2:Cuenta Principal             
            $table->unsignedInteger('empresa_id');
        });

        DB::table('user')->insert([
            [
                'id'=>1,
                'nombre'=>'Diego',
                'apellido'=>'Mendoza',
                'email'=>'palo@gmail.com',
                'dni'=>'12345678',
                'numero'=>'12345678',
                'password'=>bcrypt('123456'),
                'api_token'=>'qwerty',
                'estado'=>'0',
                'empresa_id'=>1
            ]
        ]); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
}
