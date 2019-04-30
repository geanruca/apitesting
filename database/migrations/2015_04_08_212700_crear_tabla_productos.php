<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaProductos extends Migration
{
   /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id')->unique();
            $table->string('nombre');
            $table->string('tallas')->nullable();
            $table->string('colores')->nullable();
            $table->string('descripcion')->nullable();
            $table->string('precio_inicial')->nullable();
            $table->string('precio_actual')->nullable();
            $table->string('imagenes')->nullable();
            $table->string('estado')->nullable();
            $table->string('notas')->nullable();
            $table->string('path')->nullable();

            // FK
            // $table->unsignedBigInteger('id_empresa')->nullable();
            // $table->foreign('id_empresa')->references('id')->on('empresas');
            // llaves combinadas
            $table->string('SKU')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // INDEXES
            $table->index(['id','updated_at']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
