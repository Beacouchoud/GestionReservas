$("#guardarDatosProfesors").on("click", function () {
    $("#tablaProfesors tr").each(function () {
        var current = $(this);
        $.ajax({
            url: "index.php?ctl=crearProfesor",
            type: "POST",
            data: {
                "id_usuario": current.find(".id_usuario").text(),
                "nombre": current.find(".nombre").text(),
                "apellido": current.find(".apellido").text(),
                "email": current.find(".email").text(),
                "password": current.find(".password").text(),
            },
            success: function (data) {
                console.log("Resultado exitoso de modificar Profesores");
                console.log(data);
            },
            error: function (errorData) {
                console.log("Error al modificar Profesores");
                console.error(errorData);
            }
        });
    });
});

$id_usuario = recoge('id_usuario');
$nombre = recoge('nombre');
$apellido = recoge('apellido');
$email = recoge('email');
$password = recoge('password');
$("#crearProfesor").on("click", function () {
    $.ajax({
        url: "index.php?ctl=modificarProfesor",
        type: "POST",
        data: {
            "id_usuario": $("#input_id_usuario").val(),
            "nombre": $("#input_nombre").val(),
            "apellido": $("#input_apellido").val(),
            "email": $("#input_email").val(),
            "password": $("#input_password").val(),
        },
        success: function (data) {
            console.log("Resultado exitoso de crear Profesores");
            console.log(data);
        },
        error: function (errorData) {
            console.log("Error al crear Profesores");
            console.error(errorData);
        }
    });
});

$("#tablaProfesors .habilitado").on("click", function () {
    $.ajax({
        url: "index.php?ctl=habilitarProfesor",
        type: "POST",
        data: {
            "id_Profesor": current.find(".id_usuario").text(),
            "habilitado": current.find(".habilitado").val(),
        },
        success: function (data) {
            console.log("Resultado exitoso de habilitar/deshabilitar Profesores");
            console.log(data);
        },
        error: function (errorData) {
            console.log("Error al habilitar/deshabilitar Profesores");
            console.error(errorData);
        }
    });
});

$("#tablaProfesors .darAlta").on("click", function () {
    $.ajax({
        url: "index.php?ctl=darDeAltaProfesor",
        type: "POST",
        data: {
            "id_Profesor": current.find(".id_usuario").text(),
        },
        success: function (data) {
            console.log("Resultado exitoso de dar de alta Profesores");
            console.log(data);
        },
        error: function (errorData) {
            console.log("Error al dar de alta Profesores");
            console.error(errorData);
        }
    });
})