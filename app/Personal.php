<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Personal extends Model
{
    //nombre de la tabla a la cual va consultar
    protected $table = "personal";
    //indicando que no va a usar las marcas de tiempo
    public $timestamps = false;

    public static function Buscar($cedula){
        $personalBuscado = Personal::where("cedula",$cedula)->first();
        if(is_object($personalBuscado)){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public static function BuscarPorCedula($cedula){
        $personal = Personal::where("cedula",$cedula)->first();
        if(is_object($personal)){
            Session::put("personal",$personal);
            return $personal;
        }else{
            return null;
        }
    }
}
