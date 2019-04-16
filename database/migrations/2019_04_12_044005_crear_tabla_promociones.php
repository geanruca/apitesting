<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPromociones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promociones', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cantidad_minima')->nullable();
            $table->string('cantidad_maxima')->nullable();
            $table->string('tramos_de_descuento')->nullable();
            $table->string('descuento_por_producto')->nullable();
            $table->string('descuento_final')->nullable();
            $table->string('precio_final')->nullable();
            $table->string('estado')->nullable();
            $table->string('notas')->nullable();
            $table->unsignedBigInteger('id_producto')->nullable();
            $table->foreign('id_producto')->references('id')->on('productos');
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
        Schema::dropIfExists('promociones');
    }
}
