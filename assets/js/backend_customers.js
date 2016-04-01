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
 * @namespace BackendCustomers
 */
var BackendCustomers = {
    MIN_PASSWORD_LENGTH: 7,
    /**
     * The page helper contains methods that implement each record type functionality
     * (for now there is only the CustomersHelper).
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

        BackendCustomers.helper = new CustomersHelper();
        BackendCustomers.helper.resetForm();
        BackendCustomers.helper.filter('');

        $('#image').attr('src', GlobalVariables.baseUrl + 'assets/img/default_image.jpg');

        $('#filter-customers .results').jScrollPane();
        $('#customer-appointments').jScrollPane();

        if (defaultEventHandlers) {
            BackendCustomers.bindEventHandlers();
        }
        document.getElementById("File").disabled = true;
    },
    /**
     * Default event handlers declaration for backend customers page.
     */
    bindEventHandlers: function () {
        CustomersHelper.prototype.bindEventHandlers();
    }
};

/**
 * This class contains the methods that are used in the backend customers page.
 *
 * @class CustomersHelper
 */
var CustomersHelper = function () {
    this.filterResults = {};
};

/**
 * Binds the default event handlers of the backend customers page.
 */
CustomersHelper.prototype.bindEventHandlers = function () {
    /**
     * Event: Filter Customers Form "Submit"
     */
    $('#filter-customers form').submit(function (event) {
        var key = $('#filter-customers .key').val();
        $('#filter-customers .selected-row').removeClass('selected-row');
        BackendCustomers.helper.resetForm();
        BackendCustomers.helper.filter(key);
        return false;
    });

    $('#File').change(function (event) {
        var val = $('#File').val();
        
        console.log("val" + val);
        var customerId = $(this).attr('data-id');
        console.log('customerId', customerId);
        if (val == '') {
            event.preventDefault();
            $('#File').addClass('error');
        } else
        {
            var file_data = $('#File').prop('files')[0];
            var form_data = new FormData();
            form_data.append('file', file_data);
            form_data.append('csrfToken', GlobalVariables.csrfToken);
            form_data.append('customerId', customerId);

            //$('.upload-file').hide();
            //$("#progress").removeClass('hidden');

            var postUrl = GlobalVariables.baseUrl + 'index.php/backend_api/send_file';




            $.ajax({
                url: postUrl, // point to server-side PHP script 
                dataType: 'json', // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    //alert('success');
                    window.location.reload();
                    console.log(response);
                    GlobalVariables.full_path = response;
                }


            });
        }

    });

    /**
     * Event: Filter Customers Clear Button "Click"
     */
    $('#filter-customers .clear').click(function () {
        $('#filter-customers .key').val('');
        BackendCustomers.helper.filter('');
        BackendCustomers.helper.resetForm();
    });

    /**
     * Event: Customer Row "Click"
     *
     * Display the customer data of the selected row.
     */
    $(document).on('click', '.customer-row', function () {
        document.getElementById("File").disabled = false;
        if ($('#filter-customers .filter').prop('disabled')) {
            return; // Do nothing when user edits a customer record.
        }

        var customerId = $(this).attr('data-id');
        $('#File').attr('data-id', customerId);
        var customer = {};
        $.each(BackendCustomers.helper.filterResults, function (index, item) {
            if (item.id == customerId) {
                customer = item;
                return false;
            }
        });
        console.log('customer :', customer.src_photo);
        BackendCustomers.helper.display(customer);
        $('#filter-customers .selected-row').removeClass('selected-row');
        $(this).addClass('selected-row');
        $('#edit-customer, #delete-customer').prop('disabled', false);
    });

    /**
     * Event: Appointment Row "Click"
     *
     * Display appointment data of the selected row.
     */
    $(document).on('click', '.appointment-row', function () {
        $('#customer-appointments .selected-row').removeClass('selected-row');
        $(this).addClass('selected-row');

        var customerId = $('#filter-customers .selected-row').attr('data-id');
        var appointmentId = $(this).attr('data-id');
        var appointment = {};

        $.each(BackendCustomers.helper.filterResults, function (index, c) {
            if (c.id === customerId) {
                $.each(c.appointments, function (index, a) {
                    if (a.id == appointmentId) {
                        appointment = a;
                        return false;
                    }
                });
                return false;
            }
        });

        BackendCustomers.helper.displayAppointment(appointment);
    });

    /**
     * Event: Add Customer Button "Click"
     */
    $('#add-customer').click(function () {
        BackendCustomers.helper.resetForm();
        $('#add-edit-delete-group').hide();
        $('#save-cancel-group').show();
        $('.details').find('input, textarea').prop('readonly', false);
        $('#customer-password, #customer-password-confirm').addClass('required');
        $('#filter-customers button').prop('disabled', true);
        $('#filter-customers .results').css('color', '#AAA');
    });

    /**
     * Event: Edit Customer Button "Click"
     */
    $('#edit-customer').click(function () {
        $('.details').find('input, textarea').prop('readonly', false);
        $('#add-edit-delete-group').hide();
        $('#save-cancel-group').show();
        $('#customer-password, #customer-password-confirm').removeClass('required');
        $('#filter-customers button').prop('disabled', true);
        $('#filter-customers .results').css('color', '#AAA');
    });

    /**
     * Event: Cancel Customer Add/Edit Operation Button "Click"
     */
    $('#cancel-customer').click(function () {
        var id = $('#customer-id').val();
        BackendCustomers.helper.resetForm();
        if (id != '') {
            BackendCustomers.helper.select(id, true);
        }
    });

    /**
     * Event: Save Add/Edit Customer Operation "Click"
     */
    $('#save-customer').click(function () {
        var customer = {
            'first_name': $('#first-name').val(),
            'last_name': $('#last-name').val(),
            'email': $('#email').val(),
            'phone_number': $('#phone-number').val(),
            'address': $('#address').val(),
            'city': $('#city').val(),
            'zip_code': $('#zip-code').val(),
            'notes': $('#notes').val()
        };

        // Include password if changed.
        if ($('#customer-password').val() !== '') {
            customer.password = $('#customer-password').val();
        }

        if ($('#customer-id').val() != '') {
            customer.id = $('#customer-id').val();
        }
        console.log('customer', customer);
        if (!BackendCustomers.helper.validate(customer))
            return;

        BackendCustomers.helper.save(customer);
    });

    /**
     * Event: Delete Customer Button "Click"
     */
    $('#delete-customer').click(function () {
        var customerId = $('#customer-id').val();

        var messageBtns = {};
        messageBtns[EALang['delete']] = function () {
            BackendCustomers.helper.delete(customerId);
            $('#message_box').dialog('close');
        };
        messageBtns[EALang['cancel']] = function () {
            $('#message_box').dialog('close');
        };

        GeneralFunctions.displayMessageBox(EALang['delete_customer'],
                EALang['delete_record_prompt'], messageBtns);
    });
};

/**
 * Save a customer record to the database (via ajax post).
 *
 * @param {object} customer Contains the customer data.
 */
CustomersHelper.prototype.save = function (customer) {
    var postUrl = GlobalVariables.baseUrl + '/index.php/backend_api/ajax_save_customer';
    var postData = {
        'csrfToken': GlobalVariables.csrfToken,
        'customer': JSON.stringify(customer)
    };

    $.post(postUrl, postData, function (response) {
        ///////////////////////////////////////////////////////////
        console.log('Save Customer Response:', response);
        ///////////////////////////////////////////////////////////

        if (!GeneralFunctions.handleAjaxExceptions(response))
            return;

        Backend.displayNotification(EALang['customer_saved']);
        BackendCustomers.helper.resetForm();
        $('#filter-customers .key').val('');
        BackendCustomers.helper.filter('', response.id, true);
    }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
};

/**
 * Delete a customer record from database.
 *
 * @param {numeric} id Record id to be deleted.
 */
CustomersHelper.prototype.delete = function (id) {
    var postUrl = GlobalVariables.baseUrl + '/index.php/backend_api/ajax_delete_customer';
    var postData = {
        'csrfToken': GlobalVariables.csrfToken,
        'customer_id': id
    };

    $.post(postUrl, postData, function (response) {
        ////////////////////////////////////////////////////
        //console.log('Delete customer response:', response);
        ////////////////////////////////////////////////////

        if (!GeneralFunctions.handleAjaxExceptions(response))
            return;

        Backend.displayNotification(EALang['customer_deleted']);
        BackendCustomers.helper.resetForm();
        BackendCustomers.helper.filter($('#filter-customers .key').val());
    }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
};

/**
 * Validate customer data before save (insert or update).
 *
 * @param {object} customer Contains the customer data.
 */
CustomersHelper.prototype.validate = function (customer) {
    $('#form-message').hide();
    $('.required').css('border', '');

    try {
        // Validate required fields.
        var missingRequired = false;
        $('.required').each(function () {
            if ($(this).val() == '') {
                $(this).css('border', '2px solid red');
                missingRequired = true;
            }
        });
        if (missingRequired) {
            throw EALang['fields_are_required'];
        }

        // Validate passwords.
        if ($('#customer-password').val() != $('#customer-password-confirm').val()) {
            $('#customer-password, #customer-password-confirm').css('border', '2px solid red');
            throw EALang['passwords_mismatch'];
        }

        if ($('#customer-password').val().length < BackendCustomers.MIN_PASSWORD_LENGTH
                && $('#customer-password').val() != '') {
            $('#customer-password, #customer-password-confirm').css('border', '2px solid red');

            throw EALang['password_length_notice'].replace('$number', BackendCustomers.MIN_PASSWORD_LENGTH);
        }

        // Validate email address.
        if (!GeneralFunctions.validateEmail($('#email').val())) {
            $('#email').css('border', '2px solid red');
            throw EALang['invalid_email'];
        }

        return true;

    } catch (exc) {
        $('#form-message').text(exc).show();
        return false;
    }
};

/**
 * Bring the customer form back to its initial state.
 */
CustomersHelper.prototype.resetForm = function () {
    $('#image').attr('src', GlobalVariables.baseUrl + 'assets/img/default_image.jpg');
    document.getElementById("File").disabled = true;
    $('.details').find('input, textarea').val('');
    $('.details').find('input, textarea').prop('readonly', true);

    $('#customer-appointments').html('');
    $('#appointment-details').html('');
    $('#edit-customer, #delete-customer').prop('disabled', true);
    $('#add-edit-delete-group').show();
    $('#save-cancel-group').hide();
    $('#customer-password, #customer-password-confirm').css('border', '');
    $('.details .required').css('border', '');
    $('.details #form-message').hide();

    $('#filter-customers button').prop('disabled', false);
    $('#filter-customers .selected-row').removeClass('selected-row');
    $('#filter-customers .results').css('color', '');
};

/**
 * Display a customer record into the form.
 *
 * @param {object} customer Contains the customer record data.
 */
CustomersHelper.prototype.display = function (customer) {
    $('#customer-id').val(customer.id);
    $('#first-name').val(customer.first_name);
    $('#last-name').val(customer.last_name);
    $('#email').val(customer.email);
    $('#phone-number').val(customer.phone_number);
    $('#address').val(customer.address);
    $('#city').val(customer.city);
    $('#zip-code').val(customer.zip_code);
    $('#notes').val(customer.notes);
    $('#image').attr('src', GlobalVariables.baseUrl + customer.src_photo);

    $('#customer-appointments').data('jsp').destroy();
    $('#customer-appointments').empty();
    $.each(customer.appointments, function (index, appointment) {
        var start = GeneralFunctions.formatDate(Date.parse(appointment.start_datetime), GlobalVariables.dateFormat, true),
                end = GeneralFunctions.formatDate(Date.parse(appointment.end_datetime), GlobalVariables.dateFormat, true);
        var html =
                '<div class="appointment-row" data-id="' + appointment.id + '">' +
                start + ' - ' + end + '<br>' +
                appointment.service.name + ', ' +
                appointment.provider.first_name + ' ' + appointment.provider.last_name +
                '</div>';
        $('#customer-appointments').append(html);
    });
    $('#customer-appointments').jScrollPane({mouseWheelSpeed: 70});

    $('#appointment-details').empty();
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
CustomersHelper.prototype.filter = function (key, selectId, display) {
    if (display == undefined)
        display = false;

    var postUrl = GlobalVariables.baseUrl + '/index.php/backend_api/ajax_filter_customers';
    var postData = {
        'csrfToken': GlobalVariables.csrfToken,
        'key': key
    };

    $.post(postUrl, postData, function (response) {
        ///////////////////////////////////////////////////////
        console.log('Filter Customers Response:', response);
        ///////////////////////////////////////////////////////

        if (!GeneralFunctions.handleAjaxExceptions(response))
            return;

        BackendCustomers.helper.filterResults = response;

        $('#filter-customers .results').data('jsp').destroy();
        $('#filter-customers .results').html('');
        $.each(response, function (index, customer) {
            var html = BackendCustomers.helper.getFilterHtml(customer);
            $('#filter-customers .results').append(html);
        });
        $('#filter-customers .results').jScrollPane({mouseWheelSpeed: 70});

        if (response.length == 0) {
            $('#filter-customers .results').html('<em>' + EALang['no_records_found'] + '</em>');
        }

        if (selectId != undefined) {
            BackendCustomers.helper.select(selectId, display);
        }

    }, 'json').fail(GeneralFunctions.ajaxFailureHandler);
};

/**
 * Get the filter results row html code.
 *
 * @param {object} customer Contains the customer data.
 * @return {string} Returns the record html code.
 */
CustomersHelper.prototype.getFilterHtml = function (customer) {
    var name = customer.first_name + ' ' + customer.last_name;
    var info = customer.email;
    info = (customer.phone_number != '' && customer.phone_number != null)
            ? info + ', ' + customer.phone_number : info;

    var html =
            '<div class="customer-row" data-id="' + customer.id + '">' +
            '<strong>' +
            name +
            '</strong><br>' +
            info +
            '</div><hr>';

    return html;
};

/**
 * Select a specific record from the current filter results. If the customer id does not exist
 * in the list then no record will be selected.
 *
 * @param {numeric} id The record id to be selected from the filter results.
 * @param {bool} display (OPTIONAL = false) If true then the method will display the record
 * on the form.
 */
CustomersHelper.prototype.select = function (id, display) {
    if (display == undefined)
        display = false;

    $('#filter-customers .selected-row').removeClass('selected-row');

    $('#filter-customers .customer-row').each(function () {
        if ($(this).attr('data-id') == id) {
            $(this).addClass('selected-row');
            return false;
        }
    });

    if (display) {
        $.each(BackendCustomers.helper.filterResults, function (index, customer) {
            if (customer.id == id) {
                BackendCustomers.helper.display(customer);
                $('#edit-customer, #delete-customer').prop('disabled', false);
                return false;
            }
        });
    }
};

/**
 * Display appointment details on customers backend page.
 *
 * @param {object} appointment Appointment data
 */
CustomersHelper.prototype.displayAppointment = function (appointment) {
    var start = GeneralFunctions.formatDate(Date.parse(appointment.start_datetime), GlobalVariables.dateFormat, true),
            end = GeneralFunctions.formatDate(Date.parse(appointment.end_datetime), GlobalVariables.dateFormat, true);

    var html =
            '<div>' +
            '<strong>' + appointment.service.name + '</strong><br>' +
            appointment.provider.first_name + ' ' + appointment.provider.last_name + '<br>' +
            start + ' - ' + end + '<br>' +
            '</div>';

    $('#appointment-details').html(html);
};

/**
 * Display appointment details on customers backend page.
 *
 * @param {object} appointment Appointment data
 */
CustomersHelper.prototype.savePicture = function () {
    var val = $('#File').val();
    console.log("val" + val);
    var customerId = $(this).attr('data-id');
    console.log('customerId', customerId);
    if (val == '') {
        event.preventDefault();
        $('#File').addClass('error');
    } else
    {
        var file_data = $('#File').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        form_data.append('csrfToken', GlobalVariables.csrfToken);
        form_data.append('customerId', customerId);

        //$('.upload-file').hide();
        //$("#progress").removeClass('hidden');

        var postUrl = GlobalVariables.baseUrl + 'index.php/backend_api/send_file';




        $.ajax({
            url: postUrl, // point to server-side PHP script 
            dataType: 'json', // what to expect back from the PHP script, if anything
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function (response) {
                alert('success');
                console.log(response);
                GlobalVariables.full_path = response;
            }


        });
    }
};
