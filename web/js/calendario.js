
//Formato de fecha valido 12-02-2020
// Setup the calendar with the current date
$(document).ready(function(){
    var date = new Date();
    var today = date.getDate();
    // Set click handlers for DOM elements
    $(".right-button").click({date: date}, next_year);
    $(".left-button").click({date: date}, prev_year);
    $(".month").click({date: date}, month_click);
    $("#add-button").click({date: date}, new_event);
    // Set current month as active
    $(".months-row").children().eq(date.getMonth()).addClass("active-month");
    init_calendar(date);
    $(".dates-table .table-date").click({date: date}, date_click);
    //show_events(events, months[date.getMonth()], today);

    handleDayClick(date);
});




// Initialize the calendar by appending the HTML dates
function init_calendar(date) {
    $(".tbody").empty();
    $(".events-container").empty();
    var calendar_days = $(".tbody");
    var month = date.getMonth();
    var year = date.getFullYear();
    var day_count = days_in_month(month, year);
    var row = $("<tr class='table-row'></tr>");
    var today = date.getDate();
    // Set date to 1 to find the first day of the month
    date.setDate(1);
    var first_day = date.getDay();
    // 35+firstDay is the number of date elements to be added to the dates table
    // 35 is from (7 days in a week) * (up to 5 rows of dates in a month)
    for(var i=0; i<35+first_day; i++) {
        // Since some of the elements will be blank, 
        // need to calculate actual date from index
        var day = i-first_day+1;
        // If it is a sunday, make a new row
        if(i%7===0) {
            calendar_days.append(row);
            row = $("<tr class='table-row'></tr>");
        }
        // if current index isn't a day in this month, make it blank
        if(i < first_day || day > day_count) {
            var curr_date = $("<td class='table-date nil'>"+"</td>");
            row.append(curr_date);
        }   
        else {
            var curr_date = $("<td class='table-date'>"+day+"</td>");
            if(today===day && $(".active-date").length===0) {
                curr_date.addClass("active-date");
              //  show_events(events, months[month], day);
            //   show_hours(date);
            }
            row.append(curr_date);
        }
    }
    // Append the last row and set the current year
    calendar_days.append(row);
    $(".year").text(year);
    handleDayClick(date);
}

function handleDayClick(date) {
    $(".dates-table .table-date").on("click", function ($event){
        $event.stopImmediatePropagation();
        // comprobamos que se haga click sobre un td con datos
        // para hacerlo que nunca falle no solo comprobamos el interior del elemento
        if ($event &&
            $event.currentTarget &&
            $event.currentTarget.innerText &&
            $event.currentTarget.innerText.length > 0) {
                $("#reservas").load("app/templates/reservas.php");
                // parseamos la fecha en base 10
                var dia = parseInt($event.currentTarget.innerText, 10);
                var mes=date.getMonth() +1;
                var fecha = dia + "-" + mes + "-" + date.getFullYear();
                console.log('fecha1',fecha);
                saveLocalStorage(fecha, 'fecha');

                //borramos la clase de dia activo y se la ponemos al clickeado
                $(".dates-table .table-date").removeClass('active-date');
                $($event.currentTarget).addClass('active-date');

                // entiendo que aqui se recogeran las reservas ya hechas del día, en el futuro
                
                // recoger las reservas ya hechas del dia y deshabilitar las opciones con la misma hora de inicio
                var aula = parseInt(getLocalStorage('aula'), 10);
                console.log('parametros de la consulta', fecha, aula)
                $.ajax({
                        url: "index.php?ctl=reservas",
                        type: "GET",
                        dataType: 'json',
                        data: {
                            fecha: fecha,
                            aula: aula
                        },
                        success: function(result){
                            // en el dato result debe venir un array con las reservas de ese dia
                            console.log('reservas previas', result);
                            $('#horas option').removeAttr('disabled')
                            result.forEach(reserva => {
                                $('#horas option[value="' + reserva.hora +'"]').attr('disabled', true);
                            });
                    //   var reservationsArray = reservations;
                        }
                });
                 
        }
    });
}

// Get the number of days in a given month/year
function days_in_month(month, year) {
    var monthStart = new Date(year, month, 1);
    var monthEnd = new Date(year, month + 1, 1);
    return (monthEnd - monthStart) / (1000 * 60 * 60 * 24);    
}

// esto deja de tener uso
// Event handler for when a date is clicked
function date_click(event) {
    var date = event.data.date;
    $(".active-date").removeClass("active-date");
    $(this).addClass("active-date");
    date.setDate(parseInt($(".active-date").html()));
    
};

// Event handler for when a month is clicked
function month_click(event) {
    $(".events-container").show(250);
    $("#dialog").hide(250);
    var date = event.data.date;
    $(".active-month").removeClass("active-month");
    $(this).addClass("active-month");
    var new_month = $(".month").index(this);
    date.setMonth(new_month);
    init_calendar(date);
}

// Event handler for when the year right-button is clicked
function next_year(event) {
    $("#dialog").hide(250);
    var date = event.data.date;
    var new_year = date.getFullYear()+1;
    $("year").html(new_year);
    date.setFullYear(new_year);
    init_calendar(date);
}

// Event handler for when the year left-button is clicked
function prev_year(event) {
    $("#dialog").hide(250);
    var date = event.data.date;
    var new_year = date.getFullYear()-1;
    $("year").html(new_year);
    date.setFullYear(new_year);
    init_calendar(date);
}

// Event handler for clicking the new event button
function new_event(event) {
    // if a date isn't selected then do nothing
    if($(".active-date").length===0)
        return;
    // remove red error input on click
    $("input").click(function(){
        $(this).removeClass("error-input");
    })
    // empty inputs and hide events
    $("#dialog input[type=text]").val('');
    $("#dialog input[type=number]").val('');
    $(".events-container").hide(250);
    $("#dialog").show(250);
    // Event handler for cancel button
    $("#cancel-button").click(function() {
        $("#name").removeClass("error-input");
        $("#count").removeClass("error-input");
        $("#dialog").hide(250);
        $(".events-container").show(250);
    });
    // Event handler for ok button
    $("#ok-button").unbind().click({date: event.data.date}, function() {
        var date = event.data.date;
        var name = $("#name").val().trim();
        var count = parseInt($("#count").val().trim());
        var day = parseInt($(".active-date").html());
        // Basic form validation
        if(name.length === 0) {
            $("#name").addClass("error-input");
        }
        else if(isNaN(count)) {
            $("#count").addClass("error-input");
        }
        else {
            $("#dialog").hide(250);
            console.log("new event");
            new_event_json(name, count, date, day);
            date.setDate(day);
            init_calendar(date);
        }
    });
}

// Adds a json event to event_data
function new_event_json(name, count, date, day) {
    var event = {
        "occasion": name,
        "invited_count": count,
        "year": date.getFullYear(),
        "month": date.getMonth()+1,
        "day": day
    };
    event_data["events"].push(event);
}

// Display all events of the selected date in card views
// function show_events(events, month, day) {
//     // Clear the dates container
//     $(".events-container").empty();
//     $(".events-container").show(250);
    
//     // If there are no events for this date, notify the user
//     if(events.length===0) {
//         var event_card = $("<div class='event-card'></div>");
//         var event_name = $("<div class='event-name'>There are no events planned for "+month+" "+day+".</div>");
//         $(event_card).css({ "border-left": "10px solid #FF1744" });
//         $(event_card).append(event_name);
//         $(".events-container").append(event_card);
//     }
//     else {
//         // Go through and add each event as a card to the events container
//         for(var i=0; i<events.length; i++) {
//             var event_card = $("<div class='event-card'></div>");
//             var event_name = $("<div class='event-name'>"+events[i]["occasion"]+":</div>");
//             var event_count = $("<div class='event-count'>"+events[i]["invited_count"]+" Invited</div>");
//             if(events[i]["cancelled"]===true) {
//                 $(event_card).css({
//                     "border-left": "10px solid #FF1744"
//                 });
//                 event_count = $("<div class='event-cancelled'>Cancelled</div>");
//             }
//             $(event_card).append(event_name).append(event_count);
//             $(".events-container").append(event_card);
//         }
//     }
// }



// function show_hours(date) {
//     console.log(date);
   
//     var fecha = date.toLocaleDateString();
//     console.log(fecha);
//     $.ajax({url: "index.php?ctl=calendario",type: "GET", data: {fecha: fecha}, success: function(){
//      //   var reservationsArray = reservations;
//         console.log(fecha);
//     }});
// }





const months = [ 
    "January", 
    "February", 
    "March", 
    "April", 
    "May", 
    "June", 
    "July", 
    "August", 
    "September", 
    "October", 
    "November", 
    "December" 
];


//Añadiendo el evento reservar

