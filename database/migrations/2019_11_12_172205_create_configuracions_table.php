<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfiguracionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuracion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('a',20)->nullable();
            $table->string('u',20)->nullable();
            $table->string('p',20)->nullable();
            $table->string('g',50)->default('all');
            $table->unsignedInteger('empresa_id');            
        });

        DB::table('configuracion')->insert([
            'a'=>'vespro2',
            'p'=>'123456',
            'u'=>'prueba',
            'g'=>'all',
            'empresa_id'=>1,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuracion');
    }
}
