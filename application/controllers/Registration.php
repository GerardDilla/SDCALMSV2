<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library('form_validation');
		  $this->load->library('Set_custom_session');
		  $this->load->library('email');
		  $this->load->model('Student_model/Student_login');
		  $this->load->model('Student_model/Student_info');
		  $this->load->model('Account');

		  //Controls where page is redirected after a failed process
		  $this->redirectlink = 'Registration';
		  
		  //Google Recaptcha secret key
		  $this->secretkey = '6LdiwqwUAAAAAOmYkBuO9dWXH8A_7g5uZXIsYEQ9';


	}
	public function index()
	{
		
		$this->loginpage($this->set_views->registration());

		if($this->input->post('login_submit')){

			$this->Init_Registration();

		}

	}
	private function Init_Registration(){

		//Sets up inputs
		$inputarray = array(
			'Student_Number' => $this->input->post('student_id'),
			'Email' => $this->input->post('student_email'),
			'Password' => $this->input->post('student_password'),
		);

		//Validate Form Inputs
		$validate_status = $this->InputValidate();
		if($validate_status == FALSE){

			$this->message_handler(validation_errors());
			$this->RedirectWithInput();

		}

		//Validate if Student number exists
		$studentnumber_status = $this->StudentNumberValidate($inputarray);
		if(empty($studentnumber_status)){

			$message = 'This Student Number does not exist.';
			$this->message_handler($message);
			$this->RedirectWithInput();

		}

		//Validate if Account already exists
		$account_status = $this->AccountValidate($inputarray);
		if(!empty($account_status)){

			$message = 'This Student Number already has an Account. <br><a href="#">Did you forget your password?</a>';
			$this->message_handler($message);
			$this->RedirectWithInput();

		}

		//Validated Captcha
		$captcha_status = $this->Recaptcha();
		if($captcha_status == '' || $captcha_status == 0){

			$this->message_handler('Invalid Captcha. Please try again');
			$this->RedirectWithInput();

		}

		//Inserts pre-registration data
		//$this->PreRegistration($inputarray);

		//Send Email with Verification code
		$this->SendActivationMail($inputarray);
	
	}
	private function PreRegistration($inputarray){

		

	}
	private function SendActivationMail($inputarray){


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
		$this->email->to($inputarray['Email']); 
		$this->email->subject('Student Portal Account Activation');
		$this->email->message('

		Hello and thank you for choosing St. Dominic College of Asia! 
		
		<br> 
		
		You\'re one step away from activating your Student Portal account! 
		
		<br><br> 
		
		To do so, Click the link below and it you\'ll be good to go. <br><br>
		<div style="margin: auto;width: 60%; border: 3px solid #73AD21; padding: 10px;">
		Activation Link: <a href="'.$inputarray['Email'].'">Activate Account!</a>
		</div>

		<br><br>

		');

		if(!$this->email->send())
		{
			$this->message_handler('An Error occured while sending you your verification link. Please contact our MIS team for assistance');

		}else{

			$this->message_handler('An Email was sent to '.$inputarray['Email'].' containing the link to activate your account');

		}

		//---Uncomment code below to debug---
		//echo $this->email->print_debugger(array('headers'));

	}
	private function Recaptcha(){


		//Get verified response data from google
		$param = "https://www.google.com/recaptcha/api/siteverify?secret=".$this->secretkey."&response=".$this->input->post('g-recaptcha-response');
		$verifyResponse = file_get_contents($param);
		$responseData = json_decode($verifyResponse);

		//Will return 1 is successful
		return $responseData->success;

	}
	private function InputValidate(){

		$config = array(
			array(
				'field' => 'student_id',
				'label' => 'Student Number',
				'rules' => 'required'
			),
			array(
				'field' => 'student_email',
				'label' => 'Email',
				'rules' => 'required|valid_email'
			),
			array(
				'field' => 'student_password',
				'label' => 'Password',
				'rules' => 'required|min_length[6]|max_length[20]'
			),
			array(
				'field' => 're-student_password',
				'label' => 'Password',
				'rules' => 'matches[student_password]',
				'errors' => array(
					'matches' => 'Password must match',
				),
			),
		);

		$this->form_validation->set_rules($config);

		return $this->form_validation->run();

	}
	private function AccountValidate($inputarray){

		return $this->Student_info->ValidateAccountExists($inputarray);

	}
	private function StudentNumberValidate($inputarray){

		return $this->Student_info->ValidateStudentNumber($inputarray);

	}
	private function message_handler($message=''){

		$this->session->set_flashdata('message',$message);

	}
	private function RedirectWithInput(){

		$inputarray = array(
			'prev_student_id' => $this->input->post('student_id'),
			'prev_student_email' => $this->input->post('student_email'),
			'prev_student_password' => $this->input->post('student_password'),
			'prev_re-student_password' => $this->input->post('re-student_password')
		);
		$this->session->set_flashdata($inputarray);
		Redirect($this->redirectlink);
		
	}


	
}
