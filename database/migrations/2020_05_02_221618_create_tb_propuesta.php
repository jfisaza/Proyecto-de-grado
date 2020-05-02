<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbPropuesta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propuesta', function (Blueprint $table) {
            $table->bigIncrements('prop_id')->unique();
            $table->Integer('prop_con_id')->unsigned();
            $table->foreign('prop_con_id')->references('con_id')->on('conceptos');
            $table->string('prop_formato',40);
            $table->date('prop_fecha_entrega');
            $table->date('prop_fecha_calificacion');
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
        Schema::dropIfExists('propuesta');
    }
}
