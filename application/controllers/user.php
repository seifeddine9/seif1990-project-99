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
 * User Controller
 *
 * @package Controllers
 */
class User extends CI_Controller {
    /**
     * Class Constructor
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('session');

        // Set user's selected language.
        if ($this->session->userdata('language')) {
        	$this->config->set_item('language', $this->session->userdata('language'));
        	$this->lang->load('translations', $this->session->userdata('language'));
        } else {
        	$this->lang->load('translations', $this->config->item('language')); // default
        }
    }

    /**
     * Default Method
     *
     * The default method will redirect the browser to the user/login URL.
     */









    /**
     * Default Method
     *
     * The default method will redirect the browser to the home page .
     */




    public function index() {

       $this->load->model('settings_model');

        $this->load->model('appointments_model');
        $this->load->model('providers_model');
        $this->load->model('services_model');
        $this->load->model('customers_model');
        $this->load->model('settings_model');

          $view['base_url'] = $this->config->item('base_url');
        $view['company_name'] = $this->settings_model->get_setting('company_name');
        $view['date_format'] = $this->settings_model->get_setting('date_format');
        $view['available_services'] = $this->services_model->get_available_services();
         $user_id = $this->session->userdata('user_id');
        if ($user_id == TRUE)  {  
           $view['role_slug'] = $this->session->userdata('role_slug');
           $view['customer_data'] = $this->customers_model-> get_row($this->session->userdata('user_id'));
           $view['user_id'] = $this->session->userdata('user_id');}

           


        $this->load->view('user/header' , $view);  
        $this->load->view('user/home' , $view);    
        $this->load->view('user/footer' , $view); 

}




/********************
** redirect the browser to company page
** display the company information
**
*/


    public function company() {


        $this->load->model('customers_model');
        $this->load->model('settings_model');

        
        $view['base_url'] = $this->config->item('base_url');
        $view['company_name'] = $this->settings_model->get_setting('company_name');
        $view['date_format'] = $this->settings_model->get_setting('date_format');
            $user_id = $this->session->userdata('user_id');
           if ($user_id == TRUE)  {  
           $view['role_slug'] = $this->session->userdata('role_slug');
           $view['customer_data'] = $this->customers_model-> get_row($this->session->userdata('user_id'));
           $view['user_id'] = $this->session->userdata('user_id');}

          $this->load->view('user/header'  , $view);  
          $this->load->view('user/company' , $view);    
          $this->load->view('user/footer' , $view);  



}
/*
**
**
*/

    public function tarif() {


        $this->load->model('customers_model');
        $this->load->model('settings_model');

        
        $view['base_url'] = $this->config->item('base_url');
        $view['company_name'] = $this->settings_model->get_setting('company_name');
        $view['date_format'] = $this->settings_model->get_setting('date_format');
            $user_id = $this->session->userdata('user_id');
           if ($user_id == TRUE)  {  
           $view['role_slug'] = $this->session->userdata('role_slug');
           $view['customer_data'] = $this->customers_model-> get_row($this->session->userdata('user_id'));
           $view['user_id'] = $this->session->userdata('user_id');}

          $this->load->view('user/header'  , $view);  
          $this->load->view('user/tarif' , $view);    
          $this->load->view('user/footer' , $view);  



}


/********************
** redirect the browser to apply for a job  page
** display the form to send 
**
*/

    public function work_for_us() {

        $this->load->model('services_model');

        $this->load->model('customers_model');
        $this->load->model('settings_model');
        $view['base_url'] = $this->config->item('base_url');
        $view['company_name'] = $this->settings_model->get_setting('company_name');
        $view['available_categories']  = $this->services_model->get_all_categories();

         $user_id = $this->session->userdata('user_id');
           if ($user_id == TRUE)  {  
           $view['role_slug'] = $this->session->userdata('role_slug');
           $view['customer_data'] = $this->customers_model-> get_row($this->session->userdata('user_id'));
           $view['user_id'] = $this->session->userdata('user_id');}

        $this->load->view('user/header'  , $view);  
        $this->load->view('user/nous_rejoindre' , $view);    
        $this->load->view('user/footer' , $view);  



}


/*******
**  redirect the user to the sign up page 
**
**
*/


    public function signup() {
        
        $this->load->model('customers_model');

        $this->load->model('settings_model');
        $view['base_url'] = $this->config->item('base_url');
        $view['company_name'] = $this->settings_model->get_setting('company_name');
            $user_id = $this->session->userdata('user_id');
           if ($user_id == TRUE)  {  
           $view['role_slug'] = $this->session->userdata('role_slug');
           $view['customer_data'] = $this->customers_model-> get_row($this->session->userdata('user_id'));
           $view['user_id'] = $this->session->userdata('user_id');
                   redirect($this->config->item('base_url'));

       }

       else{ $this->load->view('user/header' , $view);  
               $this->load->view('user/signup' , $view);    
               $this->load->view('user/footer' , $view); }

}



    /**
     * Display the login page.
     */

    public function login() {
         $this->load->model('settings_model');
         $this->load->helper('url');
        $this->load->model('customers_model');

        $view['base_url'] = $this->config->item('base_url');
 $view['dest_url_customer'] = $this->session->userdata('dest_url_customer');
    if (!$view['dest_url'] ||  $view['dest_url'] !== $view['base_url'] . '/index.php/backend') {
        $view['dest_url'] = $view['base_url'] . '/index.php/backend';

          }


    if (!$view['dest_url_customer']) {
        $view['dest_url_customer'] = $view['base_url'] . '/index.php/user';
        

    }

        $view['company_name'] = $this->settings_model->get_setting('company_name');
         $user_id = $this->session->userdata('user_id');
           if ($user_id == TRUE)  {  
           $view['role_slug'] = $this->session->userdata('role_slug');
           $view['customer_data'] = $this->customers_model-> get_row($this->session->userdata('user_id'));
           $view['user_id'] = $this->session->userdata('user_id');
                   redirect($this->config->item('base_url'));

       }

                 else 
                    {$this->load->view('user/header' , $view);  
                                  $this->load->view('user/login', $view); 
                                  $this->load->view('user/footer' , $view); }


           }

  

    /**
     * Display the logout page.
     */
    public function logout() {
        $this->load->model('settings_model');

        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('role_slug');
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('dest_url');
        $this->session->unset_userdata('dest_url_customer');


        $view['base_url'] = $this->config->item('base_url');
        $view['company_name'] = $this->settings_model->get_setting('company_name');
        redirect($this->config->item('base_url'));
    }

    /**
     * Display the forgot password page.
     */
    public function forgot_password() {

        $this->load->model('settings_model');
                $this->load->model('customers_model');

        $view['base_url'] = $this->config->item('base_url');
        $view['company_name'] = $this->settings_model->get_setting('company_name');
 $user_id = $this->session->userdata('user_id');
           if ($user_id == TRUE)  {  
           $view['role_slug'] = $this->session->userdata('role_slug');
           $view['customer_data'] = $this->customers_model-> get_row($this->session->userdata('user_id'));
           $view['user_id'] = $this->session->userdata('user_id');
                   redirect($this->config->item('base_url'));

       }
       else 
 {       $this->load->view('user/header', $view); 
         $this->load->view('user/forgot_password', $view);
         $this->load->view('user/footer', $view); }
    }

    public function no_privileges() {

        $this->load->model('customers_model');
        $this->load->model('settings_model');

        
        $view['base_url'] = $this->config->item('base_url');
        $view['company_name'] = $this->settings_model->get_setting('company_name');
        $view['date_format'] = $this->settings_model->get_setting('date_format');
            $user_id = $this->session->userdata('user_id');
           if ($user_id == TRUE)  {  
           $view['role_slug'] = $this->session->userdata('role_slug');
           $view['customer_data'] = $this->customers_model-> get_row($this->session->userdata('user_id'));
           $view['user_id'] = $this->session->userdata('user_id');}
           
         $this->load->view('user/header', $view); 
         $this->load->view('user/no_privileges', $view);
         $this->load->view('user/footer', $view); 
    }

    /**
     * [AJAX] Check whether the user has entered the correct login credentials.
     *
     * The session data of a logged in user are the following:
     *   - 'user_id'
     *   - 'user_email'
     *   - 'role_slug'
     *   - 'dest_url'
     */
    public function ajax_check_login() {
        try {
            if (!isset($_POST['email']) || !isset($_POST['password'])) {
                throw new Exception('Invalid credentials given!');
            }

            $this->load->model('user_model');
            $user_data = $this->user_model->check_login($_POST['email'], $_POST['password']);

            if ($user_data) {
                $this->session->set_userdata($user_data); // Save data on user's session.
                 echo json_encode($user_data);
            } 


            else {
                echo json_encode(AJAX_FAILURE);
            }

        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }
 /**
     * [AJAX] Check whether the user has entered the correct login credentials.
     *
     * The session data of a logged in user are the following:
     *   - 'user_id'
     *   - 'user_email'
     *   - 'role_slug'
     *   - 'dest_url'
     */
    public function ajax_check_login_customer() {
        try {
            if (!isset($_POST['email']) || !isset($_POST['password'])) {
                throw new Exception('Invalid credentials given!');
            }

            $this->load->model('user_model');
            $user_data = $this->user_model->check_login($_POST['email'], $_POST['password']);

            if ($user_data) {
                if ($user_data['role_slug'] == "customer")
                {$this->session->set_userdata($user_data); // Save data on user's session.
                 echo json_encode($user_data);}
                 else 
                    {  echo json_encode(AJAX_FAILURE);}
            } 


            else {
                echo json_encode(AJAX_FAILURE);
            }

        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }
    /**
     * Regenerate a new password for the current user, only if the username and
     * email address given corresond to an existing user in db.
     *
     * @param string $_POST['username']
     * @param string $_POST['email']
     */
    public function ajax_forgot_password() {
        try {
            if ( !isset($_POST['email'])) {
                throw new Exception('You must enter a valid email address in '
                        . 'order to get a new password!');
            }

            $this->load->model('user_model');
            $this->load->model('settings_model');

            $new_password = $this->user_model->regenerate_password($_POST['email']);

            if ($new_password != FALSE) {
                $this->load->library('notifications');
                $company_settings = array(
                    'company_name' => $this->settings_model->get_setting('company_name'),
                    'company_link' => $this->settings_model->get_setting('company_link'),
                    'company_email' => $this->settings_model->get_setting('company_email')
                );
                $this->notifications->send_password($new_password, $_POST['email'], $company_settings);
            }

            echo ($new_password != FALSE) ? json_encode(AJAX_SUCCESS) : json_encode(AJAX_FAILURE);
        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }



/****************
**  insert the new user in the database 
** and redirect him to his home
**
*/
public function inscription(){
        
      try{   
    $this->load->model('customers_model');
    $this->load->model('settings_model');

   // $post_data = json_decode($_POST['postData'], true);
    $post_data = $_POST['postData'];
    $customer = $_POST['post_data']['customer'];
  
    $customer['id'] = $this->customers_model->add($customer); 

            $this->load->library('session');
            $this->session->set_userdata('user_id', $customer['id']);
            $this->session->set_userdata('user_email', $customer['email']);
            $this->session->set_userdata('role_slug', DB_SLUG_CUSTOMER);
            $this->session->set_userdata('first_name', $customer['first_name']);
            $this->session->set_userdata('last_name', $customer['last_name']);
     

      $this->load->library('notifications');
      $company_settings = array(
                    'company_name' => $this->settings_model->get_setting('company_name'),
                    'company_link' => $this->settings_model->get_setting('company_link'),
                    'company_email' => $this->settings_model->get_setting('company_email')
                );
      


    echo json_encode(AJAX_SUCCESS); 

    $this->notifications->new_account($customer['password'], $customer['email'], $customer['last_name'] , $customer['first_name'] , $company_settings);
}catch (Exception $exc) {
            echo json_encode(array(
                'exceptions' => exceptionToJavaScript($exc)
            ));

        }
               

           


  
    

    }



/**********
**
** get the user avatar from the database
** 
*/

    public function get_avatar() {
        try {
          

            $this->load->model('user_model');
            $email = $_POST['email'] ;
            $user_avatar = $this->user_model->get_avatar($email);

            if ($user_avatar) { echo json_encode($user_avatar); } 


            else {    echo json_encode(AJAX_FAILURE);}

        } catch(Exception $exc) {
            echo json_encode(array(
                'exceptions' => array(exceptionToJavaScript($exc))
            ));
        }
    }




/*
**send the worker information to company mail on submit form 
**
*/
    public function send_contact_information() {
            try{   
           $this->load->model('settings_model');

 
           $first_name = $_POST['first_name'];
           $last_name = $_POST['last_name'];
           $email = $_POST['email'];
           $service = $_POST['service'];
           $mobile = $_POST['mobile'];
           $age = $_POST['age'];
           $etat_civil = $_POST['etat_civil'];
           $addresse = $_POST['addresse'];
           $city = $_POST['city'];
           $full_path = $_POST['full_path'];
   
    


 $company_settings = array(
                    'company_name' => $this->settings_model->get_setting('company_name'),
                    'company_link' => $this->settings_model->get_setting('company_link'),
                    'company_email' => $this->settings_model->get_setting('company_email')
                );
      $this->load->library('notifications');
$this->notifications->new_cv( $email , $last_name , $first_name , $mobile  , $age , $etat_civil , $addresse , $city ,  $company_settings, $full_path , $service);

       unlink($full_path);

           echo json_encode(AJAX_SUCCESS); 

}catch (Exception $exc) {
            echo json_encode(array(
                'exceptions' => exceptionToJavaScript($exc)
            ));

        }





}

/*
**
**
**
*/

    public function send_file() {
            try{   
           $this->load->model('settings_model');


           $file = $_FILES['file'];
   
          $config['upload_path'] = './uploads/';
          if(is_file($config['upload_path']))
             { chmod($config['upload_path'], 777); }  

            $config['allowed_types'] = 'pdf';
    $this->load->library('upload', $config);

          



    if (!$this->upload->do_upload('file'))
          {
                     $error = array('error' => $this->upload->display_errors());
          }
          else
          {
                  $data = array('upload_data' => $this->upload->data());
                  $full_path = $data['upload_data']['full_path'];
            
          }

         foreach (glob($config['upload_path']."*.pdf") as $file) {

               if (filemtime($file) < time() - 7200) {
                 unlink($file);
                      }
                }



           echo json_encode($full_path); 

}catch (Exception $exc) {
            echo json_encode(array(
                'exceptions' => exceptionToJavaScript($exc)
            ));

        }





}




/********************
** page services
**show the services and theire description
**
*/

    public function services() {

                $this->load->model('appointments_model');
        $this->load->model('providers_model');
        $this->load->model('services_model');
        $this->load->model('customers_model');
        $this->load->model('settings_model');

        try 
      {     $available_services  = $this->services_model->get_available_services();
            $available_providers = $this->providers_model->get_available_providers();
            $company_name        = $this->settings_model->get_setting('company_name');
            $show_provider        = $this->settings_model->get_setting('show_provider');
            $date_format         = $this->settings_model->get_setting('date_format');
            $base_url            = $this->config->item('base_url');


       // Remove the data that are not needed inside the $available_providers array.
      foreach ($available_providers as $index=>$provider) {
        $stripped_data = array(
          'id' => $provider['id'],
          'first_name' => $provider['first_name'],
          'last_name' => $provider['last_name'],
          'services' => $provider['services']
        );
        $available_providers[$index] = $stripped_data;
      }

                $manage_mode        = FALSE;
                $appointment   = array();
                $provider      = array();


   // Load the book appointment view.
            $view = array (
                'available_services'    => $available_services,
                'available_providers'   => $available_providers,
                'company_name'          => $company_name,
                'manage_mode'           => $manage_mode,
                'date_format'           => $date_format,
                'appointment_data'      => $appointment,
                'provider_data'         => $provider,
                'base_url'              => $base_url,
                'show_provider'         => $show_provider
                
            );
             $user_id = $this->session->userdata('user_id');
                 if ($user_id == TRUE)  {  
                 $view['role_slug'] = $this->session->userdata('role_slug');
                 $view['customer_data'] = $this->customers_model-> get_row($this->session->userdata('user_id'));
                 $view['user_id'] = $this->session->userdata('user_id');}
               else {

                  $customer      = array();
                $view['customer_data'] =  $customer ;

            }



        }


catch(Exception $exc) {
            $view['exceptions'][] = $exc;
        }



      

          $this->load->view('user/header'  , $view);  
          $this->load->view('user/services' , $view);    
          $this->load->view('user/footer' , $view);  



}




public function set_userdata()
{
  
     
$this->load->model('user_model');

 $user_data = $_POST['customerData'];

            if ($user_data) {

                $this->session->set_userdata($user_data); // Save data on user's session.
                 echo json_encode($user_data);
            } 




}


public function inscription2(){
        
      try{   
    $this->load->model('customers_model');
    $this->load->model('settings_model');

   // $post_data = json_decode($_POST['postData'], true);
    $post_data = $_POST['postData'];
    $customer = $_POST['post_data']['customer'];
  
    $customer['user_id'] = $this->customers_model->add($customer); 

            $this->load->library('session');
            $this->session->set_userdata('user_id', $customer['user_id']);
            $this->session->set_userdata('user_email', $customer['email']);
            $this->session->set_userdata('role_slug', DB_SLUG_CUSTOMER);
            $this->session->set_userdata('first_name', $customer['first_name']);
            $this->session->set_userdata('last_name', $customer['last_name']);
     

      $this->load->library('notifications');
      $company_settings = array(
                    'company_name' => $this->settings_model->get_setting('company_name'),
                    'company_link' => $this->settings_model->get_setting('company_link'),
                    'company_email' => $this->settings_model->get_setting('company_email')
                );
      
$customer['role_slug']='customer';
$customer['user_email']=$customer['email'];

    echo json_encode($customer); 

    $this->notifications->new_account($customer['password'], $customer['email'], $customer['last_name'] , $customer['first_name'] , $company_settings);
}catch (Exception $exc) {
            echo json_encode(array(
                'exceptions' => exceptionToJavaScript($exc)
            ));

        }
               

           


  
    

    }



public function facebook_signup(){
        

$fb_config = array(
            'appId'  => '535891186589773',
            'secret' => '87dd81f91c75d16e5dd8d21c1728642f',

        );

        $this->load->library('facebook/facebook', $fb_config);

  $user = $this->facebook->getUser();

        if ($user) {
            try {
                $data['user_profile'] = $this->facebook
                    ->api('/me/?fields=email,name,gender,locale,first_name,last_name,picture,location');


            } catch (FacebookApiException $e) {
               error_log($e);
                $user = null;
            }
        }

        if ($user) {
            $data['logout_url'] = $this->facebook
                ->getLogoutUrl();
        } else {
            $data['login_url'] = $this->facebook
                ->getLoginUrl();
        }

        $this->load->view('view',$data);
    }

  
    

    /*
    ** contact message 
    ***
    **/
     


    public function contactUs() {
            try{   
           $this->load->model('settings_model');
      $this->load->library('notifications');

          $customer = $_POST['post_data']['customer'];
           $contactName = $customer ['contactName'];
           $contactAddress = $customer['contactAddress'];
           $contactMessage = $customer['contactMessage'];
           $contactSubject = $customer['contactSubject'];
         
  
                 echo json_encode(AJAX_SUCCESS); 


    
$company_settings = array(
                    'company_name' => $this->settings_model->get_setting('company_name'),
                    'company_link' => $this->settings_model->get_setting('company_link'),
                    'company_email' => $this->settings_model->get_setting('company_email')
                );

$this->notifications->new_message($contactName, $contactAddress, $contactMessage , $contactSubject , $company_settings);




     



}catch (Exception $exc) {
            echo json_encode(array(
                'exceptions' => exceptionToJavaScript($exc)
            ));

        }





}



}

/* End of file user.php */
/* Location: ./application/controllers/user.php */
