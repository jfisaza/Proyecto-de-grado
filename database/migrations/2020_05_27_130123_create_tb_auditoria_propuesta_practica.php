<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAuditoriaPropuestaPractica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoria_propuesta_practica', function (Blueprint $table) {
            $table->integer('app_id')->unique();
            $table->string('app_titulo');
            $table->integer('app_usu_id');
            $table->foreign('app_usu_id')->references('id')->on('users');
            $table->integer('app_emp_id')->references('emp_id')->on('empresa');
            $table->string('app_numconvenio',30);
            $table->date('app_fechaconvenio');
            $table->integer('app_dir_usu_id')->unsigned();
            $table->foreign('app_dir_usu_id')->references('id')->on('users');
            $table->integer('app_pro_id')->unsigned();
            $table->foreign('app_pro_id')->references('pro_id')->on('programas');
            $table->integer('app_con_id')->unsigned()->nullable();
            $table->foreign('app_con_id')->references('con_id')->on('conceptos');
            $table->string('app_formato')->nullable();
            $table->date('app_fecha_entrega')->nullable();
            $table->date('app_fecha_calificacion')->nullable();
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
        Schema::dropIfExists('auditoria_propuesta_practica');
    }
}
