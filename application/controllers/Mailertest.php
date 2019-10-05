<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailertest extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library("user_sessionhandler");
		  $this->load->library('email');
		  $this->load->model('Grading');
		  $this->load->model("Legends");
		  $this->user_data = $this->user_sessionhandler->user_session();

		  //Gets Legends
		  $this->legends = $this->Legends->Get_Legends("Legends")[0];
		  
	}
	public function index()
	{

		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'mail.smtp2go.com';
		$config['smtp_port'] = '2525'; 
		$config['smtp_crypto'] = 'tls';
		$config['smtp_user'] = 'gpdilla@sdca.edu.ph';
		$config['smtp_pass'] = 'o7RYFpgxdTtX';
		$config['charset'] = 'utf-8';
		$config['mailtype'] = 'html';
		$config['newline'] = "rn";

		$this->email->initialize($config);

		$this->email->set_newline("\r\n");  
		
		
		$this->email->from('webmailer@sdca.edu.ph', 'St. Dominic College of Asia');
		$this->email->to('gerarddilla@gmail.com'); 
		$this->email->subject('Test Mail from portal');
		$this->email->message('
		<img src="'.base_url().'assets/images/logo-default3.png" height="50">
		Dear Gerard,
		    Thank you for choosing St. Dominic College of Asia. Your application for enrollment have been considered. Please print the copy of your application by clicking on the link below:
            You can use your reference number to process your enrollment application thru our Main Office or mobile enrollment kiosk located at SM Molino. Should you have any question fell free to visit the School or call us anytime. We are happy to be of service with you and be part of your future success.

			Thank you.
		');

		// You need to pass FALSE while sending in order for the email data
		// to not be cleared - if that happens, print_debugger() would have
		// nothing to output.
		//$this->email->send(FALSE);

		if(!$this->email->send())
		{
			echo 'An Error occured while sending you your verification link. Please contact our MIS team for assistance';
		}

		// Will only print the email headers, excluding the message subject and body
		//echo $this->email->print_debugger(array('headers'));
		
	}
	
}
