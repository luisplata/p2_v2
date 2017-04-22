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
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<label>Dosis</label>
		<input type="text" name="dosis" class="form-control" placeholder="Medicamento">
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<label>periocidad</label>
		<input type="text" name="periocidad" class="form-control"  placeholder="Medicamento">
	</div>
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<label>Cedula de Paciente</label>
		<input type="text" class="form-control" id="autocomplete-custom-append" value="{{$historia->paciente_cedula}}" readonly placeholder="Cedula Paciente">
		<input type="hidden" value="{{$historia->paciente_cedula}}" name="paciente_cedula">
		<input type="hidden" value="{{$historia->id}}" name="historia_id">
	</div>
	
	
	<div class="clearfix"></div>
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
	<input type="submit" class="btn btn-success" value="Asignar">
	</div>
	{{Form::close()}}

	<hr/>
	<label class="h2 text-uppercase">Tratamientos</label>
	@foreach ($tratamientos as $tratamiento)
		<div class="alert
		@if($tratamiento->estado == 'VIGENTE')
			bg-primary
		@else
			bg-danger
		@endif
		 "
		role="alert">
		{{$tratamiento->medicamento}} de {{$tratamiento->dosis}} cada {{$tratamiento->periocidad}} 
		<a href="{{url('doctor/quitarTratamiento/'.$tratamiento->id.'/'.$historia->id)}}" class="pull-right btn btn-danger">Quitar</a>
		</div>
	@endforeach	
@endsection
 
 @section("plugin-js")
	
 @endsection