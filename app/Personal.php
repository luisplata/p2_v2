<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Personal extends Model {

    //nombre de la tabla a la cual va consultar
    protected $table = "personal";
    //indicando que no va a usar las marcas de tiempo
    public $timestamps = false;
    //definiendo la clave primaria
    protected $primaryKey = "cedula";
    //Desactivando el autoincremental de la id
    public $incrementing = false;

    public static function isDoctor($cedula) {
        $personal = Personal::find($cedula);
        if (!is_object($personal)) {
            return FALSE;
        }
        return $personal->tipo == "DOCTOR";
    }

    public static function isEnfermera($cedula) {
        $personal = Personal::find($cedula);
        if (!is_object($personal)) {
            return FALSE;
        }
        return $personal->tipo == "ENFERMERA" || $personal->tipo == "ENFERMERA_JEFE";
    }

    public static function Buscar($cedula) {
        $personalBuscado = Personal::where("cedula", $cedula)->first();
        if (is_object($personalBuscado)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function BuscarPorCedula($cedula) {
        $personal = Personal::where("cedula", $cedula)->first();
        if (is_object($personal)) {
            Session::put("personal", $personal);
            return $personal;
        } else {
            return null;
        }
    }

    public static function Guardar($request) {
        $personal = new Personal();
        $personal->nombre = $request->nombre;
        $personal->cedula = $request->cedula;
        $personal->direccion = $request->direccion;
        $personal->telefono = $request->telefono;
        $personal->tipo = $request->tipo;
        $personal->sexo = $request->sexo;
        $personal->pass = $request->pass;
        if ($personal->save()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function Desactivar($cedula) {
        $persona = Personal::where("cedula", $cedula)->first();
        $persona->estado = "DESACTIVADO";
        if ($persona->save()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public static function Activar($cedula) {
        $persona = Personal::where("cedula", $cedula)->first();
        $persona->estado = "ACTIVADO";
        if ($persona->save()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
