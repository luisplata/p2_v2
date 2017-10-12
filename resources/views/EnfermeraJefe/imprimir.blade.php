@extends("plantilla.app")

@section("plugin-css")
<link href="http://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css"/>
@endsection

@section("contenido")
<table id="datatable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <td colspan="6" class="text-center">
                Paciente {{$paciente->cedula}} - {{$paciente->nombre}}
            </td>
        </tr>
        <tr>
            <td colspan="6" class="text-center">
                Datos completos Paciente {{$paciente->cedula}} - {{$paciente->nombre}}
            </td>
        </tr>
        <tr>
            <td>
                Tratamientos
            </td>
            <td>
                Signos Vitales
            </td>
            <td>
                Historia Clinica
            </td>
            <td>
                Acompañante
            </td>
            <td>
                Antecedentes
            </td>
            <td>
                Cubiculo
            </td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <table class="table table-striped table-bordered">
                    @foreach($paciente->tratamientos as $tratamiento)
                    <tr>
                        <td>
                            {{$tratamiento->medicamento}} de {{$tratamiento->dosis}} cada {{$tratamiento->periocidad}}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </td>
            <td>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>
                                Fecha
                            </td>
                            <td>
                                Pulso
                            </td>
                            <td>
                                SO
                            </td>
                        </tr>
                    </thead>
                    @foreach($paciente->signosVitales as $signoVital)
                    <tr>
                        <td>
                            {{$signoVital->fecha_signo}}
                        </td>
                        <td>
                            {{$signoVital->pulso}}
                        </td>
                        <td>
                            {{$signoVital->so}}
                        </td>
                    </tr>
                    @endforeach
                </table>

            </td>
            <td>
                <table class="table table-striped table-bordered">
                    @foreach($paciente->historiasClinicas as $historias)
                    <tr>
                        <td>
                            {{$historias->historia}}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </td>
            <td>
                <table class="table table-striped table-bordered">
                    @foreach($paciente->acompaniantes as $acompaniante)
                    <tr>
                        <td>
                            {{$acompaniante}}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </td>
            <td>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>
                                Tipo
                            </td>
                            <td>
                                Nombre
                            </td>
                            <td>
                                Alergia
                            </td>
                            <td>
                                Antecedente Familiar
                            </td>
                            <td>
                                Antecedente Personal
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paciente->antecedentes as $antecedente)
                        <tr>
                            <td>
                                {{$antecedente}}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </td>
            <td>
                <table class="table table-striped table-bordered">
                    @foreach($paciente->asignacionPacientes as $asignacion)
                    <tr>
                        <td>
                            {{$asignacion->cubiculo->numero}}
                        </td>
                    </tr>
                    @endforeach
                </table>
            </td>
        </tr>
    </tbody>
</table>
@endsection

@section("plugin-js")
<script type="text/javascript" src="http://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<!-- jQuery autocomplete -->
<script>
$(document).ready(function () {
    $('#datatable').DataTable({
        buttons: ['copy', 'csv', 'print']
    });
});
</script>
<!-- /jQuery autocomplete -->
@endsection