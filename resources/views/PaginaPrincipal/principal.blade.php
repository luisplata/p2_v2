<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gentellela Alela! | </title>

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
	<style>
	.right_col{
		margin-left:0px !important;
	}
	.circulo {
	  height: 100px;
	  width: 100px;
	  display: table-cell;
	  text-align: center;
	  vertical-align: middle;
	  border-radius: 50%;
	  background: #90caf9;
	}
	</style>
	<style>
		#svg-wrapper {
			width: 500px;
			height: 160px;
			margin: 2em auto;
		}

		svg path {
			fill: none;
			stroke: #000;
			stroke-width: 1.5px;
		}

		svg .axis {
			font-size: 12px;
		}

		svg .axis path {
			display: none;
		}
		.alerta{
			background-color:#f44336;
		}
		.normal{
			background-color:#FFF;
		}
		.bg-normal{
			background-color:#e3f2fd;
		}
	</style>
  </head>

  <body class="nav-md">
    <div class="container bg-normal">
      <div class="main_container" style="">
        <!-- page content -->
		<!--each('PaginaPrincipal.modulo', $cubiculos, 'cubiculo')-->
		@php
			$numero = 0;
		@endphp
		
		@foreach ($cubiculos as $cubiculo)
		@php
			$numero++;
		@endphp
			<div class="col-xs-4 animated flipInYs">
				<div class="tile-stats" id="cubiculo-{{$cubiculo->numero}}">
					<div class="h1 text-center">{{$cubiculo->numero}}</div>
					<div class="col-xs-12">
						<div class="col-xs-6 h2">
							{{$cubiculo->nombre}}<br/>
							{{$cubiculo->cedula}}
						</div>
						<div class="col-xs-6">
							<div class="circulo h1" id="so-{{$cubiculo->numero}}">
								89%
							</div>
						</div>
					</div>
					<div class="col-xs-12 h1">
					<!-- Grafico -->
					<span class="glyphicon glyphicon-heart"></span><span id="ppm-{{$cubiculo->numero}}"></span>
					<!--
					<div  id="svg-wrapper"></div>
					-->
					<!-- Grafico -->
					<hr>
					</div>
					<div class="col-xs-12 text-center">
						<span class="h3" id="mensaje_pulso_cubiculo-{{$cubiculo->numero}}"></span>
						<span class="h3" id="mensaje_so_cubiculo-{{$cubiculo->numero}}"></span>
						<br/>
					</div>
					<div class="col-xs-12">
						<div class="col-xs-6">
							<div class="text-center">
								<a class="btn btn-default" data-toggle="modal" data-target="#AdicionDeMedicamento" data-cubiculo="{{$cubiculo->numero}}">add</a>
							</div>
							<ul class="list-group">
								@foreach ($tratamientos as $tratamiento)
									@if($tratamiento->paciente_cedula == $cubiculo->cedula)
										<li class="list-group-item">
											{{$tratamiento->dosis}} de {{$tratamiento->medicamento}} cada {{$tratamiento->periocidad}} horas
										</li>
									@endif
								@endforeach
							</ul>
						</div>
						<div class="col-xs-6">
							<div class="text-center">
								<a class="btn btn-default" data-toggle="modal" data-target="#AdicionDeNotaMedica" data-cubiculo="{{$cubiculo->numero}}">add</a>
							</div>
							<ul class="list-group">
								@foreach ($notas as $nota)
									@if($nota->paciente_cedula == $cubiculo->cedula)
										<li class="list-group-item">
											{{$nota->notas}}
										</li>
									@endif
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!--Se mira que sea el tercero de la fila para colocar un clearfix-->
			@if(($numero % 3) == 0)
				<div class="clearfix"></div>
			@endif
		@endforeach		
        <!-- /page content -->
      </div>
    </div>
	
	<!-- Modal -->
<div class="modal fade" id="AdicionDeMedicamento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  {{Form::open(array("url"=>"principal/guardarTratamiento"))}}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
		<div class="row">
			<div class="col-xs-12 form-group has-feedback text-center">
				<label>Escriba su documento para validar que pueda ingresar un tratamiento</label>
				<input type="number" name="documento" class="form-control text-center required" required placeholder="Cedula">
			</div>
			<div class="col-xs-12 form-group has-feedback">
				<label>Mecicamento</label>
				<input type="text" name="medicamento" class="form-control" placeholder="Medicamento" required>
			</div>
			<div class="col-xs-6 form-group has-feedback">
				<label>Dosis</label>
				<input type="text" name="dosis" class="form-control" placeholder="Dosis" required>
			</div>
			<div class="col-xs-6 form-group has-feedback">
				<label>Periocidad</label>
				<div class="input-group">
				  <div class="input-group-addon"></div>
				  <input type="number" min="1" name="periocidad" class="form-control"  placeholder="Periocidad" required>
				  <div class="input-group-addon">Horas</div>
				</div>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
				<input type="hidden" class="cubiculo" name="cubiculo">
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
	{{Form::close()}}
  </div>
</div>
<div class="modal fade" id="AdicionDeNotaMedica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
  {{Form::open(array("url"=>"principal/guardarNotaMedica"))}}
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
		<div class="row">
			<div class="col-xs-12 form-group has-feedback text-center">
				<label>Escriba su documento para validar que pueda ingresar una nota medica</label>
				<input type="number" name="personal_cedula" class="form-control text-center required" required placeholder="Cedula">
			</div>
			<div class="col-xs-12 form-group has-feedback">
				<label>Nota</label>
				<textarea name="nota" rows="5" class="form-control" required></textarea>
			</div>
			<div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
				<input type="text" class="cubiculo" name="cubiculo">
			</div>
		</div>
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
	{{Form::close()}}
  </div>
</div>
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
	<script src="https://d3js.org/d3.v3.min.js"></script>
	<script>
	//aqui estara las consultas del simulador
		$('#AdicionDeMedicamento').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var recipient = button.data('cubiculo') // Extract info from data-* attributes
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		  modal.find('.cubiculo').val(recipient)
		});
		
		//notas medicas
		$('#AdicionDeNotaMedica').on('show.bs.modal', function (event) {
		  var button = $(event.relatedTarget) // Button that triggered the modal
		  var recipient = button.data('cubiculo') // Extract info from data-* attributes
		  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		  var modal = $(this)
		  modal.find('.cubiculo').val(recipient)
		});
		
		var parametros = {
			"cubiculo" : {{$cubiculo->numero}}
		};
		$(document).ready(function(){
			setInterval('ajax()',500);
			
			latidos();
		});
		function ajax(){
			$.ajax({
					data:  parametros,
					url:   '{{url("simulador/leer")}}',
					type:  'get',
					success:  function (response) {
						//console.log(response);
						response.forEach(function (value){
							console.log(value);
							var cubiculo = $("#cubiculo-"+value.cubiculo);
							if(value.pulso > 100 || value.pulso < 50){
								//console.warn("alerta de pulso");
								cubiculo.addClass("alerta");
								$("#mensaje_pulso_cubiculo-"+value.cubiculo).html("Alerta de Pulso fuera de parametros normales!");
							}else{
								$("#mensaje_pulso_cubiculo-"+value.cubiculo).html("");
							}
							if(value.so < 95 ){
								//console.warn("alerta de SO");
								cubiculo.addClass("alerta");
								$("#mensaje_so_cubiculo-"+value.cubiculo).html("Alerta de Saturacion de Oxigeno fuera de parametros normales!");
							}else{
								$("#mensaje_so_cubiculo-"+value.cubiculo).html("");
							}
							if(value.pulso < 100 && value.pulso > 50 && value.so > 95){
								cubiculo.removeClass("alerta");
							}
							$("#so-"+value.cubiculo).html(value.so+"%");
							$("#ppm-"+value.cubiculo).html(value.pulso+" ppm");
						});
					}
			});
		}
	</script>
	<script type="text/javascript">
	var svg = null;
	var circle = null;
	var circleTransition = null;
	var latestBeat = null;
	var insideBeat = false;
	var data = [];

	function latidos(){		
			
			var SECONDS_SAMPLE = 5;
			var BEAT_TIME = 500;
			var TICK_FREQUENCY = SECONDS_SAMPLE * 1000 / BEAT_TIME;
			var BEAT_VALUES = [0, 0, 3, -4, 10, -7, 3, 0, 0];

			var CIRCLE_FULL_RADIUS = 50;
			var MAX_LATENCY = 3000;

			var colorScale = d3.scale.linear()
					.domain([BEAT_TIME, (MAX_LATENCY - BEAT_TIME) / 2, MAX_LATENCY])
					.range(["#6D9521", "#D77900", "#CD3333"]);

			var radiusScale = d3.scale.linear()
					.range([5, CIRCLE_FULL_RADIUS])
					.domain([MAX_LATENCY, BEAT_TIME]);

			function beat() {

				if (insideBeat) return;
				insideBeat = true;

				var now = new Date();
				var nowTime = now.getTime();

				if (data.length > 0 && data[data.length - 1].date > now) {
					data.splice(data.length - 1, 1);
				}

				data.push({
					date: now,
					value: 0
				});

				var step = BEAT_TIME / BEAT_VALUES.length - 2;
				
				for (var i = 1; i < BEAT_VALUES.length; i++) {
					data.push({
						date: new Date(nowTime + i * step),
						value: BEAT_VALUES[i]
					});
				}

				latestBeat = now;

				circleTransition = circle.transition()
						.duration(BEAT_TIME)
						.attr("r", CIRCLE_FULL_RADIUS)
						.attr("fill", "#6D9521");

				setTimeout(function() {
					insideBeat = false;
				}, BEAT_TIME);
			}

			var svgWrapper = document.getElementById("svg-wrapper");
			console.log(svgWrapper);
			var margin = {left: 10, top: 10, right: CIRCLE_FULL_RADIUS * 3, bottom: 10},
					width = svgWrapper.offsetWidth - margin.left - margin.right,
					height = svgWrapper.offsetHeight - margin.top - margin.bottom;

			// create SVG
			svg = d3.select('#svg-wrapper').append("svg")
					.attr("width", width)
					.attr("height", height + margin.bottom + margin.top)
					.append("g")
						.attr("transform", "translate(" + margin.left + "," + margin.top + ")");

			console.log(svg);
			circle = svg
					.append("circle")
					.attr("fill", "#6D9521")
					.attr("cx", width + margin.right / 2)
					.attr("cy", height / 2)
					.attr("r", CIRCLE_FULL_RADIUS);

			// init scales
			var now = new Date(),
					fromDate = new Date(now.getTime() - SECONDS_SAMPLE * 1000);

			// create initial set of data
			data.push({
				date: now,
				value: 0
			});

			var x = d3.time.scale()
					.domain([fromDate, new Date(now.getTime())])
					.range([0, width]),
					y = d3.scale.linear()
							.domain([-10, 10])
							.range([height, 0]);

			var line = d3.svg.line()
					.interpolate("basis")
					.x(function(d) {
						return x(d.date);
					})
					.y(function(d) {
						return y(d.value);
					});

			var xAxis = d3.svg.axis()
					.scale(x)
					.orient("bottom")
					.ticks(d3.time.seconds, 1)
					.tickFormat(function(d) {
						var seconds = d.getSeconds() === 0 ? "00" : d.getSeconds();
						return seconds % 10 === 0 ? d.getMinutes() + ":" + seconds : ":" + seconds;
					});

			// add clipPath
			svg.append("defs").append("clipPath")
					.attr("id", "clip")
					.append("rect")
					.attr("width", width)
					.attr("height", height);

			var axis = d3.select("svg").append("g")
					.attr("class", "axis")
					.attr("transform", "translate(0," + height + ")")
					.call(xAxis);

			var path = svg.append("g")
					.attr("clip-path", "url(#clip)")
					.append("path")
					.attr("class", "line");

			svg.select(".line")
					.attr("d", line(data));

			var transition = d3.select("path").transition()
					.duration(100)
					.ease("linear");

			(function tick() {

				transition = transition.each(function() {

					// update the domains
					now = new Date();
					fromDate = new Date(now.getTime() - SECONDS_SAMPLE * 1000);
					x.domain([fromDate, new Date(now.getTime() - 100)]);

					var translateTo = x(new Date(fromDate.getTime()) - 100);

					// redraw the line
					svg.select(".line")
							.attr("d", line(data))
							.attr("transform", null)
							.transition()
							.attr("transform", "translate(" + translateTo + ")");

					// slide the x-axis left
					axis.call(xAxis);

				}).transition().each("start", tick);
			})();

			setInterval(function() {

				now = new Date();
				fromDate = new Date(now.getTime() - SECONDS_SAMPLE * 1000);

				for (var i = 0; i < data.length; i++) {
					if (data[i].date < fromDate) {
						data.shift();
					} else {
						break;
					}
				}

				if (insideBeat) return;

				data.push({
					date: now,
					value: 0
				});

				if (circleTransition != null) {

					var diff = now.getTime() - latestBeat.getTime();

					if (diff < MAX_LATENCY) {
						circleTransition = circle.transition()
								.duration(TICK_FREQUENCY)
								.attr("r", radiusScale(diff))
								.attr("fill", colorScale(diff));
					}
				}


			}, TICK_FREQUENCY);

			setInterval(function() {
				beat();
			}, 1000);
			//beat();
	}		

	</script>


  </body>
</html>
