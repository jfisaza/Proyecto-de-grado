<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPropuestaPracticas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propuesta_practicas', function (Blueprint $table) {
            $table->id('pp_id');
            $table->integer('pp_emp_id');
            $table->foreign('pp_emp_id')->references('emp_id')->on('empresa');
            $table->integer('pp_usu_id');
            $table->foreign('pp_usu_id')->references('id')->on('users');
            $table->integer('pp_dir_usu_id');
            $table->foreign('pp_dir_usu_id')->references('id')->on('users');
            $table->integer('pp_con_id');
            $table->foreign('pp_con_id')->references('con_id')->on('conceptos');
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
        Schema::dropIfExists('propuesta_practicas');
    }
}
