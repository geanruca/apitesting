<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('mobilechile.home');
});

Route::post('/contacto','HomeController@contacto');

// Auth::routes();

Route::get('/pagoconfirmado',function(){
    return view('flow.exito');
})->name('pagoconfirmado');

Route::middleware(['auth'])->prefix('aguaclean')
->group(function () {
    Route::get('/','adminpanel@index');
    Route::get('usuarios','adminpanel@usuarios');
    Route::get('productos','adminpanel@productos');
    Route::get('comunas','adminpanel@comunas');
    Route::get('pedidos','adminpanel@pedidos');
    Route::get('vsoporte','adminpanel@vsoporte');
    Route::post('soporte','adminpanel@soporte')->name("soporte");
    // Route::get('datagraficos','adminpanel@pedidos');
});

Route::get('/fracaso',function(){
    return view('flow.fracaso');
});

// Route::get('/pagoconfirmado',function(){
//     return view('flow.exito');
// });
Route::get('/auth/facebook', 'SocialAuthController@facebook');
Route::get('/auth/facebook/callback', 'SocialAuthController@callback');

Route::post('/auth/facebook/register', 'SocialAuthController@register');
Route::group(['prefix' => 'admin'], function () {
    // Voyager::routes();
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});
// Flow
Route::get('signature','Api\FlowController@signature');
Route::post('payments','Api\FlowController@create');

