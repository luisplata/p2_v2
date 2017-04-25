<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;

class Cubiculo extends Model
{
	//
    protected $table = "cubiculo";
    //indicando que no va a usar las marcas de tiempo
    public $timestamps = false;
	//definiendo la clave primaria
	protected $primaryKey = "numero";
	//Desactivando el autoincremental de la id
	public $incrementing = false;

	public static function GetDataByCubiculoAndUser(){
		return
		Cubiculo::select(
		"cubiculo.numero",
		"paciente.cedula",
		"paciente.nombre",
		"paciente.telefono",
		"paciente.direccion",
		"paciente.sexo",
		"paciente.tipo_sangre",
		"paciente.RH"
		)
		->join("paciente","paciente.cedula","cubiculo.paciente_cedula")
		//->join("notas","paciente.cedula","notas.paciente_cedula")
		//->join("tratamiento","paciente.cedula","tratamiento.paciente_cedula")
		->orderBy("cubiculo.numero")
		->get()
		
		//->
		;
	}
	
	public static function Asignar($request){
		$cubiculo = new Cubiculo();
		$cubiculo->numero = $request->numero;
		$cubiculo->paciente_cedula = $request->paciente_cedula;
		if($cubiculo->save()){
			return TRUE;
		}else{
			return FALSE;
		}
	}
	
	public static function ELiminar($numero,$paciente_cedula){
		
		if(Cubiculo::destroy($numero)){
			return TRUE;	
		}else{
			return FALSE;
		}
	}
	
	public static function GetAll(){
		return Cubiculo::join("paciente","paciente.cedula","cubiculo.paciente_cedula")->get();
	}

	public static function GetCedulaByCubiculo($cubiculo){
	    return Cubiculo::where("numero",$cubiculo)->first()->paciente_cedula;
    }
}
