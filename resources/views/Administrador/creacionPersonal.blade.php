@extends("plantilla.app")
@section("plugin-css")

@endsection

@section("contenido")
	Registro de Personal
	{{Form::open(array("url"=>"admisionista/registrarPaciente"))}}
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<input type="text" class="form-control has-feedback-left" id="inputSuccess2" name="nombre" placeholder="Nombre" required />
		<span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Cedula" name="cedula" required />
		<span class="fa fa-id-card-o form-control-feedback left" aria-hidden="true"></span>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Telefono" name="telefono" required />
		<span class="fa fa-phone form-control-feedback left" aria-hidden="true"></span>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<input type="text" class="form-control has-feedback-left" id="inputSuccess2" placeholder="direccion" name="direccion" required />
		<span class="fa fa-address-book form-control-feedback left" aria-hidden="true"></span>
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<label>Sexo:</label>
		<p>
		M:
		<input type="radio" class="flat" name="gender" id="genderM" value="H" checked="" required /> F:
		<input type="radio" class="flat" name="gender" id="genderF" value="M" />
		</p>
	</div>
	
	<div class="clearfix"></div>
	<input type="submit" class="btn btn-success" value="Registrar">
	{{Form::close()}}
@endsection

@section("plugin-js")

@endsection
