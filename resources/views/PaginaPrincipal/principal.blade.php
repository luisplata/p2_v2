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
            location.href = "{{url('/')}}";
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
                                            fechaHoraInicial.add(-5, "h");
                                            //periocidad del medicamento
                                            var periocidad = "{{$tratamiento->periocidad}}";
                                            periocidad = periocidad.split(" ")[0];
                                            //fecha hora actual
                                            var fechaActual = moment();
                                            //minutos restantes
                                            console.log(periocidad, "periocidad");
                                            periocidad *= 60;//cambiando a minutos la periocidad
                                            var minutosRestantes = Math.abs(fechaActual.diff(fechaHoraInicial, "minutes"));


                                            //Caso 1, Caso normal (esta dentro de primer rango de fecha)
                                            //Se cargan los tratamientos, y se calcula el restante para la proxima alerta
                                            console.warn(fechaActual.format('YYYY-MM-DD HH:mm:ss') + " - " + fechaHoraInicial.format('YYYY-MM-DD HH:mm:ss') + " = " + minutosRestantes);
                                            console.error(minutosRestantes, "Antes");//milisegundos
                                            minutosRestantes %= periocidad;
                                            minutosRestantes -= periocidad;
                                            minutosRestantes = Math.abs(minutosRestantes);
                                            console.error(minutosRestantes, "Despues");//milisegundos
                                            minutosRestantes = minutosRestantes * 60 * 1000;//milisegundos

                                            setInterval(function () {
                                                console.error("se activo la alarma");
                                                //swal("Esta es una alarma del |{{$cubiculo->numero}}| del tratamiento {{$tratamiento->medicamento}} cada {{$tratamiento->periocidad}} horas con una docis {{$tratamiento->dosis}}");
                                                alerta("{{$cubiculo->numero}}", "Esta es una alarma del |{{$cubiculo->numero}}| del tratamiento {{$tratamiento->medicamento}} cada {{$tratamiento->periocidad}} horas con una docis {{$tratamiento->dosis}}");
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
                                <a class="btn btn-default" href="{{url('/?cubiculo='.$cubiculo->cubiculo->numero)}}">Gestionar</a>
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
        <div class="modal fade" id="atenderAlrta" tabindex="-1">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="alerta-titulo">Alerta Medica!!!</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <p><span id="alerta-contenido"></span></p>
                            <div class="col-xs-6 form-group has-feedback">
                                <label>Usuario</label>
                                <input type="text" id="alerta-user" class="form-control" placeholder="Usuario">
                            </div>
                            <div class="col-xs-6 form-group has-feedback">
                                <label>Contrsaeña</label>
                                <input type="password" id="alerta-pass" class="form-control"  placeholder="Contraseña">
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12 form-group has-feedback">
                                <input type="" id="alerta-cubiculo" name="cubiculo">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnAtender" class="btn btn-primary">Atender</button>
                    </div>
                </div>
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
                                            var url = "{{url("")}}";
                                            $(document).ready(function () {

                                                setInterval(function () {
                                                    ajax('{{url("")}}');
                                                }, 500);
                                            });

        </script>
        <script src="{{asset('js/FuncionesExternas.js')}}"></script>
    </body>
</html>
