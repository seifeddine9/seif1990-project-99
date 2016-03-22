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
 * @namespace FrontendWaiting
 */
var FrontendWaiting = {
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

        FrontendWaiting.manageMode = manageMode;
        FrontendWaiting.resetModalInput();
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




        $("#my-waiting").tabs({
            "activate": function (event, ui) {
                var table = $.fn.dataTable.fnTables(true);
            }
        });
        $.each(GlobalVariables.waiting, function (index, waiting) {
            var start = GeneralFunctions.formatDate(Date.parse(waiting.start_datetime), GlobalVariables.dateFormat, true),
                    end = GeneralFunctions.formatDate(Date.parse(waiting.end_datetime), GlobalVariables.dateFormat, true);
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
            var tout = '<tr  data-target="#modal-info-appointment" data-id="' + waiting.id + '">' +
                    '<td><span class="dateDebut" ><i class="fa fa-clock-o  fa-2x" style="color: #68c39f"></i><strong>&nbsp;&nbsp;' + startDate + '</strong><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 1.2em;  color:#686868">&nbsp;&nbsp;&nbsp;&nbsp;à&nbsp;' + heureStart + 'H</span></span></td>' +
                    '<td><strong ">' + waiting.service.name + '</strong><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span   style="color:#686868">Pour &nbsp;' + waiting.service.price + ' ' + waiting.service.currency + '</span></td>' +
                    '</tr>';
            if (moment(newDateStart).isSameOrAfter(now))
            {
                var future = '<tr  data-target="#modal-info-appointment" data-id="' + waiting.id + '">' +
                        '<td><span class="dateDebut" ><i class="fa fa-clock-o  fa-2x" style="color: #68c39f"></i><strong>&nbsp;&nbsp;' + startDate + '</strong><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 1.2em;  color:#686868">&nbsp;&nbsp;&nbsp;&nbsp;à&nbsp;' + heureStart + 'H</span></span></td>' +
                        '<td><strong ">' + waiting.service.name + '</strong><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span   style="color:#686868">Pour &nbsp;' + waiting.service.price + ' ' + waiting.service.currency + '</span></td>' +
                        '</tr>';
            }


            if (moment(newDateStart).isBefore(now))
            {
                var past = '<tr  data-target="#modal-info-appointment" data-id="' + waiting.id + '">' +
                        '<td><span class="dateDebut" ><i class="fa fa-clock-o  fa-2x" style="color: #68c39f"></i><strong>&nbsp;&nbsp;' + startDate + '</strong><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 1.2em;  color:#686868">&nbsp;&nbsp;&nbsp;&nbsp;à&nbsp;' + heureStart + 'H</span></span></td>' +
                        '<td><strong ">' + waiting.service.name + '</strong><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span   style="color:#686868">Pour &nbsp;' + waiting.service.price + ' ' + waiting.service.currency + '</span></td>' +
                        '</tr>';
            }


            $('#list-waiting tbody').append(tout);
            $('#list-future-waiting tbody').append(future);
            $('#list-past-waiting tbody').append(past);
        });



        $('table').dataTable({
            "bLengthChange": false,
            "bInfo": false,
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
                FrontendWaiting.getAvailableHours(dateText);
                FrontendWaiting.updateConfirmFrame();
            }
        });
        // Bind the event handlers (might not be necessary every time
        // we use this class).
        if (bindEventHandlers) {
            FrontendWaiting.bindEventHandlers();
        }

        // If the manage mode is true, the appointments data should be
        // loaded by default.
        if (FrontendWaiting.manageMode) {
            FrontendWaiting.applyAppointmentData(GlobalVariables.appointmentData,
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
         * event : display  booking information on click 
         * 
         *when click on appointment-row display the appointment info
         */

        $("tr").click(function () { // Click to only happen on announce links
            var appointmentId = $(this).attr('data-id');
            var appointmentInfo;
            $.each(GlobalVariables.waiting, function (index, waiting) {

                if (GlobalVariables.waiting[index].id == appointmentId) {

                    appointmentInfo = waiting;
                }

            });
            //$('#waiting-appointment').attr('data-id', appointmentId);


            $('#general-info').html('<div >' +
                    '<span class="Service col-md-3">Prestations </span><span class="Service col-md-6">' + appointmentInfo.service.name + '</span><br>' +
                    '<span class="Provider col-md-3">Exécutant</span><span class="Provider col-md-6">' + appointmentInfo.provider.first_name + ' ' + appointmentInfo.provider.last_name + '</span><br>' +
                    '<span class="Date col-md-3">Date</span><span class="Date col-md-6">' + appointmentInfo.start_datetime + '</span><br>' +
                    '<span class="Prix col-md-3">Prix</span><span class="Prix col-md-6">' + appointmentInfo.service.price + ' ' + appointmentInfo.service.currency + '</span><br/></div>');
            $('#button-command').html('<button class="canceal-appointment btn btn-danger" type="button" id="canceal-appointment" data-id="' + appointmentInfo.hash + '" ><i class="fa fa-remove"></i>Supprimer</button>');
            $('#modal-info-waiting').modal('show');




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

            $('#modal-info-waiting').modal('hide');
        });
        /*
         * event : edit appointment clicked
         *when the user click on edit button  apply apoointment
         *data in the modal for edition
         */


        /*
         * event : cancel appointment clicked
         *when the user click on cancel button the appointment should 
         *be removed from the database 
         */

        $(document).on('click', '#canceal-appointment', function () {

            var appointmenthash = $(this).attr('data-id');
            var postData = {'csrfToken': GlobalVariables.csrfToken};
            var postUrl = GlobalVariables.baseUrl + 'index.php/waiting/cancel/' + appointmenthash;
            $('#modal-info-waiting').modal('hide');
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
                                // console.log(response);
                                window.location.reload();
                            });
                        } else {

                        }
                    });
        });






        if (FrontendWaiting.manageMode) {
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


    },
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
            //FrontendWaiting.getAvailableHours(Date.today().toString('dd-MM-yyyy'));
            FrontendWaiting.updateServiceDescription($('#select-service').val(), $('#service-description'));
            $('.available-hour:eq(0)').addClass('selected-hour');
            $('.available-hour:eq(0)').removeClass('selected-hour');
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
            FrontendWaiting.getAvailableHours($('#select-date').val());
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
            FrontendWaiting.updateConfirmFrame();
            return true;
        } catch (exc) {
            console.log(exc); // log exception
            return false;
        }
    },
};
