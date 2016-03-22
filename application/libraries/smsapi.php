<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
/**
 * This is a wrapper class for sending sms. Twilio Api Custom Library suitable for our CI Project
 * @author: Mahmud
 * @category Library
 */
 
// Include the PHP TwilioRest library

 
class Smsapi {
    private $client;
    private $AccountSid;
    private $AuthToken;
    private $CallerID;
    private $ApiVersion;
    private $CI;
    private $SMS_Callback;
    private $VOICE_Callback;
    private $VOICE_fallback;
    private $VOICE_status;
 
    function __construct(){
        // Twilio REST API version
        $this->ApiVersion   =   "2010-04-01";
 
        $this->CI           =   &get_instance();
 
        // Set our AccountSid and AuthToken
        $this->AccountSid       =   $this->CI->config->item('twilio_sid');
        $this->AuthToken        =   $this->CI->config->item('twilio_token');
        $this->SMS_Callback     =   $this->CI->config->item('twilio_sms_callback');
        $this->VOICE_Callback   =   $this->CI->config->item('twilio_voice_callback');
        $this->VOICE_fallback   =   $this->CI->config->item('twilio_voice_fallback');
        $this->VOICE_status     =   $this->CI->config->item('twilio_voice_status');
 
        // Outgoing Caller ID you have previously validated with Twilio
        $this->CallerID     =   $this->CI->config->item('twilio_phone');
 
        // Instantiate a new Twilio Rest Client
        $this->client       =   new TwilioRestClient($this->AccountSid, $this->AuthToken);
    }
 
    /**
     * This function is a wrapper to send SMS to a phone number. You should use this method for all type
     * of SMS message sending.
     * @param string $number phone number to whom sms will send
     * @param string $message message that will send to the phone number
     */
    public function send_sms($number, $message){
        $response = $this->client->request("/{$this->ApiVersion}/Accounts/{$this->AccountSid}/SMS/Messages",
                "POST", array(
                "To" => $number,
                "From" => $this->CallerID,
                "Body" => $message
        ));
        if($response->IsError){
            $error  =   "Error: {$response->ErrorMessage} " . " File: Smsapi.php 42 no line. Number: $number";
           // echo $error;
           log_message('error', $error);
           return FALSE;
        }
        else{
            //echo "Sent message to $number";
            return TRUE;
        }
    }
 
    /**
     * This function search for available mobile numbers based on ZIP code
     * @access public
     * @param string $zip ZIP code of US or Canada
     * @param string $country US or CA
     * @return BOOLEAN TRUE for get result and FALSE for error or no result
     */
    public function search_mobile_numbers($zip='', $postal='', $country='US', $failsearch=FALSE){
        $SearchParams['InPostalCode']   = !empty($zip)    ? $zip    : '';
        $SearchParams['NearNumber']     = '';
        $SearchParams['Contains']       = '';
        $SearchParams['AreaCode']       = !empty($postal) ? $postal : '';
 
        /* Initiate US Local PhoneNumber search with $SearchParams list */
        $response = $this->client->request("/{$this->ApiVersion}/Accounts/{$this->AccountSid}/AvailablePhoneNumbers/$country/Local",
                         "GET",
                          $SearchParams);
 
        if($response->IsError) {
            return $response->IsError;
        }
 
        $AvailablePhoneNumbers = $response->ResponseXml->AvailablePhoneNumbers->AvailablePhoneNumber;
 
        if (empty($AvailablePhoneNumbers)){
            $AvailablePhoneNumbers  =   "No available numbers in your zip code";
            if ($failsearch){
                //now check only available number not need to zip code specific
                $SearchParams['InPostalCode']   = '';
                $response = $this->client->request("/{$this->ApiVersion}/Accounts/{$this->AccountSid}/AvailablePhoneNumbers/$country/Local",
                             "GET",
                              $SearchParams);
 
                if($response->IsError) {
                    return $response->IsError;
                }
 
                $AvailablePhoneNumbers = $response->ResponseXml->AvailablePhoneNumbers->AvailablePhoneNumber;
            }
        }
 
        return $AvailablePhoneNumbers;
    }
 
    /**
     * Buy mobile phone number
     * @param STRING $number the phone number user wants to buy
     * @return mixed TRUE for success and string for error message
     */
    public function buy_mobile_number($number){
        /* Purchase the selected PhoneNumber */
        $response = $this->client->request("/{$this->ApiVersion}/Accounts/{$this->AccountSid}/IncomingPhoneNumbers",
                                     "POST",
                                     array(
                                         'PhoneNumber'          => $number,
                                         'SmsUrl'               => $this->SMS_Callback,
                                         'SmsMethod'            => 'POST',
                                         'VoiceCallerIdLookup'  => TRUE,
                                         'VoiceUrl'             => $this->VOICE_Callback,
                                         'VoiceMethod'          => 'POST',
                                         'VoiceFallbackUrl'     => $this->VOICE_fallback,
                                         'VoiceFallbackMethod'  => 'POST',
                                         'StatusCallback'       => $this->VOICE_status,
                                         'StatusCallbackMethod' => 'POST',
                                     ));
 
        if($response->IsError) {
            $err = urlencode("Error purchasing number: $response->ErrorMessage");
            return $err;
        }
 
        return TRUE;
    }
}
 
?>