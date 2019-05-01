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

Route::middleware(['auth:api'])
->namespace('Api')
->group(function () {
    
    Route::post('details', 'UserController@details');
    Route::apiResource('productos','ProductController');
    Route::apiResource('usuarios','UsuariosController');
    Route::apiResource('pedidos','PedidosController');
    Route::get('comunas','ComunasController@index');
    Route::get('conductor_asignado','PedidosController@conductor_asignado');
    Route::get('pedidos_sin_conductor_asignado','PedidosController@pedidos_sin_conductor_asignado');
    Route::get('conductores_disponibles_hoy','PedidosController@conductores_disponibles_hoy');
    Route::get('conductor_asignado/{id_pedido}','PedidosController@conductor_asignado');
    Route::get('conductores_disponibles_por_fecha/{date}','PedidosController@conductores_disponibles_por_fecha');
    Route::get('auto_asignacion_de_pedidos_por_comuna/{id_comuna}','PedidosController@auto_asignacion_de_pedidos_por_comuna');

    // Flow
    Route::get('signature','FlowController@signature');
    Route::post('payments','FlowController@create');
});

