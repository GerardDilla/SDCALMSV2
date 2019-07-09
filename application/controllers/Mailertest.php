<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailertest extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library("Set_custom_session");
		  $this->load->library('email');
		  $this->load->model('Grading');
		  $this->load->model("Legends");
		  $this->student_data = $this->set_custom_session->student_session();

		  //Gets Legends
		  $this->legends = $this->Legends->Get_Legends("Legends")[0];
		  
	}
	public function index()
	{


		$config['protocol']    = 'mail';

		$config['mailpath']     = "/usr/sbin/sendmail";

		$config['smtp_host']    = 'http://stdominiccollege.edu.ph';

		$config['smtp_port']    = '465';

		$config['smtp_timeout'] = '7';

		$config['smtp_user']    = 'gpdilla@sdca.edu.ph';

		$config['smtp_pass']    = 'senpai1320';

		$config['charset']    = 'utf-8';

		$config['mailtype'] = 'html'; 

		$config['validation'] = TRUE;

		$this->email->initialize($config);

		$this->email->set_newline("\r\n");  
		
		
		$this->email->from('gpdilla@sdca.edu.ph', 'St. Dominic College of Asia');
		$this->email->to('gpdilla@sdca.edu.ph'); 
		$this->email->subject('Test Mail from portal');
		$this->email->message('Dear Gerard,
		    Thank you for choosing St. Dominic College of Asia. Your application for enrollment have been considered. Please print the copy of your application by clicking on the link below:
            You can use your reference number to process your enrollment application thru our Main Office or mobile enrollment kiosk located at SM Molino. Should you have any question fell free to visit the School or call us anytime. We are happy to be of service with you and be part of your future success.

			Thank you.
		');

		// You need to pass FALSE while sending in order for the email data
		// to not be cleared - if that happens, print_debugger() would have
		// nothing to output.
		$this->email->send(FALSE);

		// Will only print the email headers, excluding the message subject and body
		echo $this->email->print_debugger(array('headers'));
		
	}
	
}
