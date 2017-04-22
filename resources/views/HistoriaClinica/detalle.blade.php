 @extends("plantilla.app")
 
 @section("plugin-css")
 
 @endsection
 
 @section("contenido")
	
	{{Form::open(array("url"=>"historia_clinica/".$historia->id, 'method' => 'put'))}}
	<h2 class="text-center h1">Modificar Historia Clinica</h2>
	
	<hr/>
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<label>Escriba la Historia Clinica</label>
		<textarea name="historia" class="form-control" rows="10">{{$historia->historia}}</textarea>
	</div>
	
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<label>Cedula de Paciente</label>
		<input type="text" class="form-control" id="autocomplete-custom-append" value="{{$historia->paciente_cedula}}" readonly placeholder="Cedula Paciente">
	</div>
	
	<div class="clearfix"></div>
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
	<input type="submit" class="btn btn-success" value="Asignar">
	</div>
	{{Form::close()}}
	
 @endsection
 
 @section("plugin-js")
	
 @endsection