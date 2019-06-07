<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

Route::middleware([])
//Route::middleware(['auth:api'])
//Route::middleware(['auth'])
->namespace('Api')
->group(function () {
    // Route::get('sacar_descuento_personal','UsuariosController@sacar_descuento_personal');
    // Route::post('details', 'UserController@details');
    Route::apiResource('productos','ProductController');
    Route::apiResource('comunas','ComunasController');
    Route::apiResource('usuarios','UsuariosController');
    Route::apiResource('pedidos','PedidosController');
    Route::get('/pedidos_de_hoy','PedidosController@hoy');
    Route::get('/vista_de_pedidos','PedidosController@vista_de_pedidos');
    Route::get('/graficos','PedidosController@graficos');
    // Route::get('comunas','ComunasController@index');
    // Route::post('pedidos/delete/{id_pedido}','PedidosController@destroy');
    // Route::get('pedidos/user/{celular}','PedidosController@pedidos_usuario');
    // Route::get('conductor_asignado','PedidosController@conductor_asignado');

    // Route::get('conductor_asignado/{id_pedido}','PedidosController@conductor_asignado');
    // Route::get('pedidos_del_dia/{fecha}/{id_conductor}','PedidosController@pedidos_del_dia');
    // Route::get('conductores_disponibles_hoy','PedidosController@conductores_disponibles_hoy');
    // Route::get('pedidos_sin_conductor_asignado','PedidosController@pedidos_sin_conductor_asignado');
    // Route::get('pedidos_filtro_por_estado/{fecha}/{estado}','PedidosController@pedidos_filtro_por_estado');
    // Route::get('conductores_disponibles_por_fecha/{date}','PedidosController@conductores_disponibles_por_fecha');
    // Route::get('auto_asignacion_de_pedidos_por_fecha/{fecha}','PedidosController@auto_asignacion_de_pedidos_por_fecha');
    // Route::get('auto_asignacion_de_pedidos_por_fecha_y_comuna/{fecha}','PedidosController@auto_asignacion_de_pedidos_por_fecha_y_comuna');

    //Carrito de compras
    Route::get('carrito/carrito_contador/{id_usuario}','CarritosController@carrito_contador');
    Route::get('carrito/{id_usuario}','CarritosController@show');
    Route::get('carrito/delete/{id_usuario}','CarritosController@delete');
    Route::get('carrito/delete/producto/{id_carrito}','CarritosController@delete_producto');
    Route::post('carrito','CarritosController@store');
    Route::post('carrito/{id_carrito}','CarritosController@update');
    Route::post('carrito/lista_de_deseados','CarritosController@deseados');
    Route::post('carrito/lista_de_comprados','CarritosController@comprados');
    Route::get('carrito/total/{id_usuario}','CarritosController@total');

    
    /**
     @ESTADOS: ['ENTREGADO','ENCAMINO','CANCELADO','SINASIGNAR','ASIGNADO']
     Ejemplo: api/pedidos_por_conductor_y_fecha/5/2019-5-1/ASIGNADO
     */
    Route::get('pedidos_por_conductor_y_fecha/{id_conductor}/{fecha}/{estado}','PedidosController@pedidos_por_conductor_y_fecha');
    Route::get('asignacion_manual/{id_pedido}/{id_conductor}','PedidosController@asignacion_manual');

    // Flow
    Route::get('signature','FlowController@signature');
    Route::post('payments','FlowController@create');
});

