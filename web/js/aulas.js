$("#guardarDatosAulas").on("click", function () {
    $("#tablaAulas tr").each(function () {
        var current = $(this);
        $.ajax({
            url: "index.php?ctl=modificarAula",
            type: "POST",
            data: {
                "id_aula": current.find(".id_aula").text(),
                "num_aula": current.find(".num_aula").text(),
                "habilitado": current.find(".habilitado").val()(),
                "descripcion_aula": current.find(".descripcion_aula").text(),
            },
            success: function (data) {
                console.log("Resultado exitoso de modificar aulas");
                console.log(data);
            },
            error: function (errorData) {
                console.log("Error al modificar aulas");
                console.error(errorData);
            }
        });
    });
})

$("#crearAula").on("click", function () {
    $.ajax({
        url: "index.php?ctl=crearAula",
        type: "POST",
        data: {
            "id_aula": $("#input_id_aula").val(),
            "num_aula": $("#input_num_aula").val(),
            "habilitado": $("#input_habilitado").val(),
            "descripcion_aula": $("#input_descripcion_aula").val(),
        },
        success: function (data) {
            console.log("Resultado exitoso de crear aulas");
            console.log(data);
        },
        error: function (errorData) {
            console.log("Error al crear aulas");
            console.error(errorData);
        }
    });
})

$("#tablaAulas .habilitado").on("click", function () {
    $.ajax({
        url: "index.php?ctl=habilitarAula",
        type: "POST",
        data: {
            "id_aula": current.find(".id_aula").text(),
            "habilitado": current.find(".habilitado").val(),
        },
        success: function (data) {
            console.log("Resultado exitoso de habilitar/deshabilitar aulas");
            console.log(data);
        },
        error: function (errorData) {
            console.log("Error al habilitar/deshabilitar aulas");
            console.error(errorData);
        }
    });
})