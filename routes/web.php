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

Route::group(['middleware' => 'TipoDoctor'], function () {

});

Route::post('/login', 'loginController@login');


//Rutas del admisionista

Route::get("admisionista",function (){
    return view("admisionista_inicio");
});

Route::post("admisionista/registrarPaciente","AdmisionistaController@GuardarPaciente");

//Hasta aqui