<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransicionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transicions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->unsignedBigInteger('flujoTrabajo_id')->unsigned();
            $table->foreign('flujoTrabajo_id')->references('id')->on('flujo_trabajos');
            $table->unsignedBigInteger('estadoInicial_id')->unsigned();
            $table->foreign('estadoInicial_id')->references('id')->on('estados');
            $table->unsignedBigInteger('estadoFinal_id')->unsigned();
            $table->foreign('estadoFinal_id')->references('id')->on('estados');
            $table->integer('orden')->unsigned();
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
        Schema::dropIfExists('transicions');
    }
}
