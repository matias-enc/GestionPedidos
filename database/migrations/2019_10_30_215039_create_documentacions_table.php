<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentaciones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('documento')->nullable();
            $table->string('descripcion')->nullable();
            $table->unsignedBigInteger('validacion_id')->nullable();
            $table->foreign('validacion_id')->references('id')->on('validaciones');
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
        Schema::dropIfExists('documentacions');
    }
}
