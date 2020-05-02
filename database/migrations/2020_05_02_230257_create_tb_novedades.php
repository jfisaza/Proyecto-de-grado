<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbNovedades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('novedades', function (Blueprint $table) {
            $table->bigIncrements('nov_id')->unique();
            $table->Integer('nov_tra_codigo')->unsigned();
            $table->foreign('nov_tra_codigo')->references('tra_codigo')->on('trabajos');
            $table->string('nov_descripcion');
            $table->date('nov_fecha');
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
        Schema::dropIfExists('novedades');
    }
}
