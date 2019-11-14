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
 * cambio de aceite
 */
Route::get('cambio_aceite', 'RecorridoController@index')->name('cambioaceite')->middleware('auth');
Route::put('cambio_aceite/{recorrido_id}', 'RecorridoController@update')->name('cambioaceite.update')->middleware('auth');
Route::post('cambio_aceite/{vehiculo_id}', 'RecorridoController@store')->name('cambioaceite.store')->middleware('auth');
Route::get('recorrido', 'RecorridoController@recorrido')->name('vehiculo.recorrido')->middleware('auth');

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
Route::get('conductor/cumpleanios','ConductorController@cumpleanios')->name('conductor.cumpleanios')->middleware('auth');
Route::put('foto/conductor/{id}','ConductorController@updateFoto')->name('conductor.update.foto')->middleware('auth');
Route::put('estado/conductor/{id}','ConductorController@cambiar_Estado')->name('conductor.estado')->middleware('auth');
Route::get('conductor/deshabilitado','ConductorController@deshabilitados')->name('conductor.deshabilitado')->middleware('auth');

Route::resource('conductor','ConductorController')->middleware('auth')->middleware('auth');

/**
 * Vehiculo 
 */
Route::put('/estado/vehiculo/{id}','VehiculoController@cambiar_Estado')->name('vehiculo.estado')->middleware('auth');
Route::resource('vehiculo','VehiculoController')->middleware('auth');/* ->only([
    'index', 'show','store','update'
]) */

/**
 * notificaciones
 */
Route::get('notificacion','NotificacionesController@alerta_docs')->name('alert.doc')->middleware('auth');

/**
 * usuario
 */
Route::get('usuario/contrasenia','UserController@view_cambiar_contrasenia')->name('cambiar_contrasenia')->middleware('auth');
Route::put('usuario/contrasenia','UserController@cambiar_contrasenia')->name('store_cambiar_contrasenia')->middleware('auth');
Route::get('/password', 'UserController@password')->name('recuperar.password');
Route::post('/emial', 'UserController@email_contrasenia')->name('recuperar.password.email');
Route::get('/password/nueva/{token}', function () {
    return view('password.nuevo');
});
Route::put('/password/nueva/{token}', 'UserController@nueva_contrasenia')->name('new.password');

/**
 * empresa
 */
Route::resource('empresa','EmpresaController')->only([
    'create', 'store'
]);