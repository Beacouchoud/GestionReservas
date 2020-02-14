
<!-- aqui pondremos reservas de cada usuario -->

<h1>Timetable</h1>
<form action="">
<select name="horas" id="horas" class="row col-10" size="14">
    <option disabled value="08">08:00 - 09:00</option>
    <option disabled value="09">09:00 - 10:00</option>
    <option disabled value="10">10:00 - 11:00</option>
    <option value="11">11:00 - 12:00</option>
    <option value="12">12:00 - 13:00</option>
    <option value="13">13:00 - 14:00</option>
    <option value="15">15:00 - 16:00</option>
    <option value="16">16:00 - 17:00</option>
    <option value="17">17:00 - 18:00</option>
    <option value="18">18:00 - 19:00</option>
    <option value="19">19:00 - 20:00</option>
    <option value="20">20:00 - 21:00</option>
    <option value="21">21:00 - 22:00</option>
</select>

<input id="reservar" type="button" value="Reserve" class="button mt-4" ></input>
</form>
<script>
    $(function() {
        //if ($('#horas').val().length > 0) {
            //var horas = [];
            //$('#horas').val().forEach(horaSel => horas.push(horaSel)); 
            var data = {
                        fecha: getLocalStorage('fecha'),
                        horas: $('#horas').val(),
                        aula: parseInt(getLocalStorage('aula'), 10),
                        action: 'reserve'
                };
            console.log('parametros a enviar', data);
            
            $.ajax({
                    url: "index.php?ctl=reservas", //devuelve las reservas de la base de datos
                    type: "GET",
                    data: data,
                    success: function(result){
                        //TODO Bloquear las horas seleccionadas
                        console.log(result);
                    }
            });
        //}


    $("#reservar").on("click", function() {
        //if ($('#horas').val().length > 0) {
            //var horas = [];
            //$('#horas').val().forEach(horaSel => horas.push(horaSel)); 
            var data = {
                        fecha: getLocalStorage('fecha'),
                        horas: $('#horas').val(),
                        aula: parseInt(getLocalStorage('aula'), 10),
                        // action: 'reserve'
                };
            console.log('parametros a enviar', data);
            
            $.ajax({
                    url: "index.php?ctl=hacerReserva", //crear metodo reservar que guarde reserva enviada
                    type: "GET",
                    data: data,
                    success: function(result){
                        //TODO Bloquear las horas seleccionadas
                        console.log(result);
                    }
            });
        //}
    });

    $("#cancelar").on("click", function() {
        if ($('#horas').val().length > 0) {
            var horas = [];
            $('#horas').val().forEach(horaSel => horas.push(horaSel)); 
            var data = {
                        fecha: getLocalStorage('fecha'),
                        horas: horas,
                        aula: parseInt(getLocalStorage('aula'), 10),
                        action: 'cancel'
                };
            console.log('parametros a enviar', data);
            
            $.ajax({
                    url: "index.php?ctl=reservas",
                    type: "GET",
                    data: data,
                    success: function(result){
                        //TODO Desbloquear las horas seleccionadas
                        console.log(result);
                    }
            });
        }
    });
});
</script>