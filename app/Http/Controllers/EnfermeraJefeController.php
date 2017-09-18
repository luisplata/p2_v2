<?php

namespace p2_v2\Http\Controllers;

use Illuminate\Http\Request;
use p2_v2\Paciente;
use p2_v2\Cubiculo;

class EnfermeraJefeController extends Controller {

    public function AsignarCubiculo(Request $request) {
        try {
            if (is_null($request->numero)) {
                return redirect("enfermera_jefe?mensaje=No hay cubiculos disponibles&tipo=error");
            }
            if (Cubiculo::Asignar($request)) {
                
            } else {
                throw new \Exception("No asigno");
            }
            return redirect("enfermera_jefe?mensaje=Se asigno el cubiculo con exito&tipo=success");
        } catch (\Exception $ex) {
            return redirect("enfermera_jefe?mensaje=No se asigno el cubiculo al paciente, puede que ya este cubiculo fue asignado a un paciente o ya el paciente este en otro cubiculo&tipo=error");
        }
    }

    public function EliminarCubiculo($cubiculo, $paciente_cedula) {
        //Dando de alta al paciente
        /* se optienen el paciente
         * antecedente
         * acompañante
         * 
         */
        try {

            if (Cubiculo::Eliminar($cubiculo, $paciente_cedula)) {
                echo "elimino";
            } else {
                return "No elimino";
            }
            return redirect("enfermera_jefe");
        } catch (\Exception $ex) {
            //dd($ex);
            return redirect("enfermera_jefe?mensaje=No se elimino&tipo=error");
        }
    }

    public function cambiarDeCubiculo(Request $request) {
        //validaciones
        if ($request->cubiculo_origen == $request->cubiculo_destino) {
            return redirect("enfermera_jefe?mensaje=No puedes mandarlo al mismo cubiculo");
        }
        $cubiculo_ocupado = \p2_v2\AsignacionPaciente::where("cubiculo_numero", $request->cubiculo_destino)->first();
        //dd($cubiculo_ocupado);
        if (is_object($cubiculo_ocupado)) {
            //sugnifica que si ya hay alguien en el cubiculo
            return redirect("enfermera_jefe?mensaje=El cubiculo destino ya esta ocupado&tipo=error");
        }
        if (is_null($request->cubiculo_destino)) {
            return redirect("enfermera_jefe?mensaje=No hay cubiculos disponibles&tipo=error");
        }
        //cambiamos al paciente de cubiculo
        //buscamos el cubiculo origen
        $cubiculo = \p2_v2\AsignacionPaciente::where("cubiculo_numero", $request->cubiculo_origen)->first();
        //cambiamos el numero del cubiculo por el destino
        $cubiculo->cubiculo_numero = $request->cubiculo_destino;
        //guardamos el cubiculo por el nuevo
        if ($cubiculo->save()) {
            return redirect("enfermera_jefe?mensaje=Se movio al paciente de cubiculo&tipo=success");
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
            "listaCubiculos" => Cubiculo::all(),
            "listaCubiculosDesocupados" => Cubiculo::leftjoin("asignacion_cubiculos", "cubiculo.numero", "asignacion_cubiculos.cubiculo_numero")->where("asignacion_cubiculos.cubiculo_numero", null)->get()
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
