<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    //
	//indicando que no va a usar las marcas de tiempo
    public $timestamps = false;
	
	public static function GetAll(){
		return Nota::join("historia_clinica","historia_clinica.id","notas.historia_clinica_id")
		->get();
	}
}
