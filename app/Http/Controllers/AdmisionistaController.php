<?php

namespace p2_v2\Http\Controllers;

use Illuminate\Http\Request;
use p2_v2\Admisionista;

class AdmisionistaController extends Controller
{
    //
    public function GuardarPaciente(Request $request){
        //echo $request->nombre;
        if(Admisionista::GuardarPaciente($request)){

        }else{

        }
        return redirect("/admisionista");
    }
}
