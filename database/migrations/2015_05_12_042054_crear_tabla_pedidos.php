<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaPedidos extends Migration
{
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$estados_pago     = ['PAGADO','PORPAGAR'];
            //$medio_de_pago    = ['EFECTIVO','REDCOMPRA'];
            //$estados_despacho = ['ENTREGADO','ENCAMINO','CANCELADO','SINASIGNAR','ASIGNADO'];
            $table->string('estado_pago')->nullable();
            $table->string('estado_despacho')->nullable();
            $table->string('medio_de_pago')->nullable();
            $table->string('total_pago')->nullable();


            $table->string('detalle_productos')->nullable();
            $table->string('horario_recepcion_inicio')->nullable();
            $table->string('horario_recepcion_final')->nullable();
            $table->date('fecha_recepcion')->nullable();
            $table->string('notas')->nullable();

            // FK
            //Datos del usuario que hace el pedido 
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id')->on('users');
            // Datos de la comuna donde se hará el despacho. Para permitir despacho en dias disponibles, agregar un pedido mínimo de productos según comuna, etc.
            $table->unsignedBigInteger('id_comuna');
            $table->foreign('id_comuna')->references('id')->on('comunas');

            // Datos del conductor que hará la entrega del producto
            $table->unsignedBigInteger('id_conductor')->nullable();
            $table->foreign('id_conductor')->references('id')->on('users');

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
        Schema::dropIfExists('pedidos');
    }
}
