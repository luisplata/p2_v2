<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admisionista extends Model {

    //
    public static function GuardarPaciente($array) {
        DB::beginTransaction();
        try {
            $paciente = new Paciente();
            $paciente->nombre = $array->nombre;
            $paciente->cedula = $array->cedula;
            $paciente->telefono = $array->telefono;
            $paciente->direccion = $array->direccion;
            $paciente->sexo = $array->sexo;

            if ($paciente->save()) {
                $antecedentes = new Antecedente();
                $antecedentes->nombre_proce = $array->nombre_proce;
                $antecedentes->alergias = $array->alergias;
                $antecedentes->ant_familiares = $array->ant_familiares;
                $antecedentes->ant_personales = $array->ant_personales;
                $antecedentes->tipo = $array->tipo;
                $antecedentes->paciente_cedula = $paciente->cedula;
                //guardamos el antecedente
                if ($antecedentes->save()) {
                    //guardamos al acompañante
                    $acompaniante = new Acompaniante();
                    $acompaniante->cedula = $array->acompaniante_cedula;
                    $acompaniante->nombre = $array->acompaniante_nombre;
                    $acompaniante->direccion = $array->acompaniante_direccion;
                    $acompaniante->telefono = $array->acompaniante_telefono;
                    $acompaniante->sexo = $array->acompaniante_sexo;
                    $acompaniante->paciente_cedula = $paciente->cedula;
                    //guardamos a su acompañante
                    if ($acompaniante->save()) {
                        
                    }
                }
            }
            DB::commit();
            return TRUE;
        } catch (Exception $ex) {
            DB::rollBack();
            return FALSE;
        }
    }

}
