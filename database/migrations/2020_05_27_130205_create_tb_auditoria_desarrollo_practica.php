<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAuditoriaDesarrolloPractica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoria_desarrollo_practica', function (Blueprint $table) {
            $table->integer('adp_id')->unique();
            $table->string('adp_titulo');
            $table->integer('adp_usu_id')->unsigned();
            $table->foreign('adp_usu_id')->references('id')->on('users');
            $table->integer('adp_emp_id')->unsigned();
            $table->foreign('adp_emp_id')->references('emp_id')->on('empresa');
            $table->integer('adp_dir_usu_id')->unsigned();
            $table->foreign('adp_dir_usu_id')->references('id')->on('users');
            $table->string('adp_numconvenio',30);
            $table->date('adp_fechaconvenio');
            $table->integer('adp_pro_id')->unsigned();
            $table->foreign('adp_pro_id')->references('pro_id')->on('programas');
            $table->integer('adp_app_id');
            $table->foreign('adp_app_id')->references('app_id')->on('auditoria_propuesta_practica');
            $table->integer('adp_con_id')->nullable();
            $table->foreign('adp_con_id')->references('con_id')->on('conceptos');
            $table->string('adp_formato')->nullable();
            $table->date('adp_fecha_entrega')->nullable();
            $table->date('adp_fecha_calificacion')->nullable();
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
        Schema::dropIfExists('auditoria_desarrollo_practica');
    }
}
