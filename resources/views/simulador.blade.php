<!DOCTYPE html>
<html lang="en">
@include("plantilla.header")
@yield('plugin-css')
<body class="nav-md">
<div class="container body">
    <div class="main_container">

    @include("plantilla.topMenu")
    <!-- page content -->
        <div class="right_col" role="main">

        </div>
        <!-- /page content -->

        @include("plantilla.pie")
    </div>
</div>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
<script src="http://stevenlevithan.com/assets/misc/date.format.js"></script>
<script>
    function contador(){
        var pulso = Math.floor(Math.random() * (100 - (-100))) + (-100);
        var cubiculo = Math.floor(Math.random() * (5 - (4))) + (4);
        var oxigeno = Math.floor(Math.random() * (100 - (0))) + (0);

        var Arduino = new Object();
        Arduino.pulso = pulso;
        Arduino.cubiculo = cubiculo;
        Arduino.oxigeno = oxigeno;
        Arduino.fecha = new Date();

        console.log(Arduino.fecha.format("yyyy-mm-dd-hh:MM:ss"));

        console.log(Arduino);
        $.ajax({
            url: "/simulador/recepcion/"+Arduino.cubiculo+"/"+Arduino.fecha.format("yyyy-mm-dd-hh:MM:ss")+"/"+Arduino.pulso+"/"+Arduino.oxigeno
        });

    }
    
    function Revisor() {
        
    }

    $(document).ready(function(){
        setInterval('contador()',480);
    });
</script>


</body>
</html>
