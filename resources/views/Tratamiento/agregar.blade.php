@extends("plantilla.app")

@section("plugin-css")

@endsection

@section("contenido")

{{Form::open(array("url"=>"doctor/asignarTratamiento/"))}}
<h2 class="text-center h1">Asignar Tratamiento</h2>

<hr/>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <label>Mecicamento</label>
    <input type="text" name="medicamento" class="form-control" placeholder="Medicamento">
</div>
<div class="col-md-4 col-sm-4 col-xs-12 form-group has-feedback">
    <label>Dosis</label>
    <input type="number" name="dosis" class="form-control" placeholder="Medicamento">
</div>
<div class="col-md-2 col-sm-2 col-xs-12 form-group has-feedback">
    <label>Unidad de Medida</label>
    <input type="radio" name="unidad" value="ml" required />ML
    <input type="radio" name="unidad" value="mg" required />MG
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <label>periocidad</label>
    <div class="input-group">
        <div class="input-group-addon"></div>
        <input type="number" name="periocidad" class="form-control"  placeholder="Medicamento">
        <div class="input-group-addon">horas</div>
    </div>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <label>Cedula de Paciente</label>
    <input type="text" class="form-control" id="autocomplete-custom-append" value="{{$historia->paciente->cedula}}" readonly placeholder="Cedula Paciente">
    <input type="hidden" value="{{$historia->paciente->id}}" name="paciente_id">
    <input type="hidden" value="{{$historia->id}}" name="historia_id">
</div>


<div class="clearfix"></div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="submit" class="btn btn-success" value="Asignar">
</div>
{{Form::close()}}

<hr/>
<label class="h2 text-uppercase">Tratamientos</label>
@foreach ($historia->paciente->tratamientos as $tratamiento)
@if($tratamiento->estado == 'VIGENTE')
<div class="alert bg-primary" role="alert">
    {{$tratamiento->medicamento}} de {{$tratamiento->dosis}} cada {{$tratamiento->periocidad}} 
    <a href="{{url('doctor/quitarTratamiento/'.$tratamiento->id.'/'.$historia->id)}}" class="pull-right btn btn-warning">Quitar</a>
</div>
@else
<div class="alert bg-danger" role="alert">
    {{$tratamiento->medicamento}} de {{$tratamiento->dosis}} cada {{$tratamiento->periocidad}} 
    <a href="{{url('doctor/borrarTratamiento/'.$tratamiento->id.'/'.$historia->id)}}" class="pull-right btn btn-danger">Eliminar</a>
</div>
@endif
@endforeach	
@endsection

@section("plugin-js")

@endsection