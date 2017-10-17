<?php

namespace p2_v2\Http\Controllers;

use p2_v2\HistoriaClinica;
use Illuminate\Http\Request;

class HistoriaClinicaController extends Controller {

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
     * @param  \p2_v2\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
    public function show(HistoriaClinica $historiaClinica) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \p2_v2\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
    public function edit(HistoriaClinica $historiaClinica) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \p2_v2\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $historiaClinica_id) {
        //
        if (HistoriaClinica::Actualizar($request, $historiaClinica_id)) {
            return redirect("doctor");
        } else {
            return redirect("doctor?mensaje=no se actualizo la hisoria clinica");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \p2_v2\HistoriaClinica  $historiaClinica
     * @return \Illuminate\Http\Response
     */
    public function destroy($historiaClinica_id) {
        //
        if (HistoriaClinica::Eliminar($historiaClinica_id)) {
            return redirect("doctor");
        } else {
            return redirect("doctor?mensaje=no se Elimino la hisoria clinica");
        }
    }

}
