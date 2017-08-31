@extends("plantilla.app")

@section("plugin-css")

@endsection

@section("contenido")
<h2>Registro de Pacientes *</h2>
{{Form::open(array("url"=>"admisionista/registrarPaciente"))}}
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="nombre" placeholder="Nombre" required />
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="number" max="9999999999" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Cedula" name="cedula" required />
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="number" max="9999999999" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Telefono" name="telefono" required />
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="direccion" name="direccion" required />
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <label>Grupo y RH *</label>
    <select class="form-control required" required="required" name="tipo_sangre">
        <option value="O -">O -</option>
        <option value="O +">O +</option>
        <option value="B -">B -</option>
        <option value="B +">B +</option>
        <option value="A -">A -</option>
        <option value="A +">A +</option>
        <option value="AB -">AB -</option>
        <option value="AB +">AB +</option>
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

<h2>Antecedentes</h2>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <select name="tipo" class="form-control has-feedback-left">
        <option disabled selected>Tipo</option>
        <option value="QUIRURGICO">Quirurgico</option>
        <option value="NO_QUIRURGICOS">No Quirurgico</option>
    </select>
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Nombre Procedimiento" name="nombre_proce">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Alergias" name="alergias">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Antecedentes familiares" name="ant_familiares">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Antecedentes personales" name="ant_personales">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="clearfix"></div>
<h2>Acompañante</h2>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Nombre Acompañante" name="acompaniante_nombre">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Cedula Acompañante" name="acompaniante_cedula">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Dirección Acompañante" name="acompaniante_direccion">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Teléfono Acompañante" name="acompaniante_telefono">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <label>Sexo:</label>
    <p>
        M:
        <input type="radio" class="flat" name="acompaniante_sexo" id="genderM" value="H" checked="" required /> F:
        <input type="radio" class="flat" name="acompaniante_sexo" id="genderF" value="M" />
    </p>
</div>

<div class="clearfix"></div>
<input type="submit" class="btn btn-success" value="Registrar">

{{Form::close()}}
<div class="clearfix"></div>
<hr/>
<h2 class="center">Pacientes Registrados</h2>
<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Cedula</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Sexo</th>
        </tr>
    </thead>


    <tbody>
        @foreach ($pacientes as $paciente)
        <tr>
            <td>{{$paciente->nombre}}</td>
            <td>{{$paciente->cedula}}</td>
            <td>{{$paciente->telefono}}</td>
            <td>{{$paciente->direccion}}</td>
            <td>{{$paciente->sexo}}</td>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection

@section("plugin-js")

@endsection