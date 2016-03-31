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
class Notifications_Model extends CI_Model {
    /**
     * Class Constructor
     */
    public function __construct() {
        parent::__construct();
    }

    

  
    /**
     * Insert a new notifications record to the database.
     *
     * @param array $notifications Associative array with the notifications's
     * data. Each key has the same name with the database fields.
     * @return int Returns the id of the new record.
     */
	 public function insert($notifications) {
        //$notifications['date_action'] = date('Y-m-d H:i:s');
        
		
		
		
		
        if (!$this->db->insert('ea_notifications', $notifications)) {
            throw new Exception('Could not insert notifications record.');
        }

        return intval($this->db->insert_id());
    }

    /**
     * Update an existing notifications record in the database.
     *
     * The notifications data argument should already include the record
     * id in order to process the update operation.
     *
     * @expectedException DatabaseException Raises when the update operation
     * failes to complete successfully.
     *
     * @param array $notifications Associative array with the notifications's
     * data. Each key has the same name with the database fields.
     */
    private function update($notifications) {
        $this->db->where('id', $notifications['id']);
        if (!$this->db->update('ea_notifications', $notifications)) {
            throw new Exception('Could not update notifications record.');
        }
    }

    /**
     * Find the database id of an notifications record.
     *
     * The notifications data should include the following fields in order
     * to get the unique id from the database: "start_datetime", "end_datetime",
     * "id_users_provider", "id_users_customer", "id_services".
     *
     * <strong>IMPORTANT!</strong> The record must already exists in the
     * database, otherwise an exception is raised.
     *
     * @param array $notifications Array with the notifications data. The
     * keys of the array should have the same names as the db fields.
     * @return int Returns the db id of the record that matches the apppointment
     * data.
     */
    public function find_record_id($notifications) {
        $this->db->where(array(
            'start_datetime'    => $notifications['start_datetime'],
            'end_datetime'      => $notifications['end_datetime'],
            'id_users_provider' => $notifications['id_users_provider'],
            'id_users_customer' => $notifications['id_users_customer'],
            'id_services'       => $notifications['id_services']
        ));

        $result = $this->db->get('ea_waiting');

        if ($result->num_rows() == 0) {
            throw new Exception('Could not find notifications record id.');
        }

        return $result->row()->id;
    }

   

    /**
     * Delete an existing notifications record from the database.
     *
     * @expectedException InvalidArgumentException Raises when the $appointment_id
     * is not an integer.
     *
     * @param numeric $notifications The record id to be deleted.
     * @return bool Returns the delete operation result.
     */
    public function delete($notifications_id) {
        if (!is_numeric($notifications_id)) {
            throw new Exception('Invalid argument type $appointment_id (value:"' . $notifications_id . '")');
        }

        $num_rows = $this->db->get_where('ea_notifications', array('id' => $notifications_id))->num_rows();

        if ($num_rows == 0) {
            return FALSE; // Record does not exist.
        }

        $this->db->where('id', $notifications_id);
        return $this->db->delete('ea_notifications');
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
     * Get all, or specific records from notifications's table.
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
		$this->db->order_by('date_action', 'desc');
        return $this->db->get('ea_notifications',30)->result_array();
    }

    


    

    
}

/* End of file appointments_model.php */
/* Location: ./application/models/appointments_model.php */
