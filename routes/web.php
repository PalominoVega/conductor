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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

/* login */
Route::get('/', function () {
    // if(Auth::check()){
    //     return view('conductor.index');
    // }
    return view('login.login');
})->name('login');

Route::post('login', 'LoginController@postLogin')->name('postlogin');
Route::get('login/check', 'LoginController@check')->name('check');
// Route::get('/home', 'ConductorController@index')->name('home');
Route::get('/login', function () {
    return view('login.login');
})->name('login');
Route::get('cerrar/', 'LoginController@cerrar_session')->name('cerrar');


/**
 * Asignador de Vehiculo
 */
Route::put('asignador/conductor/{id}','AsignadorController@updateVehiculo')->name('asignador.update.conductor')->middleware('auth');
Route::get('asignador/ajax','AsignadorController@ajax')->name('asignador.ajax')->middleware('auth');
Route::post('asignador/conductor','AsignadorController@storeVehiculo')->name('asignador.store.conductor')->middleware('auth');
Route::get('asignador','AsignadorController@index')->name('asignador.index')->middleware('auth');

/**
 * Conductor
 */
Route::put('foto/conductor/{id}','ConductorController@updateFoto')->name('conductor.update.foto')->middleware('auth');
Route::put('estado/conductor/{id}','ConductorController@cambiar_Estado')->name('conductor.estado')->middleware('auth');
Route::get('conductor/deshabilitado','ConductorController@deshabilitados')->name('conductor.deshabilitado')->middleware('auth');

Route::resource('conductor','ConductorController')->middleware('auth')->middleware('auth');

/**
 * Vehiculo 
 */
Route::put('vehiculo/{id}','VehiculoController@cambiar_Estado')->name('vehiculo.estado')->middleware('auth');
Route::resource('vehiculo','VehiculoController')->middleware('auth');/* ->only([
    'index', 'show','store','update'
]) */

/**
 * notificaciones
 */
Route::get('notificacion','NotificacionesController@alerta_docs')->name('alert.doc')->middleware('auth');


