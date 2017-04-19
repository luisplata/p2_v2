<?php

namespace p2_v2\Http\Controllers;

use p2_v2\Doctor;
use Illuminate\Http\Request;
use p2_v2\Paciente;
use p2_v2\HistoriaClinica;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
		$datos = [
		"pacientes"=>Paciente::all(),
		"historias"=>HistoriaClinica::GetAll()
		];
		return view("Doctor.index",$datos);
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
		if(HistoriaClinica::Guardar($request)){
			return redirect("doctor");
		}else{
			return redirect("doctor?mensaje=No se guardo la historia clinica");
		}
    }

    /**
     * Display the specified resource.
     *
     * @param  \p2_v2\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
		$datos = [
		"historia"=>HistoriaClinica::find($id)
		];
		//dd(HistoriaClinica::find($id));
		return view("HistoriaClinica.detalle",$datos);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \p2_v2\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \p2_v2\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \p2_v2\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
