@extends("plantilla.app")

@section("plugin-css")

@endsection

@section("contenido")
{{Form::open(array("url"=>"admisionista/paciente/modificar/".$paciente->id, "id"=>"formulario"))}}

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" value="{{$paciente->nombre}}" class="form-control has-feedback-left" id="paciente_nombre" name="nombre" placeholder="Nombre" required />
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="number" value="{{$paciente->cedula}}" max="999999999999" class="form-control has-feedback-left" id="paciente_cedula" placeholder="Cedula" name="cedula" required />
    <span class="glyphicon glyphicon-credit-card form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="number" max="9999999999" class="form-control has-feedback-left" id="paciente_telefono" placeholder="Telefono" name="telefono" required value="{{$paciente->telefono}}" />
    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="paciente_direccion" placeholder="direccion" name="direccion" required value="{{$paciente->direccion}}" />
    <span class="glyphicon glyphicon-map-marker form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="TEXT" min="1" max="200" class="form-control has-feedback-left" id="paciente_edad" placeholder="edad" name="edad" required value="{{$paciente->edad}}" />
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="clearfix"></div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <label>Grupo y RH *</label>
    <select class="form-control required" required="required" name="tipo_sangre">
        <option value="">Debe Seleccionar un tipo de sangre</option>
        <option value="O -">O -</option>
        <option value="O +">O +</option>
        <option value="B -">B -</option>
        <option value="B +">B +</option>
        <option value="A -">A -</option>
        <option value="A +">A +</option>
        <option value="AB -">AB -</option>
        <option value="AB +">AB +</option>
        <option value="NR +">NR </option>
    </select>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <label>Sexo:</label>
    <p>
        Hombre:
        <input type="radio" class="flat" name="sexo" id="genderM" value="H" checked="" required /> 
        Mujer:
        <input type="radio" class="flat" name="sexo" id="genderF" value="M" />
    </p>
</div>
<div class="clearfix"></div>

<h2>Antecedentes</h2>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <select name="tipo" class="form-control has-feedback-left">
        <option disabled selected>Tipo</option>
        <option value="QUIRURGICO">Quirurgico</option>
        <option value="NO_QUIRURGICOS">No Quirurgico</option>
    </select>
    <span class="form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess5" placeholder="Nombre Procedimiento" name="nombre_proce" value="{{$antecedente->nombre_proce}}">
    <span class="glyphicon glyphicon-copy form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess6" placeholder="Alergias" name="alergias" value="{{$antecedente->alergias}}">
    <span class="glyphicon glyphicon-copy form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess7" placeholder="Antecedentes familiares" name="ant_familiares" value="{{$antecedente->ant_familiares}}">
    <span class="glyphicon glyphicon-copy form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess8" placeholder="Antecedentes personales" name="ant_personales" value="{{$antecedente->ant_personales}}">
    <span class="glyphicon glyphicon-copy form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="clearfix"></div>
<h2>Acompañante</h2>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess9" placeholder="Nombre Acompañante" name="acompaniante_nombre" value="{{$acompaniante->nombre}}">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess10" placeholder="Cedula Acompañante" name="acompaniante_cedula" value="{{$acompaniante->cedula}}">
    <span class="glyphicon glyphicon-credit-card form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess11" placeholder="Dirección Acompañante" name="acompaniante_direccion" value="{{$acompaniante->direccion}}">
    <span class="glyphicon glyphicon-map-marker form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess12" placeholder="Teléfono Acompañante" name="acompaniante_telefono" value="{{$acompaniante->telefono}}">
    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <label>Sexo:</label>
    <p>
        Hombre:
        <input type="radio" class="flat" name="acompaniante_sexo" id="gender_acompaniante_M" value="H" checked="" required /> 
        Mujer:
        <input type="radio" class="flat" name="acompaniante_sexo" id="gender_acompaniante_F" value="M" />
    </p>
</div>

<div class="clearfix"></div>
<input type="submit" class="btn btn-success" value="Registrar">

{{Form::close()}}
@endsection

@section("plugin-js")
<script>
    $(document).ready(function () {
        $("select[name=tipo_sangre]").val("{{$paciente->tipo_sangre}} {{$paciente->RH}}");
        if ("{{$paciente->sexo}}" == "H") {
            $("#genderM").prop('checked', true);
        } else {
            $("#genderF").prop('checked', true);
        }
        if ("{{$antecedente->tipo}}" != "") {
            $("select[name=tipo]").val("{{$antecedente->tipo}}");
        }
        if ("{{$acompaniante->sexo}}" != "") {
            if ("{{$acompaniante->sexo}}" == "H") {
                $("#gender_acompaniante_M").prop('checked', true);
            } else {
                $("#gender_acompaniante_F").prop('checked', true);
            }
        }
    });
</script>
@endsection