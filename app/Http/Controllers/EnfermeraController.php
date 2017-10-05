<?php

namespace p2_v2\Http\Controllers;

use Illuminate\Http\Request;

class EnfermeraController extends Controller
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
            "historias" => \p2_v2\HistoriaClinica::GetAll()
        ];
        return view("enfermera.index",$datos);
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
        //se crea la nota medica
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function nuevaNotaMedica(Request $request) {
        //adicionamos la nueva nota medica
        //dd(session());
        try{
            
        $nota = new \p2_v2\Nota();
        $nota->historia_clinica_id = $request->historia_id;
        $nota->personal_id = session("personal")->id;
        $nota->notas = $request->nota;
        if($nota->save()){
            return redirect("enfermera?mensaje=Se adiciono la nota medica con exito&tipo=success");
        }
        throw new \Exception("No se pudo ingresar");
        
        } catch (Exception $ex) {
            return redirect("enfermera?mensaje=No se pudo ingresar la nota medica&tipo=error");
        }
    }
}
