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

    public static function GetDataByCubiculoAndUser() {
        return Cubiculo::select(
                                "cubiculo.numero", "paciente.cedula", "paciente.nombre", "paciente.telefono", "paciente.direccion", "paciente.sexo", "paciente.tipo_sangre", "paciente.RH"
                        )
                        ->join("paciente", "paciente.cedula", "cubiculo.paciente_cedula")
                        //->join("notas","paciente.cedula","notas.paciente_cedula")
                        //->join("tratamiento","paciente.cedula","tratamiento.paciente_cedula")
                        ->orderBy("cubiculo.numero")
                        ->get();
    }

    public static function Asignar($request) {
        $cubiculo = new AsignacionPaciente();
        $cubiculo->cubiculo_numero = $request->numero;
        $cubiculo->paciente_id = Paciente::getIdByCedula($request->paciente_cedula)->id;
        //Validamos que el paciente no tenga un cubiculo asignado
        $asignado = AsignacionPaciente::where("paciente_id", Paciente::getIdByCedula($request->paciente_cedula)->id)->first();
        if (is_object($asignado)) {
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
        return Cubiculo::where("numero", $cubiculo)->first()->paciente_cedula;
    }

}
