<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

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
 * Appointments Controller
 *
 * @package Controllers
 */
class home extends CI_Controller {

    /**
     * Class Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->lang->load('translations', $this->config->item('language')); // default
        $this->load->helper(array('form', 'url'));
        $this->no_cache();

        //require_once($this->config->item('base_url').'/assets/ext/twilio/Services/Twilio.php');
    }

    /**
     * Default callback method of the application.
     *
     * This method creates the appointment book wizard. If an appointment hash
     * is provided then it means that the customer followed the appointment
     * manage link that was send with the book success email.
     *
     * @param string $appointment_hash The db appointment hash of an existing record.
     */
    public function index() {

        $this->session->set_userdata('dest_url', $this->config->item('base_url') . '/index.php/home');
        //if (!$this->has_privileges(PRIV_HOME)) return;

        $this->load->model('appointments_model');
        $this->load->model('providers_model');
        $this->load->model('services_model');
        $this->load->model('customers_model');
        $this->load->model('settings_model');


        $view['base_url'] = $this->config->item('base_url');
        $view['user_id'] = $this->session->userdata('user_id');
        $view['company_name'] = $this->settings_model->get_setting('company_name');
        $view['date_format'] = $this->settings_model->get_setting('date_format');
        $view['available_services'] = $this->services_model->get_available_services();
        $view['role_slug'] = $this->session->userdata('role_slug');
        $view['customer_data'] = $this->customers_model->get_row($this->session->userdata('user_id'));



        $this->load->view('user/header', $view);
        $this->load->view('user/home', $view);
        $this->load->view('user/footer', $view);
    }

    public function profile() {

        $this->session->set_userdata('dest_url', $this->config->item('base_url') . '/index.php/home');
        if (!$this->has_privileges(PRIV_PROFILE))
            return;

        $this->load->model('appointments_model');
        $this->load->model('providers_model');
        $this->load->model('services_model');
        $this->load->model('customers_model');
        $this->load->model('settings_model');
        $this->load->model('user_model');

        $this->load->helper('general');


        $view['base_url'] = $this->config->item('base_url');
        $view['active_menu'] = PRIV_PROFILE;


        //$this->set_user_data($view);

        $user_id = $this->session->userdata('user_id');
        if ($user_id == TRUE) {
            $view['role_slug'] = $this->session->userdata('role_slug');
            $view['customer_data'] = $this->customers_model->get_row($this->session->userdata('user_id'));
            $view['user_id'] = $this->session->userdata('user_id');
        }

        $this->load->view('user/header', $view);
        $this->load->view('frontend/profile', $view);
        $this->load->view('user/footer', $view);
    }

    public function appointments($appointment_hash = '') {

        $this->session->set_userdata('dest_url', $this->config->item('base_url') . '/index.php/home');
        if (!$this->has_privileges(PRIV_APPOINTMENTS))
            return;

        $this->load->model('appointments_model');
        $this->load->model('providers_model');
        $this->load->model('services_model');
        $this->load->model('customers_model');
        $this->load->model('settings_model');


        $view['base_url'] = $this->config->item('base_url');
        $view['active_menu'] = PRIV_APPOINTMENTS;
        $view['user_id'] = $this->session->userdata('user_id');
        $view['company_name'] = $this->settings_model->get_setting('company_name');
        $view['date_format'] = $this->settings_model->get_setting('date_format');
        $view['available_services'] = $this->services_model->get_available_services();
        $view['customer_data'] = $this->customers_model->get_row($this->session->userdata('user_id'));
        $view['role_slug'] = $this->session->userdata('role_slug');

        $available_providers = $this->providers_model->get_available_providers();
        foreach ($available_providers as $index => $provider) {
            $stripped_data = array(
                'id' => $provider['id'],
                'first_name' => $provider['first_name'],
                'last_name' => $provider['last_name'],
                'services' => $provider['services']
            );
            $available_providers[$index] = $stripped_data;
        }
        $view['available_providers'] = $available_providers;


        // If an appointment hash is provided then it means that the customer
        // is trying to edit a registered appointment record.
        if ($appointment_hash !== '') {
            // Load the appointments data and enable the manage mode of the page.
            $manage_mode = TRUE;

            $results = $this->appointments_model->get_batch(array('hash' => $appointment_hash));

            if (count($results) === 0) {
                // The requested appointment doesn't exist in the database. Display
                // a message to the customer.
                $view = array(
                    'message_title' => $this->lang->line('appointment_not_found'),
                    'message_text' => $this->lang->line('appointment_does_not_exist_in_db'),
                    'message_icon' => $this->config->item('base_url')
                    . '/assets/img/error.png'
                );
                $this->load->view('appointments/message', $view);
                return;
            }

            $appointment = $results[0];
            $provider = $this->providers_model->get_row($appointment['id_users_provider']);
            $customer = $this->customers_model->get_row($appointment['id_users_customer']);
        } else {
            $manage_mode = FALSE;
            $appointment = array();
            $provider = array();
        }
        $view['manage_mode'] = $manage_mode;
        $view['appointment'] = $appointment;
        $view['provider'] = $provider;





        $appointments = $this->appointments_model
                ->get_batch(array('id_users_customer' => $this->session->userdata('user_id')));

        foreach ($appointments as &$appointment) {
            $appointment['service'] = $this->services_model
                    ->get_row($appointment['id_services']);
            $appointment['provider'] = $this->providers_model
                    ->get_row($appointment['id_users_provider']);
        }

        $view['appointments'] = $appointments;



        $this->load->view('frontend/appointments', $view);
    }

    public function waiting($appointment_hash = '') {

        $this->session->set_userdata('dest_url', $this->config->item('base_url') . '/index.php/home');
        if (!$this->has_privileges(PRIV_WAITING))
            return;

        $this->load->model('appointments_model');
        $this->load->model('providers_model');
        $this->load->model('services_model');
        $this->load->model('customers_model');
        $this->load->model('settings_model');
        $this->load->model('waiting_model');

        $view['base_url'] = $this->config->item('base_url');
        $view['active_menu'] = PRIV_WAITING;
        $view['user_id'] = $this->session->userdata('user_id');
        $view['company_name'] = $this->settings_model->get_setting('company_name');
        $view['date_format'] = $this->settings_model->get_setting('date_format');
        $view['available_services'] = $this->services_model->get_available_services();
        $view['customer_data'] = $this->customers_model->get_row($this->session->userdata('user_id'));
        $view['role_slug'] = $this->session->userdata('role_slug');

        $available_providers = $this->providers_model->get_available_providers();
        foreach ($available_providers as $index => $provider) {
            $stripped_data = array(
                'id' => $provider['id'],
                'first_name' => $provider['first_name'],
                'last_name' => $provider['last_name'],
                'services' => $provider['services']
            );
            $available_providers[$index] = $stripped_data;
        }
        $view['available_providers'] = $available_providers;


        // If an appointment hash is provided then it means that the customer
        // is trying to edit a registered appointment record.
        if ($appointment_hash !== '') {
            // Load the appointments data and enable the manage mode of the page.
            $manage_mode = TRUE;

            $results = $this->waiting_model->get_batch(array('hash' => $appointment_hash));

            if (count($results) === 0) {
                // The requested appointment doesn't exist in the database. Display
                // a message to the customer.
                $view = array(
                    'message_title' => $this->lang->line('appointment_not_found'),
                    'message_text' => $this->lang->line('appointment_does_not_exist_in_db'),
                    'message_icon' => $this->config->item('base_url')
                    . '/assets/img/error.png'
                );
                $this->load->view('waiting/message', $view);
                return;
            }

            $waiting = $results[0];
            $provider = $this->providers_model->get_row($waiting['id_users_provider']);
            $customer = $this->customers_model->get_row($waiting['id_users_customer']);
        } else {
            $manage_mode = FALSE;
            $waiting = array();
            $provider = array();
        }
        $view['manage_mode'] = $manage_mode;
        $view['waiting'] = $waiting;
        $view['provider'] = $provider;





        $waitings = $this->waiting_model
                ->get_batch(array('id_users_customer' => $this->session->userdata('user_id')));

        foreach ($waitings as &$waiting) {
            $waiting['service'] = $this->services_model
                    ->get_row($waiting['id_services']);
            $waiting['provider'] = $this->providers_model
                    ->get_row($waiting['id_users_provider']);
        }

        $view['waitings'] = $waitings;



        $this->load->view('frontend/waiting', $view);
    }

    public function save_new_password() {

        try {
            $this->load->model('customers_model');
            $this->load->model('settings_model');
            $this->load->model('user_model');
            $this->load->helper('general');

            $customer = $this->customers_model->get_row($this->session->userdata('user_id'));



            //  $post_data = $_POST['postData'];
            $passwords = $_POST['formData']['passwords'];



            $salt = $this->user_model->get_salt($this->session->userdata('user_email'));
            $old_password = hash_password($salt, $passwords['old_password']);


            if ($old_password != $customer['password']) {
                echo json_encode('errone');
            } else if (strlen($passwords['new_password']) < MIN_PASSWORD_LENGTH) {
                echo json_encode('vide');
            } else if ($old_password == $customer['password']) {
                $new_password = $passwords['new_password'];

                $customer['password'] = $new_password;
                $customer['id'] = $this->customers_model->updatee_password($customer);

                $this->load->library('notifications');
                $company_settings = array(
                    'company_name' => $this->settings_model->get_setting('company_name'),
                    'company_link' => $this->settings_model->get_setting('company_link'),
                    'company_email' => $this->settings_model->get_setting('company_email')
                );
                $this->notifications->send_password($customer['password'], $customer['email'], $company_settings);

                echo json_encode(AJAX_SUCCESS);
            }
        } catch (Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    public function save_new_info() {

        try {
            $this->load->model('customers_model');
            $this->load->model('settings_model');
            $this->load->model('user_model');
            $this->load->helper('general');

            $customer = $this->customers_model->get_row($this->session->userdata('user_id'));

            $post_data = $_POST['postData'];
            $newCustomer = $_POST['post_data']['newCustomer'];


            $customer['first_name'] = $newCustomer['first_name'];
            $customer['last_name'] = $newCustomer['last_name'];
            $customer['email'] = $newCustomer['email'];
            $customer['mobile_number'] = $newCustomer['mobile_number'];
            $customer['phone_number'] = $newCustomer['phone_number'];



            $customer['id'] = $this->customers_model->updatee($customer);



            echo json_encode(AJAX_SUCCESS);
        } catch (Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /*
     * *
     * *
     */

    public function save_new_phone() {

        try {
            $this->load->model('customers_model');
            $this->load->model('settings_model');
            $this->load->model('user_model');
            $this->load->helper('general');

            $customer = $this->customers_model->get_row($this->session->userdata('user_id'));

            $post_data = $_POST['postData'];
            $newCustomer = $_POST['post_data']['newCustomer'];
            $customer['mobile_number'] = $newCustomer['mobile_number'];

            $customer['id'] = $this->customers_model->updatee($customer);



            echo json_encode(AJAX_SUCCESS);
        } catch (Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    public function save_new_address() {

        try {
            $this->load->model('customers_model');
            $this->load->model('settings_model');
            $this->load->model('user_model');
            $this->load->helper('general');

            $customer = $this->customers_model->get_row($this->session->userdata('user_id'));

            $post_data = $_POST['postData'];
            $adresses = $_POST['post_data']['adresses'];


            $customer['address'] = $adresses['address'];
            $customer['city'] = $adresses['city'];
            $customer['zip_code'] = $adresses['zip_code'];
            $customer['address2'] = $adresses['address2'];
            $customer['city2'] = $adresses['city2'];
            $customer['zip_code2'] = $adresses['zip_code2'];

            $customer['id'] = $this->customers_model->updatee($customer);


            echo json_encode(AJAX_SUCCESS);
        } catch (Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    public function save_new_address_secondaire() {

        try {
            $this->load->model('customers_model');
            $this->load->model('settings_model');
            $this->load->model('user_model');
            $this->load->helper('general');

            $customer = $this->customers_model->get_row($this->session->userdata('user_id'));

            $post_data = $_POST['postData'];
            $adresses = $_POST['post_data']['adresses'];

            $customer['address2'] = $adresses['address2'];
            $customer['city2'] = $adresses['city2'];
            $customer['zip_code2'] = $adresses['zip_code2'];

            $customer['id'] = $this->customers_model->updatee($customer);


            echo json_encode(AJAX_SUCCESS);
        } catch (Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    function do_upload() {

        $this->load->model('customers_model');
        $this->load->model('settings_model');
        $this->load->model('user_model');
        $this->load->helper('general');

        $config['upload_path'] = './uploads/';

        if (is_file($config['upload_path'])) {
            chmod($config['upload_path'], 777); ## this should change the permissions
        }

        $config['allowed_types'] = 'jpg|png';


        $this->load->library('upload', $config);

        if (!$this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());


            $this->profile();
        } else {
            $data = $this->upload->data();

            $customer = $this->customers_model->get_row($this->session->userdata('user_id'));

            $customer['src_photo'] = $config['upload_path'] . $data['file_name'];
            $customer['id'] = $this->customers_model->updatee($customer);

            $this->profile();
        }
    }

    /*     * *******************************************

      BOOK SECTION
     * *********************************************** */

    /**
     * Cancel an existing appointment.
     *
     * This method removes an appointment from the company's schedule.
     * In order for the appointment to be deleted, the hash string must
     * be provided. The customer can only cancel the appointment if the
     * edit time period is not over yet.
     *
     * @param string $appointment_hash This is used to distinguish the
     * appointment record.
     * @param string $_POST['cancel_reason'] The text that describes why
     * the customer cancelled the appointment.
     */
    public function cancel($appointment_hash) {
        try {
            $this->load->model('appointments_model');
            $this->load->model('providers_model');
            $this->load->model('customers_model');
            $this->load->model('services_model');
            $this->load->model('settings_model');
            $this->load->model('notifications_model');


            // Check whether the appointment hash exists in the database.
            $records = $this->appointments_model->get_batch(array('hash' => $appointment_hash));
            if (count($records) == 0) {
                throw new Exception('No record matches the provided hash.');
            }

            $appointment = $records[0];
            $provider = $this->providers_model->get_row($appointment['id_users_provider']);
            $customer = $this->customers_model->get_row($appointment['id_users_customer']);
            $service = $this->services_model->get_row($appointment['id_services']);

            $company_settings = array(
                'company_name' => $this->settings_model->get_setting('company_name'),
                'company_email' => $this->settings_model->get_setting('company_email'),
                'company_link' => $this->settings_model->get_setting('company_link')
            );

            // :: DELETE APPOINTMENT RECORD FROM THE DATABASE.
            if (!$this->appointments_model->delete($appointment['id'])) {
                throw new Exception('Appointment could not be deleted from the database.');
            }
            // :: SEND SMS NOTIFICATION TO CUSTOMER AND PROVIDER

            if ($this->settings_model->get_setting('sms_notification') == '1') {
                $this->send_sms($customer['phone_number'], 'Votre rendez-vous a été annulé');
            }
            // :: add notification RECORD to DATABASE

            $notifications['message_action'] = 'le client ' . $customer['first_name'] . ' a supprimer un rendez-vous le ' . $appointment['book_datetime'] . ' pour le service ' . $service['name'];
            $notifications['type'] = 'rendez-vous supprimé';
            $notifications['id'] = $this->notifications_model->insert($notifications);

            // :: SYNC APPOINTMENT REMOVAL WITH GOOGLE CALENDAR
            if ($appointment['id_google_calendar'] != NULL) {
                try {
                    $google_sync = $this->providers_model->get_setting('google_sync', $appointment['id_users_provider']);

                    if ($google_sync == TRUE) {
                        $google_token = json_decode($this->providers_model
                                        ->get_setting('google_token', $provider['id']));
                        $this->load->library('Google_Sync');
                        $this->google_sync->refresh_token($google_token->refresh_token);
                        $this->google_sync->delete_appointment($provider, $appointment['id_google_calendar']);
                    }
                } catch (Exception $exc) {
                    $exceptions[] = $exc;
                }
            }


            // :: SEND NOTIFICATION EMAILS TO CUSTOMER AND PROVIDER
            try {
                $this->load->library('Notifications');

                $send_provider = $this->providers_model
                        ->get_setting('notifications', $provider['id']);

                if ($send_provider == TRUE) {
                    $this->notifications->send_delete_appointment($appointment, $provider, $service, $customer, $company_settings, $provider['email'], $_POST['cancel_reason']);
                }

                $send_customer = $this->settings_model->get_setting('customer_notifications');

                if ((bool) $send_customer === TRUE) {
                    $this->notifications->send_delete_appointment($appointment, $provider, $service, $customer, $company_settings, $customer['email'], $_POST['cancel_reason']);
                }
            } catch (Exception $exc) {
                $exceptions[] = $exc;
            }
        } catch (Exception $exc) {
            // Display the error message to the customer.
            $exceptions[] = $exc;
        }

        $view = array(
            'message_title' => $this->lang->line('appointment_cancelled_title'),
            'message_text' => $this->lang->line('appointment_cancelled'),
            'message_icon' => $this->config->item('base_url') . '/assets/img/success.png'
        );

        if (isset($exceptions)) {
            $view['exceptions'] = $exceptions;
        }
        echo json_encode("success");

        $this->load->view('appointments/message', $view);
    }

    /**
     * Calculate the avaialble appointment hours.
     *
     * Calculate the available appointment hours for the given date. The empty spaces
     * are broken down to 15 min and if the service fit in each quarter then a new
     * available hour is added to the "$available_hours" array.
     *
     * @param array $empty_periods Contains the empty periods as generated by the
     * "get_provider_available_time_periods" method.
     * @param string $selected_date The selected date to be search (format )
     * @param numeric $service_duration The service duration is required for the hour calculation.
     * @param bool $manage_mode (optional) Whether we are currently on manage mode (editing an existing appointment).
     *
     * @return array Returns an array with the available hours for the appointment.
     */
    private function calculate_available_hours(array $empty_periods, $selected_date, $service_duration, $manage_mode = FALSE) {
        $this->load->model('settings_model');

        $available_hours = array();

        foreach ($empty_periods as $period) {
            $start_hour = new DateTime($selected_date . ' ' . $period['start']);
            $end_hour = new DateTime($selected_date . ' ' . $period['end']);

            $minutes = $start_hour->format('i');

            if ($minutes % 15 != 0) {
                // Change the start hour of the current space in order to be
                // on of the following: 00, 15, 30, 45.
                if ($minutes < 15) {
                    $start_hour->setTime($start_hour->format('H'), 15);
                } else if ($minutes < 30) {
                    $start_hour->setTime($start_hour->format('H'), 30);
                } else if ($minutes < 45) {
                    $start_hour->setTime($start_hour->format('H'), 45);
                } else {
                    $start_hour->setTime($start_hour->format('H') + 1, 00);
                }
            }

            $current_hour = $start_hour;
            $diff = $current_hour->diff($end_hour);

            while (($diff->h * 60 + $diff->i) >= intval($service_duration)) {
                $available_hours[] = $current_hour->format('H:i');
                $current_hour->add(new DateInterval("PT15M"));
                $diff = $current_hour->diff($end_hour);
            }
        }

        // If the selected date is today, remove past hours. It is important  include the timeout before
        // booking that is set in the backoffice the system. Normally we might want the customer to book
        // an appointment that is at least half or one hour from now. The setting is stored in minutes.
        if (date('m/d/Y', strtotime($selected_date)) === date('m/d/Y')) {
            if ($manage_mode) {
                $book_advance_timeout = 0;
            } else {
                $book_advance_timeout = $this->settings_model->get_setting('book_advance_timeout');
            }

            foreach ($available_hours as $index => $value) {
                $available_hour = strtotime($value);
                $current_hour = strtotime('+' . $book_advance_timeout . ' minutes', strtotime('now'));
                if ($available_hour <= $current_hour) {
                    unset($available_hours[$index]);
                }
            }
        }

        $available_hours = array_values($available_hours);
        sort($available_hours, SORT_STRING);
        $available_hours = array_values($available_hours);

        return $available_hours;
    }

    /**
     * Search for any provider that can handle the requested service.
     *
     * This method will return the database ID of the provider with the most available periods.
     *
     * @param numeric $service_id The requested service ID.
     * @param string $selected_date The date to be searched.
     *
     * @return int Returns the ID of the provider that can provide the service at the selected date.
     */
    private function search_any_provider($service_id, $selected_date) {
        $this->load->model('providers_model');
        $this->load->model('services_model');
        $available_providers = $this->providers_model->get_available_providers();
        $service = $this->services_model->get_row($service_id);
        $provider_id = NULL;
        $max_hours_count = 0;

        foreach ($available_providers as $provider) {
            foreach ($provider['services'] as $provider_service_id) {
                if ($provider_service_id == $service_id) { // Check if the provider is available for the requested date.
                    $empty_periods = $this->get_provider_available_time_periods($provider['id'], $selected_date);
                    $available_hours = $this->calculate_available_hours($empty_periods, $selected_date, $service['duration']);
                    if (count($available_hours) > $max_hours_count) {
                        $provider_id = $provider['id'];
                        $max_hours_count = count($available_hours);
                    }
                }
            }
        }

        return $provider_id;
    }

    /**
     * Get an array containing the free time periods (start - end) of a selected date.
     *
     * This method is very important because there are many cases where the system needs to
     * know when a provider is avaible for an appointment. This method will return an array
     * that belongs to the selected date and contains values that have the start and the end
     * time of an available time period.
     *
     * @param numeric $provider_id The provider's record id.
     * @param string $selected_date The date to be checked (MySQL formatted string).
     * @param array $exclude_appointments This array contains the ids of the appointments that
     * will not be taken into consideration when the available time periods are calculated.
     *
     * @return array Returns an array with the available time periods of the provider.
     */
    private function get_provider_available_time_periods($provider_id, $selected_date, $exclude_appointments = array()) {
        $this->load->model('appointments_model');
        $this->load->model('providers_model');
        $this->load->model('settings_model');

        // Get the provider's working plan and reserved appointments.
        $working_plan = json_decode($this->providers_model->get_setting('working_plan', $provider_id), true);

        $where_clause = array(
            'id_users_provider' => $provider_id,
            'etat' => 'confirmé'
        );

        $reserved_appointments = $this->appointments_model->get_batch($where_clause);

        // Sometimes it might be necessary to not take into account some appointment records
        // in order to display what the providers' available time periods would be without them.
        foreach ($exclude_appointments as $excluded_id) {
            foreach ($reserved_appointments as $index => $reserved) {
                if ($reserved['id'] == $excluded_id) {
                    unset($reserved_appointments[$index]);
                }
            }
        }

        // Find the empty spaces on the plan. The first split between the plan is due to
        // a break (if exist). After that every reserved appointment is considered to be
        // a taken space in the plan.
        $selected_date_working_plan = $working_plan[strtolower(date('l', strtotime($selected_date)))];
        $available_periods_with_breaks = array();

        if (isset($selected_date_working_plan['breaks'])) {
            $start = new DateTime($selected_date_working_plan['start']);
            $end = new DateTime($selected_date_working_plan['end']);
            $available_periods_with_breaks[] = array(
                'start' => $selected_date_working_plan['start'],
                'end' => $selected_date_working_plan['end']
            );

            // Split the working plan to available time periods that do not contain the breaks in them.
            foreach ($selected_date_working_plan['breaks'] as $index => $break) {
                $break_start = new DateTime($break['start']);
                $break_end = new DateTime($break['end']);

                if ($break_start < $start) {
                    $break_start = $start;
                }

                if ($break_end > $end) {
                    $break_end = $end;
                }

                if ($break_start >= $break_end) {
                    continue;
                }

                foreach ($available_periods_with_breaks as $key => $open_period) {
                    $s = new DateTime($open_period['start']);
                    $e = new DateTime($open_period['end']);

                    if ($s < $break_end && $break_start < $e) { // check for overlap
                        $changed = FALSE;
                        if ($s < $break_start) {
                            $open_start = $s;
                            $open_end = $break_start;
                            $available_periods_with_breaks[] = array(
                                'start' => $open_start->format("H:i"),
                                'end' => $open_end->format("H:i")
                            );
                            $changed = TRUE;
                        }

                        if ($break_end < $e) {
                            $open_start = $break_end;
                            $open_end = $e;
                            $available_periods_with_breaks[] = array(
                                'start' => $open_start->format("H:i"),
                                'end' => $open_end->format("H:i")
                            );
                            $changed = TRUE;
                        }

                        if ($changed) {
                            unset($available_periods_with_breaks[$key]);
                        }
                    }
                }
            }
        }

        // Break the empty periods with the reserved appointments.
        $available_periods_with_appointments = $available_periods_with_breaks;

        $service_double = $this->settings_model->get_setting('enable_double');


        if ($service_double == '0') {
            foreach ($reserved_appointments as $appointment) {
                foreach ($available_periods_with_appointments as $index => &$period) {
                    $a_start = strtotime($appointment['start_datetime']);
                    $a_end = strtotime($appointment['end_datetime']);
                    $p_start = strtotime($selected_date . ' ' . $period['start']);
                    $p_end = strtotime($selected_date . ' ' . $period['end']);

                    if ($a_start <= $p_start && $a_end <= $p_end && $a_end <= $p_start) {
                        // The appointment does not belong in this time period, so we
                        // will not change anything.
                    } else if ($a_start <= $p_start && $a_end <= $p_end && $a_end >= $p_start) {
                        // The appointment starts before the period and finishes somewhere inside.
                        // We will need to break this period and leave the available part.
                        $period['start'] = date('H:i', $a_end);
                    } else if ($a_start >= $p_start && $a_end <= $p_end) {
                        // The appointment is inside the time period, so we will split the period
                        // into two new others.
                        unset($available_periods_with_appointments[$index]);
                        $available_periods_with_appointments[] = array(
                            'start' => date('H:i', $p_start),
                            'end' => date('H:i', $a_start)
                        );
                        $available_periods_with_appointments[] = array(
                            'start' => date('H:i', $a_end),
                            'end' => date('H:i', $p_end)
                        );
                    } else if ($a_start >= $p_start && $a_end >= $p_start && $a_start <= $p_end) {
                        // The appointment starts in the period and finishes out of it. We will
                        // need to remove the time that is taken from the appointment.
                        $period['end'] = date('H:i', $a_start);
                    } else if ($a_start >= $p_start && $a_end >= $p_end && $a_start >= $p_end) {
                        // The appointment does not belong in the period so do not change anything.
                    } else if ($a_start <= $p_start && $a_end >= $p_end && $a_start <= $p_end) {
                        // The appointment is bigger than the period, so this period needs to be removed.
                        unset($available_periods_with_appointments[$index]);
                    }
                }
            }
        } else {

            foreach ($reserved_appointments as $appointment) {
                $number_services = $this->appointments_model->validate_time_slot($appointment);
                $service_setting = $this->settings_model->get_setting('company_service');
                if ($number_services > $service_setting) {
                    foreach ($available_periods_with_appointments as $index => &$period) {
                        $a_start = strtotime($appointment['start_datetime']);
                        $a_end = strtotime($appointment['end_datetime']);
                        $p_start = strtotime($selected_date . ' ' . $period['start']);
                        $p_end = strtotime($selected_date . ' ' . $period['end']);

                        if ($a_start <= $p_start && $a_end <= $p_end && $a_end <= $p_start) {
                            // The appointment does not belong in this time period, so we
                            // will not change anything.
                        } else if ($a_start <= $p_start && $a_end <= $p_end && $a_end >= $p_start) {
                            // The appointment starts before the period and finishes somewhere inside.
                            // We will need to break this period and leave the available part.
                            $period['start'] = date('H:i', $a_end);
                        } else if ($a_start >= $p_start && $a_end <= $p_end) {
                            // The appointment is inside the time period, so we will split the period
                            // into two new others.
                            unset($available_periods_with_appointments[$index]);
                            $available_periods_with_appointments[] = array(
                                'start' => date('H:i', $p_start),
                                'end' => date('H:i', $a_start)
                            );
                            $available_periods_with_appointments[] = array(
                                'start' => date('H:i', $a_end),
                                'end' => date('H:i', $p_end)
                            );
                        } else if ($a_start >= $p_start && $a_end >= $p_start && $a_start <= $p_end) {
                            // The appointment starts in the period and finishes out of it. We will
                            // need to remove the time that is taken from the appointment.
                            $period['end'] = date('H:i', $a_start);
                        } else if ($a_start >= $p_start && $a_end >= $p_end && $a_start >= $p_end) {
                            // The appointment does not belong in the period so do not change anything.
                        } else if ($a_start <= $p_start && $a_end >= $p_end && $a_start <= $p_end) {
                            // The appointment is bigger than the period, so this period needs to be removed.
                            unset($available_periods_with_appointments[$index]);
                        }
                    }
                }
            }
        }

        return array_values($available_periods_with_appointments);
    }

    /**
     * Check whether the provider is still available in the selected appointment date.
     *
     * It might be times where two or more customers select the same appointment date and time.
     * This shouldn't be allowed to happen, so one of the two customers will eventually get the
     * prefered date and the other one will have to choose for another date. Use this method
     * just before the customer confirms the appointment details. If the selected date was taken
     * in the mean time, the customer must be prompted to select another time for his appointment.
     *
     * @return bool Returns whether the selected datetime is still available.
     */
    private function check_datetime_availability() {
        $this->load->model('services_model');

        $appointment = $_POST['post_data']['appointment'];

        $service_duration = $this->services_model->get_value('duration', $appointment['id_services']);

        $exclude_appointments = (isset($appointment['id'])) ? array($appointment['id']) : array();

        if ($appointment['id_users_provider'] === ANY_PROVIDER) {
            $appointment['id_users_provider'] = $this->search_any_provider($appointment['id_services'], date('Y-m-d', strtotime($appointment['start_datetime'])));
            $_POST['post_data']['appointment']['id_users_provider'] = $appointment['id_users_provider'];
            return TRUE; // The selected provider is always available.
        }

        $available_periods = $this->get_provider_available_time_periods(
                $appointment['id_users_provider'], date('Y-m-d', strtotime($appointment['start_datetime'])), $exclude_appointments);

        $is_still_available = FALSE;

        foreach ($available_periods as $period) {
            $appt_start = new DateTime($appointment['start_datetime']);
            $appt_start = $appt_start->format('H:i');

            $appt_end = new DateTime($appointment['start_datetime']);
            $appt_end->add(new DateInterval('PT' . $service_duration . 'M'));
            $appt_end = $appt_end->format('H:i');

            $period_start = date('H:i', strtotime($period['start']));
            $period_end = date('H:i', strtotime($period['end']));

            if ($period_start <= $appt_start && $period_end >= $appt_end) {
                $is_still_available = TRUE;
                break;
            }
        }

        return $is_still_available;
    }

    /**
     * GET an specific appointment book and redirect to the success screen.
     *
     * @param int $appointment_id Contains the id of the appointment to retrieve.
     */
    public function book_success($appointment_id) {
        //if the appointment id doesn't exist or zero redirect to index
        if (!$appointment_id) {
            redirect('appointments');
        }
        $this->load->model('appointments_model');
        $this->load->model('providers_model');
        $this->load->model('services_model');
        $this->load->model('settings_model');
        //retrieve the data needed in the view
        $appointment = $this->appointments_model->get_row($appointment_id);
        $provider = $this->providers_model->get_row($appointment['id_users_provider']);
        $service = $this->services_model->get_row($appointment['id_services']);
        $company_name = $this->settings_model->get_setting('company_name');
        //get the exceptions
        $exceptions = $this->session->flashdata('book_success');
        // :: LOAD THE BOOK SUCCESS VIEW
        $view = array(
            'appointment_data' => $appointment,
            'provider_data' => $provider,
            'service_data' => $service,
            'company_name' => $company_name,
        );
        if ($exceptions) {
            $view['exceptions'] = $exceptions;
        }
        $this->load->view('appointments/book_success', $view);
    }

    /**
     * [AJAX] Get the available appointment hours for the given date.
     *
     * This method answers to an AJAX request. It calculates the available hours
     * for thegiven service, provider and date.
     *
     * @param numeric $_POST['service_id'] The selected service's record id.
     * @param numeric|string $_POST['provider_id'] The selected provider's record id, can also be 'any-provider'.
     * @param string $_POST['selected_date'] The selected date of which the available hours we want to see.
     * @param numeric $_POST['service_duration'] The selected service duration in minutes.
     * @param string $_POST['manage_mode'] Contains either 'true' or 'false' and determines the if current user
     * is managing an already booked appointment or not.
     * @return Returns a json object with the available hours.
     */
    public function ajax_get_available_hours() {
        $this->load->model('providers_model');
        $this->load->model('appointments_model');
        $this->load->model('settings_model');

        try {
            // Do not continue if there was no provider selected (more likely there is no provider in the system).
            if (empty($_POST['provider_id'])) {
                echo json_encode(array());
                return;
            }

            // If manage mode is TRUE then the following we should not consider the selected
            // appointment when calculating the available time periods of the provider.
            $exclude_appointments = ($_POST['manage_mode'] === 'true') ? array($_POST['appointment_id']) : array();

            // If the user has selected the "any-provider" option then we will need to search
            // for an available provider that will provide the requested service.
            if ($_POST['provider_id'] === ANY_PROVIDER) {
                $_POST['provider_id'] = $this->search_any_provider($_POST['service_id'], $_POST['selected_date']);
                if ($_POST['provider_id'] === NULL) {
                    echo json_encode(array());
                    return;
                }
            }

            $empty_periods = $this->get_provider_available_time_periods($_POST['provider_id'], $_POST['selected_date'], $exclude_appointments);

            $available_hours = $this->calculate_available_hours($empty_periods, $_POST['selected_date'], $_POST['service_duration'], (bool) $_POST['manage_mode']);

            echo json_encode($available_hours);
        } catch (Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Register the appointment to the database.
     *
     * @return string Returns a JSON string with the appointment database ID.
     */
    public function ajax_register_appointment() {
        try {
            $post_data = $_POST['post_data']; // alias

            $this->load->model('appointments_model');
            $this->load->model('providers_model');
            $this->load->model('services_model');
            $this->load->model('customers_model');
            $this->load->model('settings_model');
            $this->load->model('notifications_model');

            // Validate the CAPTCHA string.
            if ($this->settings_model->get_setting('require_captcha') === '1' && $this->session->userdata('captcha_phrase') !== $_POST['captcha']) {
                echo json_encode(array(
                    'captcha_verification' => FALSE,
                    'expected_phrase' => $this->session->userdata('captcha_phrase')
                ));
                return;
            }

            // Check appointment availability.
            if (!$this->check_datetime_availability()) {
                throw new Exception($this->lang->line('requested_hour_is_unavailable'));
            }

            $appointment = $_POST['post_data']['appointment'];
            $customer = $this->customers_model->get_row($this->session->userdata('user_id'));



            $customer_id = $customer['id'];
            $appointment['id_users_customer'] = $customer_id;
            $appointment['is_unavailable'] = (int) $appointment['is_unavailable']; // needs to be type casted
            if ($this->settings_model->get_setting('confirm_appointment') == '0') {
                $appointment['etat'] = 'en attente';
            } else {
                $appointment['etat'] = 'confirmé';
            }

            $appointment['id'] = $this->appointments_model->add($appointment);
            $appointment['hash'] = $this->appointments_model->get_value('hash', $appointment['id']);

            $provider = $this->providers_model->get_row($appointment['id_users_provider']);
            $service = $this->services_model->get_row($appointment['id_services']);

            $company_settings = array(
                'company_name' => $this->settings_model->get_setting('company_name'),
                'company_link' => $this->settings_model->get_setting('company_link'),
                'company_email' => $this->settings_model->get_setting('company_email')
            );


            // :: add notification RECORD to DATABASE

            $appointment['book_datetime'] = $this->appointments_model->get_value('book_datetime', $appointment['id']);

            if (!$post_data['manage_mode']) {
                $notifications['message_action'] = 'le client ' . $customer['first_name'] . ' a ajouté un rendez-vous le ' . $appointment['book_datetime'] . ' pour le service ' . $service['name'];
                $notifications['type'] = 'nouveau rendez-vous';
            } else {
                $notifications['message_action'] = 'le client ' . $customer['first_name'] . ' a modifié un rendez-vous le ' . $appointment['book_datetime'] . ' pour le service ' . $service['name'];
                $notifications['type'] = 'rendez-vous modifié';
            }
            $notifications['id'] = $this->notifications_model->insert($notifications);

            // :: SYNCHRONIZE APPOINTMENT WITH PROVIDER'S GOOGLE CALENDAR
            // The provider must have previously granted access to his google calendar account
            // in order to sync the appointment.
            try {
                $google_sync = $this->providers_model->get_setting('google_sync', $appointment['id_users_provider']);

                if ($google_sync == TRUE) {
                    $google_token = json_decode($this->providers_model
                                    ->get_setting('google_token', $appointment['id_users_provider']));

                    $this->load->library('google_sync');
                    $this->google_sync->refresh_token($google_token->refresh_token);

                    if ($post_data['manage_mode'] === FALSE) {
                        // Add appointment to Google Calendar.
                        $google_event = $this->google_sync->add_appointment($appointment, $provider, $service, $customer, $company_settings);
                        $appointment['id_google_calendar'] = $google_event->id;
                        $this->appointments_model->add($appointment);
                    } else {
                        // Update appointment to Google Calendar.
                        $appointment['id_google_calendar'] = $this->appointments_model
                                ->get_value('id_google_calendar', $appointment['id']);

                        $this->google_sync->update_appointment($appointment, $provider, $service, $customer, $company_settings);
                    }
                }
            } catch (Exception $exc) {
                log_message('error', $exc->getMessage());
                log_message('error', $exc->getTraceAsString());
            }
            // :: SEND SMS NOTIFICATION TO BOTH CUSTOMER AND PROVIDER
            //$this->load->library('Smsapi');
            //$this->Smsapi->send_sms('+21653534003','hello');
            /**
              $account_sid = 'AC6d404c29766c9fb0a78ef68e3c44a943';
              $auth_token = 'e808b72821d3577d36b5c7727035b02e';

              $http = new Services_Twilio_TinyHttp(
              'https://api.twilio.com', array('curlopts' => array(
              CURLOPT_SSL_VERIFYPEER => true,
              CURLOPT_SSL_VERIFYHOST => 2,
              ))
              );

              $ali = new Services_Twilio($account_sid, $auth_token, "2010-04-01", $http);

              $ali->account->messages->create(array(
              'To' => '+21653534003',
              'From' => '+12013836183',
              'Body' => 'le client ' . $customer['first_name'] . ' a ajouté un rendez-vous le ' . $appointment['book_datetime'] . ' pour le service ' . $service['name'],
              ));
             * */
            if ($this->settings_model->get_setting('sms_notification') == '1') {

                if ($appointment['etat'] === 'confirmé') {
                    if (!$post_data['manage_mode']) {
                        $this->send_sms($customer['phone_number'], 'Votre demande de rendez-vous a été confirmée');
                    } else {
                        $this->send_sms($customer['phone_number'], 'Votre rendez-vous a été modifiée');
                    }
                } else {
                    if (!$post_data['manage_mode']) {
                        $this->send_sms($customer['phone_number'], 'Votre demande de rendez-vous a été envoyé, veuillez attendre la confirmation');
                    } else {
                        $this->send_sms($customer['phone_number'], 'Votre rendez-vous a été modifiée, veuillez attendre la confirmation');
                    }
                }
            }


            // :: SEND NOTIFICATION EMAILS TO BOTH CUSTOMER AND PROVIDER
            try {
                $this->load->library('Notifications');

                $send_provider = $this->providers_model
                        ->get_setting('notifications', $provider['id']);

                if (!$post_data['manage_mode']) {
                    $customer_title = $this->lang->line('appointment_booked');
                    $customer_message = $this->lang->line('thank_you_for_appointment');
                    $customer_link = $this->config->item('base_url') . '/index.php/appointments/index/'
                            . $appointment['hash'];

                    $provider_title = $this->lang->line('appointment_added_to_your_plan');
                    $provider_message = $this->lang->line('appointment_link_description');
                    $provider_link = $this->config->item('base_url') . '/index.php/backend/index/'
                            . $appointment['hash'];
                } else {
                    $customer_title = $this->lang->line('appointment_changes_saved');
                    $customer_message = '';
                    $customer_link = $this->config->item('base_url') . '/index.php/appointments/index/'
                            . $appointment['hash'];

                    $provider_title = $this->lang->line('appointment_details_changed');
                    $provider_message = '';
                    $provider_link = $this->config->item('base_url') . '/index.php/backend/index/'
                            . $appointment['hash'];
                }

                $send_customer = $this->settings_model->get_setting('customer_notifications');

                if ((bool) $send_customer === TRUE) {


                    if ($appointment['etat'] === 'en attente') {
                        $customer_title = 'Demande de rendez-vous envoyé';
                        $customer_message = 'Votre demande de rendez-vous a été envoyé, veuillez attendre la confirmation. Trouvez ci-joint les détails de votre demande';
                        $this->notifications->send_waiting_details($appointment, $provider, $service, $customer, $company_settings, $customer_title, $customer_message, $customer_link, $customer['email']);
                    } else {
                        $this->notifications->send_appointment_details($appointment, $provider, $service, $customer, $company_settings, $customer_title, $customer_message, $customer_link, $customer['email']);
                    }
                }

                if ($send_provider == TRUE) {
                    if ($appointment['etat'] === 'en attente') {
                        $provider_title = $this->lang->line('appointment_sent_to_you');
                        $provider_message = $this->lang->line('appointment_waiting');
                        $this->notifications->send_waiting_details($appointment, $provider, $service, $customer, $company_settings, $provider_title, $provider_message, $provider_link, $provider['email']);
                    } else {
                        $this->notifications->send_appointment_details($appointment, $provider, $service, $customer, $company_settings, $provider_title, $provider_message, $provider_link, $provider['email']);
                    }
                }
            } catch (Exception $exc) {
                log_message('error', $exc->getMessage());
                log_message('error', $exc->getTraceAsString());
            }

            echo json_encode(array(
                'appointment_id' => $appointment['id']
            ));
        } catch (Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * [AJAX] Register the waiting demand to the database.
     *
     * @return string Returns a JSON string with the appointment database ID.
     */
    public function ajax_register_waiting() {
        try {
            $post_data = json_decode($_POST['formData'], true); // alias

            $this->load->model('appointments_model');
            $this->load->model('waiting_model');
            $this->load->model('providers_model');
            $this->load->model('services_model');
            $this->load->model('customers_model');
            $this->load->model('settings_model');
            $this->load->model('notifications_model');

            $waiting = json_decode($_POST['formData'], true);


            if ($waiting['id_users_provider'] === ANY_PROVIDER) {
                $waiting['id_users_provider'] = $this->search_any_provider($waiting['id_services'], date('Y-m-d', strtotime($waiting['start_datetime'])));
                //$_POST['postData']['formData']['id_users_provider'] = $waiting['id_users_provider'];
                //return TRUE; // The selected provider is always available.
            }


            /**
              if ($this->customers_model->exists($customer)) {
              $customer['id'] = $this->customers_model->find_record_id($customer);
              }
             * */
            //$customer_id = $this->customers_model->add($customer);
            //$waiting['id_users_customer'] = $customer_id;
            $waiting['id'] = $this->waiting_model->add($waiting);
            //$waiting['hash'] = $this->appointments_model->get_value('hash', $waiting['id']);
            $customer = $this->customers_model->get_row($this->session->userdata('user_id'));
            $provider = $this->providers_model->get_row($waiting['id_users_provider']);
            $service = $this->services_model->get_row($waiting['id_services']);

            $company_settings = array(
                'company_name' => $this->settings_model->get_setting('company_name'),
                'company_link' => $this->settings_model->get_setting('company_link'),
                'company_email' => $this->settings_model->get_setting('company_email')
            );

            // :: add notification RECORD to DATABASE

            $waiting['book_datetime'] = $this->waiting_model->get_value('book_datetime', $waiting['id']);
            $notifications['message_action'] = 'le client ' . $customer['first_name'] . ' a demandé un rendez-vous le ' . $waiting['book_datetime'] . ' pour le service ' . $service['name'];
            $notifications['type'] = 'nouveau demande liste d attente';

            $notifications['id'] = $this->notifications_model->insert($notifications);


            if ($this->settings_model->get_setting('sms_notification') == '1') {
                $this->send_sms($customer['phone_number'], 'Votre demande de liste d attente a été envoyer');
            }
            // :: SEND NOTIFICATION EMAILS TO BOTH CUSTOMER AND PROVIDER
            try {
                $this->load->library('Notifications');

                $send_provider = $this->providers_model
                        ->get_setting('notifications', $provider['id']);
                $reason = 'hello';

                $customer_title = 'Nouvelle demande au liste d attente';
                $customer_message = 'Merci de votre demande.Trouvez ci-joint les détails de votre demande. une reponse va étre transmite bientot.';
                $customer_link = $this->config->item('base_url') . '/index.php/appointments/index/'
                        . $appointment['hash'];

                $provider_title = 'Une nouvelle demande liste d attente a été envoyé ';
                $provider_message = $this->lang->line('appointment_link_description');
                $provider_link = $this->config->item('base_url') . '/index.php/backend/index/'
                        . $appointment['hash'];

                if ($send_provider == TRUE) {
                    $this->notifications->send_waiting_details($appointment, $provider, $service, $customer, $company_settings, $customer_title, $customer_message, $customer_link, $provider['email']);
                }

                $send_customer = $this->settings_model->get_setting('customer_notifications');

                if ((bool) $send_customer === TRUE) {
                    $this->notifications->send_waiting_details($appointment, $provider, $service, $customer, $company_settings, $customer_title, $customer_message, $customer_link, $customer['email']);
                }
            } catch (Exception $exc) {
                $exceptions[] = $exc;
            }

            echo json_encode(array(
                'waiting_id' => $waiting['id'],
                'customer' => $customer['email']
            ));
        } catch (Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

    /**
     * Check whether current user is logged in and has the required privileges to
     * view a page.
     *
     * The backend page requires different privileges from the users to display pages. Not all
     * pages are avaiable to all users. For example secretaries should not be able to edit the
     * system users.
     *
     * @see Constant Definition In application/config/constants.php
     *
     * @param string $page This argument must match the roles field names of each section
     * (eg "appointments", "users" ...).
     * @param bool $redirect (OPTIONAL - TRUE) If the user has not the required privileges
     * (either not logged in or insufficient role privileges) then the user will be redirected
     * to another page. Set this argument to FALSE when using ajax.
     *
     * @return bool Returns whether the user has the required privileges to view the page or
     * not. If the user is not logged in then he will be prompted to log in. If he hasn't the
     * required privileges then an info message will be displayed.
     */
    private function has_privileges($page, $redirect = TRUE) {
        // Check if user is logged in.
        $user_id = $this->session->userdata('user_id');
        if ($user_id == FALSE) { // User not logged in, display the login view.
            if ($redirect) {
                header('Location: ' . $this->config->item('base_url'));
            }
            return FALSE;
        }
        // Check if the user has the required privileges for viewing the selected page.
        $role_slug = $this->session->userdata('role_slug');
        //$role_priv = $this->db->get_where('ea_roles', array('slug' => $role_slug))->row_array();
        if ($role_slug !== 'customer') { // User does not have the permission to view the page.
            if ($redirect) {
                header('Location: ' . $this->config->item('base_url') . 'index.php/user/no_privileges');
            }
            return FALSE;
        }


        return TRUE;
    }

    public function send_sms($number, $msg) {
        $account_sid = 'AC6d404c29766c9fb0a78ef68e3c44a943';
        $auth_token = 'e808b72821d3577d36b5c7727035b02e';

        $http = new Services_Twilio_TinyHttp(
                'https://api.twilio.com', array('curlopts' => array(
                CURLOPT_SSL_VERIFYPEER => true,
                CURLOPT_SSL_VERIFYHOST => 2,
            ))
        );

        $client = new Services_Twilio($account_sid, $auth_token, "2010-04-01", $http);

        $client->account->messages->create(array(
            'To' => $number,
            'From' => '+12013836183',
            'Body' => $msg,
        ));

        //$client->account->messages->sendMessage('+12013836183',$number,$msg);
    }

    protected function no_cache() {
        header('Cache-Control: no-store, no-cache, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0', false);
        header('Pragma: no-cache');
    }

}

/* End of file appointments.php */
/* Location: ./application/controllers/appointments.php */
