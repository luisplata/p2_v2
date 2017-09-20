<?php

namespace p2_v2\Http\Controllers;

use Illuminate\Http\Request;
use p2_v2\Admisionista;
use p2_v2\Paciente;
use Illuminate\Support\Facades\DB;

class AdmisionistaController extends Controller {

    //
    public function GuardarPaciente(Request $request) {

        if (Admisionista::GuardarPaciente($request)) {
            return redirect("/admisionista?mensaje=Se guardo el pacente&tipo=success");
        } else {
            return redirect("/admisionista?mensaje=No se guardo el paciente porque ya existe&tipo=warning");
        }
    }

    public function modificarPaciente($id) {
        //Buscamos al paciente y lo mandamos a la vista
        $paciente = Paciente::find($id);
        if (!is_object($paciente)) {
            return redirect("admisionista?mensaje=El paciente que desea modificar no existe&tipo=error");
        }
        $antecedentes = \p2_v2\Antecedente::where("paciente_id", $paciente->id)->first();
        $acompaniante = \p2_v2\Acompaniante::where("paciente_id", $paciente->id)->first();
        $datos = array(
            "paciente" => $paciente,
            "antecedente" => is_object($antecedentes) ? $antecedentes : new \p2_v2\Antecedente(),
            "acompaniante" => is_object($acompaniante) ? $acompaniante : new \p2_v2\Acompaniante()
        );
        return view("Admisionista.editarPaciente", $datos);
    }

    public function editarPaciente(Request $request, $id) {
        DB::beginTransaction();
        try {
            $paciente = Paciente::find($id);

            if (!is_object($paciente)) {
                throw new \Exception("El paciente, No existe");
            }
            $paciente->cedula = $request->cedula;
            $paciente->nombre = $request->nombre;
            $paciente->telefono = $request->telefono;
            $paciente->edad = $request->edad;
            $paciente->direccion = $request->direccion;
            $paciente->sexo = $request->sexo;
            $divicion = explode(" ", $request->tipo_sangre);
            $paciente->tipo_sangre = $divicion[0];
            $paciente->RH = $divicion[1];

            if ($paciente->save()) {

                $antecedentes = \p2_v2\Antecedente::where("paciente_id", $paciente->id)->first();
                $antecedentes = is_object($antecedentes) ? $antecedentes : new \p2_v2\Antecedente();
                $antecedentes->nombre_proce = $request->nombre_proce;
                $antecedentes->alergias = $request->alergias;
                $antecedentes->ant_familiares = $request->ant_familiares;
                $antecedentes->ant_personales = $request->ant_personales;
                $antecedentes->tipo = $request->tipo;
                $antecedentes->paciente_id = $paciente->id;
                //guardamos el antecedente
                if (!is_null($request->tipo)) {
                    $antecedentes->save();
                }
                //guardamos al acompañante
                $acompaniante = \p2_v2\Acompaniante::where("cedula", $request->acompaniante_cedula)->first();
                $acompaniante = is_object($acompaniante) ? $acompaniante : new \p2_v2\Acompaniante();
                $acompaniante->cedula = $request->acompaniante_cedula;
                $acompaniante->nombre = $request->acompaniante_nombre;
                $acompaniante->direccion = $request->acompaniante_direccion;
                $acompaniante->telefono = $request->acompaniante_telefono;
                $acompaniante->sexo = $request->acompaniante_sexo;
                $acompaniante->paciente_id = $paciente->id;
                //guardamos a su acompañante
                if (!is_null($request->acompaniante_cedula)) {
                    $acompaniante->save();
                }
            }
            DB::commit();
            return redirect("admisionista?mensaje=El paciente ha sido modificado&tipo=success");
        } catch (\Exception $ex) {
            DB::rollBack();
            return redirect("admisionista?mensaje=Error al modificar paciente, puede que la cedula ya este registrada&tipo=error");
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
