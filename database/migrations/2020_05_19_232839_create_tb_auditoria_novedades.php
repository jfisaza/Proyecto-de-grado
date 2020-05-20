<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbAuditoriaNovedades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoria_novedades', function (Blueprint $table) {
            $table->integer('an_id')->unique();
            $table->integer('an_ad_id')->unsigned();
            $table->foreign('an_ad_id')->references('ad_id')->on('auditoria_desarrollo');
            $table->string('an_descripcion');
            $table->date('an_fecha');
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
        Schema::dropIfExists('auditoria_novedades');
    }
}
