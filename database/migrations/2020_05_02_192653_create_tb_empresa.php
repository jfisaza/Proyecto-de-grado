<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresa', function (Blueprint $table) {
            $table->bigIncrements('emp_id')->unique();
            $table->string('emp_nombre',100);
            $table->string('emp_sector',40);
            $table->string('emp_representante',40);
            $table->string('emp_direccion',100);
            $table->string('emp_telefono',13);
            $table->string('emp_correo',40);
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
        Schema::dropIfExists('empresa');
    }
}
