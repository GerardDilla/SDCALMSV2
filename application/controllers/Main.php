<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library('form_validation');
		  $this->load->library('Set_custom_session');
		  $this->load->model('Student_Model/Student_login');
			echo 'test123';
	}
	public function index()
	{
		//$this->load->view('welcome_message');
		if($this->session->has_userdata('LoginData')){
			redirect('Grades');
		}
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
						'Last_Name' => $result[0]['Last_Name']
					);
					//print_r($this->session->userdata['LoginData']);
					$this->session->set_userdata('LoginData',$account_session);
					redirect('Grades');

				}

			}else{
				
				$this->session->set_flashdata('message',validation_errors());
				redirect('Main');
			
			}

		}

	}
	public function logout(){
		$this->session->unset_userdata('LoginData');
		redirect('Main');
	}
	public function sample()
	{
		//$this->load->view('welcome_message');
		$this->template($this->set_views->Dashboard());

	}

	
}
