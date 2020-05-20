<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAuditoriaDesarrollo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoria_desarrollo', function (Blueprint $table) {
            $table->integer('ad_id')->unique();
            $table->string('ad_titulo');
            $table->integer('ad_est1');
            $table->foreign('ad_est1')->references('id')->on('users');
            $table->integer('ad_est2')->nullable();
            $table->foreign('ad_est2')->references('id')->on('users');
            $table->integer('ad_est3')->nullable();
            $table->foreign('ad_est3')->references('id')->on('users');
            $table->integer('ad_dir_usu_id')->unsigned();
            $table->foreign('ad_dir_usu_id')->references('id')->on('users');
            $table->integer('ad_codir_usu_id')->nullable()->unsigned();
            $table->foreign('ad_codir_usu_id')->references('id')->on('users');
            $table->integer('ad_mod_id')->unsigned();
            $table->foreign('ad_mod_id')->references('mod_id')->on('modalidades');
            $table->integer('ad_pro_id')->unsigned();
            $table->foreign('ad_pro_id')->references('pro_id')->on('programas');
            $table->integer('ad_con_id')->unsigned()->nullable();
            $table->foreign('ad_con_id')->references('con_id')->on('conceptos');
            $table->integer('ad_ap_id')->unsigned();
            $table->foreign('ad_ap_id')->references('ap_id')->on('auditoria_propuestas');
            $table->string('ad_formato')->nullable();
            $table->date('ad_fecha_entrega')->nullable();
            $table->date('ad_fecha_calificacion')->nullable();
            $table->timestamp('ad_citacion')->nullable();
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
        Schema::dropIfExists('auditoria_desarrollo');
    }
}
