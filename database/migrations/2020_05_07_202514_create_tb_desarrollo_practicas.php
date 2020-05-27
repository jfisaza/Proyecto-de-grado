<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbDesarrolloPracticas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('desarrollo_practicas', function (Blueprint $table) {
            $table->integer('dp_id')->unique();
            $table->string('dp_titulo');
            $table->integer('dp_usu_id')->unsigned();
            $table->foreign('dp_usu_id')->references('id')->on('users');
            $table->integer('dp_emp_id')->unsigned();
            $table->foreign('dp_emp_id')->references('emp_id')->on('empresa');
            $table->integer('dp_dir_usu_id')->unsigned();
            $table->foreign('dp_dir_usu_id')->references('id')->on('users');
            $table->string('dp_numconvenio',30);
            $table->date('dp_fechaconvenio');
            $table->integer('dp_pro_id')->unsigned();
            $table->foreign('dp_pro_id')->references('pro_id')->on('programas');
            $table->integer('dp_pp_id');
            $table->foreign('dp_pp_id')->references('pp_id')->on('propuesta_practicas');
            $table->integer('dp_con_id')->nullable();
            $table->foreign('dp_con_id')->references('con_id')->on('conceptos');
            $table->string('dp_formato')->nullable();
            $table->date('dp_fecha_entrega')->nullable();
            $table->date('dp_fecha_calificacion')->nullable();
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
        Schema::dropIfExists('desarrollo_practicas');
    }
}
