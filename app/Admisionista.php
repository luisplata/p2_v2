<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;

class Admisionista extends Model
{
    //
    public static function GuardarPaciente($array){
        $paciente = new Paciente();
        $paciente->nombre = $array->nombre;
        $paciente->cedula = $array->cedula;
        $paciente->telefono = $array->telefono;
        $paciente->direccion = $array->direccion;
        $paciente->sexo = $array->sexo;

        if($paciente->save()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
