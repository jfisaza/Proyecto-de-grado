<?php

use Illuminate\Support\Facades\Route;

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

Route::resource('/banco','BancoController');
Route::resource('/usuarios','UsersController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/estudiantes','EstudiantesController');
Route::get('/propuesta','EstudiantesController@propuestaDownload')->name('propuesta');
Route::get('/desarrollo','EstudiantesController@desarrolloDownload')->name('desarrollo');
Route::post('/estudiante','EstudiantesController@agregarEstudiante')->name('estudiante');
Route::get('/estudiante','EstudiantesController@abandonar')->name('estudiante');
Route::get('/desarrollo','EstudiantesController@crearDesarrollo')->name('desarrollo');
Route::resource('/docentes','DocentesController');
Route::resource('/administrativos','AdministrativosController');
