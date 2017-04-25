<?php

namespace p2_v2\Http\Controllers;

use Illuminate\Http\Request;
use p2_v2\Cubiculo;
use p2_v2\Tratamiento;
use p2_v2\Nota;

class VentanaPrincipalController extends Controller
{
    //
	public function index(){
		$datos = array(
			"cubiculos"=>Cubiculo::GetDataByCubiculoAndUser(),
			"tratamientos"=>Tratamiento::GetAll(),
			"notas"=>Nota::GetAll()
		);
		//dd($datos);
		return view("PaginaPrincipal.principal",$datos);
	}
}
