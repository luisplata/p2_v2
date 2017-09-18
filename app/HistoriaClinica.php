<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;

class HistoriaClinica extends Model
{
    //
	protected $table = "historia_clinica";
	//indicando que no va a usar las marcas de tiempo
    public $timestamps = false;
	
	public static function GetHistoriaByCedula($cedula){
		return HistoriaClinica::where("paciente_cedula",$cedula)->first();
	}
	
	public static function Guardar($request){
		
		$historiaClinica = new HistoriaClinica();
		$historiaClinica->historia = $request->historia;
		$historiaClinica->paciente_id = Paciente::getIdByCedula($request->paciente_cedula)->id;
		
		return $historiaClinica->save();
		
	}
	
	public static function GetAll(){
		return HistoriaClinica::join("paciente", "paciente.id","historia_clinica.paciente_id")
		->select(
		"historia_clinica.*",
		"paciente.nombre as paciente_nombre",
		"paciente.cedula as paciente_cedula"
		)
		->get();
	}
	
	public static function Actualizar($request,$id){
		$historia = HistoriaClinica::find($id);
		$historia->historia = $request->historia;
		return $historia->save();
	}
	
	public static function Eliminar($id){
		//Para eliminar una historia clinica de forma efectiva 
		/* Eliminar 
		- los tratamientos
		- acompañantes
		- paciente
		- cubiculo
		- signos
		
		*/
		return HistoriaClinica::destroy($id);
	}
}
