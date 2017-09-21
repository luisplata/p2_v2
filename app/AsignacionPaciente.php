<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;

class AsignacionPaciente extends Model {

    //
    protected $primaryKey = "cubiculo_numero";
    public $timestamps = false;
    //definiendo la clave primaria
    public $incrementing = false;
    protected $table = "asignacion_cubiculos";

    public static function GetDataByCubiculoAndUser() {
        return AsignacionPaciente::select(
                                "cubiculo.numero", "paciente.id", "paciente.cedula", "paciente.nombre", "paciente.telefono", "paciente.direccion", "paciente.sexo", "paciente.tipo_sangre", "paciente.RH"
                        )
                        ->join("paciente", "paciente.id", "asignacion_cubiculos.paciente_id")
                        ->join("cubiculo", "cubiculo.numero", "asignacion_cubiculos.cubiculo_numero")
                        ->orderBy("cubiculo.numero")
                        ->get();
    }

   
    public function cubiculo()
    {
        return $this->belongsTo('p2_v2\Cubiculo');
    }
    
    public function paciente()
    {
        return $this->belongsTo('p2_v2\Paciente');
    }
}
