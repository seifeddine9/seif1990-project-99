




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
var FrontendProfile = {
    /**
     * This method initializes the book appointment page.
     *
     * @param {bool} bindEventHandlers (OPTIONAL) Determines whether the default
     * event handlers will be binded to the dom elements.
     * @param {bool} manageMode (OPTIONAL) Determines whether the customer is going
     * to make  changes to an existing appointment rather than booking a new one.
     */
    initialize: function (bindEventHandlers) {
        if (bindEventHandlers === undefined) {
            bindEventHandlers = true; // Default Value
        }


        if (window.console === undefined) {
            window.console = function () {} // IE compatibility
        }

        /*
         **
         **
         **
         */

        $(document).on("keypress", "#phone-number ,#mobile-number ,#new-mobile-number", function (event) {
            // Allow: backspace, delete, tab, escape, enter and .

            console.log(isNaN(String.fromCharCode(event.which)));

            if (event.which != 8 && isNaN(String.fromCharCode(event.which))) {
                event.preventDefault();
            }




        });



        /*
         **
         **
         **
         */
        console.log(GlobalVariables.customer);
        $(".alert").addClass('hidden');
        $('.required').parents('.form-group').removeClass('has-error');

        $(".nom").append(GlobalVariables.customer.last_name + "  " + GlobalVariables.customer.first_name);
        $(".mail").append(GlobalVariables.customer.email);
        $(".telephone").append(GlobalVariables.customer.phone_number);
        $(".address-principal").append(GlobalVariables.customer.address + "  " + GlobalVariables.customer.city + "  " + GlobalVariables.customer.zip_code);

        if (GlobalVariables.customer.mobile_number)
        {
            $(".label-mobile").show();
            $(".mobile").show();
            $('.ajout-tel').hide();
            $(".mobile").append(GlobalVariables.customer.mobile_number);

        } else {
            $(".label-mobile").hide();
            $(".mobile").hide();
            $('.ajout-tel').show();


        }

        if (!GlobalVariables.customer.address2 && !GlobalVariables.customer.city2 && !GlobalVariables.customer.zip_code2)
        {

            $(".address-secondaire").hide();
            $('.label-address-secondaire').hide();
            $('.ajout-address').show();


        } else {
            $(".address-secondaire").append(GlobalVariables.customer.address2 + "  " + GlobalVariables.customer.city2 + "  " + GlobalVariables.customer.zip_code2);

            $(".address-secondaire").show();
            $('.label-address-secondaire').show();
            $('.ajout-address').hide();



        }



        // Bind the event handlers (might not be necessary every time
        // we use this class).
        if (bindEventHandlers) {
            FrontendProfile.bindEventHandlers();
        }


    },
    bindEventHandlers: function () {


        /***************** EDIT PASSWORD SECTION *********
         ************************************************/

        $(document).on('click', '#canceal-update-password', function () {

            $('#old-password').val('');
            $('#new-password').val('');



        });


        $(document).on('keypress', '#old-password ,#new-password ', function () {

            $(this).parents('.form-group').removeClass('has-error');
            $('.alert-danger').addClass('hidden');
            $('.alert-success').addClass('hidden');


        });



        $('#save-new-password').click(function (event) {


            var missingRequiredField = false;


            $('.required').each(function () {
                if ($(this).val() == '') {
                    $(this).parents('.form-group').addClass('has-error');
                    missingRequiredField = true;

                }
            });

            if (missingRequiredField) {
                event.preventDefault();
            } else
            {

                $('.required').parents('.form-group').removeClass('has-error');

                var old_password = $('#old-password').val();
                var new_password = $('#new-password').val();


                var formData = new Object();

                formData['passwords'] = {
                    'old_password': old_password,
                    'new_password': new_password
                };

                var postData = {
                    'csrfToken': GlobalVariables.csrfToken,
                    'formData': formData
                };
//console.log(postData);
                var postUrl = GlobalVariables.baseUrl + 'index.php/home/save_new_password';



                $.post(postUrl, postData, function (response) {
                    ////////////////////////////////////////////////////////////
                    console.log(response);

                    if (response == GlobalVariables.AJAX_SUCCESS) {
                        $('#old-password').val('');
                        $('#new-password').val('');
                        $('.alert-success').removeClass('hidden');


                    } else if (response == 'errone')
                    {
                        $('.alert-danger').removeClass('hidden');
                    } else if (response == 'vide')
                    {
                        $('.alert-danger').removeClass('hidden');
                        $('.alert-danger').text('Le nouveau mot de passe doit contenir au moins 7 caractéres');


                    }

                    ////////////////////////////////////////////////////////////
                    if (!GeneralFunctions.handleAjaxExceptions(response))
                        return;

                    ////////////////////////////////////////////////////////////
                    // if (!GeneralFunctions.handleAjaxExceptions(response)) return;
                }, 'json');
            }



        });


        /***************** EDIT general info  SECTION*********
         ************************************************/




        /**
         **
         **
         */
        $(document).on('keypress', '#last_name ,#first_name ,#email , #phone-number ', function () {

            $(this).parents('.group-form').removeClass('has-error');



        });

        $(document).on('click', '#canceal-update-new-phone', function () {
            $('.ajout-input-phone').removeClass('hidden');
            $('.new-phone').addClass('hidden');
            $('#new-mobile-number').val('');

            $('#update-info').show();

        });
        $(document).on('click', '#canceal-update-info', function () {
            $('.edit-info').addClass('hidden');
            $('.info').removeClass('hidden');

            $('#update-info').show();

        });
        $(document).on('click', '.ajout-input-phone', function () {
            $('.ajout-input-phone').addClass('hidden');
            $('.new-phone').removeClass('hidden');
            $('#new-mobile-number').val('');
            $('#update-info').hide();
        });


        /*
         **
         **
         */




        $(document).on('click', '#update-info', function () {

            $('.info').addClass('hidden');
            $('.edit-info').removeClass('hidden');
            $('#last_name').val(GlobalVariables.customer.last_name);
            $('#first_name').val(GlobalVariables.customer.first_name);
            $('#email').val(GlobalVariables.customer.email);
            $('#phone-number').val(GlobalVariables.customer.phone_number);
            $('.require').parents('.group-form').removeClass('has-error');
            $('#last_name').focus();

            if (GlobalVariables.customer.mobile_number)
            {
                $('.mobile-number').removeClass('hidden');
                $('#mobile-number').val(GlobalVariables.customer.mobile_number);
            } else {
                $('.mobile-number').addClass('hidden');
            }


        });


        /*
         **
         **
         */


        $('#save-update').click(function (event) {
            var missingRequiredField = false;
            $('.require').each(function () {

                if ($(this).val() == '') {
                    $(this).parents('.group-form').addClass('has-error');
                    missingRequiredField = true;

                }
            });

            if (missingRequiredField) {
                event.preventDefault();
            } else
            {

                var mobile_number = $('#mobile-number').val();
                var phone_number = $('#phone-number').val();
                var email = $('#email').val();
                var last_name = $('#last_name').val();
                var first_name = $('#first_name').val();

                var formData = new Object();

                formData['newCustomer'] = {
                    'first_name': first_name,
                    'last_name': last_name,
                    'email': email,
                    'mobile_number': mobile_number,
                    'phone_number': phone_number,
                };

                var postData = {
                    'csrfToken': GlobalVariables.csrfToken,
                    'post_data': formData
                };

                var postUrl = GlobalVariables.baseUrl + 'index.php/home/save_new_info';



                $.post(postUrl, postData, function (response) {
                    ////////////////////////////////////////////////////////////
                    console.log(response);

                    if (response == GlobalVariables.AJAX_SUCCESS) {
                        $('#update-info').show();
                        GlobalVariables.customer.last_name = last_name;
                        GlobalVariables.customer.first_name = first_name;
                        GlobalVariables.customer.email = email;
                        GlobalVariables.customer.mobile_number = mobile_number;
                        GlobalVariables.customer.phone_number = phone_number;
                        $(".nom").html(last_name + "  " + first_name);
                        $(".mail").html(email);
                        $(".telephone").html(phone_number);

                        if (GlobalVariables.customer.mobile_number)
                        {
                            $(".label-mobile").show();
                            $(".mobile").show();
                            $('.ajout-tel').hide();
                            $(".mobile").html(mobile_number);



                        } else {
                            $(".label-mobile").hide();
                            $(".mobile").hide();
                            $('.ajout-tel').show();
                            $('.ajout-input-phone').removeClass('hidden');

                        }
                        $('.info').removeClass('hidden');
                        $('.edit-info').addClass('hidden');

                    } else {
                    }
                    ////////////////////////////////////////////////////////////
                    if (!GeneralFunctions.handleAjaxExceptions(response))
                        return;
                }, 'json');

            }


        });

        /*
         **
         **
         **
         */


        $('#save-new-mobile-number').click(function (event) {


            var mobile_number = $('#new-mobile-number').val();

            var formData = new Object();
            formData['newCustomer'] = {'mobile_number': mobile_number};
            var postData = {
                'csrfToken': GlobalVariables.csrfToken,
                'post_data': formData
            };

            var postUrl = GlobalVariables.baseUrl + 'index.php/home/save_new_phone';
            $.post(postUrl, postData, function (response) {
                ////////////////////////////////////////////////////////////
                console.log(response);

                if (response == GlobalVariables.AJAX_SUCCESS) {
                    $('#update-info').show();
                    GlobalVariables.customer.mobile_number = mobile_number;

                    if (GlobalVariables.customer.mobile_number)
                    {
                        $(".label-mobile").show();
                        $(".mobile").show();
                        $('.ajout-tel').hide();
                        $(".mobile").html(mobile_number);

                    } else {
                        $(".label-mobile").hide();
                        $(".mobile").hide();
                        $('.ajout-tel').show();
                        $('.ajout-input-phone').removeClass('hidden');
                    }
                    $('.new-phone').addClass('hidden');

                } else {
                }
                ////////////////////////////////////////////////////////////
                if (!GeneralFunctions.handleAjaxExceptions(response))
                    return;
            }, 'json');




        });





        /************************COORRDONNEE SECTION*****
         ****************************************************/

        $(document).on('click', '#canceal-update-new-address', function () {
            $('.ajout-input-address').removeClass('hidden');
            $('.ajout-new-address').addClass('hidden');
            $('#new-mobile-number').val('');
            $('#new-address2').val('');
            $('#new-city2').val('');
            $('#new-zip_code2').val('');
            $('#update-address').show();

        });
        $(document).on('click', '#canceal-update-address', function () {
            $('.edit-info-address').addClass('hidden');
            $('.info-address').removeClass('hidden');

            $('#update-address').show();

        });


        $(document).on('click', '.ajout-input-address', function () {
            $('.ajout-input-address').addClass('hidden');
            $('.ajout-new-address').removeClass('hidden');
            $('#new-address2').val('');
            $('#new-city2').val('');
            $('#new-zip_code2').val('');
            $('#update-address').hide();

        });

        /*
         **
         **
         */

        $(document).on('click', '#update-address', function () {

            $(".info-address").addClass('hidden');
            $(".edit-info-address").removeClass('hidden');


            $('#address').val(GlobalVariables.customer.address);
            $('#city').val(GlobalVariables.customer.city);
            $('#zip_code').val(GlobalVariables.customer.zip_code);


            if (!GlobalVariables.customer.address2 && !GlobalVariables.customer.city2 && !GlobalVariables.customer.zip_code2)

            {
                $(".address2").addClass('hidden');
            } else {
                $('#address2').val(GlobalVariables.customer.address2);
                $('#city2').val(GlobalVariables.customer.city2);
                $('#zip_code2').val(GlobalVariables.customer.zip_code2);
                $(".address2").removeClass('hidden');

            }





        });

        /*
         **
         **
         */



        $(document).on('click', '#save-update-address', function () {

            var address = $('#address').val();
            var city = $('#city').val();
            var zip_code = $('#zip_code').val();
            var address2 = $('#address2').val();
            var city2 = $('#city2').val();
            var zip_code2 = $('#zip_code2').val();



            var formData = new Object();



            formData['adresses'] = {
                'address': address,
                'city': city,
                'zip_code': zip_code,
                'address2': address2,
                'city2': city2,
                'zip_code2': zip_code2,
            };

            var postData = {
                'csrfToken': GlobalVariables.csrfToken,
                'post_data': formData
            };

            var postUrl = GlobalVariables.baseUrl + 'index.php/home/save_new_address';

            $.post(postUrl, postData, function (response) {
                ////////////////////////////////////////////////////////////
                console.log(response);



                if (response == GlobalVariables.AJAX_SUCCESS) {

                    $('#update-address').show();


                    GlobalVariables.customer.address = address;
                    GlobalVariables.customer.city = city;
                    GlobalVariables.customer.zip_code = zip_code;
                    GlobalVariables.customer.address2 = address2;
                    GlobalVariables.customer.city2 = city2;
                    GlobalVariables.customer.zip_code2 = zip_code2;

                    $(".address-principal").html(GlobalVariables.customer.address + "  " + GlobalVariables.customer.city + "  " + GlobalVariables.customer.zip_code);


                    if (GlobalVariables.customer.address2 && GlobalVariables.customer.city2 && GlobalVariables.customer.zip_code2)
                    {
                        $(".address-secondaire").show();
                        $('.label-address-secondaire').show();
                        $(".address-secondaire").html(GlobalVariables.customer.address2 + "  " + GlobalVariables.customer.city2 + "  " + GlobalVariables.customer.zip_code2);
                    } else {
                        $(".address-secondaire").hide();
                        $('.label-address-secondaire').hide();
                        $('.ajout-address').show();

                        $('.ajout-input-address').removeClass('hidden');
                        $('.ajout-new-address').addClass('hidden');

                    }
                    $('.info-address').removeClass('hidden');
                    $('.edit-info-address').addClass('hidden');


                }

                ////////////////////////////////////////////////////////////
                if (!GeneralFunctions.handleAjaxExceptions(response))
                    return;
            }, 'json');

        });

        /*
         **
         **
         */



        $(document).on('click', '#save-update-new-address', function () {


            var address2 = $('#new-address2').val();
            var city2 = $('#new-city2').val();
            var zip_code2 = $('#new-zip_code2').val();



            var formData = new Object();



            formData['adresses'] = {
                'address2': address2,
                'city2': city2,
                'zip_code2': zip_code2,
            };

            var postData = {
                'csrfToken': GlobalVariables.csrfToken,
                'post_data': formData
            };

            var postUrl = GlobalVariables.baseUrl + 'index.php/home/save_new_address_secondaire';

            $.post(postUrl, postData, function (response) {
                ////////////////////////////////////////////////////////////
                console.log(response);



                if (response == GlobalVariables.AJAX_SUCCESS) {


                    $('#update-address').show();


                    GlobalVariables.customer.address2 = address2;
                    GlobalVariables.customer.city2 = city2;
                    GlobalVariables.customer.zip_code2 = zip_code2;




                    if (GlobalVariables.customer.address2 && GlobalVariables.customer.city2 && GlobalVariables.customer.zip_code2)
                    {
                        $(".address-secondaire").show();
                        $('.label-address-secondaire').show();
                        $(".address-secondaire").html(GlobalVariables.customer.address2 + "  " + GlobalVariables.customer.city2 + "  " + GlobalVariables.customer.zip_code2);
                        $('.ajout-address').hide();
                    } else {
                        $(".address-secondaire").hide();
                        $('.label-address-secondaire').hide();
                        $('.ajout-address').show();

                        $('.ajout-input-address').removeClass('hidden');
                        $('.ajout-new-address').addClass('hidden');

                    }

                }


                ////////////////////////////////////////////////////////////
                if (!GeneralFunctions.handleAjaxExceptions(response))
                    return;
            }, 'json');

        });

        /**********************************************DP SECTION*
         ********************************************************************/


        $("#File").change(function () {



            $("#myform").submit();



        });








    }

};