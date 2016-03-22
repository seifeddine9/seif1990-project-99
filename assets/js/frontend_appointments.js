  $('document').ready(function(){



    $('#my-appointments').empty();



/*alert(GlobalVariables.appointments.id);*/
console.log(GlobalVariables.appointments[1]);

$.each(GlobalVariables.appointments, function(index, appointment ) {
        var start = GeneralFunctions.formatDate(Date.parse(appointment.start_datetime), GlobalVariables.dateFormat, true),
            end = GeneralFunctions.formatDate(Date.parse(appointment.end_datetime), GlobalVariables.dateFormat, true);
        var html =
                '<div class="appointment-row" data-id="' + appointment.id + '">' +
                    start + ' - ' + end + '<br>' +
                    appointment.service.name + ', ' +
                    appointment.provider.first_name + ' ' + appointment.provider.last_name +
                '</div>';
        $('#my-appointments').append(html);
    });


/* to be continued*/




});
