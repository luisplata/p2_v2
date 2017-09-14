@extends("plantilla.app")

@section("plugin-css")

@endsection

@section("contenido")

{{Form::open(array("url"=>"enfermera_jefe/asignarCubiculo"))}}
<h2>Asignar Cubiculo</h2>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <select class="form-control has-feedback-left" name="numero">
        @foreach($listaCubiculos as $cubiculo)
        <option value="{{$cubiculo->numero}}">{{$cubiculo->numero}}</option>
        @endforeach
    </select>
    <span class="glyphicon glyphicon-hdd form-control-feedback left" aria-hidden="true"></span>
</div>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="number" max="999999999999" class="form-control has-feedback-left" id="autocomplete-custom-append" name="paciente_cedula" placeholder="Cedula Paciente">
    <span class="glyphicon glyphicon-credit-card form-control-feedback left" aria-hidden="true"></span>
</div>

<div class="clearfix"></div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="submit" class="btn btn-success" value="Asignar">
</div>
{{Form::close()}}
<div class="clearfix"></div>
<hr/>
<h2 class="center">Asignacion de cubiculos</h2>
<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Cubiculo</th>
            <th>Paciente</th>
            <th>Accion</th>
        </tr>
    </thead>


    <tbody>
        @foreach ($cubiculos as $c)
        <tr>
            <td>{{$c->cubiculo_numero}}</td>
            <td>{{$c->paciente_nombre}}</td>
            <td>
                <a href="{{url('enfermera_jefe/eliminarCubiculo/'.$c->cubiculo_numero.'/'.$c->paciente_cedula)}}" class="btn btn-warning">Eliminar</a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection

@section("plugin-js")
<!-- jQuery autocomplete -->
<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>

<!-- jQuery autocomplete -->
<script>
$(document).ready(function() {
var countries = {
@foreach ($pacientes as $paciente)
    "{{$paciente->cedula}}":"{{$paciente->cedula}}",
    @endforeach
};
var countriesArray = $.map(countries, function(value, key) {
return {
value: value,
    data: key
};
});
// initialize autocomplete with custom appendTo
$('#autocomplete-custom-append').autocomplete({
lookup: countriesArray
});
});
</script>
<!-- /jQuery autocomplete -->
@endsection