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
    // Route::apiResource('payments','FlowController');
    Route::get('signature','FlowController@signature');
    Route::post('payments','FlowController@create');
});

