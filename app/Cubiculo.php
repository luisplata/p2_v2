<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;

class Cubiculo extends Model {

    //
    protected $table = "cubiculo";
    //indicando que no va a usar las marcas de tiempo
    public $timestamps = false;
    //definiendo la clave primaria
    protected $primaryKey = "numero";
    //Desactivando el autoincremental de la id
    public $incrementing = false;

   

    public static function Asignar($request) {
        
        $cubiculo = new AsignacionPaciente();
        $cubiculo->cubiculo_numero = $request->numero;
        $cubiculo->paciente_id = Paciente::getIdByCedula($request->paciente_cedula)->id;
        //Validamos que el paciente no tenga un cubiculo asignado
        $asignado = AsignacionPaciente::where("paciente_id", Paciente::getIdByCedula($request->paciente_cedula)->id)->first();
        if (is_object($asignado)) {
            return FALSE;
        }
        //Se tiene que validar que el cubiculo no tenga ya un paciente
        //Esto lo vamos a hacer buscando primero en le cubiculo no haya otra persona
        //y son dos valicaciones: Que el cubiculo no tenga alguien mas
        //que el paciente no este asignado ya en un cubiculo
        $cubiculo_ocupado = AsignacionPaciente::where("cubiculo_numero",$request->numero)->first();
        if(!is_null($cubiculo_ocupado)){
            //sugnifica que si ya hay alguien en el cubiculo
            return FALSE;
        }
        if ($cubiculo->save()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function ELiminar($numero, $paciente_cedula) {
        $asignacion_cubiculo = AsignacionPaciente::where("cubiculo_numero", $numero)->where("paciente_id", Paciente::getIdByCedula($paciente_cedula)->id)->first();
        //dd($asignacion_cubiculo);
        if ($asignacion_cubiculo->delete()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function GetCedulaByCubiculo($cubiculo) {
        $c = Cubiculo::where("numero", $cubiculo)->first()->paciente_id;
        if(is_object($c)){
            return $c;
        }else{
            return null;
        }
    }

     public function asignacionPacientes()
    {
        return $this->hasMany('p2_v2\AsignacionPaciente');
    }
}
