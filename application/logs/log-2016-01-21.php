<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

ERROR - 2016-01-21 16:06:43 --> Severity: Warning  --> mail(): Failed to connect to mailserver at &quot;localhost&quot; port 25, verify your &quot;SMTP&quot; and &quot;smtp_port&quot; setting in php.ini or use ini_set() C:\wamp\www\easyappointments\application\third_party\phpmailer\phpmailer\class.phpmailer.php 664
ERROR - 2016-01-21 16:06:43 --> Email could not been sent. Mailer Error (Line 127): Could not instantiate mail function.
ERROR - 2016-01-21 16:06:43 --> #0 C:\wamp\www\easyappointments\application\controllers\appointments.php(444): Notifications->send_appointment_details(Array, Array, Array, Array, Array, 'Appointment cha...', '', 'http://192.168....', 'cfrcfr@live.fr')
#1 [internal function]: Appointments->ajax_register_appointment()
#2 C:\wamp\www\easyappointments\system\core\CodeIgniter.php(360): call_user_func_array(Array, Array)
#3 C:\wamp\www\easyappointments\index.php(229): require_once('C:\\wamp\\www\\eas...')
#4 {main}
ERROR - 2016-01-21 16:07:17 --> Severity: Warning  --> mail(): Failed to connect to mailserver at &quot;localhost&quot; port 25, verify your &quot;SMTP&quot; and &quot;smtp_port&quot; setting in php.ini or use ini_set() C:\wamp\www\easyappointments\application\third_party\phpmailer\phpmailer\class.phpmailer.php 664
ERROR - 2016-01-21 16:07:23 --> Severity: Warning  --> mail(): Failed to connect to mailserver at &quot;localhost&quot; port 25, verify your &quot;SMTP&quot; and &quot;smtp_port&quot; setting in php.ini or use ini_set() C:\wamp\www\easyappointments\application\third_party\phpmailer\phpmailer\class.phpmailer.php 664
ERROR - 2016-01-21 16:07:45 --> Severity: Warning  --> mail(): Failed to connect to mailserver at &quot;localhost&quot; port 25, verify your &quot;SMTP&quot; and &quot;smtp_port&quot; setting in php.ini or use ini_set() C:\wamp\www\easyappointments\application\third_party\phpmailer\phpmailer\class.phpmailer.php 664
