<?php

namespace p2_v2\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use p2_v2\Personal;

class loginController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
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

    public function login(Request $request) {
        $personal = Personal::BuscarPorCedula($request->cedula);
        if ($personal != null) {
            //validamos la contraseña que envia
            if (sha1($request->pass) != $personal->pass) {
                return redirect("/?mensaje=Usuario o contraseña invalidos");
            }
            //validamos que este activo para ingresar
            if ($personal->estado != "ACTIVADO") {
                //NO ESTA AUTORIZADO
                return redirect("/?mensaje=Usuario o contraseña invalidos");
            }
            if ($personal->tipo == "DOCTOR") {
                //verificamos que venga con un cubiculo si es asi, le madamos el dato
                //del paciente y su cedula
                $dato = "";
                $cubiculo = \p2_v2\Cubiculo::find($request->cubiculo);
                if (is_object($cubiculo)) {
                    $dato = "?paciente=" . $cubiculo->asignacionPacientes[0]->paciente->cedula;
                }
                return redirect("doctor" . $dato);
            } elseif ($personal->tipo == "ENFERMERA_JEFE") {
                return redirect("enfermera_jefe");
            } elseif ($personal->tipo == "ENFERMERA") {
                //verificamos que venga con un cubiculo si es asi, le madamos el dato
                //del paciente y su cedula
                $dato = "";
                $cubiculo = \p2_v2\Cubiculo::find($request->cubiculo);
                if (is_object($cubiculo) && count($cubiculo->asignacionPacientes) > 0 && count($cubiculo->asignacionPacientes[0]->paciente->historiasClinicas) > 0) {

                    $dato = "?historia=" . $cubiculo->asignacionPacientes[0]->paciente->historiasClinicas[0]->id;
                }
                return redirect("enfermera" . $dato);
            } elseif ($personal->tipo == "ADMISIONISTA") {
                return redirect("admisionista");
            } elseif ($personal->tipo == "ADMINISTRADOR") {
                return redirect("administrador");
            }
        } else {
            return redirect("/?mensaje=Usuario o contraseña invalidos");
        }
    }

    public function LogOut() {
        Session::flush(); // removes all session data
        return redirect("/");
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
