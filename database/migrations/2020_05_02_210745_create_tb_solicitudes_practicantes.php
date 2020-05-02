<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSolicitudesPracticantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudes_practicantes', function (Blueprint $table) {
            $table->bigIncrements('sol_id');
            $table->Integer('sol_emp_id')->unsigned();
            $table->foreign('sol_emp_id')->references('emp_id')->on('empresa');
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
        Schema::dropIfExists('solicitudes_practicantes');
    }
}
