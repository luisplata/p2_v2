@extends("plantilla.app")
@section("plugin-css")
@endsection

@section("contenido")
{{Form::open(array("url"=>"administrador/cubiculos"))}}
<h2>Nuevo Cubiculo</h2>

<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="number" class="form-control has-feedback-left" id="inputSuccess2" name="numero" placeholder="Cubiculo">
    <span class="glyphicon glyphicon-hdd form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="clearfix"></div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="submit" class="btn btn-success" value="Asignar">
</div>
{{Form::close()}}
<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Cubiculo</th>
            <th>Accion</th>
        </tr>
    </thead>


    <tbody>
        @foreach ($cubiculos as $c)
        <tr>
            <td>{{$c->numero}}</td>
            <td>
                <a href="{{url('administrador/cubiculos/'.$c->numero)}}" class="btn btn-warning">Eliminar</a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>

@endsection

@section("plugin-js")

@endsection