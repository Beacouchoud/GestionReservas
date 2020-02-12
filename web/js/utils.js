function anyadirArrayAtabla(tabla, array) {
    for (const key in array) {
        if (array.hasOwnProperty(key)) {
            var tbody = tabla.find("tbody");
            if (tbody.length == 0) {
                tbody = $("<tbody></tbody>");
                tabla.append(tbody);
            }
            anyadirFilaAtabla(tbody, array[key]);
        }
    }
}

function anyadirFilaAtabla(tbody, array) {
    var $tr = $("<tr></tr>");
    var $td = $("<td></td>");
    for (const key in array) {
        if (array.hasOwnProperty(key)) {
            $tr.append($td.clone().text(array[key]));
        }
    }

    $tr.append($td.clone().append($("<button id='botonBorrar' class='btn btn-danger'>Borrar</button>")));
    tbody.append($tr);
}

function dateToDatabaseFormat(date) {
    return `${date.getFullYear()}-${date.getMonth()}-${date.getDate()}`;
}