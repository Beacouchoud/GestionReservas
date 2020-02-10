<?php ob_start() ?>
<!-- aqui pondremos El calendario (-_-) o eso creo (╯︵╰,) -->
<link rel="stylesheet" href="web/css/style.css">
  <div class="content container">
    <div class="calendar-container row">
      <div class="calendar col-12 "> 
        <div class="year-header xs-col-8 sm-col-12 "> 
          <span class="left-button" id="prev"> &lang; </span> 
          <span class="year" id="label"></span> 
          <span class="right-button" id="next"> &rang; </span>
        </div> 
        <table class="months-table col-12 mb-5"> 
          <tbody>
            <tr class="months-row">
              <td class="month"">Jan</td> 
              <td class="month">Feb</td> 
              <td class="month">Mar</td> 
              <td class="month">Apr</td> 
              <td class="month">May</td> 
              <td class="month">Jun</td> 
              <td class="month">Jul</td>
              <td class="month">Aug</td> 
              <td class="month">Sep</td> 
                <td class="month">Oct</td>          
                <td class="month">Nov</td>
                <td class="month">Dec</td>
                </tr>
            </tbody>
        </table> 
            
        <table class="days-table col-12"> 
            <td class="day">Sun</td> 
            <td class="day">Mon</td> 
            <td class="day">Tue</td> 
            <td class="day">Wed</td> 
            <td class="day">Thu</td> 
            <td class="day">Fri</td> 
            <td class="day">Sat</td>
        </table> 
        <div class="frame col-12"> 
            <table class="dates-table"> 
                <tbody class="tbody">             
                </tbody> 
            </table>
        </div> 
            <button class="button" id="add-button" class="mt-3">Add Event</button>
        </div>
        </div>
        </div>

<?php $contenido = ob_get_clean() ?>

<?php include 'layouthome.php' ?>

