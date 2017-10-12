<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model {

    //
    protected $table = "tratamiento";

    //indicando que no va a usar las marcas de tiempo
    //public $timestamps = false;

    public static function Guardar($request) {
        $tratamiento = new Tratamiento();
        $tratamiento->medicamento = $request->medicamento;
        $tratamiento->dosis = $request->dosis . " " . $request->unidad;
        $tratamiento->periocidad = $request->periocidad . " Horas";
        $tratamiento->paciente_id = $request->paciente_id;
        $tratamiento->personal_id = session("personal")->id;
        //validamos si es un doctor
        if (Personal::isDoctor(session("personal")->cedula)) {
            return $tratamiento->save();
        } else {
            return FALSE;
        }
    }

    public static function Eliminar($id) {
        //se cambia el estado del estado para 
        $tratamiento = Tratamiento::find($id);
        $tratamiento->estado = "PRESCRITO";
        return $tratamiento->save();
    }

    public static function borrar($id) {
        //se cambia el estado del estado para 
        $tratamiento = Tratamiento::find($id);
        //$tratamiento->estado = "PRESCRITO";
        return $tratamiento->delete();
    }

    public static function GetByPaciente($paciente_id) {
        return Tratamiento::where(array(
                            "estado" => "VIGENTE",
                            "paciente_id" => $paciente_id
                        ))
                        ->get();
    }

    public static function GetAll() {
        return Tratamiento::where(array(
                            "estado" => "VIGENTE"
                        ))
                        ->get();
    }

    public function paciente() {
        return $this->belongsTo('p2_v2\Paciente');
    }

    public function personal() {
        return $this->belongsTo("p2_v2\Personal", "personal_id");
    }

}
