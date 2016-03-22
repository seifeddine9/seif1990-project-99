<?php
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
 * Easy!Appointments Configuration File 
 * 
 * Set your installation BASE_URL * without the trailing slash * and the database 
 * credentials in order to connect to the database. You can enable the DEBUG_MODE
 * while developing the application.
 * 
 * IMPORTANT: 
 * If you are updating from version 1.0 you will have to create a new "config.php"
 * file because the old "configuration.php" is not used anymore.
 */
class Config {
    // ------------------------------------------------------------------------
    // General Settings
    // ------------------------------------------------------------------------
    //const BASE_URL      = 'http://192.168.1.4';
	const BASE_URL      = 'http://www.mesrendezvous.tn/';
    const DEBUG_MODE    = FALSE;
     
    // ------------------------------------------------------------------------
    // Database Settings
    // ------------------------------------------------------------------------
    const DB_HOST       = 'localhost';    
    const DB_NAME       = 'easymcube';
    const DB_USERNAME   = 'root';
    const DB_PASSWORD   = '';

    // ------------------------------------------------------------------------
    // Google Calendar Sync
    // ------------------------------------------------------------------------
    const GOOGLE_SYNC_FEATURE   = true; // Enter TRUE or FALSE
    const GOOGLE_PRODUCT_NAME   = 'mcube';
    const GOOGLE_CLIENT_ID      = '775055540456-c75b2gb107d2frhofqaclupnrc0n8kou.apps.googleusercontent.com'; 
    const GOOGLE_CLIENT_SECRET  = 'Nd1L7Qq9pYeNk6kPJ45FySBN'; 
    const GOOGLE_API_KEY        = 'AIzaSyDhy8uRVQN0Vcih6WTCDzr_-nRdEj-0zqw';
}
/* End of file config.php */
/* Location: ./config.php */