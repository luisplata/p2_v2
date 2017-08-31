<?php

namespace p2_v2\Http\Controllers;

use Illuminate\Http\Request;
use p2_v2\Personal;

class AdministradorController extends Controller {

    public function Desactivar($cedula) {
        if (Personal::Desactivar($cedula)) {
            
        } else {
            
        }
        return redirect("administrador");
    }

    public function Activar($cedula) {
        if (Personal::Activar($cedula)) {
            
        } else {
            
        }
        return redirect("administrador");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //El personal que esta ingresado
        $datos = array(
            "personal" => Personal::all()
        );
        return view("Administrador.index", $datos);
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
            return redirect("administrador?mensaje=El usuario ha sido guardado correctamente&tipo=success");
        } else {
            return redirect("administrador?mensaje=El personal ya esta registrado");
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
        $personal = Personal::find($id);
        //dd($personal);
        if(!is_object($personal)){
            return redirect("administrador?mensaje=El usuario que desea modificar no existe");
        }
        return view("Administrador.edit",$personal);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //Actualizamos al personal que biene por parametro
        $personal = Personal::find($id);
        if(!is_object($personal)){
            return redirect("administrador?mensaje=El usuario que desea modificar no existe");
        }
        $personal->nombre = $request->nombre;
        $personal->telefono = $request->telefono;
        $personal->tipo = $request->tipo;
        $personal->sexo = $request->sexo;
        $personal->direccion = $request->direccion;
        if($personal->save()){
            return redirect("administrador?mensaje=El usuario fue modificado&tipo=success");
        }else{
            return redirect("administrador?mensaje=No fue psible modificarlo");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //eliminamos al que pase por aqui
        $personal = Personal::find($id);
        if(!is_object($personal)){
            return redirect("administrador?mensaje=El usuario que desea eliminar no existe");
        }
        if($personal->delete()){
            return redirect("administrador?mensaje=El usuario ha sido eliminado con exito&tipo=success");
        }
        
    }

}
