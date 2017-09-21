<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;

class Antecedente extends Model {

    //
    public $timestamps = false;

    public function paciente() {
        return $this->belongsTo('p2_v2\Paciente');
    }

}
