<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    //
	protected $table="tratamiento";
    //indicando que no va a usar las marcas de tiempo
    //public $timestamps = false;

	public static function Guardar($request){
		$tratamiento = new Tratamiento();
		$tratamiento->medicamento = $request->medicamento;
		$tratamiento->dosis = $request->dosis;
		$tratamiento->periocidad = $request->periocidad;
		$tratamiento->paciente_cedula = $request->paciente_cedula;
		//$tratamiento->estado = $request->estado;
		return $tratamiento->save();
	}
	
	public static function Eliminar($id){
		//se cambia el estado del estado para 
		$tratamiento = Tratamiento::find($id);
		$tratamiento->estado = "PRESCRITO";
		return $tratamiento->save();
	}
	public static function GetByPaciente($paciente_cedula){
		return Tratamiento::where(array(
		"estado"=>"VIGENTE",
		"paciente_cedula"=>$paciente_cedula
		))
		->get();
	}
}
