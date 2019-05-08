<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carritos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users');

            $table->string('nombre_producto_1')->nullable();
            $table->string('cantidad_producto_1')->nullable();
            $table->string('precio_producto_1')->nullable();
            $table->string('subtotal_producto_1')->nullable();
            $table->string('descuento_subtotal_producto_1')->nullable();

            $table->string('nombre_producto_2')->nullable();
            $table->string('cantidad_producto_2')->nullable();
            $table->string('precio_producto_2')->nullable();
            $table->string('subtotal_producto_2')->nullable();
            $table->string('descuento_subtotal_producto_2')->nullable();

            $table->string('nombre_producto_3')->nullable();
            $table->string('cantidad_producto_3')->nullable();
            $table->string('precio_producto_3')->nullable();
            $table->string('subtotal_producto_3')->nullable();
            $table->string('descuento_subtotal_producto_3')->nullable();

            $table->string('nombre_producto_4')->nullable();
            $table->string('cantidad_producto_4')->nullable();
            $table->string('precio_producto_4')->nullable();
            $table->string('subtotal_producto_4')->nullable();
            $table->string('descuento_subtotal_producto_4')->nullable();

            $table->string('nombre_producto_5')->nullable();
            $table->string('cantidad_producto_5')->nullable();
            $table->string('precio_producto_5')->nullable();
            $table->string('subtotal_producto_5')->nullable();
            $table->string('descuento_subtotal_producto_5')->nullable();

            $table->string('nombre_producto_6')->nullable();
            $table->string('cantidad_producto_6')->nullable();
            $table->string('precio_producto_6')->nullable();
            $table->string('subtotal_producto_6')->nullable();
            $table->string('descuento_subtotal_producto_6')->nullable();

            $table->string('nombre_producto_7')->nullable();
            $table->string('cantidad_producto_7')->nullable();
            $table->string('precio_producto_7')->nullable();
            $table->string('subtotal_producto_7')->nullable();
            $table->string('descuento_subtotal_producto_7')->nullable();

            $table->string('nombre_producto_8')->nullable();
            $table->string('cantidad_producto_8')->nullable();
            $table->string('precio_producto_8')->nullable();
            $table->string('subtotal_producto_8')->nullable();
            $table->string('descuento_subtotal_producto_8')->nullable();
            
            $table->string('nombre_producto_9')->nullable();
            $table->string('cantidad_producto_9')->nullable();
            $table->string('precio_producto_9')->nullable();
            $table->string('subtotal_producto_9')->nullable();
            $table->string('descuento_subtotal_producto_9')->nullable();
            
            $table->string('nombre_producto_10')->nullable();
            $table->string('cantidad_producto_10')->nullable();
            $table->string('precio_producto_10')->nullable();
            $table->string('subtotal_producto_10')->nullable();
            $table->string('descuento_subtotalp_roducto_10')->nullable();
            
            $table->string('descuento_total')->nullable();
            $table->string('total_a_pagar')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carritos');
    }
}
