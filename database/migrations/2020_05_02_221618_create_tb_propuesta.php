<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPropuesta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propuesta', function (Blueprint $table) {
            $table->bigIncrements('prop_id')->unique();
            $table->string('prop_titulo');
            $table->integer('prop_dir_usu_id')->unsigned();
            $table->foreign('prop_dir_usu_id')->references('id')->on('users');
            $table->integer('prop_codir_usu_id')->nullable()->unsigned();
            $table->foreign('prop_codir_usu_id')->references('id')->on('users');
            $table->integer('prop_mod_id')->unsigned();
            $table->foreign('prop_mod_id')->references('mod_id')->on('modalidades');
            $table->integer('prop_pro_id')->unsigned();
            $table->foreign('prop_pro_id')->references('pro_id')->on('programas');  
            $table->integer('prop_con_id')->unsigned()->nullable();
            $table->foreign('prop_con_id')->references('con_id')->on('conceptos');
            $table->string('prop_formato')->nullable();
            $table->date('prop_fecha_entrega')->nullable();
            $table->date('prop_fecha_calificacion')->nullable();
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
        Schema::dropIfExists('propuesta');
    }
}
