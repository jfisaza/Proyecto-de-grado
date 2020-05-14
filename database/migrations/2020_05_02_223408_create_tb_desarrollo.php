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
            $table->integer('des_con_id')->unsigned()->nullable();
            $table->foreign('des_con_id')->references('con_id')->on('conceptos');
            $table->integer('des_prop_id')->unsigned();
            $table->foreign('des_prop_id')->references('prop_id')->on('propuesta');
            $table->string('des_formato',40)->nullable();
            $table->date('des_fecha_entrega')->nullable();
            $table->date('des_fecha_calificacion')->nullable();
            $table->timestamp('tra_citacion')->nullable();

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
