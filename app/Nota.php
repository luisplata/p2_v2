<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model {

    //
    //indicando que no va a usar las marcas de tiempo
    public $timestamps = false;

    public function historiaClinica() {
        return $this->belongsTo('p2_v2\HistoriaClinica');
    }

    public function personal() {
        return $this->belongsTo('p2_v2\Personal');
    }

    public static function GetAll() {
        return Nota::join("historia_clinica", "historia_clinica.id", "notas.historia_clinica_id")
                        ->get();
    }

    public static function Guardar($request) {
        $nota = new Nota();
        $nota->notas = $request->nota;
        $nota->personal_cedula = $request->personal_cedula;
        $nota->historia_clinica_id = $request->historia_clinica_id;
        if ($nota->save()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
