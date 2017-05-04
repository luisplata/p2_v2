<!DOCTYPE html>
<html lang="en">
<body class="nav-md">
simulador
<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>

<script src="http://stevenlevithan.com/assets/misc/date.format.js"></script>
<script>
    function contador(){
        var pulso = Math.floor(Math.random() * (100 - (0))) + (0);
        var cubiculo = Math.floor(Math.random() * (7 - (1))) + (1);
        var oxigeno = Math.floor(Math.random() * (110 - (80))) + (80);

        var Arduino = new Object();
        Arduino.pulso = pulso;
        Arduino.cubiculo = cubiculo;
        Arduino.oxigeno = oxigeno;
        Arduino.fecha = new Date();

        //console.log(Arduino.fecha.format("yyyy-mm-dd-hh:MM:ss"));

        console.log(Arduino);
        $.ajax({
            url: "/simulador/recepcion/"+Arduino.cubiculo+"/"+Arduino.fecha.format("yyyy-mm-dd-hh:MM:ss")+"/"+Arduino.pulso+"/"+Arduino.oxigeno
        });

    }
    
    function Revisor() {
        
    }

    $(document).ready(function(){
        setInterval('contador()',1000);
    });
</script>


</body>
</html>

