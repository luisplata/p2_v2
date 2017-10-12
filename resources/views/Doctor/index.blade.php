@extends("plantilla.app")

@section("plugin-css")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section("contenido")

{{Form::open(array("url"=>"doctor"))}}
<h2 class="text-center h1">Crear una Historia Clinica</h2>

<hr/>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <label>Escriba la Historia Clinica</label>
    <textarea name="historia" class="form-control" rows="10"></textarea>
</div>

<div class="col-xs-6">
    <label>Cubiculo - Cedula - Nombre</label>
    <select class="form-control" name="paciente_cedula" data-placeholder="Selecciona una historia" required>
        <option></option>
        @foreach ($cubiculosAsignados as $ca)
           @if(count($ca->paciente->historiasClinicas) <= 0)
                <option value="{{$ca->paciente->cedula}}">{{$ca->paciente->asignacionPacientes[0]->cubiculo->numero}} - {{$ca->paciente->cedula}} - {{$ca->paciente->nombre}}</option>
            @endif
        @endforeach
    </select>
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
            <th>Historia #</th>
            <th>Nombre Paciente</th>
            <th>Cedula Paciente</th>
            <th>Accion</th>
        </tr>
    </thead>


    <tbody>
        @foreach ($historias as $h)
        <tr>
            <td>{{$h->id}}</td>
            <td>{{$h->paciente_nombre}}</td>
            <td>{{$h->paciente_cedula}}</td>
            <td>
                <a href="{{url('doctor/eliminar/'.$h->id)}}" class="btn btn-warning pull-right">Eliminar</a>
                <a href="{{url('doctor/ver/'.$h->id)}}" class="btn btn-primary pull-right">Modificar</a>
                <a href="{{url('doctor/asignarTratamiento/'.$h->id)}}" class="btn btn-success pull-right">Asignar Tratamiento</a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection

@section("plugin-js")
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
$('select[name=historia_id]').select2();
</script>
@endsection