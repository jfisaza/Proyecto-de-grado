<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAuditoriaNovedadesPractica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoria_novedades_practica', function (Blueprint $table) {
            $table->id('anp_id');
            $table->integer('anp_adp_id')->unsigned();
            $table->foreign('anp_adp_id')->references('adp_id')->on('auditoria_desarrollo_practica');
            $table->string('anp_descripcion');
            $table->date('anp_fecha');
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
        Schema::dropIfExists('auditoria_novedades_practica');
    }
}
