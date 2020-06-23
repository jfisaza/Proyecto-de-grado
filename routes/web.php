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


Route::resource('/usuarios','UsersController');
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//rutas de banco de ideas
Route::resource('/banco','BancoController');
Route::get('/createSolicitud','BancoController@createSolicitud')->name('createSolicitud');
Route::post('/storeSolicitud','BancoController@storeSolicitud')->name('storeSolicitud');
Route::get('/editSolicitud/{id}','BancoController@editSolicitud')->name('editSolicitud');
Route::post('/updateSolicitud/{id}','BancoController@updateSolicitud')->name('updateSolicitud');
Route::get('/destroySolicitud/{id}','BancoController@destroySolicitud')->name('destroySolicitud');
//Rutas de estudiantes
Route::resource('/estudiantes','EstudiantesController');
Route::get('/propuesta','EstudiantesController@propuestaDownload')->name('propuesta');
Route::get('/desarrollo','EstudiantesController@desarrolloDownload')->name('desarrollo');
Route::post('/estudiante','EstudiantesController@agregarEstudiante')->name('estudiante');
Route::get('/estudiante','EstudiantesController@abandonar')->name('estudiante');
Route::get('/creardesarrollo','EstudiantesController@crearDesarrollo')->name('creardesarrollo');
Route::post('/formato','EstudiantesController@subirFormato')->name('/formato');
Route::get('/estudiantes/{id}','EstudiantesController@desarrolloEdit')->name('estudiantes');
Route::post('/desarrolloUpdate/{id}','EstudiantesController@desarrolloUpdate')->name('desarrolloUpdate');
Route::post('/novedades','EstudiantesController@novedades')->name('novedades');
Route::get('/finalizar/{id}','EstudiantesController@finalizar')->name('finalizar');
//practica
Route::get('/estudiantep','EstudiantesController@createp')->name('estudiantep');
Route::post('/estudiantesp','EstudiantesController@storep')->name('estudiantesp');
Route::get('/estudiantepedit/{id}','EstudiantesController@editp')->name('estudiantepedit');
Route::post('/estudiantepupdate/{id}','EstudiantesController@updatep')->name('estudiantepupdate');
Route::get('/creardesarrollop/{id}','EstudiantesController@crearDesarrolloPractica')->name('creardesarrollop');
Route::post('/formatop/{id}','EstudiantesController@subirFormatoPractica')->name('/formatop');
Route::get('/propuestap/{id}','EstudiantesController@propuestaPracticaDownload')->name('propuestap');
Route::get('/desarrollop/{id}','EstudiantesController@desarrolloPracticaDownload')->name('desarrollop');
Route::post('/novedadesp/{id}','EstudiantesController@novedadesPractica')->name('novedadesp');
Route::get('/estudiantepdedit/{id}','EstudiantesController@desarrolloPracticaEdit')->name('estudiantepdedit');
Route::post('/estudiantepdupdate/{id}','EstudiantesController@desarrolloPracticaUpdate')->name('estudiantepdupdate');
Route::get('/abandonar','EstudiantesController@abandonarPractica')->name('abandonar');
Route::get('/finalizarp/{id}','EstudiantesController@finalizarPractica')->name('finalizarp');

//Rutas de docentes
Route::resource('/docentes','DocentesController');
Route::get('/descargaFormatoP/{id}','DocentesController@downloadPropuesta')->name('descargaFormatoP');
Route::get('/descargaFormatoD/{id}','DocentesController@downloadDesarrollo')->name('descargaFormatoD');
Route::get('/descargaFormatoPP/{id}','DocentesController@downloadPropuestaPractica')->name('descargaFormatoPP');
Route::get('/descargaFormatoDP/{id}','DocentesController@downloadDesarrolloPractica')->name('descargaFormatoDP');

//Rutas de administrativos
Route::resource('/administrativos','AdministrativosController');
Route::get('/asigPro/{id}','AdministrativosController@asignarPropuesta')->name('asigPro');
Route::post('/asigCalPro','AdministrativosController@asignarCalificadorPropuesta')->name('asigCalPro');
Route::get('/asigDes/{id}','AdministrativosController@asignarDesarrollo')->name('asigDes');
Route::post('/asigCalDes','AdministrativosController@asignarCalificadorDesarrollo')->name('asigCalDes');
Route::get('/asigProP/{id}','AdministrativosController@asignarPropuestaPractica')->name('asigProP');
Route::post('/asigCalProP','AdministrativosController@asignarCalificadorPropuestaPractica')->name('asigCalProP');
Route::get('/asigDesP/{id}','AdministrativosController@asignarDesarrolloPractica')->name('asigDesP');
Route::post('/asigCalDesP','AdministrativosController@asignarCalificadorDesarrolloPractica')->name('asigCalDesP');
Route::get('/apropuesta/{id}','AdministrativosController@downloadAuditoriaPropuesta')->name('apropuesta');
Route::get('/adesarrollo/{id}','AdministrativosController@downloadAuditoriaDesarrollo')->name('adesarrollo');
Route::post('/setRolDocente','AdministrativosController@setRolDocente')->name('setRolDocente');
Route::post('/setRolAdministrativo','AdministrativosController@setRolAdministrativo')->name('setRolAdministrativo');
Route::get('/setRolEstudiante/{id}','AdministrativosController@setRolEstudiante')->name('setRolEstudiante');
Route::get('/propuestaa/{id}','AdministrativosController@downloadPropuesta')->name('propuestaa');
Route::get('/desarrolloa/{id}','AdministrativosController@downloadDesarrollo')->name('desarrolloa');
Route::get('/dpropuestap/{id}','AdministrativosController@downloadPropuestaPractica')->name('dpropuestap');
Route::get('/ddesarrolloap/{id}','AdministrativosController@downloadDesarrolloPractica')->name('ddesarrolloap');
Route::get('/exportPropuesta', 'AdministrativosController@exportPropuesta')->name('exportPropuesta');
Route::get('/exportDesarrollo', 'AdministrativosController@exportDesarrollo')->name('exportDesarrollo');
Route::get('/exportAuditoriaPropuesta', 'AdministrativosController@exportAuditoriaPropuesta')->name('exportAuditoriaPropuesta');
Route::get('/exportAuditoriaDesarrollo', 'AdministrativosController@exportAuditoriaDesarrollo')->name('exportAuditoriaDesarrollo');
Route::get('/exportPropuestaPractica', 'AdministrativosController@exportPropuestaPractica')->name('exportPropuestaPractica');
Route::get('/exportDesarrolloPractica', 'AdministrativosController@exportDesarrolloPractica')->name('exportDesarrolloPractica');
Route::get('/exportAuditoriaPropuestaPractica', 'AdministrativosController@exportAuditoriaPropuestaPractica')->name('exportAuditoriaPropuestaPractica');
Route::get('/exportAuditoriaDesarrolloPractica', 'AdministrativosController@exportAuditoriaDesarrolloPractica')->name('exportAuditoriaDesarrolloPractica');
Route::post('/fechalimite','AdministrativosController@setFechaLimitePropuestas')->name('/fechalimite');