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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/index', 'GeneralController@index')->name('get.index');
    Route::get('/mostrar-evidencias/{registro}/{tipo}', 'GeneralController@listImg')->name('get.listImg');
    Route::get('/calendario', 'GeneralController@getCalendarioV')->name('get.calendario');
    Route::get('/calendarioList', 'GeneralController@getCalendarioList')->name('get.calendarioList');
    Route::delete('/calendarioEliminar/{evidencia}', 'GeneralController@postEvidenciaEliminar')->name('post.calendarioEliminar');
    Route::delete('/registroEliminar/{registro}', 'GeneralController@postRegistroEliminar')->name('post.registroEliminar');
    Route::post('/calendario', 'GeneralController@postCalendarioV')->name('post.calendario');
    Route::get('/registro/editar/{registro}', 'GeneralController@editRegistro')->name('get.editRegistro');
    Route::post('/registro/editar/{registro}', 'GeneralController@updateRegistro')->name('post.editEvidencia');
    Route::post('/folio', 'GeneralController@postFolio')->name('post.folio');
    Route::post('/evidencias', 'GeneralController@postEvidencia')->name('post.evidencia');
});