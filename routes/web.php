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
    return view('show');
});
// Route::post('login', 'LoginController@postLogin')->name('postlogin');
Route::get('login/check', 'LoginController@check')->name('check');
// Route::get('/home', 'HomeController@index')->name('home');
// Route::get('/login', function () {
//     return view('login.login_1');
// })->name('login');
// Route::post('cerrar/', 'HomeController@cerrar_session')->name('cerrar');