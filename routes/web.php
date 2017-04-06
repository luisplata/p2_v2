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
    //Session::flush();
    return view('login');
});
Route::get('/logout', "loginController@LogOut");

Route::group(['middleware' => 'TipoDoctor'], function () {

});

//administrador
Route::group(['prefix' => 'administrador'], function () {
	Route::resource('/','AdministradorController');
	Route::get("desactivar/{cedula}","AdministradorController@Desactivar");
	Route::get("activar/{cedula}","AdministradorController@Activar");
});

Route::post('/login', 'loginController@login');


//Rutas del admisionista
//administrador
Route::group(['prefix' => 'admisionista'], function () {
	Route::resource('/','AdmisionistaController');
});

Route::post("admisionista/registrarPaciente","AdmisionistaController@GuardarPaciente");

//Hasta aqui
//Enfermera JEFE
Route::group(['prefix' => 'enfermera_jefe'], function () {
	Route::resource('/','EnfermeraJefeController');
	Route::post("asignarCubiculo","EnfermeraJefeController@AsignarCubiculo");
	Route::get("eliminarCubiculo/{cubiculo}/{paciente_cedula}","EnfermeraJefeController@EliminarCubiculo");
});