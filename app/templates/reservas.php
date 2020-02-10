
<!-- aqui pondremos reservas de cada usuario -->
<h1>Timetable</h1>
<select name="horas" id="horas"></select>
<?php foreach ($params['reservas'] as $reserva) :?>
    <option value=""><?php echo $reserva['hora']." - ".$reserva["profesor"] ?></option>
            <!--TODO: si es administrador mostrar checkbox -->
    </tr>
<?php endforeach; ?>
