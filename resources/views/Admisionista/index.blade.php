@extends("plantilla.app")

@section("plugin-css")
<link href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
@endsection

@section("contenido")
<h2>Registro de Pacientes * <button class="right btn btn-default" onclick="nn()">N/N</button></h2>
{{Form::open(array("url"=>"admisionista/registrarPaciente", "id"=>"formulario"))}}
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="paciente_nombre" name="nombre" placeholder="Nombre" required />
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="number" max="999999999999" class="form-control has-feedback-left" id="paciente_cedula" placeholder="Cedula" name="cedula" required />
    <span class="glyphicon glyphicon-credit-card form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="number" max="9999999999" class="form-control has-feedback-left" id="paciente_telefono" placeholder="Telefono" name="telefono" required />
    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="paciente_direccion" placeholder="direccion" name="direccion" required />
    <span class="glyphicon glyphicon-map-marker form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="TEXT" min="1" max="200" class="form-control has-feedback-left" id="paciente_edad" placeholder="edad" name="edad" required />
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
    <input type="text" class="form-control has-feedback-left" id="inputSuccess5" placeholder="Nombre Procedimiento" name="nombre_proce">
    <span class="glyphicon glyphicon-copy form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess6" placeholder="Alergias" name="alergias">
    <span class="glyphicon glyphicon-copy form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess7" placeholder="Antecedentes familiares" name="ant_familiares">
    <span class="glyphicon glyphicon-copy form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess8" placeholder="Antecedentes personales" name="ant_personales">
    <span class="glyphicon glyphicon-copy form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="clearfix"></div>
<h2>Acompañante</h2>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess9" placeholder="Nombre Acompañante" name="acompaniante_nombre">
    <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess10" placeholder="Cedula Acompañante" name="acompaniante_cedula">
    <span class="glyphicon glyphicon-credit-card form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess11" placeholder="Dirección Acompañante" name="acompaniante_direccion">
    <span class="glyphicon glyphicon-map-marker form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <input type="text" class="form-control has-feedback-left" id="inputSuccess12" placeholder="Teléfono Acompañante" name="acompaniante_telefono">
    <span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
</div>
<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
    <label>Sexo:</label>
    <p>
        Hombre:
        <input type="radio" class="flat" name="acompaniante_sexo" id="genderM" value="H" checked="" required /> 
        Mujer:
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
            <th>Edad</th>
            <th>Telefono</th>
            <th>Direccion</th>
            <th>Sexo</th>
            <th>Acción</th>
        </tr>
    </thead>


    <tbody>
        @foreach ($pacientes as $paciente)
        <tr>
            <td>{{$paciente->nombre}}</td>
            <td>{{$paciente->cedula}}</td>
            <td>{{$paciente->edad}}</td>
            <td>{{$paciente->telefono}}</td>
            <td>{{$paciente->direccion}}</td>
            <td>{{$paciente->sexo =='H'?'Hombre':'Mujer'}}</td>
            <td><a class="btn btn-primary" href="{{url('admisionista/paciente/modificar/'.$paciente->id)}}">Modificar</a></td>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection

@section("plugin-js")
<script type="text/javascript" src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{asset("js/moment/moment.min.js")}}"></script>
<script>
    $(document).ready(function () {
        $('table').DataTable();
    });
    function nn() {
        //Cargamos datos genericos y el documento random
        var nombre = "NN";
        var cedula = generarDocumentoRadom();
        var telefono = "00";
        var direccion = "NN";
        var edad = "NN";
        $("#paciente_nombre").val(nombre);
        $("#paciente_cedula").val(cedula);
        $("#paciente_telefono").val(telefono);
        $("#paciente_direccion").val(direccion);
        $("#paciente_edad").val(edad);
        $("select[name=tipo_sangre]").val("NR +");

    }
    function generarDocumentoRadom() {
        //documento random con formato de [fecha][random4digitos]
        var fecha = moment().format('YYYYMMDD');
        var consecutivo = Math.round(Math.random() * (9999 - 1) + 1);
        return fecha + consecutivo + "";
    }
</script>
@endsection