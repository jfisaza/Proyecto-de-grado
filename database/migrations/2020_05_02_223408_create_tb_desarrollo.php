<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDesarrollo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desarrollo', function (Blueprint $table) {
            $table->integer('des_id')->unique();
            $table->string('des_titulo');
            $table->integer('des_dir_usu_id')->unsigned();
            $table->foreign('des_dir_usu_id')->references('id')->on('users');
            $table->integer('des_codir_usu_id')->nullable()->unsigned();
            $table->foreign('des_codir_usu_id')->references('id')->on('users');
            $table->integer('des_mod_id')->unsigned();
            $table->foreign('des_mod_id')->references('mod_id')->on('modalidades');
            $table->integer('des_con_id')->unsigned()->nullable();
            $table->foreign('des_con_id')->references('con_id')->on('conceptos');
            $table->integer('des_prop_id')->unsigned();
            $table->foreign('des_prop_id')->references('prop_id')->on('propuesta');
            $table->string('des_formato')->nullable();
            $table->date('des_fecha_entrega')->nullable();
            $table->date('des_fecha_calificacion')->nullable();
            $table->timestamp('des_citacion')->nullable();

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
        Schema::dropIfExists('desarrollo');
    }
}
