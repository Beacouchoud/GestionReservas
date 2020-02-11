
<!-- aqui pondremos reservas de cada usuario -->

<h1>Timetable</h1>
<form action="">
<select name="horas" id="horas" multiple class="row col-10" size="14">
    <option disabled value="08:00 - 09:00">08:00 - 09:00</option>
    <option disabled value="09:00 - 10:00">09:00 - 10:00</option>
    <option disabled value="10:00 - 11:00">10:00 - 11:00</option>
    <option value="11">11:00 - 12:00</option>
    <option value="12">12:00 - 13:00</option>
    <option value="13">13:00 - 14:00</option>
    <option value="15">15:00 - 16:00</option>
    <option value="16">16:00 - 17:00</option>
    <option value="18:00 - 18:00">17:00 - 18:00</option>
    <option value="18:00 - 19:00">18:00 - 19:00</option>
    <option value="19:00 - 20:00">19:00 - 20:00</option>
    <option value="20:00 - 21:00">20:00 - 21:00</option>
    <option value="21:00 - 22:00">21:00 - 22:00</option>
</select>
<input id="reservar" type="button" value="Reservar" class="button mt-4" ></input>
</form>
<script>
    $("#reservar").on("click", function() {
        // recogemos el día, mes y año para poner la hora
        fechaSeleccionada
        $.ajax({
                url: "index.php?ctl=reservas",
                type: "GET",
                data: {fecha: fecha},
                success: function(result){
                    console.log(result);
            //   var reservationsArray = reservations; que esta el profe y estoy escribiendo sin tocar el teclado espera
        
                }
        });
    });
    // como las citas son de 1h y siempre comienzan a en punto. con tener el princip
</script>