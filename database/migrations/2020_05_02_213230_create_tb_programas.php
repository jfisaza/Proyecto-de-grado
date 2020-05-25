<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbProgramas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programas', function (Blueprint $table) {
            $table->Increments('pro_id');
            $table->string('pro_nombre',100);
            $table->Integer('pro_fac_id')->unsigned();
            $table->foreign('pro_fac_id')->references('fac_id')->on('facultades');
            $table->Integer('pro_coo_id')->unsigned();
            $table->foreign('pro_coo_id')->references('coo_id')->on('coordinacion');

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
        Schema::dropIfExists('programas');
    }
}
