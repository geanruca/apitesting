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
// dd('ok');

Auth::routes();

Route::get('/pagoconfirmado',function(){
    return view('flow.exito');
});
Route::middleware(['auth'])
->group(function () {

    Route::get('/aguaclean','adminpanel@index');
    Route::get('/aguaclean/usuarios','adminpanel@usuarios');
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
    Voyager::routes();
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');
});
// Flow
Route::get('signature','Api\FlowController@signature');
Route::post('payments','Api\FlowController@create');

