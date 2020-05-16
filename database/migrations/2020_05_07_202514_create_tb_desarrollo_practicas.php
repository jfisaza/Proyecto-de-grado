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
            $table->id('dp_id');
            $table->integer('dp_pp_id');
            $table->foreign('dp_pp_id')->references('pp_id')->on('propuesta_practicas');
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
        Schema::dropIfExists('desarrollo_practicas');
    }
}
