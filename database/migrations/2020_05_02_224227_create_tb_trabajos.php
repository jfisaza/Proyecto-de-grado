<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTrabajos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajos', function (Blueprint $table) {
            $table->bigIncrements('tra_id')->unique();
            $table->string('tra_titulo');
            $table->integer('tra_fac_id')->unsigned();
            $table->foreign('tra_fac_id')->references('fac_id')->on('facultades');
            $table->integer('tra_prop_id')->unsigned();
            $table->foreign('tra_prop_id')->references('prop_id')->on('propuesta');
            $table->integer('tra_des_id')->unsigned();
            $table->foreign('tra_des_id')->references('des_id')->on('desarrollo');
            $table->integer('tra_dir_usu_id')->unsigned();
            $table->foreign('tra_dir_usu_id')->references('id')->on('users');
            $table->integer('tra_codir_usu_id')->nullable()->unsigned();
            $table->foreign('tra_codir_usu_id')->references('id')->on('users');
            $table->integer('tra_mod_id')->unsigned();
            $table->foreign('tra_mod_id')->references('mod_id')->on('modalidades');  
            $table->timestamp('tra_citacion')->nullable();
            $table->integer('tra_emp_id')->nullable()->unsigned();
            $table->foreign('tra_emp_id')->references('emp_id')->on('empresa');

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
        Schema::dropIfExists('trabajos');
    }
}