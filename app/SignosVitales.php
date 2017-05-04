<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;

class SignosVitales extends Model
{
    //

    protected $table = "signos";
    //indicando que no va a usar las marcas de tiempo
    public $timestamps = false;

	public static function Lectura(){
		//hacemos un join con tratamiento para sacar las fechas del tratamiento
		$resultado = SignosVitales::where("visto","0")
		->get();
		//cambiamos el visto por 1
		foreach ($resultado as $result){
			$result->visto = 1;
			$result->save();
		}
		return $resultado;
	}
}
