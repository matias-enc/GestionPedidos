<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipoItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('descripcion');
            $table->unsignedBigInteger('flujoTrabajo_id')->nullable();
            $table->foreign('flujoTrabajo_id')->references('id')->on('flujo_trabajos');
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
        Schema::dropIfExists('tipo_items');
    }
}
