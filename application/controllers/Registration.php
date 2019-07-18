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

		  //Department
		  $this->department = 'MIS';

		  //Defines Length of Activation Key
		  $this->Keylength = 9;

		  //Defines log date
		  $this->logdate = date("Y/m/d");

		  //Defines Length of key until expiration
		  $this->key_expiration = 30;


	}
	public function index(){
		//Front
		$this->loginpage($this->set_views->registration());

		if($this->input->post('login_submit')){
			$this->Init_Registration();
		}



	}
	public function Keygen(){
		//Front
		$this->loginpage($this->set_views->keygen());
		
		if($this->input->post('keygen_submit')){

			$this->Init_KeyGen();

		}

	}
	public function AccountVerify(){

		
		if($this->input->get('activate')){
			$verifyarray = array(
				'Student_Number' => $this->input->get('id'),
				'Activation_Code' => $this->input->get('key')
			);
			$this->Init_VerifyAccount($verifyarray);
		}
		$this->loginpage($this->set_views->verification());

	}
	private function Init_Registration(){

		//Sets up inputs
		$inputarray = array(
			'Student_Number' => $this->input->post('student_id'),
			'Activation_Code' => $this->input->post('activation_code'),
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

		//Validate Activation Code
		$code_status = $this->ActivateCodeCheck($inputarray);
		if(empty($code_status)){

			$this->message_handler('Invalid Activation Code. You may acquire this code by going to the <u>'.$this->department.'</u> office');
			$this->RedirectWithInput();

		}

		//Validated Captcha
		$captcha_status = $this->Recaptcha();
		if($captcha_status == '' || $captcha_status == 0){

			$this->message_handler('Invalid Captcha. Please try again');
			$this->RedirectWithInput();

		}

		//Inserts Portal Account
		$insertarray = array(
			'Student_Number' => $inputarray['Student_Number'],
			'Email' => $inputarray['Email'],
			'Password' => md5($inputarray['Password']),
			'DateActivated' => $this->logdate,
		);
		if($this->RegisterStudent($insertarray)){

			//Send Email with Verification code
			$mail_status = $this->SendActivationMail($inputarray);
			
			if($mail_status == 0)
			{
				$this->message_handler('An Error occured while sending you your verification link. Please contact our MIS team for assistance');
				$this->RedirectWithInput();
			}else{
	
				$this->message_handler('<h4>Almost there! An Email was sent to '.$inputarray['Email'].' containing the link to activate your account<h4>');
				$this->RedirectWithInput();
			}
	


		}

	}
	private function Init_KeyGen(){

		//Sets up inputs
		$inputarray = array(
			'Student_Number' => $this->input->post('student_id'),
			'DateGiven' => $this->logdate,
		);


		//Validate input rules
		$config = array(
			array(
				'field' => 'student_id',
				'label' => 'Student Number',
				'rules' => 'required'
			),
		);
		$this->form_validation->set_rules($config);

		if($this->form_validation->run() == FALSE){

			$this->message_handler(validation_errors());
			$this->RedirectWithInput('Registration/Keygen');

		}

		//Validate if Student number exists
		$studentnumber_status = $this->StudentNumberValidate($inputarray);
		if(empty($studentnumber_status)){

			$message = 'This Student Number does not exist.';
			$this->message_handler($message);
			$this->RedirectWithInput('Registration/Keygen');

		}

		//Validate Activation Code // Checks if user wants to bypass if currently enrolled in sem
		if(empty($this->input->post('bypass_enrolled'))){
			$enrollement_status = $this->EnrollmentValidate($inputarray);
			if(empty($enrollement_status)){

				$message = 'The Account you\'re trying to activate is not enrolled in the current Semester. <br><br> You can choose to bypass this check, the system will Log this should you choose to do so.';
				$this->message_handler($message);
				$this->RedirectWithInput('Registration/Keygen');

			}
		}

		//Get a Unique key
		$inputarray['Activation_Code'] = $this->ProduceUniqueKey($this->Keylength);

		//Inserting or updating of ActivationCode
		$code_status = $this->CheckExistingCodeData($inputarray);
		if(empty($code_status)){
			//Inserts new row in portal_activationcode table
			$this->InsertActivationCode($inputarray);
			$this->message_handler('Succesfully created Activation Key!');
		}else{
			//Updates row in portal_activationcode table
			$this->UpdateActivationCode($inputarray,$code_status[0]['ID']);
			$this->message_handler('Succesfully updated Activation Key!');
		}

		$this->session->set_flashdata('Activation_Code',$inputarray['Activation_Code']);
		$this->RedirectWithInput('Registration/Keygen');
		

	}
	private function Init_VerifyAccount($verifyarray){

		//Validate Activation Code
		$code_status = $this->ActivateCodeCheck($verifyarray);
		if(empty($code_status)){

			$message = 'Invalid / Expired Verification Code';
			$this->message_handler($message);
			return;
		}

		//VSet Verified to 1
		$updatearray = array(
			'Verified' => 1,
			'Student_Number' => $verifyarray['Student_Number']
		);
		if($this->VerifyFinal($updatearray)){

			$message = '<h3>Successfully verified your account! <br><br>Sign in <a href="'.base_url().'index.php/Registration/RedirectWithInput/Main">Here</a><h3>';

			$this->message_handler($message);

		}else{

			$message = '<h3>This request is no longer valid.<h3>';
			
			$this->message_handler($message);

		}
		

	}
	private function SendActivationMail($inputarray){

		$mail_status = 1;

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

		<h3>Hello and thank you for choosing <span style="color:#cc0000">St. Dominic College of Asia!</span><h3>
		
		<br> 
		
		You\'re one step away from activating your Student Portal account! 
		
		<br><br> 
		
		To do so, Click the link below and it you\'ll be good to go. <br><br>
		<div style="margin: auto;width: 60%; border: 3px solid #73AD21; padding: 10px;">
		Activation Link: <a target="_blank" href="'.base_url().'index.php/Registration/AccountVerify?activate=1&id='.$inputarray['Student_Number'].'&key='.$inputarray['Activation_Code'].'">Activate Account!</a>
		</div>

		<br><br>

		Report this to the MIS office if you think this is not your doing, Thank you.

		');

		if(!$this->email->send())
		{
			$mail_status == 0;
		}

		return $mail_status;
		//---Uncomment code below to debug---
		//echo $this->email->print_debugger(array('headers'));

	}
	public function Test_SendActivationMail(){


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
		$this->email->subject('Student Portal Account Activation');
		$this->email->message('

		<h3>Hello and thank you for choosing <span style="color:#cc0000">St. Dominic College of Asia!</span></h3>
		
		<br> 
		
		You\'re one step away from activating your Student Portal account! 
		
		<br><br> 
		
		To do so, Click the link below and it you\'ll be good to go. <br><br>
		<div style="margin: auto;width: 60%; border: 3px solid #73AD21; padding: 10px;">
		Activation Link: <a target="_blank" href="'.base_url().'index.php/Registration/AccountVerify?activate=1">Activate Account!</a>
		</div>

		<br><br>

		Report this to the MIS office if you think this is not your doing, Thank you.

		');

		if(!$this->email->send())
		{
			echo 'An Error occured while sending you your verification link. Please contact our MIS team for assistance';
			
		}else{

			echo '<h4>Almost there! An Email was sent to  containing the link to activate your account<h4>';
			
		}

		//---Uncomment code below to debug---
		echo '<br><hr><br>'.$this->email->print_debugger(array('headers'));

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
				'field' => 'activation_code',
				'label' => 'Activation Code',
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
	private function ActivateCodeCheck($inputarray){

		return $this->Student_info->ValidateActivationCode($inputarray);

	}
	private function CheckExistingCodeData($inputarray){

		return $this->Student_info->CheckExistingCodeData($inputarray);

	}
	private function InsertActivationCode($inputarray){

		return $this->Student_info->InsertCode($inputarray);

	}
	private function UpdateActivationCode($inputarray,$ID){

		return $this->Student_info->UpdateCode($inputarray,$ID);

	}
	private function EnrollmentValidate($inputarray){

		return $this->Student_info->ValidatedCurrentEnrollment($inputarray);

	}
	private function ProduceUniqueKey($limit){

		$code['draft'] = strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit));
		$stop = 0;
		//Check availability of code
		if(empty($this->Student_info->CheckCodeAvailability($code))){

			$code['final'] = $code['draft'];
		

		}else{

			while($stop < 1){

				if(empty($this->Student_info->CheckCodeAvailability($code))){
					
					$stop++;
				}

			}

		}
		return $code['final'];

	}
	private function RegisterStudent($inputarray){

		return $this->Student_info->InsertNewAccount($inputarray);

	}
	private function VerifyFinal($array){

		return $this->Student_info->VerifyEmail($array);

	}
	private function message_handler($message=''){

		$this->session->set_flashdata('message',$message);

	}
	public function RedirectWithInput($custom_url = ''){

		$inputarray = array(
			'prev_student_id' => $this->input->post('student_id') != '' ? $this->input->post('student_id') : '',
			'prev_student_email' => $this->input->post('student_email') != '' ? $this->input->post('student_email') : '',
			'prev_student_password' => $this->input->post('student_password') != '' ? $this->input->post('student_password') : '',
			'prev_re-student_password' => $this->input->post('re-student_password') != '' ? $this->input->post('re-student_password') : ''
		);
		$this->session->set_flashdata($inputarray);
		Redirect($custom_url != '' ? $custom_url : $this->redirectlink);
		
	}
	


	
}
