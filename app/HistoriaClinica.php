<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;

class HistoriaClinica extends Model {

    //
    protected $table = "historia_clinica";
    //indicando que no va a usar las marcas de tiempo
    public $timestamps = false;

    public function paciente() {
        return $this->belongsTo('p2_v2\Paciente');
    }

    public function notas() {
        return $this->hasMany('p2_v2\Nota');
    }

    public static function GetHistoriaByCedula($cedula) {
        return HistoriaClinica::where("paciente_cedula", $cedula)->first();
    }

    public static function Guardar($request) {
        //Validamos que el paciente que le vamos a colocar la historia no tenga una ya
        $paciente = Paciente::getIdByCedula($request->paciente_cedula);
        if(!is_object($paciente)){
            return FALSE;
        }
        $historias = $paciente->historiasClinicas;
        //dd(sizeof($historias));
        if(sizeof($historias) > 0){
            //significa que tuene una historia clinica lo mandamos a la mierda
            return FALSE;
        }
        $historiaClinica = new HistoriaClinica();
        $historiaClinica->historia = $request->historia;
        $historiaClinica->paciente_id = Paciente::getIdByCedula($request->paciente_cedula)->id;
        $historiaClinica->personal_id = session("personal")->id;
        if(Personal::isDoctor(session("personal")->cedula)){
            return $historiaClinica->save();
        }else{
            return FALSE;
        }
    }

    public static function GetAll() {
        return HistoriaClinica::join("paciente", "paciente.id", "historia_clinica.paciente_id")
                        ->select(
                                "historia_clinica.*", "paciente.nombre as paciente_nombre", "paciente.cedula as paciente_cedula"
                        )
                        ->get();
    }

    public static function Actualizar($request, $id) {
        $historia = HistoriaClinica::find($id);
        $historia->historia = $request->historia;
        return $historia->save();
    }

    public static function Eliminar($id) {
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
