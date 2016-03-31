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
 * @namespace BackendHeader
 */
var BackendHeader = {
    /**
     * The page helper contains methods that implement each record type functionality
     * (for now there is only the HeaderHelper).
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

        BackendHeader.helper = new HeaderHelper();

        BackendHeader.helper.getheadernotifications();


//        setInterval(function () {
//            $.ajax({url: "server", success: function (data) {
//                    //Update your dashboard gauge
//                    BackendHeader.helper.getheadernotifications();
//                }, dataType: "json"});
//        }, 3000);




        setInterval(function () {
            $(document).ajaxStart(function () {
                $('#loading').hide();
            });
            BackendHeader.helper.getheadernotifications();
            //console.log('hello');

            

        }, 10000);



        /**(function poll(){
         $.ajax({ url: "server", success: function(data){
         //Update your dashboard gauge
         BackendHeader.helper.getheadernotifications();
         }, dataType: "json", complete: poll, timeout: 3000 });
         })();
         **/
        $('#notification_results').css('height', '200px');
        $('#notification-row').css('height', '40px');
        $('#notification_results').css('width', '400px');
        $('#notification_results').css('margin-bottom', '20px');
        $('#notification_results').css('overflow-y', 'auto');


        if (defaultEventHandlers) {
            BackendHeader.bindEventHandlers();
        }
    },
    /**
     * Default event handlers declaration for backend customers page.
     */
    bindEventHandlers: function () {
        HeaderHelper.prototype.bindEventHandlers();
    }
};
/**
 * This class contains the methods that are used in the backend customers page.
 *
 * @class HeaderHelper
 */
var HeaderHelper = function () {
    this.filterResults = {};
};
/**
 * Binds the default event handlers of the backend customers page.
 */



HeaderHelper.prototype.bindEventHandlers = function () {
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
HeaderHelper.prototype.getheadernotifications = function () {
    //if (display == undefined) display = false;

    var postUrl = GlobalVariables.baseUrl + '/index.php/backend_api/ajax_get_notification';
    var postData = {
        'csrfToken': GlobalVariables.csrfToken

    };

    $.post(postUrl, postData, function (response) {
        ///////////////////////////////////////////////////////
        //console.log('Filter notification_list Response:', response);
        ///////////////////////////////////////////////////////

        if (!GeneralFunctions.handleAjaxExceptions(response))
            return;

        BackendHeader.helper.filterResults = response;
        //$('#waiting-list .results').data('jsp').destroy();
        $('#notification_results').html('');
        var curr = new Date; // get current date
        var first = curr.getDate() - curr.getDay(); // First day is the day of the month - the day of the week
        var firstday = new Date(curr.setDate(first)).toString('yyyy-MM-dd 00:00:00');
        //console.log('firstday: ', firstday);



        $.each(response, function (index, notification_list) {

            if (notification_list.date_action >= firstday) {
                var html = BackendHeader.helper.getFilterHtmlheadernotifications(notification_list);

                $('#notification_results').append(html);
            } else {
                BackendHeader.helper.deletenotification(notification_list.id);
            }

        });



    }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
};


/**
 * Get the filter results row html code.
 *
 * @param {object} waiting-list Contains the waiting-list data.
 * @return {string} Returns the record html code.
 */
HeaderHelper.prototype.getFilterHtmlheadernotifications = function (notification_list) {

    var date_action = GeneralFunctions.formatDate(Date.parse(notification_list.date_action), GlobalVariables.dateFormat, true);
    var today = new Date();//.toString('yyyy-MM-dd hh:mm:ss');
    var action = new Date(notification_list.date_action);//.toString('yyyy-MM-dd hh:mm:ss');
    //var time = parseInt((today - action) / (1000 * 60 * 60 * 24));
    today.getTimezoneOffset();
    action.getTimezoneOffset();
    //console.log(today);
    //action.setUTCMilliseconds(1270544790922);
    var passed = 0;
    if (parseInt((today - action) / (1000)) >= 1 && parseInt((today - action) / (1000 * 60)) < 1)
    {
        var time = parseInt((today - action) / (1000));
        passed = "il y a " + time + " secondes";
    } else if (parseInt((today - action) / (1000 * 60)) >= 1 && parseInt((today - action) / (1000 * 60 * 60)) < 1)
    {
        var time = parseInt((today - action) / (1000 * 60));
        passed = "il y a " + time + " minutes";
    } else if (parseInt((today - action) / (1000 * 60 * 60)) >= 1 && parseInt((today - action) / (1000 * 60 * 60 * 24)) < 1)
    {
        var time = parseInt((today - action) / (1000 * 60 * 60));
        passed = "il y a " + time + " heures";
    } else if (parseInt((today - action) / (1000 * 60 * 60 * 24)) >= 1)
    {
        var time = parseInt((today - action) / (1000 * 60 * 60 * 24));
        passed = "il y a " + time + " jours";
    }



    //console.log('today', today);
    //console.log('action', action);
    //console.log('time', time);

    var html =
            '<a href="#">' +
            '<div class="notification-row" data-id="' + notification_list.id + '">' +
            '<i class="fa fa-calendar-check-o"></i>    ' +
            notification_list.type +
            '<span class="pull-right text-muted small">"' + passed + '"</span>' +
            '</div>' +
            '</a>' +
            '<li class="divider"></li>';



    return html;
};


HeaderHelper.prototype.deletenotification = function (notification_id) {
    var postUrl = GlobalVariables.baseUrl + '/index.php/backend_api/ajax_delete_notification';
    var postData = {
        'csrfToken': GlobalVariables.csrfToken,
        'id': notification_id
    };

    $.post(postUrl, postData, function (response) {
        ///////////////////////////////////////////////////////
        console.log('DELETE NOTIFICATION:', response);
        ///////////////////////////////////////////////////////
    }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
};
