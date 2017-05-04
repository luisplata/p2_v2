 @extends("plantilla.app")
 @section("plugin-css")
 @endsection
 @section("contenido")
	
	{{Form::open(array("url"=>"doctor"))}}
	<h2 class="text-center h1">Crear una Historia Clinica</h2>
	
	<hr/>
	
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<label>Escriba la Historia Clinica</label>
		<textarea name="historia" class="form-control" rows="10"></textarea>
	</div>
	
	<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
		<label>Cedula de Paciente</label>
		<input type="text" class="form-control" id="autocomplete-custom-append" name="paciente_cedula" placeholder="Cedula Paciente">
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
	<!-- jQuery autocomplete -->
	<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
    
	<!-- jQuery autocomplete -->
    <script>
      $(document).ready(function() {
        var countries = {
			@foreach ($pacientes as $paciente)
			"{{$paciente->cedula}}":"{{$paciente->cedula}}",
			@endforeach
			};

        var countriesArray = $.map(countries, function(value, key) {
          return {
            value: value,
            data: key
          };
        });

        // initialize autocomplete with custom appendTo
        $('#autocomplete-custom-append').autocomplete({
          lookup: countriesArray
        });
      });
    </script>
    <!-- /jQuery autocomplete -->
 @endsection