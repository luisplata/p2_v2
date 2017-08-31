<?php

namespace p2_v2\Http\Controllers;

use Illuminate\Http\Request;
use p2_v2\Admisionista;
use p2_v2\Paciente;

class AdmisionistaController extends Controller {

    //
    public function GuardarPaciente(Request $request) {

        if (Admisionista::GuardarPaciente($request)) {
            return redirect("/admisionista?mensaje=Se guardo el pacente&tipo=success");
        } else {
            return redirect("/admisionista?mensaje=No se guardo el paciente porque ya existe&tipo=warning");
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $datos = array(
            "pacientes" => Paciente::all()
        );
        return view("Admisionista.index", $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
        if (Personal::Guardar($request)) {
            return redirect("administrador");
        } else {
            return redirect("administrador");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
