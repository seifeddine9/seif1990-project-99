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
 * Backend Customers javasript namespace. Contains the main functionality
 * of the backend customers page. If you need to use this namespace in a
 * different page, do not bind the default event handlers during initialization.
 *
 * @namespace BackendDashboard
 */
var BackendDashboard = {
    /**
     * The page helper contains methods that implement each record type functionality
     * (for now there is only the DashboardHelper).
     *
     * @type {object}
     */
    helper: {},
    /**
     * This method initializes the backend customers page. If you use this namespace
     * in a different page do not use this method.
     *
     * @param {bool} defaultEventHandlers (OPTIONAL = false) Whether to bind the default
     * event handlers or not.
     */
    initialize: function (defaultEventHandlers) {
        if (defaultEventHandlers == undefined)
            defaultEventHandlers = false;

        BackendDashboard.helper = new DashboardHelper();
        BackendDashboard.helper.getallwaiting();
        BackendDashboard.helper.getallappointment();

        BackendDashboard.helper.getallnotifications();  
        
        setInterval(function () {
            $(document).ajaxStart(function () {
                $('#loading').hide();
            });
           BackendDashboard.helper.getallnotifications();  
            //console.log('hello');

            

        }, 10000);
        
        /**
        setInterval(function () {
            BackendDashboard.helper.getallnotifications();   
        }, 60000);
        **/
        $('#appointment_list .results').jScrollPane();
        $('#waiting_list .results').jScrollPane();
        $('#notification_list .results').jScrollPane();

        if (defaultEventHandlers) {
            BackendDashboard.bindEventHandlers();
        }
        
    },
    /**
     * Default event handlers declaration for backend customers page.
     */
    bindEventHandlers: function () {
        DashboardHelper.prototype.bindEventHandlers();
    }
};

/**
 * This class contains the methods that are used in the backend customers page.
 *
 * @class DashboardHelper
 */
var DashboardHelper = function () {
    this.filterResults = {};
};

/**
 * Binds the default event handlers of the backend customers page.
 */



DashboardHelper.prototype.bindEventHandlers = function () {


    $(document).on('click', '#date_button', function (e) {
        if ($('#date1').val() === '' || $('#date2').val() === '' || $('#date1').val() > $('#date2').val())
        {
            e.preventDefault();
        } else
        {
            var dates = {
                'date_debut': $('#date1').val(),
                'date_fin': $('#date2').val()

            };
            BackendDashboard.helper.filter(dates);
            BackendDashboard.helper.getallwaiting(dates);
            BackendDashboard.helper.getallappointment(dates);
        }


    });
    $(document).on('click', '#supprimer-appointment', function () {

        var appointmenthash = $(this).attr('data-id');
        console.log(appointmenthash);
        var postData = {
            'csrfToken': GlobalVariables.csrfToken
        };

        var postUrl = GlobalVariables.baseUrl + '/index.php/appointments/cancel/' + appointmenthash;
        $.post(postUrl, postData, function (response) {
            console.log(response);
            window.location.reload();
        });


    });


    $(document).on('click', '#supprimer-waiting', function () {

        var waitinghash = $(this).attr('delete-id');
        console.log(waitinghash);
        var postData = {
            'csrfToken': GlobalVariables.csrfToken
        };

        var postUrl = GlobalVariables.baseUrl + '/index.php/waiting/cancel/' + waitinghash;
        $.post(postUrl, postData, function (response) {
            console.log(response);
            window.location.reload();
        });


    });

    $(document).on('click', '#approuver-waiting', function () {
        var waiting_id = $(this).attr('approuver-id');
        
        BackendDashboard.helper.getwaitingbyid(waiting_id);
        
        window.location.reload();
        //setTimeout(function(){location.reload(), 5000} );


    });
    $(document).on('click', '#bloquer-waiting', function () {
        var waiting_id = $(this).attr('bloqued-id');
        //alert('hello');

        BackendDashboard.helper.addbloquedwaiting(waiting_id);


        //window.location.reload();



    });
    $(document).on('click', '#confirm-appointment', function () {
        var appointment_id = $(this).attr('confirm-id');
        //alert('hello');

        BackendDashboard.helper.confirmappointment(appointment_id);


        window.location.reload();



    });

};

DashboardHelper.prototype.filter = function (dates) {


    var postUrl = GlobalVariables.baseUrl + '/index.php/backend_api/ajax_filter_dates';
    var postData = {
        'dates': JSON.stringify(dates),
        'csrfToken': GlobalVariables.csrfToken
    };

    $.post(postUrl, postData, function (response) {

        ///////////////////////////////////////////////////////
        console.log('Filter Dashboard Response:', response);
        ///////////////////////////////////////////////////////

        //if (!GeneralFunctions.handleAjaxExceptions(response)) return;

        //BackendDashboard.helper.filterResults = response;
        
        
        $(".number_appointment").html(response.all);
        $(".number_appointment_confirmed").html(response.confirmed);
        $(".number_appointment_projected").html(response.projected);

        $(".number_appointment_total").html(response.all_price);


    }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
};





/**
 * Filter customer records.
 *
 * @param {string} key This key string is used to filter the customer records.
 * @param {numeric} selectId (OPTIONAL = undefined) If set then after the filter
 * operation the record with the given id will be selected (but not displayed).
 * @param {bool} display (OPTIONAL = false) If true then the selected record will
 * be displayed on the form.
 */
DashboardHelper.prototype.getallwaiting = function (dates) {
    //if (display == undefined) display = false;

    var postUrl = GlobalVariables.baseUrl + '/index.php/backend_api/ajax_get_waiting';
    if (dates == '') {
        var postData = {
            'csrfToken': GlobalVariables.csrfToken

        };

    } else {
        var postData = {
            'csrfToken': GlobalVariables.csrfToken,
            'dates': JSON.stringify(dates)
        };
    }




    $.post(postUrl, postData, function (response) {
        ///////////////////////////////////////////////////////
        console.log('Filter waiting_list Response:', response);
        ///////////////////////////////////////////////////////

        if (!GeneralFunctions.handleAjaxExceptions(response))
            return;

        BackendDashboard.helper.filterResults = response;
        //$('#waiting_list .results').data('jsp').destroy();
        $('#waiting_list .results').html('');
        $.each(response, function (index, waiting_list) {
            var date = new Date().toString('yyyy-MM-dd HH:mm:ss');
            if (waiting_list.start_datetime > date) {
                var html = BackendDashboard.helper.getFilterHtmlWaiting(waiting_list);
                $('#waiting_list .results').append(html);


                if (waiting_list.etat == 'bloqued') {
                    $('#waiting_list .results [waiting-id="' + waiting_list.id + '"]').css('background', '#ff6666');
                    $('[bloqued-id="' + waiting_list.id + '"]').hide();
                    $('[delete-id="' + waiting_list.hash + '"]').show();
                } else {
                    $('[bloqued-id="' + waiting_list.id + '"]').show();
                    $('[delete-id="' + waiting_list.hash + '"]').hide();
                }
            }
        });



    }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
};



/**
 * Filter customer records.
 *
 * @param {string} key This key string is used to filter the customer records.
 * @param {numeric} selectId (OPTIONAL = undefined) If set then after the filter
 * operation the record with the given id will be selected (but not displayed).
 * @param {bool} display (OPTIONAL = false) If true then the selected record will
 * be displayed on the form.
 */
DashboardHelper.prototype.getwaitingbyid = function (waiting_id) {
    //if (display == undefined) display = false;
    
    var postUrl = GlobalVariables.baseUrl + '/index.php/backend_api/ajax_get_waiting_id';


    var postData = {
        'csrfToken': GlobalVariables.csrfToken,
        'waiting_id': waiting_id
    };

    $.post(postUrl, postData, function (response) {
        ///////////////////////////////////////////////////////
        console.log('Filter waiting_list_id Response:', response);
        ///////////////////////////////////////////////////////
        BackendDashboard.helper.addwaitingappointment(response);
        if (!GeneralFunctions.handleAjaxExceptions(response))
            return;

    }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
    
};


/**
 * Filter customer records.
 *
 * @param {string} key This key string is used to filter the customer records.
 * @param {numeric} selectId (OPTIONAL = undefined) If set then after the filter
 * operation the record with the given id will be selected (but not displayed).
 * @param {bool} display (OPTIONAL = false) If true then the selected record will
 * be displayed on the form.
 */
DashboardHelper.prototype.deletewaitingbyid = function (waiting_id) {
    //if (display == undefined) display = false;

    var postUrl = GlobalVariables.baseUrl + '/index.php/backend_api/ajax_delete_waiting';

    console.log('Filter waiting id:', waiting_id);
    var postData = {
        'csrfToken': GlobalVariables.csrfToken,
        'waiting_id': waiting_id
    };

    $.post(postUrl, postData, function (response) {
        ///////////////////////////////////////////////////////
        console.log('Filter waiting delete:', response);
        ///////////////////////////////////////////////////////		
        if (!GeneralFunctions.handleAjaxExceptions(response))
            return;

    }, 'json').fail(GeneralFunctions.ajaxFailureHandler);

};


/**
 * Filter customer records.
 *
 * @param {string} key This key string is used to filter the customer records.
 * @param {numeric} selectId (OPTIONAL = undefined) If set then after the filter
 * operation the record with the given id will be selected (but not displayed).
 * @param {bool} display (OPTIONAL = false) If true then the selected record will
 * be displayed on the form.
 */
DashboardHelper.prototype.addbloquedwaiting = function (waiting_id) {
    //if (display == undefined) display = false;

    var postUrl = GlobalVariables.baseUrl + '/index.php/backend_api/ajax_bloqued_waiting';

    console.log('Filter waiting id:', waiting_id);
    var postData = {
        'csrfToken': GlobalVariables.csrfToken,
        'waiting_id': waiting_id
    };

    $.post(postUrl, postData, function (response) {
        ///////////////////////////////////////////////////////
        console.log('Filter bloqued:', response);
        ///////////////////////////////////////////////////////		
        if (!GeneralFunctions.handleAjaxExceptions(response))
            return;

    }, 'json').fail(GeneralFunctions.ajaxFailureHandler);

};

/**
 * Filter customer records.
 *
 * @param {string} key This key string is used to filter the customer records.
 * @param {numeric} selectId (OPTIONAL = undefined) If set then after the filter
 * operation the record with the given id will be selected (but not displayed).
 * @param {bool} display (OPTIONAL = false) If true then the selected record will
 * be displayed on the form.
 */
DashboardHelper.prototype.confirmappointment = function (appointment_id) {
    //if (display == undefined) display = false;

    var postUrl = GlobalVariables.baseUrl + '/index.php/backend_api/ajax_confirm_appointment';

    console.log('Filter appointment id:', appointment_id);
    var postData = {
        'csrfToken': GlobalVariables.csrfToken,
        'appointment_id': appointment_id
    };

    $.post(postUrl, postData, function (response) {
        ///////////////////////////////////////////////////////
        console.log('Filter confirm:', response);
        ///////////////////////////////////////////////////////		
        if (!GeneralFunctions.handleAjaxExceptions(response))
            return;

    }, 'json').fail(GeneralFunctions.ajaxFailureHandler);

};


/**
 * Filter customer records.
 *
 * @param {string} key This key string is used to filter the customer records.
 * @param {numeric} selectId (OPTIONAL = undefined) If set then after the filter
 * operation the record with the given id will be selected (but not displayed).
 * @param {bool} display (OPTIONAL = false) If true then the selected record will
 * be displayed on the form.
 */
DashboardHelper.prototype.addwaitingappointment = function (waiting) {
    //if (display == undefined) display = false;

    var postUrl = GlobalVariables.baseUrl + '/index.php/backend_api/ajax_save_appointment';
    
    var appointment = {
        'id_services': waiting['id_services'],
        'id_users_provider': waiting['id_users_provider'],
        'id_users_customer': waiting['id_users_customer'],
        'start_datetime': waiting['start_datetime'],
        'end_datetime': waiting['end_datetime'],
        'notes': waiting['notes'],
        'is_unavailable': false
    };

    //waiting['start_datetime']=waiting['start_datetime'].toString('yyyy-MM-dd HH:mm:ss');
    console.log('see waiting appointment Response:', appointment);

    var postData = {
        'csrfToken': GlobalVariables.csrfToken,
        'appointment_data': JSON.stringify(appointment)
    };

    $.post(postUrl, postData, function (response) {
        ///////////////////////////////////////////////////////
        console.log('Filter waiting appointment Response:', response);
        ///////////////////////////////////////////////////////

        if (!GeneralFunctions.handleAjaxExceptions(response))
            return;
        BackendDashboard.helper.deletewaitingbyid(waiting['id']);
        
    }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
    window.location.reload();
};





/**
 * Get the filter results row html code.
 *
 * @param {object} waiting-list Contains the waiting-list data.
 * @return {string} Returns the record html code.
 */
DashboardHelper.prototype.getFilterHtmlWaiting = function (waiting_list) {
    var start = GeneralFunctions.formatDate(Date.parse(waiting_list.start_datetime), GlobalVariables.dateFormat, true),
            end = GeneralFunctions.formatDate(Date.parse(waiting_list.end_datetime), GlobalVariables.dateFormat, true);

    var html =
            '<div class="waiting-row" waiting-id="' + waiting_list.id + '" data-toggle="modal" data-target="#' + waiting_list.id + '">' +
            '<strong>Nom client: ' + waiting_list.customer.first_name + '</strong><br>' +
            '<strong>Nom service: ' + waiting_list.service.name + '</strong><br> Nom exécutant: '
            + waiting_list.provider.first_name + ' ' + waiting_list.provider.last_name + '<br>Durée :' +
            start + ' - ' + end + '<br>' +
            '</div><hr>' +
            '<div id="' + waiting_list.id + '" class="modal fade" role="dialog" >' +
            '<div class="modal-dialog modal-sm">' +
            '<!-- Modal content-->' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
            '<h4 class="modal-title">Nom client: ' + waiting_list.customer.first_name + '</h4>' +
            '</div>' +
            '<div class="modal-body">' +
            '<strong>Nom service: ' + waiting_list.service.name + '</strong><br> Nom exécutant: '
            + waiting_list.provider.first_name + ' ' + waiting_list.provider.last_name + '<br>Durée :' +
            start + ' - ' + end + '<br>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-success" id="approuver-waiting" approuver-id="' + waiting_list.id + '">Approuver</button>' +
            '<button type="button" class="btn btn-warning" id="bloquer-waiting" bloqued-id="' + waiting_list.id + '">Refuser</button>' +
            '<button type="button" class="btn btn-danger" id="supprimer-waiting" delete-id="' + waiting_list.hash + '">Supprimer</button>' +
            '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';



    return html;
};






/**
 * Filter customer records.
 *
 * @param {string} key This key string is used to filter the customer records.
 * @param {numeric} selectId (OPTIONAL = undefined) If set then after the filter
 * operation the record with the given id will be selected (but not displayed).
 * @param {bool} display (OPTIONAL = false) If true then the selected record will
 * be displayed on the form.
 */
DashboardHelper.prototype.getallappointment = function (dates) {
    //if (display == undefined) display = false;

    var postUrl = GlobalVariables.baseUrl + '/index.php/backend_api/ajax_get_appointment';
    if (dates === '') {
        var postData = {
            'csrfToken': GlobalVariables.csrfToken

        };

    } else {
        var postData = {
            'csrfToken': GlobalVariables.csrfToken,
            'dates': JSON.stringify(dates)
        };
    }

    $.post(postUrl, postData, function (response) {
        ///////////////////////////////////////////////////////
        console.log('Filter appointment_list Response:', response);
        ///////////////////////////////////////////////////////

        if (!GeneralFunctions.handleAjaxExceptions(response))
            return;

        BackendDashboard.helper.filterResults = response;
        //$('#waiting-list .results').data('jsp').destroy();
        $('#appointment_list .results').html('');
        $.each(response, function (index, appointment_list) {
            var date = new Date().toString('yyyy-MM-dd HH:mm:ss');

            if (appointment_list.start_datetime > date) {
                var html = BackendDashboard.helper.getFilterHtmlAppointment(appointment_list);
                $('#appointment_list .results').append(html);
            }
            
            if (appointment_list.etat === 'confirmé') {
                    //$('#waiting_list .results [waiting-id="' + waiting_list.id + '"]').css('background', '#ff6666');
                    $('[confirm-id="' + appointment_list.id + '"]').hide();
                    //$('[delete-id="' + waiting_list.hash + '"]').show();
                } else {
                    $('[confirm-id="' + appointment_list.id + '"]').show();
                    //$('[delete-id="' + waiting_list.hash + '"]').hide();
                }
        });

        $('#appointment_list .results').jScrollPane({mouseWheelSpeed: 70});

    }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
};

/**
 * Get the filter results row html code.
 *
 * @param {object} waiting-list Contains the waiting-list data.
 * @return {string} Returns the record html code.
 */
DashboardHelper.prototype.getFilterHtmlAppointment = function (appointment_list) {

    var start = GeneralFunctions.formatDate(Date.parse(appointment_list.start_datetime), GlobalVariables.dateFormat, true),
            end = GeneralFunctions.formatDate(Date.parse(appointment_list.end_datetime), GlobalVariables.dateFormat, true);

    var html =
            '<div class="appointment-row" data-id="' + appointment_list.id + '" data-toggle="modal" data-target="#' + appointment_list.id + '">' +
            '<strong>Nom client: ' + appointment_list.customer.first_name + '</strong><br>' +
            '<strong>Nom service: ' + appointment_list.service.name + '</strong><br> Nom exécutant: '
            + appointment_list.provider.first_name + ' ' + appointment_list.provider.last_name + '<br>Durée :' +
            start + ' - ' + end + '<br>' +
            '<strong>Etat: ' + appointment_list.etat + '</strong><br>' +
            '</div><hr>' +
            '<div id="' + appointment_list.id + '" class="modal fade" role="dialog" >' +
            '<div class="modal-dialog modal-sm">' +
            '<!-- Modal content-->' +
            '<div class="modal-content">' +
            '<div class="modal-header">' +
            '<button type="button" class="close" data-dismiss="modal">&times;</button>' +
            '<h4 class="modal-title">Nom client: ' + appointment_list.customer.first_name + '</h4>' +
            '</div>' +
            '<div class="modal-body">' +
            '<strong>Nom service: ' + appointment_list.service.name + '</strong><br> Nom exécutant: '
            + appointment_list.provider.first_name + ' ' + appointment_list.provider.last_name + '<br>Durée :' +
            start + ' - ' + end + '<br>' +
            '</div>' +
            '<div class="modal-footer">' +
            '<button type="button" class="btn btn-primary" id="confirm-appointment" confirm-id="' + appointment_list.id + '">Confirmer</button>' +
            '<button type="button" class="btn btn-danger" id="supprimer-appointment" data-id="' + appointment_list.hash + '">Supprimer</button>' +
            '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>';




    return html;
};



/**
 * Filter customer records.
 *
 * @param {string} key This key string is used to filter the customer records.
 * @param {numeric} selectId (OPTIONAL = undefined) If set then after the filter
 * operation the record with the given id will be selected (but not displayed).
 * @param {bool} display (OPTIONAL = false) If true then the selected record will
 * be displayed on the form.
 */
DashboardHelper.prototype.getallnotifications = function () {
    //if (display == undefined) display = false;

    var postUrl = GlobalVariables.baseUrl + '/index.php/backend_api/ajax_get_notification';
    var postData = {
        'csrfToken': GlobalVariables.csrfToken

    };

    $.post(postUrl, postData, function (response) {
        ///////////////////////////////////////////////////////
        console.log('Filter notification_list Response:', response);
        ///////////////////////////////////////////////////////

        if (!GeneralFunctions.handleAjaxExceptions(response))
            return;

        BackendDashboard.helper.filterResults = response;
        //$('#waiting-list .results').data('jsp').destroy();
        $('#notification_list .results').html('');
        var curr = new Date; // get current date
        var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
        var last = first + 6; // last day is the first day + 6

        var firstday = new Date(curr.setDate(first)).toString('yyyy-MM-dd 00:00:00');

        console.log('first date', firstday);



        $.each(response, function (index, notification_list) {

           

            if (notification_list.date_action > firstday) {
                var html = BackendDashboard.helper.getFilterHtmlnotifications(notification_list);

                $('#notification_list .results').append(html);
            }

        });

        $('#notification_list .results').jScrollPane({mouseWheelSpeed: 70});

    }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
};

/**
 * Get the filter results row html code.
 *
 * @param {object} waiting-list Contains the waiting-list data.
 * @return {string} Returns the record html code.
 */
DashboardHelper.prototype.getFilterHtmlnotifications = function (notification_list) {

    var date_action = GeneralFunctions.formatDate(Date.parse(notification_list.date_action), GlobalVariables.dateFormat, true);


    var html =
            '<div class="notification-row" data-id="' + notification_list.id + '" >' +
            '<strong>' + notification_list.message_action + '</strong><br>' +
            '</div><hr>';




    return html;
};

/**
 * Get the filter results row html code.
 *
 * @param {object} waiting-list Contains the waiting-list data.
 * @return {string} Returns the record html code.
 */
DashboardHelper.prototype.getFilterHtmlheadernotifications = function (notification_list) {

    var date_action = GeneralFunctions.formatDate(Date.parse(notification_list.date_action), GlobalVariables.dateFormat, true);


  var html =
            '<a href="#">'
    '<div class="notification-row" data-id="' + notification_list.id + '">' +
            notification_list.type +
            '<span class="pull-right text-muted small">4 minutes ago</span>' +
            '</div>' +
            '</a>';



    return html;
};




