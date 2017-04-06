<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    //
    protected $table = "paciente";
    //indicando que no va a usar las marcas de tiempo
    public $timestamps = false;
	//definiendo la clave primaria
	protected $primaryKey = "cedula";
	//Desactivando el autoincremental de la id
	public $incrementing = false;
}
