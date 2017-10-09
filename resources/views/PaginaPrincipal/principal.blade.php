<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Principal PLT </title>

        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{!! asset('css/sweetalert.css') !!}" />
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
        <script src="{{asset('/js/sweetalert.min.js')}}"></script>
        <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
        <div class="container bg-normal">
            <div class="main_container" style="">
                <!-- page content -->
                <!--each('PaginaPrincipal.modulo', $cubiculos, 'cubiculo')-->
                @php
                $numero = 0;
                @endphp

                @if(count($cubiculoAsignado) <= 0)
                    <script>
                        swal("No hay datos que mostrar")
                            .then((value) => {
                            location.href ="{{url('/')}}";
                        });
                    </script>
                @else

                <!-- foreach cubiculo--------------------------------------------------------------------------- -->
                @foreach ($cubiculoAsignado as $cubiculo)
                @php
                $numero++;
                @endphp
                <div class="col-xs-4 animated flipInYs">
                    <div class="tile-stats" id="cubiculo-{{$cubiculo->cubiculo->numero}}">
                        <div class="h1 text-center">-{{$cubiculo->cubiculo->numero}}-</div>
                        <div class="col-xs-12">
                            <div class="col-xs-6 h3">
                                {{$cubiculo->paciente->nombre}}<br/>
                                {{$cubiculo->paciente->cedula}}<br/>
                                @php
                                $antecedente = $cubiculo->paciente->antecedentes->first();
                                $alergia = "";
                                //If del cubiculo par alos antecedentes////////////////////////////////////////////////
                                if(is_object($antecedente)){
                                $alergia = $antecedente->alergias;
                                }
                                //If del cubiculo par alos antecedentes////////////////////////////////////////////////
                                @endPhp
                                Alergias:<br/>
                                {{$alergia}}
                            </div>
                            <div class="col-xs-6">
                                <div class="circulo h1" id="so-{{$cubiculo->cubiculo->numero}}">
                                    89%
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 h1">
                            <!-- Grafico -->
                            <span class="glyphicon glyphicon-heart"></span><span id="ppm-{{$cubiculo->cubiculo->numero}}"></span>
                            <!--
                            <div  id="svg-wrapper"></div>
                            -->
                            <!-- Grafico -->
                            <hr>
                        </div>
                        <div class="col-xs-12 text-center">
                            <span class="h3" id="mensaje_pulso_cubiculo-{{$cubiculo->cubiculo->numero}}"></span>
                            <span class="h3" id="mensaje_so_cubiculo-{{$cubiculo->cubiculo->numero}}"></span>
                            <span class="h3" id="mensaje_medicamento-{{$cubiculo->cubiculo->numero}}"></span>
                            <br/>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-xs-6">
                                <div class="text-center">
                                    <a class="btn btn-default hidden" data-toggle="modal" data-target="#AdicionDeMedicamento" data-cubiculo="{{$cubiculo->numero}}">Tratamientos</a>
                                    <label>Tratamientos</label>
                                </div>
                                <ul class="list-group">
                                    <!-- foreach de los tatamientos ----------------------------------------------- -->
                                    @foreach ($cubiculo->paciente->tratamientos as $tratamiento)
                                    <!-- if del tratamiento ------------------------------------------------------- -->
                                    @if($tratamiento->estado == "VIGENTE")
                                    <li class="list-group-item " id="medicamento_id_{{$tratamiento->id}}">
                                        {{$tratamiento->dosis}} de {{$tratamiento->medicamento}} cada {{$tratamiento->periocidad}} horas
                                        <script>
                                            //fecha inical del medicamento
                                            var fechaHoraInicial = moment("{{$tratamiento->updated_at}}");
                                            //mientras se soluciona el problema con la fecha en el servidor
                                            fechaHoraInicial.add(-5,"h");
                                            //periocidad del medicamento
                                            var periocidad = "{{$tratamiento->periocidad}}";
                                            periocidad = periocidad.split(" ")[0];
                                            //fecha hora actual
                                            var fechaActual = moment();
                                            //minutos restantes
                                            console.log(periocidad,"periocidad");
                                            periocidad *= 60;//cambiando a minutos la periocidad
                                            var minutosRestantes = Math.abs(fechaActual.diff(fechaHoraInicial, "minutes"));
                                            minutosRestantes -= periocidad;
                                            minutosRestantes = Math.abs(minutosRestantes);
                                            //Caso 1, Caso normal (esta dentro de primer rango de fecha)
                                            //Se cargan los tratamientos, y se calcula el restante para la proxima alerta
                                            console.warn(fechaActual.format('YYYY-MM-DD HH:mm:ss') + " - " + fechaHoraInicial.format('YYYY-MM-DD HH:mm:ss') + " = " + minutosRestantes);
                                            minutosRestantes %= periocidad;
                                            minutosRestantes = minutosRestantes * 60 * 1000;//milisegundos
                                            console.error(minutosRestantes);//milisegundos
                                            setInterval(function () {
                                                swal("Esta es una alarma del {{$cubiculo->numero}} del tratamiento {{$tratamiento->medicamento}} cada {{$tratamiento->periocidad}} horas con una docis {{$tratamiento->dosis}}");
                                                //creamos un temporalizador para marcrla como no atendida
                                                //setTimeout(function(){

                                                //}, timeout);
                                                minutosRestantes = periocidad * 60 * 1000;
                                            }
                                            , minutosRestantes);
                                            //console.log(fechaHoraInicial.format('HH:mm:ss'));
                                            //console.log(fechaActual.format('HH:mm:ss'));
                                            //Creamos un setInterval() para ejecutar la cunfion con la periocidad
                                            //del tratamiento
                                            //pero primero se calcula cual es la prixima alerta

                                        </script>
                                        <span id="tratamiento_boton_{{$tratamiento->id}}"  class="hidden"><button data-tratamiento_id="{{$tratamiento->id}}" onClick="AlarmaMedicamentoContestada(this)">Administrar</button></span>
                                    </li>
                                        @endif
                                        <!-- if ----------------------------------------------- -->
                                    @endforeach
                                    <!-- foreach ----------------------------------------------- -->
                                </ul>
                            </div>


                            <div class="col-xs-6">
                                <div class="text-center">
                                    <a class="btn btn-default hidden" data-toggle="modal" data-target="#AdicionDeNotaMedica" data-cubiculo="{{$cubiculo->numero}}">Notas Medicas</a>
                                    <label>Notas Medicas</label>
                                </div>
                                <ul class="list-group">
                                    <!-- foreach ----------------------------------------------- -->
                                    @foreach ($cubiculo->paciente->historiasClinicas as $historiasClinicas)
                                        <!-- foreach  ----------------------------------------------- -->
                                        @foreach ($historiasClinicas->notas as $nota)
                                        <li class="list-group-item">
                                            {{$nota->notas}}
                                        </li>
                                        <!-- foreach  ----------------------------------------------- -->
                                        @endforeach
                                        <!-- foreach  ----------------------------------------------- -->
                                    @endforeach
                                </ul>
                            </div>
                            <div class="clearfix"></div>
                            <hr>
                            <div class="col-xs-12 text-center">
                                <a class="btn btn-default" href="{{url('')}}">Gestionar</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Se mira que sea el tercero de la fila para colocar un clearfix-->
                <!-- if ----------------------------------------------- -->
                @if(($numero % 3) == 0)
                <div class="clearfix"></div>
                <!-- if  ----------------------------------------------- -->
                @endif
                <!-- foeeach  del cubiculo----------------------------------------------- -->
                @endforeach
                @endif
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
        <script src="/js/moment/moment.min.js"></script>

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

                                            Date.prototype.addHours = function (h) {
                                                this.setTime(this.getTime() + (h * 60 * 60 * 1000));
                                                return this;
                                            }

//                                            function AlarmaMedicamentoContestada(boton) {
//                                               var bot = $(boton);
//                                                var id = bot.data("tratamiento_id");
//                                                $.ajax({
//                                                    url: '{{url("simulador/tratamiento/")}}/' + id,
//                                                   success: function (response) {
//                                                        var botone = $("#tratamiento_boton_" + id);
//                                                        botone.addClass("hidden");
//                                                        var medicamento = $("#medicamento_id_" + id);
//                                                        medicamento.removeClass("alerta");
//                                                    }
//                                                });
//                                            }

                                            function medicamentos(cubiculo) {
                                                $.ajax({
                                                    url: '{{url("simulador/medicamento/")}}/' + cubiculo,
                                                    type: 'get',
                                                    success: function (response) {
                                                        console.warn(response);
                                                        response.forEach(function (value) {
                                                            //validamos lo del medicamento
                                                            var ultimaFecha = value.updated_at;
                                                            var fechaDeMedicamento = new Date(ultimaFecha);
                                                            //le restamos las 5 horas que hay de diferencia
                                                            fechaDeMedicamento.addHours(-5);
                                                            //hay que restarle 5 horas, por la hora local
                                                            var ahora = new Date();
                                                            //se le suman las horas
                                                            fechaDeMedicamento.addHours(value.periocidad);
                                                            if (fechaDeMedicamento < ahora) {

                                                                var medicamento = $("#medicamento_id_" + value.id);
                                                                medicamento.addClass("alerta");
                                                                var boton = $("#tratamiento_boton_" + value.id);
                                                                boton.removeClass("hidden");
                                                            }
                                                        });
                                                    },
                                                    
                                                });
                                            }

                                            function ajax() {
                                                $.ajax({
                                                    url: '{{url("simulador/leer")}}',
                                                    type: 'get',
                                                    success: function (response) {
                                                        //console.log(response);
                                                        response.forEach(function (value) {
                                                            //console.log(value);
                                                            var cubiculo = $("#cubiculo-" + value.cubiculo);
                                                            if (value.pulso > 100 || value.pulso < 50) {
                                                                //console.warn("alerta de pulso");
                                                                cubiculo.addClass("alerta");
                                                                $("#mensaje_pulso_cubiculo-" + value.cubiculo).html("Alerta de Pulso fuera de parametros normales!");
                                                            } else {
                                                                $("#mensaje_pulso_cubiculo-" + value.cubiculo).html("");
                                                            }
                                                            if (value.so < 95) {
                                                                //console.warn("alerta de SO");
                                                                cubiculo.addClass("alerta");
                                                                $("#mensaje_so_cubiculo-" + value.cubiculo).html("Alerta de Saturacion de Oxigeno fuera de parametros normales!");
                                                            } else {
                                                                $("#mensaje_so_cubiculo-" + value.cubiculo).html("");
                                                            }
                                                            if (value.pulso < 100 && value.pulso > 50 && value.so > 95) {
                                                                cubiculo.removeClass("alerta");
                                                            }
                                                            //console.log(value.cubiculo + " "+value.so);
                                                            $("#so-" + value.cubiculo).html(value.so + "%");
                                                            $("#ppm-" + value.cubiculo).html(value.pulso + " ppm");
                                                            //consulto los medicamentos por cubiculos
                                                            medicamentos(value.cubiculo);
                                                        });
                                                    }
                                                });
                                            }
                                            $(document).ready(function () {
                                                setInterval(function () {
                                                    ajax();
                                                    
                                                }, 500);
                                            });
                                            function crearAlarma(fechaAnterior) {
                                                swal(fechaAnterior);
                                            }
        </script>

    </body>
</html>
