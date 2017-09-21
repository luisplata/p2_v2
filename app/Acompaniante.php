<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;

class Acompaniante extends Model {

    //
    protected $table = "acompanante";
    public $timestamps = false;

    public function paciente() {
        return $this->belongsTo('p2_v2\Paciente');
    }

}
