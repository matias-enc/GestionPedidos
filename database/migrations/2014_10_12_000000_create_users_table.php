<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('apellido')->nullable();
            $table->string('direccion')->nullable();
            $table->string('dni')->nullable();
            $table->string('telefono')->nullable();
            $table->string('celular')->nullable();
            $table->integer('pais_id')->unsigned()->nullable();
            $table->integer('provincia_id')->unsigned()->nullable();
            $table->integer('localidad_id')->unsigned()->nullable();
            $table->string('postal')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('pais_id')->references('id')->on('paises');
            $table->foreign('provincia_id')->references('id')->on('provincias');
            $table->foreign('localidad_id')->references('id')->on('localidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
