<?php

namespace p2_v2\Http\Controllers;

use Illuminate\Http\Request;
use p2_v2\Cubiculo;
use p2_v2\SignosVitales;
use p2_v2\Tratamiento;

class SignosVitalesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function SignosVitales($cubiculo, $fecha, $pulso, $oxigeno) {

        /* Procedimiento
         * se verifica que el cubiculo este ocupado
          Se consulta en la tabla CUbiculo, quien esta ahi.
          Se saca la cedula y se coloca en la tabla signos
         */
        //dd($cubiculo);//buscamos este cubiculo
        $cubiculo = Cubiculo::find($cubiculo);
        //primer filtro, si es un objeto todo bien
        if (!is_object($cubiculo)) {
            return "No Guardo";
        }
        $asignacionPaciente = $cubiculo->asignacionPacientes->first();
        $paciente = $asignacionPaciente->paciente;
        //dd($paciente);
        //$id_paciente = Cubiculo::GetCedulaByCubiculo($cubiculo);
        //dd($id_paciente);
        $signo = new SignosVitales();
        $signo->pulso = $pulso;
        $signo->cubiculo = $cubiculo->numero;
        $signo->paciente_id = $paciente->id;
        $signo->so = $oxigeno;
        $signo->fecha_signo = \DateTime::createFromFormat('Y-m-d-H:i:s', $fecha)->format('Y-m-d H:i:s');
        //dd($signo->fecha_signo);
        if ($signo->save()) {
            echo "Guardo";
        } else {
            echo "No Guardo";
        }
    }

    public function Medicamentos($cubiculo) {
        //retornamos los medicamentos que estan relacionados con el cubiculo
        $cubiculo = Cubiculo::find($cubiculo);
        $medicamentos;
        foreach ($cubiculo->asignacionPacientes as $ac){
            //buscamos al paciente
            $medicamentos = $ac->paciente->tratamientos;
        }
        return $medicamentos;
    }

    public function ActualizarTratamiento($tratamiento_id) {
        //Buscamos al tratamiento y lo actualizamos para guardar que ya estuvo su aplicacion
        $tratamiento = Tratamiento::find($tratamiento_id);
        $tratamiento->increment("veces_administrado");
        $tratamiento->save();
        //dd($tratamiento);
    }

    public function LecturaSignosVitales() {
        return SignosVitales::Lectura();
    }

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
