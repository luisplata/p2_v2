<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{$paciente->nombre." - ".$paciente->cedula}}</title>

        <!-- Bootstrap -->
        <link href="/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    </head>

    <body>
    <center><h1>FORMATO DE HISTORIA CLINICA</h1></center>
    <br/>
    <dl>
        <b>Nombre</b>: {{$paciente->nombre}}
        <br/>
        <b>Identificacion</b>: {{$paciente->cedula}}
        <br/>
        <b>Registro</b>: {{count($paciente->historiasClinicas) > 0? $paciente->historiasClinicas[0]->id:"No tiene historia clinica"}}
    </dl>
    <center>
        Sexo: {{$paciente->sexo == "H"? "Masculino":"Femenino"}} | Edad: {{$paciente->edad}} | Cubiculo: {{$paciente->asignacionPacientes[0]->cubiculo->numero}} | RH: {{$paciente->tipo_sangre == "NR"?"NR":$paciente->tipo_sangre.$paciente->RH}}
    </center>

    @foreach($paciente->historiasClinicas as $historia)
    <h2>Historia Clinica</h2>
    <p>
        {{$historia->historia}}
    </p>
    @endforeach

    @foreach($paciente->antecedentes as $antecedente)
    <h2>Antecedentes</h2>
    <p>
        {{$antecedente->tipo}}: {{$antecedente->nombre_proce}}
    </p>
    <h2>Alergias</h2>
    <p>
        {{$antecedente->alergias}}
    </p>
    <h2>Antecedentes Familiares</h2>
    <p>
        {{$antecedente->ant_familiares}}
    </p>
    <h2>Antecedentes Personales</h2>
    <p>
        {{$antecedente->ant_personales}}
    </p>
    @endforeach
    <h2>Tratamientos</h2>
    @foreach($paciente->tratamientos as $tratamiento)
    <p>
        Creado el: {{$tratamiento->created_at}}
        {{$tratamiento->medicamento}} de {{$tratamiento->dosis}} cada {{$tratamiento->periocidad}}
        <br/>
        <b>{{$tratamiento->personal->nombre}}</b>
    </p>
    @endforeach
    <button class="btn btn-primary hidden-print" id="imprimir">Imprimir</button>
    <script>
        document.querySelector("#imprimir").onclick = function () {
            alert("Alerta, Al terminar el proceso de impresion se liberará el cubiculo del paciente");
            window.print();
            location.href = "{{url('enfermera_jefe/darDeAlta/'.$paciente->asignacionPacientes[0]->cubiculo->numero.'/'.$paciente->cedula)}}";
        };
    </script>
</body>
</html>
