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
 * Appointments Model
 *
 * @package Models
 */
class Waiting_Model extends CI_Model {
    /**
     * Class Constructor
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Add an waiting_appointment record to the database.
     *
     * This method adds a new waiting_appointment to the database. If the 
     * waiting_appointment doesn't exists it is going to be inserted, otherwise
     * the record is going to be updated.
     *
     * @param array $waiting_appointment Associative array with the waiting_appointment
     * data. Each key has the same name with the database fields.
     * @return int Returns the appointments id.
     */
    public function add($waiting_appointment) {
        // Validate the waiting_appointment data before doing anything.
        $this->validate($waiting_appointment);

        // Perform insert() or update() operation.
        if (!isset($waiting_appointment['id'])) {
            $waiting_appointment['id'] = $this->insert($waiting_appointment);
        } else {
            $this->update($waiting_appointment);
        }

        return $waiting_appointment['id'];
    }

    /**
     * Check if a particular waiting_appointment record already exists.
     *
     * This method checks wether the given waiting_appointment already exists
     * in the database. It doesn't search with the id, but by using the
     * following fields: "start_datetime", "end_datetime", "id_users_provider",
     * "id_users_customer", "id_services".
     *
     * @param array $waiting_appointment Associative array with the waiting_appointment's
     * data. Each key has the same name with the database fields.
     * @return bool Returns wether the record exists or not.
     */
    public function exists($waiting_appointment) {
        if (!isset($waiting_appointment['start_datetime'])
                || !isset($waiting_appointment['end_datetime'])
                || !isset($waiting_appointment['id_users_provider'])
                || !isset($waiting_appointment['id_users_customer'])
                || !isset($waiting_appointment['id_services'])) {
            throw new Exception('Not all waiting_appointment field values '
                    . 'are provided : ' . print_r($waiting_appointment, TRUE));
        }

        $num_rows = $this->db->get_where('ea_waiting', array(
                'start_datetime'    => $waiting_appointment['start_datetime'],
                'end_datetime'      => $waiting_appointment['end_datetime'],
                'id_users_provider' => $waiting_appointment['id_users_provider'],
                'id_users_customer' => $waiting_appointment['id_users_customer'],
                'id_services'       => $waiting_appointment['id_services'],))
                ->num_rows();

        return ($num_rows > 0) ? TRUE : FALSE;
    }

    /**
     * Insert a new waiting_appointment record to the database.
     *
     * @param array $waiting_appointment Associative array with the waiting_appointment's
     * data. Each key has the same name with the database fields.
     * @return int Returns the id of the new record.
     */
    private function insert($waiting_appointment) {
        $waiting_appointment['book_datetime'] = date('Y-m-d H:i:s');
        $waiting_appointment['hash'] = $this->generate_hash();
		
		/**
		$notification['message']='Le client a demandé un rendez vous dans cette date: '.$waiting_appointment['start_datetime'].'';
		$notification['date']=$waiting_appointment['book_datetime'];
		
		if (!$this->db->insert('ea_notifications', $notification)) {
            throw new Exception('Could not insert notification record.');
        }
		**/
		
        if (!$this->db->insert('ea_waiting', $waiting_appointment)) {
            throw new Exception('Could not insert waiting_appointment record.');
        }

        return intval($this->db->insert_id());
    }

    /**
     * Update an existing waiting_appointment record in the database.
     *
     * The waiting_appointment data argument should already include the record
     * id in order to process the update operation.
     *
     * @expectedException DatabaseException Raises when the update operation
     * failes to complete successfully.
     *
     * @param array $waiting_appointment Associative array with the waiting_appointment's
     * data. Each key has the same name with the database fields.
     */
    private function update($waiting_appointment) {
        $this->db->where('id', $waiting_appointment['id']);
        if (!$this->db->update('ea_waiting', $waiting_appointment)) {
            throw new Exception('Could not update waiting_appointment record.');
        }
    }
	
	
	/**
     * Update an existing waiting_appointment record in the database.
     *
     * The waiting_appointment data argument should already include the record
     * id in order to process the update operation.
     *
     * @expectedException DatabaseException Raises when the update operation
     * failes to complete successfully.
     *
     * @param array $waiting_appointment Associative array with the waiting_appointment's
     * data. Each key has the same name with the database fields.
     */
    public function bloqued($waiting_appointment) {
        $this->db->where('id', $waiting_appointment['id']);
		$waiting_appointment['etat']='bloqued';
        if (!$this->db->update('ea_waiting', $waiting_appointment)) {
            throw new Exception('Could not update waiting_appointment record.');
        }
    }

    /**
     * Find the database id of an waiting_appointment record.
     *
     * The waiting_appointment data should include the following fields in order
     * to get the unique id from the database: "start_datetime", "end_datetime",
     * "id_users_provider", "id_users_customer", "id_services".
     *
     * <strong>IMPORTANT!</strong> The record must already exists in the
     * database, otherwise an exception is raised.
     *
     * @param array $waiting_appointment Array with the waiting_appointment data. The
     * keys of the array should have the same names as the db fields.
     * @return int Returns the db id of the record that matches the apppointment
     * data.
     */
    public function find_record_id($waiting_appointment) {
        $this->db->where(array(
            'start_datetime'    => $waiting_appointment['start_datetime'],
            'end_datetime'      => $waiting_appointment['end_datetime'],
            'id_users_provider' => $waiting_appointment['id_users_provider'],
            'id_users_customer' => $waiting_appointment['id_users_customer'],
            'id_services'       => $waiting_appointment['id_services']
        ));

        $result = $this->db->get('ea_waiting');

        if ($result->num_rows() == 0) {
            throw new Exception('Could not find waiting_appointment record id.');
        }

        return $result->row()->id;
    }

    /**
     * Validate waiting_appointment data before the insert or update operations
     * are executed.
     *
     * @param array $waiting_appointment Contains the waiting_appointment data.
     * @return bool Returns the validation result.
     */
    public function validate($waiting_appointment) {
        $this->load->helper('data_validation');

        // If a waiting_appointment id is given, check wether the record exists
        // in the database.
        if (isset($waiting_appointment['id'])) {
            $num_rows = $this->db->get_where('ea_waiting',
                    array('id' => $waiting_appointment['id']))->num_rows();
            if ($num_rows == 0) {
                throw new Exception('Provided waiting_appointment id does not '
                        . 'exist in the database.');
            }
        }

        // Check if waiting_appointment dates are valid.
        
		if (!validate_mysql_datetime($waiting_appointment['start_datetime'])) {
            throw new Exception('waiting_appointment start datetime is invalid.');
        }

        if (!validate_mysql_datetime($waiting_appointment['end_datetime'])) {
            throw new Exception('waiting_appointment end datetime is invalid.');
        }
		
        // Check if the provider's id is valid.
        $num_rows = $this->db
                ->select('*')
                ->from('ea_users')
                ->join('ea_roles', 'ea_roles.id = ea_users.id_roles', 'inner')
                ->where('ea_users.id', $waiting_appointment['id_users_provider'])
                ->where('ea_roles.slug', DB_SLUG_PROVIDER)
                ->get()->num_rows();
        if ($num_rows == 0) {
            throw new Exception('waiting_appointment provider id is invalid.');
        }

       
            // Check if the customer's id is valid.
            $num_rows = $this->db
                    ->select('*')
                    ->from('ea_users')
                    ->join('ea_roles', 'ea_roles.id = ea_users.id_roles', 'inner')
                    ->where('ea_users.id', $waiting_appointment['id_users_customer'])
                    ->where('ea_roles.slug', DB_SLUG_CUSTOMER)
                    ->get()->num_rows();
            if ($num_rows == 0) {
                throw new Exception('waiting_appointment customer id is invalid.');
            }

            // Check if the service id is valid.
            $num_rows = $this->db->get_where('ea_services',
                    array('id' => $waiting_appointment['id_services']))->num_rows();
            if ($num_rows == 0) {
                throw new Exception('waiting_appointment customer id is invalid.');
            }
        

        return TRUE;
    }

    /**
     * Delete an existing waiting_appointment record from the database.
     *
     * @expectedException InvalidArgumentException Raises when the $appointment_id
     * is not an integer.
     *
     * @param numeric $appointment_id The record id to be deleted.
     * @return bool Returns the delete operation result.
     */
    public function delete($appointment_id) {
        if (!is_numeric($appointment_id)) {
            throw new Exception('Invalid argument type $appointment_id (value:"' . $appointment_id . '")');
        }

        $num_rows = $this->db->get_where('ea_waiting', array('id' => $appointment_id))->num_rows();

        if ($num_rows == 0) {
            return FALSE; // Record does not exist.
        }

        $this->db->where('id', $appointment_id);
        return $this->db->delete('ea_waiting');
    }

    /**
     * Get a specific row from the appointments table.
     *
     * @param numeric $appointment_id The record's id to be returned.
     * @return array Returns an associative array with the selected
     * record's data. Each key has the same name as the database
     * field names.
     */
    public function get_row($appointment_id) {
        if (!is_numeric($appointment_id)) {
            throw new Exception('Invalid argument given. Expected '
                    . 'integer for the $appointment_id : ' . $appointment_id);
        }
        return $this->db->get_where('ea_waiting',
                array('id' => $appointment_id))->row_array();
    }
	
	/**
		*get waiting_appointment number
	**/
	public function get_count() {
        return $this->db->count_all('ea_waiting');
        
    }
	
	/**
		*get filtred waiting_appointment number
	**/
	
	
	
	
	public function get_count_filter($date_debut,$date_fin) {
				 
				$num_rows = $this->db
                    ->select('*')
                    ->from('ea_waiting')                   
                    ->where('ea_waiting.start_datetime <', $date_fin)
					->where('ea_waiting.start_datetime >', $date_debut)   
                    ->get()->num_rows()
					;
					return $num_rows;
	}
	
	
	/**
		*get filtered confirmed waiting_appointment number
	**/
	
	public function get_count_confirmed_filter($date_debut,$date_fin) {
				 $date = date('Y-m-d H:i:s');
				$num_rows = $this->db
                    ->select('*')
                    ->from('ea_waiting')                   
                    ->where('ea_waiting.start_datetime <', $date)
					->where('ea_waiting.start_datetime <', $date_fin)
					->where('ea_waiting.start_datetime >', $date_debut)
                    ->get()->num_rows()
					;
					return $num_rows;
	}
	
	
	
	/**
		*get confirmed waiting_appointment number
	**/
	
	public function get_count_confirmed() {
				 $date = date('Y-m-d H:i:s');
				$num_rows = $this->db
                    ->select('*')
                    ->from('ea_waiting')                   
                    ->where('ea_waiting.start_datetime <', $date)					   
                    ->get()->num_rows()
					;
					return $num_rows;
	}
	
	
	
	/**
		*get filtered projected waiting_appointment number
	**/
	public function get_count_projected_filter($date_debut,$date_fin) {
				 $date = date('Y-m-d H:i:s');
				$num_rows = $this->db
                    ->select('*')
                    ->from('ea_waiting')                   
                    ->where('ea_waiting.start_datetime >', $date)
					->where('ea_waiting.start_datetime <', $date_fin)
					->where('ea_waiting.start_datetime >', $date_debut)
                    ->get()->num_rows()
					;
					return $num_rows;
	}
	
		/**
		*get projected waiting_appointment number
	**/
	public function get_count_projected() {
				 $date = date('Y-m-d H:i:s');
				$num_rows = $this->db
                    ->select('*')
                    ->from('ea_waiting')                   
                    ->where('ea_waiting.start_datetime >', $date)                   
                    ->get()->num_rows()
					;
					return $num_rows;
	}
	
    /**
     * Get a specific field value from the database.
     *
     * @param string $field_name The field name of the value to be returned.
     * @param numeric $appointment_id The selected record's id.
     * @return string Returns the records value from the database.
     */
    public function get_value($field_name, $appointment_id) {
        if (!is_numeric($appointment_id)) {
            throw new Exception('Invalid argument given, expected '
                    . 'integer for the $appointment_id : ' . $appointment_id);
        }

        if (!is_string($field_name)) {
            throw new Exception('Invalid argument given, expected '
                    . 'string for the $field_name : ' . $field_name);
        }

        if ($this->db->get_where('ea_waiting',
                array('id' => $appointment_id))->num_rows() == 0) {
            throw new Exception('The record with the provided id '
                    . 'does not exist in the database : ' . $appointment_id);
        }

        $row_data = $this->db->get_where('ea_waiting',
                array('id' => $appointment_id))->row_array();

        if (!isset($row_data[$field_name])) {
            throw new Exception('The given field name does not '
                    . 'exist in the database : ' . $field_name);
        }

        return $row_data[$field_name];
    }

    /**
     * Get all, or specific records from waiting_appointment's table.
     *
     * @example $this->Model->getBatch('id = ' . $recordId);
     *
     * @param string $where_clause (OPTIONAL) The WHERE clause of
     * the query to be executed. DO NOT INCLUDE 'WHERE' KEYWORD.
     * @return array Returns the rows from the database.
     */
    public function get_batch($where_clause = '') {
        if ($where_clause != '') {
            $this->db->where($where_clause);
        }
		$this->db->order_by('start_datetime', 'desc');
        return $this->db->get('ea_waiting')->result_array();
    }

    /**
     * Generate a unique hash for the given waiting_appointment data.
     *
     * This method uses the current date-time to generate a unique
     * hash string that is later used to identify this waiting_appointment.
     * Hash is needed when the email is send to the user with an
     * edit link.
     *
     * @return string Returns the unique waiting_appointment hash.
     */
    
    /**
     * Get all, or specific records from waiting_appointment's table.
     *
     * @example $this->Model->getBatch('id = ' . $recordId);
     *
     * @param string $where_clause (OPTIONAL) The WHERE clause of
     * the query to be executed. DO NOT INCLUDE 'WHERE' KEYWORD.
     * @return array Returns the rows from the database.
     */
    public function get_batch_filter($date_debut, $date_fin) {
       
		$this->db->order_by('start_datetime', 'desc');
                $this->db->where('ea_waiting.start_datetime <', $date_fin);
                $this->db->where('ea_waiting.start_datetime >', $date_debut);
                return $this->db->get('ea_waiting')->result_array(); 
    
       
    }
    
    public function generate_hash() {
        $current_date = new DateTime();
        return md5($current_date->getTimestamp());
    }

    /**
     * Inserts or updates an unavailable period record in the database.
     *
     * @param array $unavailable Contains the unavaible data.
     * @return int Returns the record id.
     */
    public function add_unavailable($unavailable) {
        // Validate period
        $start = strtotime($unavailable['start_datetime']);
        $end = strtotime($unavailable['end_datetime']);
        if ($start > $end) {
            throw new Exception('Unavailable period start must be prior to end.');
        }

        // Validate provider record
        $where_clause = array(
            'id' => $unavailable['id_users_provider'],
            'id_roles' => $this->db->get_where('ea_roles', array('slug' => DB_SLUG_PROVIDER))->row()->id
        );

        if ($this->db->get_where('ea_users', $where_clause)->num_rows() == 0) {
            throw new Exception('Provider id was not found in database.');
        }

        // Add record to database (insert or update).
        if (!isset($unavailable['id'])) {
            $unavailable['book_datetime'] = date('Y-m-d H:i:s');
            $unavailable['is_unavailable'] = true;

            $this->db->insert('ea_waiting', $unavailable);
            $unavailable['id'] = $this->db->insert_id();
        } else {
            $this->db->where(array('id' => $unavailable['id']));
            $this->db->update('ea_waiting', $unavailable);
        }

        return $unavailable['id'];
    }

    /**
     * Delete an unavailable period.
     *
     * @param numeric $unavailable_id Record id to be deleted.
     */
    public function delete_unavailable($unavailable_id) {
        if (!is_numeric($unavailable_id)) {
            throw new Exception('Invalid argument type $unavailable_id (value:"' .
                    $unavailable_id . '")');
        }

        $num_rows = $this->db->get_where('ea_waiting', array('id' => $unavailable_id))
                ->num_rows();
        if ($num_rows == 0) {
            return FALSE; // Record does not exist.
        }

        $this->db->where('id', $unavailable_id);
        return $this->db->delete('ea_waiting');
    }

    /**
     * Clear google sync IDs from waiting_appointment record.
     *
     * @param numeric $provider_id The waiting_appointment provider record id.
     */
    public function clear_google_sync_ids($provider_id) {
        if (!is_numeric($provider_id)) {
            throw new Exception('Invalid argument type $provider_id (value: "'
                    . $provider_id . '")');
        }

        $this->db->update('ea_waiting', array('id_google_calendar' => NULL),
                array('id_users_provider' => $provider_id));
    }
}

/* End of file appointments_model.php */
/* Location: ./application/models/appointments_model.php */
