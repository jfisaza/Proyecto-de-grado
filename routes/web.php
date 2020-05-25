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
Route::get('/propuestaa/{id}','AdministrativosController@downloadPropuesta')->name('propuestaa');
Route::get('/desarrolloa/{id}','AdministrativosController@downloadDesarrollo')->name('desarrolloa');
Route::post('/estudiante','EstudiantesController@agregarEstudiante')->name('estudiante');
Route::get('/estudiante','EstudiantesController@abandonar')->name('estudiante');
Route::get('/creardesarrollo','EstudiantesController@crearDesarrollo')->name('creardesarrollo');
Route::post('/formato','EstudiantesController@subirFormato')->name('/formato');
Route::get('/estudiantes/{id}','EstudiantesController@desarrolloEdit')->name('estudiantes');
Route::post('/desarrolloUpdate/{id}','EstudiantesController@desarrolloUpdate')->name('desarrolloUpdate');
Route::post('/novedades','EstudiantesController@novedades')->name('novedades');
Route::get('/finalizar/{id}','EstudiantesController@finalizar')->name('finalizar');
Route::resource('/docentes','DocentesController');
Route::get('/descargaFormatoP/{id}','DocentesController@downloadPropuesta')->name('descargaFormatoP');
Route::get('/descargaFormatoD/{id}','DocentesController@downloadDesarrollo')->name('descargaFormatoD');
Route::resource('/administrativos','AdministrativosController');
Route::get('/asigPro/{id}','AdministrativosController@asignarPropuesta')->name('asigPro');
Route::post('/asigCalPro','AdministrativosController@asignarCalificadorPropuesta')->name('asigCalPro');
Route::get('/asigDes/{id}','AdministrativosController@asignarDesarrollo')->name('asigDes');
Route::post('/asigCalDes','AdministrativosController@asignarCalificadorDesarrollo')->name('asigCalDes');
Route::get('/apropuesta/{id}','AdministrativosController@downloadAuditoriaPropuesta')->name('apropuesta');
Route::get('/adesarrollo/{id}','AdministrativosController@downloadAuditoriaDesarrollo')->name('adesarrollo');
Route::get('/createSolicitud','BancoController@createSolicitud')->name('createSolicitud');
Route::post('/storeSolicitud','BancoController@storeSolicitud')->name('storeSolicitud');
Route::get('/editSolicitud/{id}','BancoController@editSolicitud')->name('editSolicitud');
Route::post('/updateSolicitud/{id}','BancoController@updateSolicitud')->name('updateSolicitud');
Route::get('/destroySolicitud/{id}','BancoController@destroySolicitud')->name('destroySolicitud');
Route::post('/setRolDocente','AdministrativosController@setRolDocente')->name('setRolDocente');
Route::post('/setRolAdministrativo','AdministrativosController@setRolAdministrativo')->name('setRolAdministrativo');
Route::get('/setRolEstudiante/{id}','AdministrativosController@setRolEstudiante')->name('setRolEstudiante');
Route::get('/exportPropuesta', 'AdministrativosController@exportPropuesta')->name('exportPropuesta');
Route::get('/exportDesarrollo', 'AdministrativosController@exportDesarrollo')->name('exportDesarrollo');
Route::get('/exportAuditoriaPropuesta', 'AdministrativosController@exportAuditoriaPropuesta')->name('exportAuditoriaPropuesta');
Route::get('/exportAuditoriaDesarrollo', 'AdministrativosController@exportAuditoriaDesarrollo')->name('exportAuditoriaDesarrollo');