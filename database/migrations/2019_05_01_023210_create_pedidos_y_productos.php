<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePedidosYProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos_y_productos', function (Blueprint $table) {
            //FK
            $table->unsignedBigInteger('id_pedido'); 
            $table->foreign('id_pedido')->references('id')->on('pedidos'); 

            $table->unsignedBigInteger('id_producto'); 
            $table->foreign('id_producto')->references('id')->on('productos'); 

            $table->string('cantidad')->nullable();  
            $table->string('precio_inicial')->nullable(); 
            $table->string('cargo_unitario')->nullable(); 
            $table->string('descuento_unitario')->nullable();

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
        Schema::dropIfExists('pedidos_y_productos');
    }
}
