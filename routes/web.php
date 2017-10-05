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


Route::get('/logout', "loginController@LogOut");
Route::post('/login', 'loginController@login');

Route::group(['middleware' => 'autenticado'], function () {
    //Rutas del admisionista
    Route::group(['prefix' => 'admisionista', "middleware" => "admisionista"], function () {
        Route::resource('/', 'AdmisionistaController');
        Route::post("registrarPaciente", "AdmisionistaController@GuardarPaciente");
        Route::get("paciente/modificar/{id}", "AdmisionistaController@modificarPaciente");
        Route::post("paciente/modificar/{id}", "AdmisionistaController@editarPaciente");
    });

    //administrador
    Route::group(['prefix' => 'administrador', "middleware" => "administrador"], function () {
        Route::get("cubiculos/{numero}", "CubiculoController@destroy");
        Route::resource('/', 'AdministradorController');
        Route::get("desactivar/{cedula}", "AdministradorController@Desactivar");
        Route::get("activar/{cedula}", "AdministradorController@Activar");
        Route::get("/{id}/edit", "AdministradorController@edit");
        Route::put("/{id}/", "AdministradorController@update");
        Route::get("/eliminar/{id}", "AdministradorController@destroy");
        Route::resource("cubiculos", "CubiculoController");
    });

    //Enfermera JEFE
    Route::group(['prefix' => 'enfermera_jefe', "middleware" => "enfermera_jefe"], function () {
        Route::resource('/', 'EnfermeraJefeController');
        Route::post("asignarCubiculo", "EnfermeraJefeController@AsignarCubiculo");
        Route::get("eliminarCubiculo/{cubiculo}/{paciente_cedula}", "EnfermeraJefeController@EliminarCubiculo");
        Route::post("pasar", "EnfermeraJefeController@cambiarDeCubiculo");
    });

    Route::group(['prefix' => 'doctor', "middleware" => "doctor"], function () {
        Route::resource('/', 'DoctorController');
        Route::get("ver/{id}", "DoctorController@show");
        Route::get("eliminar/{id}", "HistoriaClinicaController@destroy");
        Route::get("asignarTratamiento/{historia_clinica_id}", "TratamientoController@AsignarTratamiento");
        Route::post("asignarTratamiento", "TratamientoController@store");
        Route::get("quitarTratamiento/{tratamiento_id}/{historia_clinica_id}", "TratamientoController@destroy");
        Route::get("borrarTratamiento/{tratamiento_id}/{historia_clinica_id}", "TratamientoController@borrar");
    });

    //Enfermera raza
    Route::group(['prefix' => 'enfermera', "middleware" => "enfermera"], function () {
        Route::get("/", "EnfermeraController@index");
        Route::post("add/nota-medica","EnfermeraController@nuevaNotaMedica");
    });
});

//Simulador
Route::group(['prefix' => 'simulador'], function () {
    Route::get("/", function () {
        return view("simulador");
    });
    //URLS para los envios y recepcion de datos de signos vitales
    Route::get("/recepcion/{cubiculo}/{fecha}/{pulso}/{oxigeno}", "SignosVitalesController@SignosVitales");
    Route::get("/leer/", "SignosVItalesController@LecturaSignosVitales");
    Route::get("/medicamento/{cubiculo}", "SignosVItalesController@Medicamentos");
    Route::get("/tratamiento/{tratamiento_id}", "SignosVItalesController@ActualizarTratamiento");
});

//Pagina principal
Route::group(['prefix' => 'principal'], function () {
    Route::get("/", "VentanaPrincipalController@index");
    Route::post("guardarTratamiento", "VentanaPrincipalController@GuardarTratemiento");
    Route::post("guardarNotaMedica", "VentanaPrincipalController@GuardarNotaMedica");
});




//Hasta aqui

Route::resource("/historia_clinica", "HistoriaClinicaController");

Route::get('/{mensaje?}', function ($request = null) {
    $datos = array(
        "mensaje" => $request
    );
    return view('login', $datos);
});
