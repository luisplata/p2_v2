<?php

namespace p2_v2\Http\Controllers;

use Illuminate\Http\Request;

class CubiculoController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //Listado de cubixculos
        //busqueda de los cubiculos
        $cubiculos = \p2_v2\Cubiculo::all();
        $datos = array("cubiculos" => $cubiculos);
        return view("cubiculo.index", $datos);
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
        //crear el cibiculo
        try {

            $cubiculo = new \p2_v2\Cubiculo();
            $cubiculo->numero = $request->numero;
            if ($cubiculo->save()) {
                return redirect("administrador/cubiculos?mensaje=Se guardo el cubiculo correctamente&tipo=success");
            } else {
                return redirect("administrador/cubiculos?mensaje=no se guardo el cubiculo, puede que ya exista&tipo=error");
            }
        } catch (\Exception $ex) {
            return redirect("administrador/cubiculos?mensaje=no se guardo el cubiculo, puede que ya exista&tipo=error");
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
        //Eliminamos el cubiculo
        try{
            \p2_v2\Cubiculo::destroy($id);
            return redirect("administrador/cubiculos?mensaje=Se elimino correctamente el cubiculo&tipo=success");
        } catch (\Exception $ex) {
return redirect("administrador/cubiculos?mensaje=No se elimino, puede que haya un paciente en el&tipo=error");
        }
        
    }

}
