@extends("plantilla.app")

@section("plugin-css")

@endsection

@section("contenido")
<h2>Registro de Personal</h2>
{{Form::open(array("url"=>"administrador"))}}
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="nombre" placeholder="Nombre" required />
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="number" max="9999999999" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Cedula" name="cedula" required />
    <span class="fa fa-id-card-o form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="number" max="9999999999"  class="form-control has-feedback-left" id="inputSuccess2" placeholder="Telefono" name="telefono" required />
    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="direccion" name="direccion" required />
    <span class="fa fa-address-card form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="password" maxlenth="10" class="form-control has-feedback-left" id="inputSuccess2" placeholder="password" name="pass" required />
    <span class="fa fa-key form-control-feedback left" aria-hidden="true"></span>
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
        M:
        <input type="radio" class="flat" name="sexo" id="genderM" value="H" checked="" required /> F:
        <input type="radio" class="flat" name="sexo" id="genderF" value="M" />
    </p>
</div>

<div class="clearfix"></div>

<input type="submit" class="btn btn-success" value="Registrar">
{{Form::close()}}
<div class="clearfix"></div>
<hr/>
<h2 class="center">Personal Registrado</h2>
<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Cedula</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Sexo</th>
            <th>Tipo</th>
            <th>Acción</th>
        </tr>
    </thead>


    <tbody>
        @foreach ($personal as $p)
        <tr>
            <td>{{$p->nombre}}</td>
            <td>{{$p->cedula}}</td>
            <td>{{$p->telefono}}</td>
            <td>{{$p->direccion}}</td>
            <td>{{$p->sexo}}</td>
            <td>{{$p->tipo}}</td>
            <td>
                @if($p->estado == "ACTIVADO")
                <a href="{{url('administrador/desactivar/'.$p->cedula)}}" class="btn btn-warning">Desactivar</a>
                @else
                <a href="{{url('administrador/activar/'.$p->cedula)}}" class="btn btn-success">Activar</a>
                @endif
                <a href="{{url('administrador/'.$p->cedula.'/edit')}}" class="btn btn-primary">Modificar</a>
                <a href="{{url('administrador/eliminar/'.$p->cedula)}}" class="btn btn-danger">Eliminar</a>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection

@section("plugin-js")

@endsection