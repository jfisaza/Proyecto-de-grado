<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbBancoIdeas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banco_ideas', function (Blueprint $table) {
            $table->bigIncrements('ban_id')->unique();
            $table->string('ban_nombre',60);
            $table->Integer('ban_usu_id')->unsigned();
            $table->foreign('ban_usu_id')->references('id')->on('users');
            $table->Integer('ban_mod_id')->unsigned();
            $table->foreign('ban_mod_id')->references('mod_id')->on('modalidades');            
            $table->Integer('ban_pro_id')->unsigned();
            $table->foreign('ban_pro_id')->references('pro_id')->on('programas');
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
        Schema::dropIfExists('banco_ideas');
    }
}
