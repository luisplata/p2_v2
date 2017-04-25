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
	</style>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container right_col">
        <!-- page content -->
		<!--each('PaginaPrincipal.modulo', $cubiculos, 'cubiculo')-->
		@foreach ($cubiculos as $cubiculo)
			<div class="col-xs-4 animated flipInY" id="cubiculo-{{$cubiculo->numero}}">
				<div class="tile-stats">
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
					<div class="col-xs-12">
						<div class="col-xs-6">
							<div class="text-center">
								<a class="btn btn-default">add</a>
							</div>
							<ul class="list-group">
								@foreach ($tratamientos as $tratamiento)
									@if($tratamiento->paciente_cedula == $cubiculo->cedula)
										<li class="list-group-item">
											{{$tratamiento->dosis}} de {{$tratamiento->medicamento}} cada {{$tratamiento->periocidad}}
										</li>
									@endif
								@endforeach
							</ul>
						</div>
						<div class="col-xs-6">
							<div class="text-center">
								<a class="btn btn-default">add</a>
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
			
		@endforeach		
        <!-- /page content -->
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
