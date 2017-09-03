<?php

namespace p2_v2\Http\Controllers;

use Illuminate\Http\Request;
use p2_v2\Paciente;
use p2_v2\Cubiculo;

class EnfermeraJefeController extends Controller {

    public function AsignarCubiculo(Request $request) {
        try {
            if (Cubiculo::Asignar($request)) {
                
            } else {
                throw new \Exception("No asigno");
            }
            return redirect("enfermera_jefe?mensaje=Se asigno el cubiculo con exito&tipo=success");
        } catch (\Exception $ex) {
            return redirect("enfermera_jefe?mensaje=No se asigno, el cubiculo al paciente, puede que ya este asignado&tipo=error");
        }
    }

    public function EliminarCubiculo($cubiculo, $paciente_cedula) {
        //eliminando cubiculo
        try {

            if (Cubiculo::Eliminar($cubiculo, $paciente_cedula)) {
                echo "elimino";
            } else {
                return "No elimino";
            }
            return redirect("enfermera_jefe");
        } catch (\Exception $ex) {
            dd($ex);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
        $datos = array(
            "pacientes" => Paciente::all(),
            "cubiculos" => \p2_v2\AsignacionPaciente::join("paciente", "paciente.id", "asignacion_cubiculos.paciente_id")
                    ->select("paciente.nombre as paciente_nombre", "cubiculo_numero", "paciente.cedula as paciente_cedula")
                    ->get(),
            "listaCubiculos" => Cubiculo::all()
        );
        return view("EnfermeraJefe.index", $datos);
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
