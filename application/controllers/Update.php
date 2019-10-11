<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();
		  
		  $this->load->helper(array('form', 'url'));

		  $this->load->library('form_validation');
  
		  $this->load->model('Model_Update/Update_Model');

	}


	public function index()
	{   
	//username sample
	$student_number = '20130335';

		$config = array(
			array(
					'field' => 'email',
					'label' => 'Email',
					'rules' => 'trim|required|is_unique[highered_accounts.Email]'
			),
			array(
					'field' => 'cemail',
					'label' => 'Confirm Email',
					'rules' => 'trim|required|matches[email]'
					/*'errors' => array(
					'required' => 'You must provide a %s.',
					),*/
			),
			array(
				'field' => 'opassword',
				'label' => 'Current Password',
		  		'rules' => 'trim|required|callback_checkoldpass'
	      	),
			array(
					'field' => 'npassword',
					'label' => 'New Password',
					'rules' => 'trim|required'
			),
			array(
					'field' => 'rtnpassword',
					'label' => 'Confirm password',
					'rules' => 'trim|required|matches[npassword]'
			)
	    );
		$this->form_validation->set_rules($config);
	
		if ($this->form_validation->run() == TRUE) {
			$data = array(
				'npassword' => MD5($this->input->post('npassword')),
				'email' => $this->input->post('email'),
				'Student_Number' => $student_number
			);
			$update = $this->Update_Model->UpdateEmailPass($data);
		
		}else{
			echo "fail";
		}

	   $this->load->view('Main/Update');
	
	}

	public function checkoldpass(){
		$password = $this->Update_Model->check_oldpass($this->input->post('opassword'),'20130335');
			 
		if($password->num_rows() == 1){
			return TRUE;
		}else{
			$this->form_validation->set_message('checkoldpass', 'WRONG CURRENT PASSWORD!');
			return FALSE;
			
		}
	}
	
  

  
	

	
}
