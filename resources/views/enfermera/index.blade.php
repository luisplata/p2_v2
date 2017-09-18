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
    <div class="col-xs-6">
        <label>Nota</label>
        <textarea class="form-control" name="nota" placeholder="Ingrese la nota a la historia clinica" rows="10"></textarea>
    </div>
    <div class="col-xs-6">
        <label> historias: # - cedula - nombre</label>>
        <select class="form-control" name="historia_id" data-placeholder="Selecciona una historia" required>
            <option></option>
            @foreach ($historias as $h)
            <option value="{{$h->id}}">{{$h->id}} - {{$h->paciente_cedula}} - {{$h->paciente_nombre}}</option>
            @endforeach
        </select>
    </div>
    <div class="clearfix"></div>
    <br/>
    <div class="col-xs-12">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</div>
@endsection

@section("plugin-js")
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
$('select[name=historia_id]').select2();
</script>
@endsection