function alerta(cubiculo, alerta) {
    //hay un bug no controlado, que cuando hay otra alerta con el modal abierto se modifica el dato :S
    $("#alerta-titulo").text("Cubiculo " + cubiculo);
    $("#alerta-contenido").text(alerta);
    $("#alerta-cubiculo").val(cubiculo);
    $("#atenderAlrta").modal({
        backdrop: 'static',
        keyboard: false
    });
    //Comenzamos  contar para la alerta critica
    alertaCritica(cubiculo, alerta);
}
function alertaCritica(cubiculo, alerta) {
    setTimeout(function () {
        $("#atenderAlrta").modal('hide');
        $("#alerta-critica-titulo").text("Alerta critica! " + "Cubiculo " + cubiculo);
        $("#alerta-critica-contenido").text(alerta);
        $("#alerta-critica-cubiculo").val(cubiculo);
        $("#atenderAlrtaCritica").modal({
            backdrop: 'static',
            keyboard: false
        });
    }, 30000);
}
function validarUsurio(url, cubiculo, user, pass) {
    //hacemos un ajax verificar estos datos

    $.ajax({
        url: url + "/simulador/atenderAlerta/" + cubiculo,
        type: 'post',
        data: {usuario: user, pass: pass, _token: token},
        success: function (response) {
            if (response.respuesta == "true") {
                //Son validos
                swal("Correcto");
                console.log(response);
                $("#atenderAlrta").modal('hide');
            } else {
                //No son validos
                swal("Usted no es una enfermera");
                console.log(response);
            }

            //vaciamos los campos
            var user = $("#alerta-user").val("");
            var pass = $("#alerta-pass").val("");
        }
    });
}
function validarEnfermeraJefe(url, cubiculo, user, pass) {
    //hacemos un ajax verificar estos datos

    $.ajax({
        url: url + "/simulador/atenderAlerta/enfermeraJefe/" + cubiculo,
        type: 'post',
        data: {usuario: user, pass: pass, _token: token},
        success: function (response) {
            if (response.respuesta == "true") {
                //Son validos
                swal("Correcto");
                console.log(response);
                $("#atenderAlrtaCritica").modal('hide');
            } else {
                //No son validos
                swal("Usted no es una enfermera");
                console.log(response);
            }

            //vaciamos los campos
            var user = $("#alerta-user").val("");
            var pass = $("#alerta-pass").val("");
        }
    });
}
function ajax(url) {
    $.ajax({
        url: url + "/simulador/leer",
        type: 'get',
        success: function (response) {
            //console.log(response);
            response.forEach(function (value) {
                //console.log(value);
                var cubiculo = $("#cubiculo-" + value.cubiculo);
                if (value.pulso > 100 || value.pulso < 50) {
                    //console.warn("alerta de pulso");
                    //cubiculo.addClass("alerta");
                    //$("#mensaje_pulso_cubiculo-" + value.cubiculo).html("Alerta de Pulso fuera de parametros normales!");
                    //Version dos de la alerta
                    alerta(value.cubiculo, "Alerta de Pulso fuera de parametros normales!");
                    console.error("Fuera de lo normal");
                } else {
                    //$("#mensaje_pulso_cubiculo-" + value.cubiculo).html("");
                }
                if (value.so < 95) {
                    //console.warn("alerta de SO");
                    //cubiculo.addClass("alerta");
                    //$("#mensaje_so_cubiculo-" + value.cubiculo).html("Alerta de Saturacion de Oxigeno fuera de parametros normales!");
                    //version 2 de la alerta
                    alerta(value.cubiculo, "Alerta de Saturacion de Oxigeno fuera de parametros normales!");
                    console.error("Fuera de lo normal");
                } else {
                    //$("#mensaje_so_cubiculo-" + value.cubiculo).html("");
                }
                if (value.pulso < 100 && value.pulso > 50 && value.so > 95) {
                    cubiculo.removeClass("alerta");
                }
                //console.log(value.cubiculo + " "+value.so);
                $("#so-" + value.cubiculo).html(value.so + "%");
                $("#ppm-" + value.cubiculo).html(value.pulso + " ppm");
                //consulto los medicamentos por cubiculos
                //medicamentos(value.cubiculo, url);
            });
        }
    });
}
function medicamentos(cubiculo, url) {
    $.ajax({
        url: url + "/simulador/medicamento/" + cubiculo,
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

Date.prototype.addHours = function (h) {
    this.setTime(this.getTime() + (h * 60 * 60 * 1000));
    return this;
}
$("#btnAtender").on("click", function () {
    var user = $("#alerta-user").val();
    var pass = $("#alerta-pass").val();
    var cubiculo = $("#alerta-cubiculo").val();
    isEnfermera = false;
    //para llegar aqui tenemos que validar
    validarUsurio(url, cubiculo, user, pass);
});

$("#btnAtender-critica").on("click", function () {
    var user = $("#alerta-critica-user").val();
    var pass = $("#alerta-critica-pass").val();
    var cubiculo = $("#alerta-critica-cubiculo").val();
    isEnfermera = false;
    //para llegar aqui tenemos que validar
    validarEnfermeraJefe(url, cubiculo, user, pass);
});