<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>URGENCIAS Primer Nivel</title>

        <!-- Bootstrap -->
        <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="/vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="/vendors/animate.css/animate.min.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="/build/css/custom.min.css" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="/css/sweetalert.css">
    </head>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        {{ Form::open(array('url' => 'login')) }}
                        <div>
                            <h1><img class="img-circle imagen_top"  src="https://www.asepeyo.es/wp-content/uploads/cropped-ico-asepeyo-32x32.png" /> </h1>
                        </div>
                        <h1>Ingreso de Personal</h1>
                        <div id="cubiculo">
                            <input class="form-control" placeholder="Identificación" name="cedula" type="number">
                        </div>
                        <div>
                            <input class="form-control" placeholder="password" name="pass" type="password">
                        </div>
                        <div>
                            <button class="btn btn-default submit">Ingresar</button>
                        </div>
                        <div class="clearfix"></div>
                        <div class="separator">
                            <div class="clearfix"></div>
                            <br />
                            <div>
                                <h1><img class="img-circle imagen_top"  src="https://pbs.twimg.com/profile_images/732304571985494016/TMNTavT1_reasonably_small.jpg" /> Universidad Del Sinú</h1>
                                <p>©{{date("Y")}} All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                            </div>
                            {{ Form::close() }}
                    </section>
                </div>
            </div>
        </div>
        <script src="{!! asset('js/sweetalert.min.js') !!}"></script> 
        <script>
var url_string = window.location;
var url = new URL(url_string);
var cubiculo = url.searchParams.get("cubiculo");

if (cubiculo != null) {
    var div = document.querySelector("#cubiculo");
    div.innerHTML += '<input name="cubiculo" type="hidden" value="' + cubiculo + '">';
    console.log(div);
}
        </script>
    </body>
</html>
