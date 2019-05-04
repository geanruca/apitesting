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
            $table->string('estado')->nullable();
            $table->string('notas')->nullable();
            $table->string('img1')->nullable();
            $table->string('img2')->nullable();
            $table->string('img3')->nullable();
            $table->string('img4')->nullable();
            $table->string('img5')->nullable();
            $table->string('img6')->nullable();
            $table->string('img7')->nullable();
            $table->string('img8')->nullable();
            $table->string('img9')->nullable();
            $table->string('path1')->nullable();
            $table->string('path2')->nullable();
            $table->string('path3')->nullable();
            $table->string('path4')->nullable();
            $table->string('path5')->nullable();
            $table->string('path6')->nullable();
            $table->string('path7')->nullable();
            $table->string('path8')->nullable();
            $table->string('path9')->nullable();

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
