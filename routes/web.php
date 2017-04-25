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
Route::post('/login', 'loginController@login');

Route::group(['middleware' => 'TipoDoctor'], function () {

});

//administrador
Route::group(['prefix' => 'administrador'], function () {
	Route::resource('/','AdministradorController');
	Route::get("desactivar/{cedula}","AdministradorController@Desactivar");
	Route::get("activar/{cedula}","AdministradorController@Activar");
});



Route::get("/simulador",function (){
    return view("simulador");
});
//Pagina principal
Route::get("/principal","VentanaPrincipalController@index");

//URLS para los envios y recepcion de datos de signos vitales
Route::get("/simulador/recepcion/{cubiculo}/{fecha}/{pulso}/{oxigeno}","SignosVitalesController@SignosVitales");
Route::get("/simulador/leer/","SignosVItalesController@LecturaSignosVitales");


//Rutas del admisionista
Route::group(['prefix' => 'admisionista'], function () {
	Route::resource('/','AdmisionistaController');
	Route::post("registrarPaciente","AdmisionistaController@GuardarPaciente");
});



//Hasta aqui
//Enfermera JEFE
Route::group(['prefix' => 'enfermera_jefe'], function () {
	Route::resource('/','EnfermeraJefeController');
	Route::post("asignarCubiculo","EnfermeraJefeController@AsignarCubiculo");
	Route::get("eliminarCubiculo/{cubiculo}/{paciente_cedula}","EnfermeraJefeController@EliminarCubiculo");
});

Route::group(['prefix' => 'doctor'], function () {
	Route::resource('/','DoctorController');
	Route::get("ver/{id}","DoctorController@show");
	Route::get("eliminar/{id}","HistoriaClinicaController@destroy");
	Route::get("asignarTratamiento/{historia_clinica_id}","TratamientoController@AsignarTratamiento");
	Route::post("asignarTratamiento","TratamientoController@store");
	Route::get("quitarTratamiento/{tratamiento_id}/{historia_clinica_id}","TratamientoController@destroy");
});
	
Route::resource("/historia_clinica","HistoriaClinicaController");