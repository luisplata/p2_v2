<?php

namespace p2_v2\Http\Controllers;

use Illuminate\Http\Request;
use p2_v2\Cubiculo;
use p2_v2\Tratamiento;
use p2_v2\Nota;
use p2_v2\Personal;
use p2_v2\Paciente;
use p2_v2\HistoriaClinica;

class VentanaPrincipalController extends Controller
{
    //GuardarNotaMedica
	
	public function GuardarNotaMedica(Request $request){
		//VALIDAMOS QUE SEA AUTORIZADO
		
		if(!Personal::isEnfermera($request->personal_cedula)){
			return redirect("/principal?mensaje=No eres un Enfermer@ para realizar esta accion");
		}
		$paciente = Paciente::find(Cubiculo::GetCedulaByCubiculo($request->cubiculo));
		//Valida que tenga historia clinica
		if(!is_object(HistoriaClinica::GetHistoriaByCedula($paciente->cedula))){
			return redirect("/principal?mensaje=Necesita Tener una historia clinica para poder asignar una nota medica");
		}
		
		
		$historia = HistoriaClinica::GetHistoriaByCedula($paciente->cedula);
		$request->historia_clinica_id = $historia->id;
		if(Nota::Guardar($request)){
			return redirect("/principal");
		}else{
			return redirect("/principal?mensaje=No se guardo la nota medica");
		}
	}
	
	public function GuardarTratemiento(Request $request){
		
		if(!Personal::isDoctor($request->documento)){
			return redirect("/principal?mensaje=No eres un doctor para realizar esta accion");
		}
		
		
		$cedula_paciente = Cubiculo::GetCedulaByCubiculo($request->cubiculo);
		$request->paciente_cedula = $cedula_paciente;
		if(Tratamiento::Guardar($request)){
			
		}else{
			
		}
		return redirect("/principal");
		
	}
	
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
