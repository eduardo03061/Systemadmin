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


Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/registrarUsuario', 'UsersController@registrar')->name('registrar');
Route::post('/guardarUsuario', 'UsersController@storage')->name('guardar-user');
Route::get('/editarUsuario/edit/{nick}', 'UsersController@edit')->name('users.edit');

Route::post('/updateUsuario', 'UsersController@update')->name('users.update');
Route::post('/deleteusuario/{nick}', 'UsersController@destroy')->name('users.destroy');
