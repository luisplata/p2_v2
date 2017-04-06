<?php

namespace p2_v2\Http\Controllers;

use Illuminate\Http\Request;

use p2_v2\Paciente;
use p2_v2\Cubiculo;

class EnfermeraJefeController extends Controller
{
	public function AsignarCubiculo(Request $request){
		if(Cubiculo::Asignar($request)){
			
		}else{
			return "No Guardo";
		}
		return redirect("enfermera_jefe");
	}
	
	public function EliminarCubiculo($cubiculo,$paciente_cedula){
		//eliminando cubiculo
		if(Cubiculo::Eliminar($cubiculo,$paciente_cedula)){
			
		}else{
			return "No elimino";
		}
		return redirect("enfermera_jefe");
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$datos = array(
			"pacientes"=>Paciente::all(),
			"cubiculos"=>Cubiculo::GetAll()
		);
		return view("EnfermeraJefe.index",$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
