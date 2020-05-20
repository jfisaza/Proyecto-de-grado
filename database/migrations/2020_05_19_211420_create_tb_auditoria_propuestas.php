<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAuditoriaPropuestas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoria_propuestas', function (Blueprint $table) {
            $table->integer('ap_id')->unique();
            $table->string('ap_titulo');
            $table->integer('ap_est1');
            $table->foreign('ap_est1')->references('id')->on('users');
            $table->integer('ap_est2')->nullable();
            $table->foreign('ap_est2')->references('id')->on('users');
            $table->integer('ap_est3')->nullable();
            $table->foreign('ap_est3')->references('id')->on('users');
            $table->integer('ap_dir_usu_id')->unsigned();
            $table->foreign('ap_dir_usu_id')->references('id')->on('users');
            $table->integer('ap_codir_usu_id')->nullable()->unsigned();
            $table->foreign('ap_codir_usu_id')->references('id')->on('users');
            $table->integer('ap_mod_id')->unsigned();
            $table->foreign('ap_mod_id')->references('mod_id')->on('modalidades');
            $table->integer('ap_pro_id')->unsigned();
            $table->foreign('ap_pro_id')->references('pro_id')->on('programas');  
            $table->integer('ap_con_id')->unsigned()->nullable();
            $table->foreign('ap_con_id')->references('con_id')->on('conceptos');
            $table->string('ap_formato')->nullable();
            $table->date('ap_fecha_entrega')->nullable();
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
        Schema::dropIfExists('auditoria_propuestas');
    }
}
