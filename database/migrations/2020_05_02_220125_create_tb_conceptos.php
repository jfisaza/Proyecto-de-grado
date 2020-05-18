<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbConceptos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conceptos', function (Blueprint $table) {
            $table->Increments('con_id')->unique();
            $table->string('con_nombre',40)->nullable;
            $table->integer('con_acta')->nullable();
            $table->Integer('con_usu_id')->unsigned();
            $table->foreign('con_usu_id')->references('id')->on('users');
            $table->date('con_fecha')->nullable();

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
        Schema::dropIfExists('conceptos');
    }
}
