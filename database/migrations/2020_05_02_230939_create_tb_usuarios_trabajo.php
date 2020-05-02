<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUsuariosTrabajo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuarios_trabajo', function (Blueprint $table) {
            $table->bigIncrements('ut_id')->unique();
            $table->Integer('ut_usu_id')->unsigned();
            $table->foreign('ut_usu_id')->references('id')->on('users');
            $table->Integer('ut_tra_codigo')->unsigned();
            $table->foreign('ut_tra_codigo')->references('tra_codigo')->on('trabajos');
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
        Schema::dropIfExists('usuarios_trabajo');
    }
}
