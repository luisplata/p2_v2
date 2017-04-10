<?php

namespace p2_v2;

use Illuminate\Database\Eloquent\Model;

class SignosVitales extends Model
{
    //

    protected $table = "signos";
    //indicando que no va a usar las marcas de tiempo
    public $timestamps = false;

}
