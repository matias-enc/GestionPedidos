<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeguimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seguimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pedido_id')->nullable();
            $table->foreign('pedido_id')->references('id')->on('pedidos');
            $table->unsignedBigInteger('estado_id')->nullable();
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->unsignedBigInteger('item_id')->nullable();
            $table->foreign('item_id')->references('id')->on('items');
            $table->double('precio')->nullable();
            $table->integer('cantidad')->nullable();
            $table->timestamp('fechaInicial');
            $table->timestamp('fechaFinal');
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
        Schema::dropIfExists('seguimientos');
    }
}
