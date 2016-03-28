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
var FrontendService = {
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
            window.console = function () {} ;// IE compatibility
        }
          window.fbAsyncInit = function() {
  FB.init({
    appId      : '535891186589773',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.5' // use graph api version 2.5
  });





  };

    $("#phone-number-fb").intlTelInput({
  nationalMode: true,
  utilsScript: GlobalVariables.baseUrl+"assets/ext/intl-tel-input/utils.js", // just for formatting/placeholders etc
  autoPlaceholder: false
});

        FrontendService.manageMode = manageMode;
        FrontendService.resetModalInput();

        $.each(GlobalVariables.availableServices, function (index, service) {

            var html =

                        '<li class=" service-row  col-xs-4 portfolio-box web-design" data-id="' + service.id + '"  >'+
                           ' <div class="portfolio-box-container">'+
                               '<img class="img-responsive" style="height: 200px; width: 100%"  src="' + GlobalVariables.baseUrl + service.src_photo +'">' +
                                '<div class="portfolio-box-text">'+
                                   '<h4 style="text-align: center;"><strong>' + service.name + '</strong></h4>' +
                                   ' <p class="description" style= text-align: center;><strong>A partir de  : ' + service.price + "  " + service.currency + '/ ' + service.duration + ' min</strong></p>'+

                     '<br/><button type="button" id="button-detail" class="btn  btn-primary  " data-book-id="' + service.id + '"  data-toggle="modal" data-target="#detail-modal">' +
                    '<i class="fa fa-search-plus"></i>' +
                    '</button>&nbsp;&nbsp;' +
                  '<button type="button" id="button-reserver" class="btn  btn-primary " data-book-id="' + service.id + '"  data-toggle="modal" data-target="#book-modal">'+
                           '<i class="fa fa-calendar-plus-o"></i>'+
                        '</button>'+



                                '</div>'+

         
           ' </li>'
                    ;



            $('.portfolio-masonry').append(html);
        });




        /*
         **
         /**
         */
        if (!jQuery.isEmptyObject(GlobalVariables.customerData)) {

            $('#first-name').val(GlobalVariables.customerData.first_name);
            $('#last-name').val(GlobalVariables.customerData.last_name);
            $('#email').val(GlobalVariables.customerData.email);
            $('#phone-number').val(GlobalVariables.customerData.phone_number);
            $('#address').val(GlobalVariables.customerData.address);
            $('#city').val(GlobalVariables.customerData.city);
            $('#zip-code').val(GlobalVariables.customerData.zip_code);


        }



        $(document).on("keypress", ".phone-number", function (event) {
            // console.log(isNaN(String.fromCharCode(event.which)));

            if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
                event.preventDefault();
            }
        });



        /*
         ** 
         **
         */

        $('.required').each(function () {
            $(document).on("keypress", ".required", function () {
                $(this).parents('.form-group').removeClass('has-error');
                $('.alert').removeClass(' alert-danger alert-success')
                        .addClass('hidden');
            });

        });


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
                FrontendService.getAvailableHours(dateText);
                FrontendService.updateConfirmFrame();
            }
        });


        // Bind the event handlers (might not be necessary every time
        // we use this class).
        if (bindEventHandlers) {
            FrontendService.bindEventHandlers();
        }

        // If the manage mode is true, the appointments data should be
        // loaded by default.
        if (FrontendService.manageMode) {
            FrontendService.applyAppointmentData(GlobalVariables.appointmentData,
                    GlobalVariables.providerData, GlobalVariables.customerData);
        }
        console.log('showprovider', GlobalVariables.showProvider);
        
        
        if (GlobalVariables.showProvider =='1')
            {
                $('#wizard-frame-1').show();
                $('#button-back-2').removeClass('hidden');
                $('#wizard-frame-2').hide(); 
                
            } else {
                $('#wizard-frame-1').hide();
                $('#button-back-2').hide();
                $('#wizard-frame-2').show();
                
            }
    },
    /**
     * This method binds the necessary event handlers for the book
     * appointments page.
     */
    bindEventHandlers: function () {


 /*
 ** event : select more detail 
 ** show the service detail modal
  */


$('#detail-modal').on('show.bs.modal', function(e) {
    var serviceId = $(e.relatedTarget).data('book-id');
    //$(e.currentTarget).find('#select-service').val(bookId);
   // console.log($('#select-service').val());


//console.log(GlobalVariables);
   var serviceDetail;
    
            $.each(GlobalVariables.availableServices, function (index, service) {

                if (GlobalVariables.availableServices[index].id == serviceId) {

                    serviceDetail = service;
                }

            });

$('.service-title').append(serviceDetail.name);

$('.service-sous-title').append( '[' + EALang['duration'] + ' ' + serviceDetail.duration + ' ' + 
    EALang['minutes'] + '] '+'[' + EALang['price'] + ' ' + serviceDetail.price + ' ' + serviceDetail.currency + ']');

$('.image-service').append('<img class="img-responsive"  style="height: 200px; width: 100%" src="' + GlobalVariables.baseUrl + serviceDetail.src_photo +'">');


$('.service-description').append('Une intervenante vous est dédiée et intervient à horaire régulier.'+

'Vous pouvez demander le remplacement de la femme de ménage qui vous est réservée autant de fois que vous le voulez, jusqu’à ce que vous soyez pleinement satisfait.<br/> En cas d’absence de notre intervenante, un remplacement est organisé. <br/>Si vous annulez une intervention, vous ne nous devez rien. <br/> <br/><strong style="color: #b02349;">Attention toutefois à nous prévenir au minimum 3 jours ouvrés avant l’intervention annulée !</strong>'+

'<br/><br/>Le carnet de tickets d’heures commandé correspond à un trimestre d’interventions continues. Ces tickets sont à confier à notre intervenante à chacune de ses interventions.<br/> <br/> Si vous souhaitez demander le remboursement des tickets non utilisés, une retenue forfaitaire de 20 € TTC (TVA incluse de 20%) est appliquée.'+

serviceDetail.description);

$('.command-button-reserver').append('<button type="button" id="reserver" class="btn  btn-primary  " data-book-id="' + serviceDetail.id + '"  data-toggle="modal" data-target="#book-modal">' +
                    ' Réserver maintenant' +
                    '</button>');


});
/*
** when the modal is hidden
*** reset all information
**/


$('#detail-modal').on('hidden.bs.modal', function(e) {
$('.service-title , .service-sous-title , .image-service , .service-description , .command-button-reserver').html('');


});

/*
** on click on appointment button hide the detail modal 
**and show the  book modal
 */

 $(document).on('click', '#reserver', function (e) {

$('#detail-modal').modal('hide');
});







        /**
         * Event: Selected Provider "Changed"
         *
         * Whenever the provider changes the available appointment
         * date - time periods must be updated.
         
         */



        $('#select-provider').change(function () {
            FrontendService.getAvailableHours(Date.today().toString('dd-MM-yyyy'));
            FrontendService.updateConfirmFrame();
        });
        // $('.service-row').addClass('selected-row');


        $('#book-modal').on('show.bs.modal', function (e) {
            var bookId = $(e.relatedTarget).data('book-id');
            $(e.currentTarget).find('#select-service').val(bookId);
            // console.log($('#select-service').val());
              $('.ask-dispo').html('<br/>Si vous ne trouvez pas une date qui vous convient vous pouvez envoyer une demande au administrateur');
            $('#waiting-appointment').attr('data-id', $(e.relatedTarget).data('book-id'));

            console.log(GlobalVariables.customerData);

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


            FrontendService.getAvailableHours($('#select-date').val());
            FrontendService.updateConfirmFrame();
            FrontendService.updateServiceDescription($('#select-service').val(), $('#service-description'));


        });


        /**
         * event : display  booking information on click 
         * 
         *when click on appointment-row display the appointment info
         */

        $("#waiting-appointment").click(function () { // Click to only happen on announce links
            /**
             var appointmentId = $(this).attr('data-id');
             var appointmentInfo;
             $.each(GlobalVariables.appointments, function (index, appointment) {
             
             if (GlobalVariables.appointments[index].id == appointmentId) {
             
             appointmentInfo = appointment;
             }
             
             });
             **/
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

                //var start_datetime = $('#select-date').datepicker('getDate').toString('Y-m-d H:i:s');





                var formData = {
                    'start_datetime': $('#select-date').datepicker('getDate').toString('yyyy-MM-dd') + ' ' + $('#waiting-hour').val() + ':00',
                    'end_datetime': FrontendService.calcEndDatetimeWaiting(),
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
                    
                    swal({
                        text: "Votre demande a été envoyée!"

                    },
                            function () {
                                window.location.reload();
                            })
                });
            }
        });


/*
** on close  waiting modal
*
***
**/


        $(document).on('click', '.cancel-waiting', function (e) {

        $('#waiting-modal').modal('hide');
        if ($('#provider-form').css("display") == "none")
            {
                
                $('#select-provider').val('any-provider');
            }
            console.log('provider1: ', $('#select-provider').val());
        });
 

        /**
         * Event: Selected Service "Changed"
         *
         * When the user clicks on a service, its available providers should
         * become visible.
         */

        /**
         * Event: Next Step Button "Clicked"
         *
         * This handler is triggered every time the user pressed the
         * "next" button on the book wizard. Some special tasks might
         * be perfomed, depending the current wizard step.
         */



        $(document).on("click", '#button-next-1', function (event) {
            // If we are on the first step and there is not provider selected do not continue
            // with the next step.
            if ($('#select-provider').val() == null) {
                return;
            } else {
                var nextTabIndex = parseInt($(this).attr('data-step_index')) + 1;

                $(this).parents().eq(1).hide('fade', function () {
                    $('.active-step').removeClass('active-step');
                    $('#step-' + nextTabIndex).addClass('active-step');
                    $('#wizard-frame-' + nextTabIndex).show('fade');
                });


            }


        });





        $(document).on("click", '.sign-up', function (event) {

            $('.alert').addClass('hidden');
            $('.cnx-choice').addClass('hidden');
            $('.inscrit').removeClass('hidden');
        });




        $(document).on("click", '#button-next-2', function (event) {
            // If we are on the first step and there is not provider selected do not continue
            // with the next step.
            if ($('.selected-hour').length == 0) {
                if ($('#select-hour-prompt').length == 0) {
                    $('#available-hours').append('<br><br>'
                            + '<span id="select-hour-prompt" class="text-danger">'
                            + EALang['appointment_hour_missing']
                            + '</span>');
                }
                return;
            } else {
                if (jQuery.isEmptyObject(GlobalVariables.customerData))
                {
                    var nextTabIndex = parseInt($(this).attr('data-step_index')) + 1;
                          
                    $(this).parents().eq(1).hide('fade', function () {
                        $('.active-step').removeClass('active-step');
                        $('#step-' + nextTabIndex).addClass('active-step');
                        $('#wizard-frame-' + nextTabIndex).show('fade');
                    });
                } else
                {
                    var nextTabIndex = parseInt($(this).attr('data-step_index')) + 2;

                    $('#first-name').val(GlobalVariables.customerData.first_name);
                    $('#last-name').val(GlobalVariables.customerData.last_name);
                    $('#email').val(GlobalVariables.customerData.email);
                    $('#phone-number').val(GlobalVariables.customerData.phone_number);
                    $('#address').val(GlobalVariables.customerData.address);
                    $('#city').val(GlobalVariables.customerData.city);
                    $('#zip-code').val(GlobalVariables.customerData.zip_code);



                    $(this).parents().eq(1).hide('fade', function () {
                        $('.active-step').removeClass('active-step');
                        $('#step-' + nextTabIndex).addClass('active-step');
                        $('#wizard-frame-' + nextTabIndex).show('fade');
                    });
                }


            }


        });
/*  when the user click on facebook log in 
** 
**
 */




/*
** on click on button next  either check the user's email and password 
*** or  sign him up 
 */

        $(document).on("click", '#button-next-3', function (event) {
            // If we are on the first step and there is not provider selected do not continue
            // with the next step.

            var nextTabIndex = parseInt($(this).attr('data-step_index')) + 1;


            if ($(".inscrit").hasClass("hidden") && !$(".cnx-choice").hasClass("hidden") )

            {
                $(".last-name ,.first-name , .password , .email , .phone-number , .address , .city ,.zip-code, #phone-number-fb , #address-fb , #city-fb , #zip-code-fb").removeClass("required");
                $("#email-address , #password-cnx").addClass("required");

                var postUrl = GlobalVariables.baseUrl + 'index.php/user/ajax_check_login_customer';
                var postData = {
                    'csrfToken': GlobalVariables.csrfToken,
                    'email': $('#email-address').val(),
                    'password': $('#password-cnx').val()
                };
            } else if (!$(".inscrit").hasClass("hidden") && $(".cnx-choice").hasClass("hidden") ) {
                $(".last-name ,.first-name , .password , .email , .phone-number , .address , .city ,.zip-code").addClass("required");
                $("#email-address , #password-cnx , #phone-number-fb , #address-fb , #city-fb , #zip-code-fb").removeClass("required");

                var formData = new Object();

                formData['customer'] = {
                    'last_name': $('.last-name').val(),
                    'first_name': $('.first-name').val(),
                    'password': $('.password').val(),
                    'email': $('.email').val(),
                    'phone_number': $('.phone-number').val(),
                    'address': $('.address').val(),
                    'city': $('.city').val(),
                    'zip_code': $('.zip-code').val(),
                    'src_photo': $('#default-image').val()

                };

                var postData = {
                    'csrfToken': GlobalVariables.csrfToken,
                    'post_data': formData
                };
                var postUrl = GlobalVariables.baseUrl + 'index.php/user/inscription2';


            }

         else if (!$(".update-address-phone-number").hasClass("hidden") && $(".cnx-choice").hasClass("hidden") && $(".inscrit").hasClass("hidden") ) {
                $("#phone-number-fb , #address-fb , #city-fb , #zip-code-fb").addClass("required");
                $(".last-name ,.first-name , .password , .email , .phone-number , .address , .city ,.zip-code,#email-address , #password-cnx").removeClass("required");

                var formData = new Object();

                formData['customer'] = {
                    'last_name': $('#last-name').val(),
                    'first_name': $('#first-name').val(),
                    'email': $('#email').val(),
                    'phone_number': $('#phone-number-fb').val(),
                    'address': $('#address-fb').val(),
                    'city': $('#city-fb').val(),
                    'zip_code': $('#zip-code-fb').val(),
                    'idfacebook': $('#idfacebook').val(),
                    'src_photo': $('#picture').val()

                };

                var postData = {
                    'csrfToken': GlobalVariables.csrfToken,
                    'post_data': formData
                };
                var postUrl = GlobalVariables.baseUrl + 'index.php/user/inscription2';


            }


            console.log(postData);
            if (!FrontendService.validateCustomerForm()) {
                return;
            }


            $.post(postUrl, postData, function (response) {
                //////////////////////////////////////////////////
                console.log('Check Login Response: ', response);
                //////////////////////////////////////////////////

                //if (!GeneralFunctions.handleAjaxExceptions(response))
                //  return;

                if (response.role_slug == "customer")
                {


                    $('#first-name').val(response.first_name);
                    $('#last-name').val(response.last_name);
                    $('#email').val(response.user_email);
                    $('#phone-number').val(response.phone_number);
                    $('#city').val(response.city);
                    $('#address').val(response.address);
                    $('#zip-code').val(response.zip_code);

                    $('#not-logged-in').html(' <a href="#" class="" data-toggle="dropdown" > <strong>' + response.first_name + " " + response.last_name + ' </strong><span class=" fa fa-angle-down"></span></a>' +
                            '<ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">' +
                            '<?php $active = ($active_menu == PRIV_APPOINTMENTS) ? "active" : ""; ?>' +
                            '<li class="<?php echo $active; ?>" ><a <a href="' + GlobalVariables.baseUrl + 'index.php/home/appointments"><span> Mes Rendez-vous</span></a> </li>' +
                            '<?php $active = ($active_menu == PRIV_PROFILE) ? "active" : ""; ?>' +
                            '<li  class="<?php echo $active; ?>" > <a href="' + GlobalVariables.baseUrl + 'index.php/home/profile"> <span>Mon Profile</span> </a> </li>' +
                            '<?php $active = ($active_menu == PRIV_WAITING) ? "active" : ""; ?>' +
                            '<li  class="<?php echo $active; ?>" > <a href="' + GlobalVariables.baseUrl + 'index.php/home/waiting"> <span>Liste d\'attente</span> </a> </li>' +
                            '<li>' +
                            '<a href="javascript:;"><span>Aide</span></a>' +
                            '</li>' +
                            '<li><a  href="' + GlobalVariables.baseUrl + 'index.php/user/logout"><hr><i class="fa fa-sign-out pull-right"></i> Déconnexion</a>' +
                            '</li>' +
                            '</ul>');


                    var customerData = new Object();
                    customerData = {
                        'user_id': response.user_id,
                        'first_name': response.first_name,
                        'last_name': response.last_name,
                        'email': response.user_email,
                        'phone_number': response.phone_number,
                        'address': response.address,
                        'city': response.city,
                        'zip_code': response.zip_code,
                        'role_slug': response.role_slug
                    };
                    GlobalVariables.customerData = customerData;
                    console.log(GlobalVariables.customerData);


                    FrontendService.updateConfirmFrame();






                    $('#wizard-frame-3').hide('fade', function () {
                        $('.active-step').removeClass('active-step');
                        $('#step-' + nextTabIndex).addClass('active-step');
                        $('#wizard-frame-' + nextTabIndex).show('fade');
                    });
                } else {
                    if (response.exceptions)
                    {
                        console.log('Check Login Response: ', response);

                        json = JSON.parse(response.exceptions);
                        $('.signup').text(json.message);
                    } else {
                        $('.signup').html(EALang['login_failed']);
                    }
                    $('.signup')
                            .removeClass('hidden alert-danger alert-success')
                            .addClass('alert-danger');

                }

            }, 'json');






        });









        /**
         * Event: Back Step Button "Clicked"
         *
         * This handler is triggered every time the user pressed the
         * "back" button on the book wizard.
         */
        $('.button-back').click(function () {
            if (!jQuery.isEmptyObject(GlobalVariables.customerData))
            {
                $("#button-back-4").attr('data-step_index', '3');


            }

            var prevTabIndex = parseInt($(this).attr('data-step_index')) - 1;

            $(this).parents().eq(1).hide('fade', function () {
                $('.active-step').removeClass('active-step');
                $('#step-' + prevTabIndex).addClass('active-step');
                $('#wizard-frame-' + prevTabIndex).show('fade');
                if (jQuery.isEmptyObject(GlobalVariables.customerData))
                {
                    $('.form-group').removeClass('has-error');
                    $('.alert').addClass('hidden');
                    $(".cnx-choice").removeClass('hidden');
                    $(".inscrit").addClass('hidden');
                      $(".update-address-phone-number").addClass('hidden');


                }
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
            $('.hours').text($('.selected-hour').text());

            FrontendService.updateConfirmFrame();
        });

        if (FrontendService.manageMode) {
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

            FrontendService.registerAppointment();
        });

        /**
         * Event: Refresh captcha image.
         */
        $('.captcha-title small').click(function (event) {
            $('.captcha-image').attr('src', GlobalVariables.baseUrl + 'index.php/captcha?' + Date.now());
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
        var appointmentId = (FrontendService.manageMode)
                ? GlobalVariables.appointmentData['id'] : undefined;

        // Make ajax post request and get the available hours.
        var postUrl = GlobalVariables.baseUrl + 'index.php/home/ajax_get_available_hours';

        var postData = {
            'csrfToken': GlobalVariables.csrfToken,
            'service_id': $('#select-service').val(),
            'provider_id': $('#select-provider').val(),
            'selected_date': selDate,
            'service_duration': selServiceDuration,
            'manage_mode': FrontendService.manageMode,
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
                 $('.ask-dispo').html('<br/>Si vous ne trouvez pas une date qui vous convient vous pouvez envoyer une demande au administrateur');
                $('#available-hours').html('<li style="width:50px; float:left;"></li>');
                                    $('.hours').text('Choisir l\'Heure ');

                $.each(response, function (index, availableHour) {
                    if ((currColumn * 10) < (index + 1)) {
                        currColumn++;
                        $('#available-hours').append('<li style="width:50px; float:left;"></li>');

                    }

                    $('#available-hours li:eq(' + (currColumn - 1) + ')').append(
                            '<span class="available-hour">' + availableHour + '</span>');
                });

                if (FrontendService.manageMode) {
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

                FrontendService.updateConfirmFrame();

            } else {
              $('.ask-dispo').html(EALang['no_available_hours']+'\n\n'+ EALang['ask_for_dispo']);
                      $('.hours').text('non disponible');


            }
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
                servicePrice = '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-credit-card" ></i> ' + service.price;
                serviceCurrency = service.currency;
                servicename = service.name;
                return false; // break loop
            }
        });

        if ($('#provider-form').css("display") == "none")
        {
        var html =
                '<h4> &nbsp;&nbsp;<i class="fa fa-star"></i>&nbsp;' + servicename + '</h4>' +
                '<p>'
                + '<strong class="text-primary">'
                
                + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-calendar" ></i> '+selectedDate + '&nbsp;&nbsp;-&nbsp;<i class="fa fa-clock-o" ></i> ' + $('.selected-hour').text()
                +servicePrice + ' ' + serviceCurrency
                + '</strong>' +
                '</p>';
        }else{
             var html =
                '<h4> &nbsp;&nbsp;<i class="fa fa-star"></i>&nbsp; ' + servicename + '</h4>' +
                '<p>'
                + '<strong class="text-primary">'
                + '<i class="fa fa-user"></i> '+$('#select-provider option:selected').text() + '<br>'
                + '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <i class="fa fa-calendar""></i> '+selectedDate + '&nbsp;&nbsp;-&nbsp;<i class="fa fa-clock-o" ></i> ' + $('.selected-hour').text()
                +servicePrice + '' + serviceCurrency
                + '</strong>' +
                '</p>';
        }

        $('#appointment-details').html(html);

        // Customer Details

        var firstname = GeneralFunctions.escapeHtml($('#first-name').val()),
                lastname = GeneralFunctions.escapeHtml($('#last-name').val()),
                phoneNumber = GeneralFunctions.escapeHtml($('#phone-number').val()),
                email = GeneralFunctions.escapeHtml($('#email').val()),
                address = GeneralFunctions.escapeHtml($('#address').val()),
                city = GeneralFunctions.escapeHtml($('#city').val()),
                zipCode = GeneralFunctions.escapeHtml($('#zip-code').val());



        html =
                '<h4><i class="fa fa-user"></i> ' + firstname + ' ' + lastname + '</h4>' +
                '<p><strong class="text-primary">' +
                '&nbsp;&nbsp;<i class="fa fa-home" ></i>&nbsp;' + address +' <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'+ zipCode +' '+ city+
                '<br/>' + 
                 '&nbsp;&nbsp;<i class="fa fa-envelope-o" ></i> ' + email +
                '<br/>' +
                '&nbsp;&nbsp;<i class="fa fa-phone" ></i>  ' + phoneNumber +
                '<br/>' +
                '</strong></p>';

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
            'end_datetime': FrontendService.calcEndDatetime(),
            'notes': $('#notes').val(),
            'is_unavailable': false,
            'id_users_provider': $('#select-provider').val(),
            'id_services': $('#select-service').val()
        };

        postData['manage_mode'] = FrontendService.manageMode;

        if (FrontendService.manageMode) {
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
            FrontendService.getAvailableHours($('#select-date').val());

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

            FrontendService.updateConfirmFrame();

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
                        window.location = GlobalVariables.baseUrl + '/index.php/home/appointments';
                    }, 1000);
                })
                .fail(function (jqxhr, textStatus, errorThrown) {
                    $('.captcha-title small').trigger('click');
                    GeneralFunctions.ajaxFailureHandler(jqxhr, textStatus, errorThrown);
                })
                .always(function () {
                    $layer.remove();
                })
    },
    /**
     * This function reset  the modal's data input. when the modal is closed
     *
     * 
     */
    resetModalInput: function () {

        $('.modal').on('hidden.bs.modal', function () {



            $('#book-appointment-wizard').show();
            if (GlobalVariables.showProvider =='1')
            {
                $('#wizard-frame-1').show();
                $('#button-back-2').removeClass('hidden');
                $('#wizard-frame-2').hide(); 
                
            } else {
                $('#wizard-frame-1').hide();
                $('#button-back-2').hide();
                $('#wizard-frame-2').show();
                
            }
            $('#wizard-frame-3').hide();
            $('#wizard-frame-4').hide();
            $('.ask-dispo').html('<br/>Si vous ne trouvez pas une date qui vous convient vous pouvez envoyer une demande au administrateur');
            $('#success-frame').hide();
            $('.alert').removeClass(' alert-danger alert-success')
                    .addClass('hidden');
            $('select').prop('selectedIndex', 0);
            $('.cnx-choice').removeClass('hidden');
            $('.inscrit').addClass('hidden');

            $('input.captcha-text').focus();
            $('#select-date').datepicker("setDate", Date.today());
            //FrontendBook.getAvailableHours(Date.today().toString('dd-MM-yyyy'));
            FrontendService.updateServiceDescription($('#select-service').val(), $('#service-description'));
            $('.available-hour:eq(0)').addClass('selected-hour');
            $('.available-hour:eq(0)').removeClass('selected-hour');

        });
    }

 



};
