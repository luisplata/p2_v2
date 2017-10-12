@extends("plantilla.app")

@section("plugin-css")
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

@section("contenido")
<div class="row">
    para asignar una nota medica se necesitan:<br/>
    historia clinica ID -> seleccionando<br/>
    personal ID -> interno<br/>
    NOTA -> se llena<br/>
    <hr/>
    {{Form::open(["url"=>"enfermera/add/nota-medica"])}}
    <div class="col-xs-6">
        <label>Nota</label>
        <textarea class="form-control" name="nota" placeholder="Ingrese la nota a la historia clinica" rows="10"></textarea>
    </div>
    <div class="col-xs-6">
        <label> Cubiculo -Cedula - Nombre</label>>
        <select class="form-control" name="historia_id" data-placeholder="Selecciona una historia" required>
            <option></option>
            @foreach ($historias as $h)
                 @if(count($h->paciente->asignacionPacientes) > 0)
                    <option value="{{$h->id}}">{{$h->paciente->asignacionPacientes[0]->cubiculo->numero}} - {{$h->paciente->cedula}} - {{$h->paciente->nombre}}</option>
                @endif
            @endforeach
        </select>
    </div>
    <div class="clearfix"></div>
    <br/>
    <div class="col-xs-12">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
    {{Form::close()}}
</div>
@endsection

@section("plugin-js")
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
$('select[name=historia_id]').select2();
</script>
@endsection