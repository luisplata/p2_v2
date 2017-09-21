<?php

namespace p2_v2\Http\Controllers;

use p2_v2\Tratamiento;
use Illuminate\Http\Request;
use p2_v2\HistoriaClinica;

class TratamientoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    public function AsignarTratamiento($historia_id) {
        $historia = HistoriaClinica::where("historia_clinica.id", $historia_id)
                ->first();
        $datos = [
            "historia" => $historia,
            "tratamientos" => Tratamiento::GetByPaciente($historia->paciente_id)
        ];
        return view("Tratamiento.agregar", $datos);
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
        if (Tratamiento::Guardar($request)) {
            return redirect("/doctor/asignarTratamiento/" . $request->historia_id);
        } else {
            return redirect("/doctor/asignarTratamiento/" . $request->historia_id . "?mensaje=No se guardo el tratamiento");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \p2_v2\Tratamiento  $tratamiento
     * @return \Illuminate\Http\Response
     */
    public function show(Tratamiento $tratamiento) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \p2_v2\Tratamiento  $tratamiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Tratamiento $tratamiento) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \p2_v2\Tratamiento  $tratamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tratamiento $tratamiento) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \p2_v2\Tratamiento  $tratamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy($tratamiento_id, $historia_id) {
        //
        //dd($historia_id);
        if (Tratamiento::Eliminar($tratamiento_id)) {
            return redirect("doctor/asignarTratamiento/" . $historia_id);
        } else {
            return redirect("doctor/asignarTratamiento/" . $historia_id . "?mensaje=No se logro quitar el tratamiento");
        }
    }
    public function borrar($tratamiento_id, $historia_id) {
        //
        //dd($historia_id);
        if (Tratamiento::borrar($tratamiento_id)) {
            return redirect("doctor/asignarTratamiento/" . $historia_id);
        } else {
            return redirect("doctor/asignarTratamiento/" . $historia_id . "?mensaje=No se logro quitar el tratamiento");
        }
    }

}
