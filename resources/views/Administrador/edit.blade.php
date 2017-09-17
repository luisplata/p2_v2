@extends("plantilla.app")

@section("plugin-css")

@endsection

@section("contenido")
<h2>Registro de Personal</h2>
{{Form::open(['url' => ['administrador', $cedula], 'method' => 'put'])}}
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input value="{{$nombre}}" type="text" class="form-control has-feedback-left" id="inputSuccess2" name="nombre" placeholder="Nombre" required>
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input readonly="" value="{{$cedula}}" type="number" max="9999999999" class="form-control has-feedback-left" id="inputSuccess2" required>
    <span class="glyphicon glyphicon-credit-card form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input value="{{$telefono}}" type="number" max="9999999999"  class="form-control has-feedback-left" id="inputSuccess2" placeholder="Telefono" name="telefono" required>
    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input value="{{$direccion}}" type="text" class="form-control has-feedback-left"  id="inputSuccess2" placeholder="direccion" name="direccion" required>
    <span class="glyphicon glyphicon-map-marker form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="clearfix"></div>
<div class="col-md-6 col-sm-6 col-xs-12">
    Tipo:
    <select name="tipo" class="form-control">
        <option value="DOCTOR">Doctor</option>
        <option value="ENFERMERA">Enfermera</option>
        <option value="ADMISIONISTA">Admisionista</option>
        <option value="ENFERMERA_JEFE">Enfermera Jefe</option>
        <option value="ADMINISTRADOR">Administrador</option>
    </select>
</div>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <label>Sexo:</label>
    <p>
        @if($sexo == "H")
        M:
        <input type="radio" class="flat" name="sexo" id="genderM" value="H" checked="" required /> F:
        <input type="radio" class="flat" name="sexo" id="genderF" value="M" />
        @else
        M:
        <input type="radio" class="flat" name="sexo" id="genderM" value="H" required /> F:
        <input type="radio" class="flat" name="sexo" id="genderF" value="M" checked=""  />
        @endif
    </p>
</div>

<div class="clearfix"></div>

<input type="submit" class="btn btn-success" value="Registrar">
{{Form::close()}}
<div class="clearfix"></div>
<hr/>

@endsection

@section("plugin-js")
<script>
//Vamos a seleccionar el que biene por DB
$(document).ready(function (){
   $("select[name=tipo] option[value={{$tipo}}]").prop('selected', true);
});
</script>
@endsection