<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model {

    //
    protected $table = "paciente";
    //indicando que no va a usar las marcas de tiempo
    public $timestamps = false;
    //Desactivando el autoincremental de la id
    public $incrementing = false;

    public static function getIdByCedula($cedula) {
        return Paciente::where("cedula", $cedula)->first();
    }

    public function asignacionPacientes() {
        return $this->hasMany('p2_v2\AsignacionPaciente');
    }

    public function tratamientos() {
        return $this->hasMany('p2_v2\Tratamiento');
    }

    public function acompaniantes() {
        return $this->hasMany('p2_v2\Acompaniante');
    }

    public function antecedentes() {
        return $this->hasMany('p2_v2\Antecedente');
    }

    public function signosVitales() {
        return $this->hasMany('p2_v2\SignosVitales');
    }

    public function historiasClinicas() {
        return $this->hasMany('p2_v2\HistoriaClinica');
    }

}
