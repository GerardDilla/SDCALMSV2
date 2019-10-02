<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library('form_validation');
		  $this->load->library('Set_custom_session');
		  $this->load->model('Student_model/Student_login');
		  $this->load->model('Instructor_model/Instructor_login');
	}
	public function index()
	{	
		//$this->load->view('welcome_message');
		if($this->session->has_userdata('LoginData')){
			redirect('Dashboard');
		}
		else if($this->session->has_userdata('Instructor_LoginData')){
			//redirect('TeacherDashboard');
		}
		print_r($this->session->has_userdata('Instructor_LoginData'));
		$this->loginpage($this->set_views->login());
		
	}
	public function Login(){
		
		$login_button = $this->input->post('login_submit');
		if(isset($login_button)){

			$config = array(
				array(
					'field' => 'student_id',
					'label' => 'Student Number',
					'rules' => 'required'
				),
				array(
					'field' => 'student_password',
					'label' => 'Password',
					'rules' => 'required'
				),
			);

			$this->form_validation->set_rules($config);

			if($this->form_validation->run() == TRUE){

				$array = array(
					'student_id' => $this->input->post('student_id'),
					'student_password' => $this->input->post('student_password')
				);

				$result = $this->Student_login->verify_login($array);
				print_r($result);
				if(empty($result)){

					$this->session->set_flashdata('message','Invalid Student Number / Password');
					redirect('Main');

				}else{

					$account_session = array(
						'Student_Number' => $result[0]['Student_Number'],
						'Reference_Number' => $result[0]['Reference_Number'],
						'First_Name' => $result[0]['First_Name'],
						'Middle_Name' => $result[0]['Middle_Name'],
						'Last_Name' => $result[0]['Last_Name'],
						'Email' => $result[0]['Email'],
						'ViaRegistration' => $result[0]['ViaRegistration'],
						'Verified' => $result[0]['Verified'],
					);
					//print_r($this->session->userdata['LoginData']);
					$this->session->set_userdata('LoginData',$account_session);
					redirect('Dashboard');

				}

			}else{
				
				$this->session->set_flashdata('message',validation_errors());
				redirect('Main');
			
			}

		}

	}
	public function Instructor_login(){

		$login_button = $this->input->post('login_submit');
		if(isset($login_button)){

			$config = array(
				array(
					'field' => 'instructor_id',
					'label' => 'Instructor_ID',
					'rules' => 'required'
				),
				array(
					'field' => 'passkey',
					'label' => 'Password',
					'rules' => 'required'
				),
			);

			$this->form_validation->set_rules($config);

			if($this->form_validation->run() == TRUE){

				$array = array(
					'Instructor_ID' => $this->input->post('instructor_id'),
					'Passkey' => $this->input->post('passkey')
				);

				$result = $this->Instructor_login->verify_login($array);
				//print_r($result);
				if(empty($result)){

					$this->session->set_flashdata('instructor_message','Invalid Instructor ID / Password');
					redirect('Main');

				}
				else if($result[0]['Active'] == 0){
					$this->session->set_flashdata('instructor_message','Cannot login, this account is deactivated');
					redirect('Main');
				}
				else{

					$account_session = array(
						'Instructor_Unique_ID' => $result[0]['ID'],
						'Instructor_ID' => $result[0]['Instructor_ID'],
						'Instructor_Type' => $result[0]['Instructor_Type'],
						'Instructor_Name' => $result[0]['Instructor_Name']
					);
					//print_r($this->session->userdata['LoginData']);
					$this->session->set_userdata('Instructor_LoginData',$account_session);
					redirect('TeacherDashboard');
					//echo 'logged in';

				}

			}else{
				
				$this->session->set_flashdata('instructor_message',validation_errors());
				redirect('Main');
			
			}
		}

	}
	public function logout(){
		$this->session->unset_userdata('LoginData');
		redirect('Main');
	}
	public function Instructor_logout(){
		$this->session->unset_userdata('Instructor_LoginData');
		redirect('Main');
	}

	
}
