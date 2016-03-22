<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
class Waiting extends CI_Controller {
    /**
     * Class Constructor
     */
	public function __construct() {
		parent::__construct();

		$this->load->library('session');
        //$this->load->helper('installation');

        // Set user's selected language.
		if ($this->session->userdata('language')) {
			$this->config->set_item('language', $this->session->userdata('language'));
			$this->lang->load('translations', $this->session->userdata('language'));
		} else {
			$this->lang->load('translations', $this->config->item('language')); // default
		}

		// Common helpers
		//$this->load->helper('google_analytics');
	}

   

    
	

   

    /**
     * [AJAX] Register the waiting demand to the database.
     *
     * @return string Returns a JSON string with the appointment database ID.
     */
    public function ajax_register_waiting() {
        try {
            $post_data = $_POST['post_data']; // alias

			$this->load->model('waiting_model');
            $this->load->model('providers_model');
            $this->load->model('services_model');
            $this->load->model('customers_model');           
            $waiting = $_POST['post_data'];           
            if ($this->customers_model->exists($customer)) {
                $customer['id'] = $this->customers_model->find_record_id($customer);
			}

            $customer_id = $this->customers_model->add($customer);
            //$waiting['id_users_customer'] = $customer_id;
            $waiting['id'] = $this->appointments_model->add($waiting);
            //$waiting['hash'] = $this->appointments_model->get_value('hash', $waiting['id']);

            //$provider = $this->providers_model->get_row($appointment['id_users_provider']);
            //$service = $this->services_model->get_row($appointment['id_services']);

            

            
			/**
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

				if ((bool)$send_customer === TRUE) {
					$this->notifications->send_appointment_details($appointment, $provider,
							$service, $customer,$company_settings, $customer_title,
							$customer_message, $customer_link, $customer['email']);
				}

                if ($send_provider == TRUE) {
                    $this->notifications->send_appointment_details($appointment, $provider,
                            $service, $customer, $company_settings, $provider_title,
                            $provider_message, $provider_link, $provider['email']);
                }
            } catch(Exception $exc) {
                log_message('error', $exc->getMessage());
                log_message('error', $exc->getTraceAsString());
            }
			**/
            echo json_encode(array(
                    'appointment_id' => $waiting['id']
                ));

        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }

	

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
    public function cancel($waiting_hash) {
        try {
			$this->load->model('waiting_model');
            $this->load->model('appointments_model');
            $this->load->model('providers_model');
            $this->load->model('customers_model');
            $this->load->model('services_model');
            $this->load->model('settings_model');

            // Check whether the appointment hash exists in the database.
            $records = $this->waiting_model->get_batch(array('hash' => $waiting_hash));
            if (count($records) == 0) {
                throw new Exception('No record matches the provided hash.');
            }

            $waiting = $records[0];
            $provider = $this->providers_model->get_row($waiting['id_users_provider']);
            $customer = $this->customers_model->get_row($waiting['id_users_customer']);
            $service = $this->services_model->get_row($waiting['id_services']);
			/**
            $company_settings = array(
                'company_name' => $this->settings_model->get_setting('company_name'),
                'company_email' => $this->settings_model->get_setting('company_email'),
                'company_link' => $this->settings_model->get_setting('company_link')
            );
			**/
            // :: DELETE APPOINTMENT RECORD FROM THE DATABASE.
            if (!$this->waiting_model->delete($waiting['id'])) {
                throw new Exception('Appointment could not be deleted from the database.');
            }

           
			/**
            // :: SEND NOTIFICATION EMAILS TO CUSTOMER AND PROVIDER
            try {
                $this->load->library('Notifications');

                $send_provider = $this->providers_model
                            ->get_setting('notifications', $provider['id']);

                if ($send_provider == TRUE) {
                    $this->notifications->send_delete_appointment($appointment, $provider,
                            $service, $customer, $company_settings, $provider['email'],
                            $_POST['cancel_reason']);
                }

				$send_customer = $this->settings_model->get_setting('customer_notifications');

				if ((bool)$send_customer === TRUE) {
					$this->notifications->send_delete_appointment($appointment, $provider,
							$service, $customer, $company_settings, $customer['email'],
							$_POST['cancel_reason']);
				}

            } catch(Exception $exc) {
                $exceptions[] = $exc;
            }
			**/
        } catch(Exception $exc) {
            // Display the error message to the customer.
            $exceptions[] = $exc;
        }

        
    }

	

	
}

/* End of file appointments.php */
/* Location: ./application/controllers/appointments.php */
