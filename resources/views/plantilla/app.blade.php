<!DOCTYPE html>
<html lang="en">
    @include("plantilla.header")
    @yield('plugin-css')
    <style>
        .imagen_top{
            height:40px;
            padding-right:5px;
        }
    </style>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">



                @include("plantilla.sideMenu")

                @include("plantilla.topMenu")
                <!-- page content -->
                <div class="right_col" role="main">
                    @yield('contenido')
                </div>
                <!-- /page content -->

                @include("plantilla.pie")
            </div>
        </div>

        <!-- jQuery -->
        <script src="{{asset('vendors/jquery/dist/jquery.min.js')}}"></script>
        <!-- Bootstrap -->
        <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <!-- Custom Theme Scripts -->

        <script src="{{asset('/js/sweetalert.min.js')}}"></script>
        <script src="{{asset('/js/idle-timer.min.js')}}"></script>
        <script>
var url_string = window.location;
var url = new URL(url_string);
var mensaje = url.searchParams.get("mensaje");
var tipo = url.searchParams.get("tipo");
var titulo = url.searchParams.get("titulo");
if (mensaje != null) {
    swal(titulo == null ? "" : titulo, mensaje, tipo == null ? "info" : tipo);
}
//Si es un admisionista o un administrador no cuenta esto
//{{session("personal")->tipo}}
@if (session("personal")->tipo != "ADMINISTRADOR" && session("personal")->tipo != "ADMISIONISTA")
$(function () {
    // Set idle time
    $(document).idleTimer(60000);
    $(document).on("idle.idleTimer", function (event, elem, obj) {
        //mandar ajax con destruccion de session
        $.ajax({
            url: "{{url('/logout')}}"
        });
        swal({
            title: "Sesion Caducada",
            text: "Su session ha caducado, debe logearse de nuevo",
            icon: "warning"
        }).then(() => {
            //redireccion al login
            location.href="{{url('/principal')}}";
        });
    }
    );
});
@endif
        </script>
        @yield('plugin-js')
    </body>
</html>
