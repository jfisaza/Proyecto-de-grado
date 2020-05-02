<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbRolesUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_user', function (Blueprint $table) {
            $table->increments('ur_id')->unique();
            $table->Integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->Integer('roler_rol_id')->unsigned();
            $table->foreign('roler_rol_id')->references('rol_id')->on('roles');
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
        Schema::dropIfExists('roles_user');
    }
}
