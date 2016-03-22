/* ----------------------------------------------------------------------------
 * Easy!Appointments - Open Source Web Scheduler
 *
 * @package     EasyAppointments
 * @author      A.Tselegidis <alextselegidis@gmail.com>
 * @copyright   Copyright (c) 2013 - 2016, Alex Tselegidis
 * @license     http://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        http://easyappointments.org
 * @since       v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * This namespace contains functions that implement the book appointment page
 * functionality. Once the initialize() method is called the page is fully
 * functional and can serve the appointment booking process.
 *
 * @namespace FrontendBook
 */
var FrontendBook = {
    /**
     * Determines the functionality of the page.
     *
     * @type {bool}
     */
    manageMode: false,
    /**
     * This method initializes the book appointment page.
     *
     * @param {bool} bindEventHandlers (OPTIONAL) Determines whether the default
     * event handlers will be binded to the dom elements.
     * @param {bool} manageMode (OPTIONAL) Determines whether the customer is going
     * to make  changes to an existing appointment rather than booking a new one.
     */
    initialize: function (bindEventHandlers, manageMode) {
        if (bindEventHandlers === undefined) {
            bindEventHandlers = true; // Default Value
        }

        if (manageMode === undefined) {
            manageMode = false; // Default Value
        }

        if (window.console === undefined) {
            window.console = function () {} // IE compatibility
        }

        FrontendBook.manageMode = manageMode;
        FrontendBook.resetModalInput();
        // Initialize page's components (tooltips, datepickers etc).
        $('.book-step').qtip({
            position: {
                my: 'top center',
                at: 'bottom center'
            },
            style: {
                classes: 'qtip-green qtip-shadow custom-qtip'
            }
        });
        console.log(GlobalVariables);
        $('thead').hide();
        $("#my-appointments").tabs({
            "activate": function (event, ui) {
                var table = $.fn.dataTable.fnTables(true);
            }
        });
        $.each(GlobalVariables.appointments, function (index, appointment) {
            var start = GeneralFunctions.formatDate(Date.parse(appointment.start_datetime), GlobalVariables.dateFormat, true),
                    end = GeneralFunctions.formatDate(Date.parse(appointment.end_datetime), GlobalVariables.dateFormat, true);
            //dateStart
            var heureStart = start.substr(11);
            var dateStart = start.substr(0, 10);
            dateStart = dateStart.split("/");
            var newDateStart = dateStart[2] + "-" + dateStart[1] + "-" + dateStart[0];
            newDateStart = newDateStart + " " + heureStart;
            //newDateStart= new Date(newDateStart);// dateStart
            // console.log(newDateStart );
            /*             
             //dateEnd
             var heureEnd =end.substr(11);
             var dateEnd = end.substr(0, 10);
             dateEnd = dateEnd.split("/");
             
             var newDateEnd = dateEnd[2] + "/" + dateEnd[1]+ "/" + dateEnd[0];
             newDateEnd = newDateEnd +" "+ heureEnd;
             newDateEnd= new Date(newDateEnd);// dateEnd*/

            var startDate = moment(start, 'DD/MM/YYYY').format("DD MMM YYYY")
            var now = moment();
            var tout = '<tr  data-target="#modal-info-appointment" data-id="' + appointment.id + '">' +
                    '<td><span class="dateDebut" ><i class="fa fa-clock-o  fa-2x" style="color: #68c39f"></i><strong>&nbsp;&nbsp;' + startDate + '</strong><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 1.2em;  color:#686868">&nbsp;&nbsp;&nbsp;&nbsp;à&nbsp;' + heureStart + 'H</span></span></td>' +
                    '<td><strong ">' + appointment.service.name + '</strong><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span   style="color:#686868">Pour &nbsp;' + appointment.service.price + ' ' + appointment.service.currency + '</span></td>' +
                    '</tr>';
            if (moment(newDateStart).isSameOrAfter(now))
            {
                var future = '<tr  data-target="#modal-info-appointment" data-id="' + appointment.id + '">' +
                        '<td><span class="dateDebut" ><i class="fa fa-clock-o  fa-2x" style="color: #68c39f"></i><strong>&nbsp;&nbsp;' + startDate + '</strong><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 1.2em;  color:#686868">&nbsp;&nbsp;&nbsp;&nbsp;à&nbsp;' + heureStart + 'H</span></span></td>' +
                        '<td><strong ">' + appointment.service.name + '</strong><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span   style="color:#686868">Pour &nbsp;' + appointment.service.price + ' ' + appointment.service.currency + '</span></td>' +
                        '</tr>';
            }


            if (moment(newDateStart).isBefore(now))
            {
                var past = '<tr  data-target="#modal-info-appointment" data-id="' + appointment.id + '">' +
                        '<td><span class="dateDebut" ><i class="fa fa-clock-o  fa-2x" style="color: #68c39f"></i><strong>&nbsp;&nbsp;' + startDate + '</strong><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 1.2em;  color:#686868">&nbsp;&nbsp;&nbsp;&nbsp;à&nbsp;' + heureStart + 'H</span></span></td>' +
                        '<td><strong ">' + appointment.service.name + '</strong><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span   style="color:#686868">Pour &nbsp;' + appointment.service.price + ' ' + appointment.service.currency + '</span></td>'+
                        '</tr>';
            }





            $('#list-appointments tbody').append(tout);
            $('#list-future-appointments tbody').append(future);
            $('#list-past-appointments tbody').append(past);
        });





       $('table').dataTable({ 
           "bLengthChange": false,
           "bInfo" : false,
           "pageLength": 5,
           'responsive': true,
           "oLanguage": {
                    
                     "sInfoEmpty": 'Aucun Rendez-vous à afficher',
                    "sEmptyTable": "Aucun Rendez-vous à afficher."
}
});
        $('#select-date').datepicker({
            dateFormat: 'dd-mm-yy',
            firstDay: 1, // Monday
            minDate: 0,
            defaultDate: Date.today(),
            dayNames: [EALang['sunday'], EALang['monday'], EALang['tuesday'], EALang['wednesday'], EALang['thursday'], EALang['friday'], EALang['saturday']],
            dayNamesShort: [EALang['sunday'].substr(0, 3), EALang['monday'].substr(0, 3),
                EALang['tuesday'].substr(0, 3), EALang['wednesday'].substr(0, 3),
                EALang['thursday'].substr(0, 3), EALang['friday'].substr(0, 3),
                EALang['saturday'].substr(0, 3)],
            dayNamesMin: [EALang['sunday'].substr(0, 2), EALang['monday'].substr(0, 2),
                EALang['tuesday'].substr(0, 2), EALang['wednesday'].substr(0, 2),
                EALang['thursday'].substr(0, 2), EALang['friday'].substr(0, 2),
                EALang['saturday'].substr(0, 2)],
            monthNames: [EALang['january'], EALang['february'], EALang['march'], EALang['april'],
                EALang['may'], EALang['june'], EALang['july'], EALang['august'], EALang['september'],
                EALang['october'], EALang['november'], EALang['december']],
            prevText: EALang['previous'],
            nextText: EALang['next'],
            currentText: EALang['now'],
            closeText: EALang['close'],
            onSelect: function (dateText, instance) {
                FrontendBook.getAvailableHours(dateText);
                FrontendBook.updateConfirmFrame();
            }
        });
        // Bind the event handlers (might not be necessary every time
        // we use this class).
        if (bindEventHandlers) {
            FrontendBook.bindEventHandlers();
        }

        // If the manage mode is true, the appointments data should be
        // loaded by default.
        if (FrontendBook.manageMode) {
            FrontendBook.applyAppointmentData(GlobalVariables.appointmentData,
                    GlobalVariables.providerData, GlobalVariables.customerData);
        } else {
            $('#select-service').trigger('change'); // Load the available hours.
        }


    },
    /**
     * This method binds the necessary event handlers for the book
     * appointments page.
     */
    bindEventHandlers: function () {
        /**
         * Event: Selected Provider "Changed"
         *
         * Whenever the provider changes the available appointment
         * date - time periods must be updated.
         */
        $('#select-provider').change(function () {
            FrontendBook.getAvailableHours(Date.today().toString('dd-MM-yyyy'));
            FrontendBook.updateConfirmFrame();
        });
        /**
         * event : display  booking information on click 
         * 
         *when click on appointment-row display the appointment info
         */

        $("tr").click(function () { // Click to only happen on announce links


            var appointmentId = $(this).attr('data-id');
            var appointmentInfo;
            $.each(GlobalVariables.appointments, function (index, appointment) {

                if (GlobalVariables.appointments[index].id == appointmentId) {

                    appointmentInfo = appointment;

                }

            });
            $('#waiting-appointment').attr('data-id', appointmentId);
            $('#waiting-confirm').attr('data-id', appointmentInfo.hash);
            console.log('appointment hash: ', appointmentInfo.hash);
            if ($('#provider-form').css("display") != "none")
            {
                $('#general-info').html('<div >' +
                        '<span class="Service col-md-3">Prestations </span><span class="Service col-md-6">' + appointmentInfo.service.name + '</span><br>' +
                        '<span class="Provider col-md-3">Exécutant</span><span class="Provider col-md-6">' + appointmentInfo.provider.first_name + ' ' + appointmentInfo.provider.last_name + '</span><br>' +
                        '<span class="Date col-md-3">Date</span><span class="Date col-md-6">' + appointmentInfo.start_datetime + '</span><br>' +
                        '<span class="Prix col-md-3">Prix</span><span class="Prix col-md-6">' + appointmentInfo.service.price + ' ' + appointmentInfo.service.currency + '</span><br/></div>');
            } else {
                $('#general-info').html('<div >' +
                        '<span class="Service col-md-3">Prestations </span><span class="Service col-md-6">' + appointmentInfo.service.name + '</span><br>' +
                        //'<span class="Provider col-md-3">Exécutant</span><span class="Provider col-md-6">' + appointmentInfo.provider.first_name + ' ' + appointmentInfo.provider.last_name + '</span><br>' +
                        '<span class="Date col-md-3">Date</span><span class="Date col-md-6">' + appointmentInfo.start_datetime + '</span><br>' +
                        '<span class="Prix col-md-3">Prix</span><span class="Prix col-md-6">' + appointmentInfo.service.price + ' ' + appointmentInfo.service.currency + '</span><br/></div>');

            }


            $('#button-command').html('<button class="edit-appointment btn btn-primary" type="button" id="edit-appointment" data-id="' + appointmentInfo.id + '" ' +
                    '  data-toggle="modal" data-target="#edit-modal"> <i class="fa fa-pencil"> &nbsp</i>Modifier</button>' + '   ' +
                    '<button class="canceal-appointment btn btn-danger" type="button" id="canceal-appointment" data-id="' + appointmentInfo.hash + '" ><i class="fa fa-remove"></i>Supprimer</button>');
            $('#modal-info-appointment').modal('show');




        });
        /**
         * event : display  booking information on click 
         * 
         *when click on appointment-row display the appointment info
         */

        $("#waiting-appointment").click(function () { // Click to only happen on announce links
            var appointmentId = $(this).attr('data-id');
            var appointmentInfo;
            $.each(GlobalVariables.appointments, function (index, appointment) {

                if (GlobalVariables.appointments[index].id == appointmentId) {

                    appointmentInfo = appointment;
                }

            });

            $.each(GlobalVariables.availableServices, function (index, service) {
                if (service['id'] == $('#select-service').val()) {
                    servicename = service['name'];
                    serviceprice = service['price'];
                    servicecurrency = service['currency'];
                }
            });
            if ($('#provider-form').css("display") != "none")
            {
                $.each(GlobalVariables.availableProviders, function (index, provider) {
                    if (provider['id'] == $('#select-provider').val()) {
                        providername = provider['first_name'];
                        providerlast = provider['last_name'];
                    }
                });
            }
            waitingtime = $('#select-date').datepicker('getDate').toString('yyyy-MM-dd');

            if ($('#provider-form').css("display") != "none")
            {
                $('#waiting-content').html('<div >' +
                        '<span class="Service col-md-3">Prestations </span><span class="Service col-md-6">' + servicename + '</span><br>' +
                        '<span class="Provider col-md-3">Exécutant</span><span class="Provider col-md-6">' + providername + ' ' + providerlast + '</span><br>' +
                        '<span class="Date col-md-3">Date</span><span class="Date col-md-6">' + waitingtime + '</span><br>' +
                        '<span class="Prix col-md-3">Prix</span><span class="Prix col-md-6">' + serviceprice + ' ' + servicecurrency + '</span><br/></div>' +
                        '<span class="heure col-md-3">Heure</span><span class="Heure col-md-6"><input type="time" id="waiting-hour"></span><br/></div>');
            } else {
                $('#waiting-content').html('<div >' +
                        '<span class="Service col-md-3">Prestations </span><span class="Service col-md-6">' + servicename + '</span><br>' +
                        //'<span class="Provider col-md-3">Exécutant</span><span class="Provider col-md-6">' + providername + ' ' + providerlast + '</span><br>' +
                        '<span class="Date col-md-3">Date</span><span class="Date col-md-6">' + waitingtime + '</span><br>' +
                        '<span class="Prix col-md-3">Prix</span><span class="Prix col-md-6">' + serviceprice + ' ' + servicecurrency + '</span><br/></div>' +
                        '<span class="heure col-md-3">Heure</span><span class="Heure col-md-6"><input type="time" id="waiting-hour"></span><br/></div>');

            }
        });


        /*
         **waiting list event
         **
         */
        $(document).on('click', '#waiting-confirm', function (e) {

            if ($('#waiting-hour').val() == '')
            {
                e.preventDefault();
            } else {


                var postUrl = GlobalVariables.baseUrl + '/index.php/home/ajax_register_waiting';
                var endDatetime = undefined;
                var appointmenthash = $(this).attr('data-id');
                //var start_datetime = $('#select-date').datepicker('getDate').toString('Y-m-d H:i:s');





                var formData = {
                    'start_datetime': $('#select-date').datepicker('getDate').toString('yyyy-MM-dd') + ' ' + $('#waiting-hour').val() + ':00',
                    'end_datetime': FrontendBook.calcEndDatetimeWaiting(),
                    'notes': $('#notes').val(),
                    'id_users_provider': $('#select-provider').val(),
                    'id_services': $('#select-service').val(),
                    'id_users_customer': GlobalVariables.customerData['id']
                };
                console.log(formData);

                var postData = {
                    'csrfToken': GlobalVariables.csrfToken,
                    'formData': JSON.stringify(formData)
                };



                console.log(postData);


                $.post(postUrl, postData, function (response) {
                    if (!GeneralFunctions.handleAjaxExceptions(response))
                        return;
                    console.log(response);
                    FrontendBook.deleteappointment(appointmenthash);
                    swal({
                        text: "Votre demande a été envoyée!"

                    },
                            function () {
                                window.location.reload();
                            })
                    //window.location.reload();
                });
            }
        });


        /*
         **
         *
         **
         */

        $(document).on('show.bs.modal', '.modal', function () {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function () {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        });

        /*
         **
         **
         **
         */
        $('#edit-modal').on('hidden.bs.modal', function () {
            // Load up a new modal...

            $('#modal-info-appointment').modal('hide');
        });
        /*
         * event : edit appointment clicked
         *when the user click on edit button  apply apoointment
         *data in the modal for edition
         */

        $(document).on('click', '#edit-appointment', function () {

            FrontendBook.manageMode = true;
            var appointmentId = $(this).attr('data-id');
            var appointmentget;
            $.each(GlobalVariables.appointments, function (index, appointment) {

                if (GlobalVariables.appointments[index].id == appointmentId) {

                    GlobalVariables.appointmentData = appointment;
                }

            });
//console.log(appointmentget['id']);
            FrontendBook.applyAppointmentData(GlobalVariables.appointmentData,
                    GlobalVariables.provider, GlobalVariables.customerData);
        });
        /*
         * event : cancel appointment clicked
         *when the user click on cancel button the appointment should 
         *be removed from the database 
         */

        $(document).on('click', '#canceal-appointment', function () {

            var appointmenthash = $(this).attr('data-id');
            var postData = {'csrfToken': GlobalVariables.csrfToken};
            var postUrl = GlobalVariables.baseUrl + 'index.php/home/cancel/' + appointmenthash;
            $('#modal-info-appointment').modal('hide');
            swal({
                title: 'Etes vous sur de vouloir annuler ce rendez-vous?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmer!',
                cancelButtonText: 'Annuler!',
                confirmButtonClass: 'confirm-class',
                cancelButtonClass: 'cancel-class',
                closeOnConfirm: true, },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.post(postUrl, postData, function (response) {
                                 //console.log('delete response:',response);
                                window.location.reload();
                            });
                        } else {

                        }
                    });
        });
        /**
         * Event: Selected Service "Changed"
         *
         * When the user clicks on a service, its available providers should
         * become visible.
         */
        $('#select-service').change(function () {
            var currServiceId = $('#select-service').val();
            $('#select-provider').empty();
            $.each(GlobalVariables.availableProviders, function (indexProvider, provider) {
                $.each(provider['services'], function (indexService, serviceId) {
                    // If the current provider is able to provide the selected service,
                    // add him to the listbox.
                    if (serviceId == currServiceId) {
                        var optionHtml = '<option value="' + provider['id'] + '">'
                                + provider['first_name'] + ' ' + provider['last_name']
                                + '</option>';
                        $('#select-provider').append(optionHtml);
                    }
                });
            });

            // Add the "Any Provider" entry.

            if ($('#provider-form').css("display") == "none")
            {
                if ($('#select-provider option').length >= 1) {
                    $('#select-provider').append(new Option('- ' + EALang['any_provider'] + ' -', 'any-provider'));
                }
                $('#select-provider').val('any-provider');
            }
            console.log('provider: ', $('#select-provider').val());


            FrontendBook.getAvailableHours($('#select-date').val());
            FrontendBook.updateConfirmFrame();
            FrontendBook.updateServiceDescription($('#select-service').val(), $('#service-description'));
        });
        /**
         * Event: Next Step Button "Clicked"
         *
         * This handler is triggered every time the user pressed the
         * "next" button on the book wizard. Some special tasks might
         * be perfomed, depending the current wizard step.
         */
        $('.button-next').click(function () {
            // If we are on the first step and there is not provider selected do not continue
            // with the next step.
            if ($(this).attr('data-step_index') === '1' && $('#select-provider').val() == null) {
                return;
            }

            // If we are on the 2nd tab then the user should have an appointment hour
            // selected.
            if ($(this).attr('data-step_index') === '2') {
                if ($('.selected-hour').length == 0) {
                    if ($('#select-hour-prompt').length == 0) {
                        $('#available-hours').append('<br><br>'
                                + '<span id="select-hour-prompt" class="text-danger">'
                                + EALang['appointment_hour_missing']
                                + '</span>');
                    }
                    return;
                }
            }

            // If we are on the 3rd tab then we will need to validate the user's
            // input before proceeding to the next step.
            if ($(this).attr('data-step_index') === '3') {
                if (!FrontendBook.validateCustomerForm()) {
                    return; // Validation failed, do not continue.
                } else {
                    FrontendBook.updateConfirmFrame();
                }
            }

            // Display the next step tab (uses jquery animation effect).
            var nextTabIndex = parseInt($(this).attr('data-step_index')) + 1;
            $(this).parents().eq(1).hide('fade', function () {
                $('.active-step').removeClass('active-step');
                $('#step-' + nextTabIndex).addClass('active-step');
                $('#wizard-frame-' + nextTabIndex).show('fade');
            });
        });
        /**
         * Event: Back Step Button "Clicked"
         *
         * This handler is triggered every time the user pressed the
         * "back" button on the book wizard.
         */
        $('.button-back').click(function () {
            var prevTabIndex = parseInt($(this).attr('data-step_index')) - 1;
            $(this).parents().eq(1).hide('fade', function () {
                $('.active-step').removeClass('active-step');
                $('#step-' + prevTabIndex).addClass('active-step');
                $('#wizard-frame-' + prevTabIndex).show('fade');
            });
        });
        /**
         * Event: Available Hour "Click"
         *
         * Triggered whenever the user clicks on an available hour
         * for his appointment.
         */
        $('#available-hours').on('click', '.available-hour', function () {
            $('.selected-hour').removeClass('selected-hour');
            $(this).addClass('selected-hour');
            FrontendBook.updateConfirmFrame();
        });
        if (FrontendBook.manageMode) {
            /**
             * Event: Cancel Appointment Button "Click"
             *
             * When the user clicks the "Cancel" button this form is going to
             * be submitted. We need the user to confirm this action because
             * once the appointment is cancelled, it will be delete from the
             * database.
             */
            $('#cancel-appointment').click(function (event) {
                var dialogButtons = {};
                dialogButtons['OK'] = function () {
                    if ($('#cancel-reason').val() === '') {
                        $('#cancel-reason').css('border', '2px solid red');
                        return;
                    }
                    $('#cancel-appointment-form textarea').val($('#cancel-reason').val());
                    $('#cancel-appointment-form').submit();
                };
                dialogButtons[EALang['cancel']] = function () {
                    $('#message_box').dialog('close');
                };
                GeneralFunctions.displayMessageBox(EALang['cancel_appointment_title'],
                        EALang['write_appointment_removal_reason'], dialogButtons);
                $('#message_box').append('<textarea id="cancel-reason" rows="3"></textarea>');
                $('#cancel-reason').css('width', '100%');
                return false;
            });
        }

        /**
         * Event: Book Appointment Form "Submit"
         *
         * Before the form is submitted to the server we need to make sure that
         * in the meantime the selected appointment date/time wasn't reserved by
         * another customer or event.
         */
        $('#book-appointment-submit').click(function (event) {
            FrontendBook.registerAppointment();
        });
        /**
         * Event: Refresh captcha image.
         */
        $('.captcha-title small').click(function (event) {
            $('.captcha-image').attr('src', GlobalVariables.baseUrl + '/index.php/captcha?' + Date.now());
        });
    },
    /**
     * This function makes an ajax call and returns the available
     * hours for the selected service, provider and date.
     *
     * @param {string} selDate The selected date of which the available
     * hours we need to receive.
     */
    getAvailableHours: function (selDate) {
        $('#available-hours').empty();
        // Find the selected service duration (it is going to
        // be send within the "postData" object).
        var selServiceDuration = 15; // Default value of duration (in minutes).
        $.each(GlobalVariables.availableServices, function (index, service) {
            if (service['id'] == $('#select-service').val()) {
                selServiceDuration = service['duration'];
            }
        });

        // If the manage mode is true then the appointment's start
        // date should return as available too.
        var appointmentId = (FrontendBook.manageMode)
                ? GlobalVariables.appointmentData['id'] : undefined;
        // Make ajax post request and get the available hours.
        var postUrl = GlobalVariables.baseUrl + 'index.php/home/ajax_get_available_hours';
        var postData = {
            'csrfToken': GlobalVariables.csrfToken,
            'service_id': $('#select-service').val(),
            'provider_id': $('#select-provider').val(),
            'selected_date': selDate,
            'service_duration': selServiceDuration,
            'manage_mode': FrontendBook.manageMode,
            'appointment_id': appointmentId
        };
        $.post(postUrl, postData, function (response) {
            ///////////////////////////////////////////////////////////////
            console.log('Get Available Hours JSON Response:', response);
            ///////////////////////////////////////////////////////////////

            if (!GeneralFunctions.handleAjaxExceptions(response))
                return;
            // The response contains the available hours for the selected provider and
            // service. Fill the available hours div with response data.
            if (response.length > 0) {
                var currColumn = 1;
                $('#available-hours').html('<div style="width:50px; float:left;"></div>');
                $.each(response, function (index, availableHour) {
                    if ((currColumn * 10) < (index + 1)) {
                        currColumn++;
                        $('#available-hours').append('<div style="width:50px; float:left;"></div>');
                    }

                    $('#available-hours div:eq(' + (currColumn - 1) + ')').append(
                            '<span class="available-hour">' + availableHour + '</span><br/>');
                });
                if (FrontendBook.manageMode) {
                    // Set the appointment's start time as the default selection.
                    $('.available-hour').removeClass('selected-hour');
                    $('.available-hour').filter(function () {
                        return $(this).text() === Date.parseExact(
                                GlobalVariables.appointmentData['start_datetime'],
                                'yyyy-MM-dd HH:mm:ss').toString('HH:mm');
                    }).addClass('selected-hour');
                } else {
                    // Set the first available hour as the default selection.
                    $('.available-hour:eq(0)').addClass('selected-hour');
                }

                FrontendBook.updateConfirmFrame();
            } else {
                $('#available-hours').html(EALang['no_available_hours']);
            }

            //$('#waiting-content').html($('#select-service').val());


        }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
    },
    /**
     * This function validates the customer's data input. The user cannot contiue
     * without passing all the validation checks.
     *
     * @return {bool} Returns the validation result.
     */
    validateCustomerForm: function () {
        $('#wizard-frame-3 input').css('border', '');
        try {
            // Validate required fields.
            var missingRequiredField = false;
            $('.required').each(function () {
                if ($(this).val() == '') {
                    $(this).parents('.form-group').addClass('has-error');
                    // $(this).css('border', '2px solid red');
                    missingRequiredField = true;
                }
            });
            if (missingRequiredField) {
                throw EALang['fields_are_required'];
            }




            return true;
        } catch (exc) {
            $('#form-message').text(exc);
            return false;
        }
    },
    /**
     * This function reset  the modal's data input. when the modal is closed
     *
     * 
     */
    resetModalInput: function () {

        $('.modal').on('hidden.bs.modal', function () {

            $('#book-appointment-wizard').show();
            $('#wizard-frame-1').show();
            $('#wizard-frame-2').hide();
            $('#wizard-frame-3').hide();
            $('#success-frame').hide();
            $('select').prop('selectedIndex', 0);
            $('input').val('');
            $('input.captcha-text').focus();
            $('#select-date').datepicker("setDate", Date.today());
            //FrontendBook.getAvailableHours(Date.today().toString('dd-MM-yyyy'));
            FrontendBook.updateServiceDescription($('#select-service').val(), $('#service-description'));
            $('.available-hour:eq(0)').addClass('selected-hour');
            $('.available-hour:eq(0)').removeClass('selected-hour');
        });
    },
    /**
     * Every time this function is executed, it updates the confirmation
     * page with the latest customer settigns and input for the appointment
     * booking.
     */
    updateConfirmFrame: function () {
        // Appointment Details
        var selectedDate = $('#select-date').datepicker('getDate');
        if (selectedDate !== null) {
            selectedDate = GeneralFunctions.formatDate(selectedDate, GlobalVariables.dateFormat);
        }

        var selServiceId = $('#select-service').val();
        var servicePrice, serviceCurrency;
        $.each(GlobalVariables.availableServices, function (index, service) {
            if (service.id == selServiceId) {
                servicePrice = '<br>' + service.price;
                serviceCurrency = service.currency;
                return false; // break loop
            }
        });
        var html =
                '<h4>' + $('#select-service option:selected').text() + '</h4>' +
                '<p>'
                + '<strong class="text-primary">'
                + $('#select-provider option:selected').text() + '<br>'
                + selectedDate + ' ' + $('.selected-hour').text()
                + servicePrice + ' ' + serviceCurrency
                + '</strong>' +
                '</p>';
        $('#appointment-details').html(html);
        // Customer Details

        var firstname = GlobalVariables.customerData.first_name,
                lastname = GlobalVariables.customerData.last_name,
                phoneNumber = GlobalVariables.customerData.phone_number,
                email = GlobalVariables.customerData.email,
                address = GlobalVariables.customerData.address,
                city = GlobalVariables.customerData.city,
                zipCode = GlobalVariables.customerData.zip_code,
                html =
                '<h4>' + firstname + ' ' + lastname + '</h4>' +
                '<p>' +
                EALang['phone'] + ': ' + phoneNumber +
                '<br/>' +
                EALang['email'] + ': ' + email +
                '<br/>' +
                EALang['address'] + ': ' + address +
                '<br/>' +
                EALang['city'] + ': ' + city +
                '<br/>' +
                EALang['zip_code'] + ': ' + zipCode +
                '</p>';
        $('#customer-details').html(html);
        // Update appointment form data for submission to server when the user confirms
        // the appointment.
        var postData = new Object();
        postData['customer'] = {
            'last_name': $('#last-name').val(),
            'first_name': $('#first-name').val(),
            'email': $('#email').val(),
            'phone_number': $('#phone-number').val(),
            'address': $('#address').val(),
            'city': $('#city').val(),
            'zip_code': $('#zip-code').val()
        };
        postData['appointment'] = {
            'start_datetime': $('#select-date').datepicker('getDate').toString('yyyy-MM-dd')
                    + ' ' + $('.selected-hour').text() + ':00',
            'end_datetime': FrontendBook.calcEndDatetime(),
            'notes': $('#notes').val(),
            'is_unavailable': false,
            'id_users_provider': $('#select-provider').val(),
            'id_services': $('#select-service').val()
        };
        postData['manage_mode'] = FrontendBook.manageMode;
        if (FrontendBook.manageMode) {
            postData['appointment']['id'] = GlobalVariables.appointmentData['id'];
            postData['customer']['id'] = GlobalVariables.customerData['id'];
        }
        $('input[name="csrfToken"]').val(GlobalVariables.csrfToken);
        $('input[name="post_data"]').val(JSON.stringify(postData));
    },
    /**
     * This method calculates the end datetime of the current appointment.
     * End datetime is depending on the service and start datetime fieldss.
     *
     * @return {string} Returns the end datetime in string format.
     */
    calcEndDatetime: function () {
        // Find selected service duration.
        var selServiceDuration = undefined;
        $.each(GlobalVariables.availableServices, function (index, service) {
            if (service.id == $('#select-service').val()) {
                selServiceDuration = service.duration;
                return false; // Stop searching ...
            }
        });
        // Add the duration to the start datetime.
        var startDatetime = $('#select-date').datepicker('getDate').toString('dd-MM-yyyy')
                + ' ' + $('.selected-hour').text();
        startDatetime = Date.parseExact(startDatetime, 'dd-MM-yyyy HH:mm');
        var endDatetime = undefined;
        if (selServiceDuration !== undefined && startDatetime !== null) {
            endDatetime = startDatetime.add({'minutes': parseInt(selServiceDuration)});
        } else {
            endDatetime = new Date();
        }

        return endDatetime.toString('yyyy-MM-dd HH:mm:ss');
    },
    /**
     * This method calculates the end datetime of the current appointment.
     * End datetime is depending on the service and start datetime fieldss.
     *
     * @return {string} Returns the end datetime in string format.
     */
    calcEndDatetimeWaiting: function () {
        // Find selected service duration.
        var selServiceDuration = undefined;

        $.each(GlobalVariables.availableServices, function (index, service) {
            if (service.id == $('#select-service').val()) {
                selServiceDuration = service.duration;
                return false; // Stop searching ...
            }
        });

        // Add the duration to the start datetime.
        var startDatetime = $('#select-date').datepicker('getDate').toString('dd-MM-yyyy')
                + ' ' + $('#waiting-hour').val();
        startDatetime = Date.parseExact(startDatetime, 'dd-MM-yyyy HH:mm');
        var endDatetime = undefined;

        if (selServiceDuration !== undefined && startDatetime !== null) {
            endDatetime = startDatetime.add({'minutes': parseInt(selServiceDuration)});
        } else {
            endDatetime = new Date();
        }

        return endDatetime.toString('yyyy-MM-dd HH:mm:ss');
    },
    /*********
     *
     *
     *
     */



    deleteappointment: function (appointmenthash) {
        var postData = {'csrfToken': GlobalVariables.csrfToken};
        var postUrl = GlobalVariables.baseUrl + 'index.php/home/cancel/' + appointmenthash;

        $.post(postUrl, postData, function (response) {

        });
    },
    /**
     * This method applies the appointment's data to the wizard so
     * that the user can start making changes on an existing record.
     *
     * @param {object} appointment Selected appointment's data.
     * @param {object} provider Selected provider's data.
     * @param {object} customer Selected customer's data.
     * @returns {bool} Returns the operation result.
     */
    applyAppointmentData: function (appointment, provider, customer) {
        try {
            // Select Service & Provider
            $('#select-service').val(appointment['id_services']).trigger('change');
            $('#select-provider').val(appointment['id_users_provider']);
            // Set Appointment Date
            $('#select-date').datepicker('setDate',
                    Date.parseExact(appointment['start_datetime'], 'yyyy-MM-dd HH:mm:ss'));
            FrontendBook.getAvailableHours($('#select-date').val());
            // Apply Customer's Data
            $('#last-name').val(customer['last_name']);
            $('#first-name').val(customer['first_name']);
            $('#email').val(customer['email']);
            $('#phone-number').val(customer['phone_number']);
            $('#address').val(customer['address']);
            $('#city').val(customer['city']);
            $('#zip-code').val(customer['zip_code']);
            var appointmentNotes = (appointment['notes'] !== null)
                    ? appointment['notes'] : '';
            $('#notes').val(appointmentNotes);
            FrontendBook.updateConfirmFrame();
            return true;
        } catch (exc) {
            console.log(exc); // log exception
            return false;
        }
    },
    /**
     * This method updates a div's html content with a brief description of the
     * user selected service (only if available in db). This is usefull for the
     * customers upon selecting the correct service.
     *
     * @param {int} serviceId The selected service record id.
     * @param {object} $div The destination div jquery object (e.g. provide $('#div-id')
     * object as value).
     */
    updateServiceDescription: function (serviceId, $div) {
        var html = '';
        $.each(GlobalVariables.availableServices, function (index, service) {
            if (service.id == serviceId) { // Just found the service.
                html = '<strong>' + service.name + ' </strong>';
                if (service.description != '' && service.description != null) {
                    html += '<br>' + service.description + '<br>';
                }

                if (service.duration != '' && service.duration != null) {
                    html += '[' + EALang['duration'] + ' ' + service.duration
                            + ' ' + EALang['minutes'] + '] ';
                }

                if (service.price != '' && service.price != null) {
                    html += '[' + EALang['price'] + ' ' + service.price + ' ' + service.currency + ']';
                }

                html += '<br>';
                return false;
            }
        });
        $div.html(html);
        if (html != '') {
            $div.show();
        } else {
            $div.hide();
        }
    },
    /**
     * Register an appointment to the database.
     *
     * This method will make an ajax call to the appointments controller that will register
     * the appointment to the database.
     */
    registerAppointment: function () {

        var $captchaText = $('.captcha-text');
        if ($captchaText.length > 0) {
            $captchaText.css('border', '');
            if ($captchaText.val() === '') {
                $captchaText.css('border', '1px solid #dc3b40');
                return;
            }
        }

        var formData = jQuery.parseJSON($('input[name="post_data"]').val());
        var postData = {
            'csrfToken': GlobalVariables.csrfToken,
            'post_data': formData
        };
        if ($captchaText.length > 0) {
            postData.captcha = $captchaText.val();
        }

        if (GlobalVariables.manageMode) {
            postData.exclude_appointment_id = GlobalVariables.appointmentData.id;
        }

        var postUrl = GlobalVariables.baseUrl + 'index.php/home/ajax_register_appointment',
                $layer = $('<div/>');
        $.ajax({
            url: postUrl,
            method: 'post',
            data: postData,
            dataType: 'json',
            beforeSend: function (jqxhr, settings) {
                $layer
                        .appendTo('body')
                        .css({
                            'background': 'white',
                            'position': 'fixed',
                            'top': '0',
                            'left': '0',
                            'height': '100vh',
                            'width': '100vw',
                            'opacity': '0.5'
                        });
            }
        })
                .done(function (response) {
                    if (!GeneralFunctions.handleAjaxExceptions(response)) {
                        $('.captcha-title small').trigger('click');
                        return false;
                    }

                    if (response.captcha_verification === false) {
                        $('#captcha-hint')
                                .text(EALang['captcha_is_wrong'] + '(' + response.expected_phrase + ')')
                                .fadeTo(400, 1);
                        setTimeout(function () {
                            $('#captcha-hint').fadeTo(400, 0);
                        }, 3000);
                        $('.captcha-title small').trigger('click');
                        $captchaText.css('border', '1px solid #dc3b40');
                        return false;
                    }

                    $('#book-appointment-wizard').hide();
                    $('#success-frame').show();
                    setTimeout(function () {
                        window.location.reload(1);
                    }, 2000);
                    /* window.location.replace(GlobalVariables.baseUrl
                     + '/index.php/appointments/book_success/' + response.appointment_id);*/
                })
                .fail(function (jqxhr, textStatus, errorThrown) {
                    $('.captcha-title small').trigger('click');
                    GeneralFunctions.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
                })
                .always(function () {
                    $layer.remove();
                })
    }
};
