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
            $table->bigIncrements('des_id')->unique();
            $table->Integer('des_con_id')->unsigned();
            $table->foreign('des_con_id')->references('con_id')->on('conceptos');
            $table->Integer('des_prop_id')->unsigned();
            $table->foreign('des_prop_id')->references('prop_id')->on('propuesta');
            $table->string('des_formato',40);
            $table->date('des_fecha_entrega');
            $table->date('des_fecha_calificacion');


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
