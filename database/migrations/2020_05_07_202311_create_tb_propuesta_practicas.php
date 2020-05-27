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
            $table->bigIncrements('pp_id')->unique();
            $table->string('pp_titulo');
            $table->integer('pp_usu_id')->unsigned();
            $table->foreign('pp_usu_id')->references('id')->on('users');
            $table->integer('pp_emp_id')->unsigned();
            $table->foreign('pp_emp_id')->references('emp_id')->on('empresa');
            $table->string('pp_numconvenio',30);
            $table->date('pp_fechaconvenio');
            $table->integer('pp_dir_usu_id')->unsigned();
            $table->foreign('pp_dir_usu_id')->references('id')->on('users');
            $table->integer('pp_pro_id')->unsigned();
            $table->foreign('pp_pro_id')->references('pro_id')->on('programas');
            $table->integer('pp_con_id')->unsigned()->nullable();
            $table->foreign('pp_con_id')->references('con_id')->on('conceptos');
            $table->string('pp_formato')->nullable();
            $table->date('pp_fecha_entrega')->nullable();
            $table->date('pp_fecha_calificacion')->nullable();

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
