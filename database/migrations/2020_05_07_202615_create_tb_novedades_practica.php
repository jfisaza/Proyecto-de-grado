<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbNovedadesPractica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novedades_practica', function (Blueprint $table) {
            $table->id('np_id');
            $table->integer('np_dp_id')->unsigned();
            $table->foreign('np_dp_id')->references('dp_id')->on('desarrollo_practicas');
            $table->string('np_descripcion');
            $table->date('np_fecha');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('novedades_practica');
    }
}
