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


}
