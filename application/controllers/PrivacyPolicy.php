<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrivacyPolicy extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library('form_validation');
		  $this->load->library('Set_custom_session');
		  $this->load->library("api_input_validator");
		  $this->load->library('email');
		  $this->load->model('Student_model/Student_info');
		  $this->student_data = $this->set_custom_session->student_session();

		  //Department
		  $this->system = 'HEI Portal';


		  //Defines log date
		  $this->logdate = date("Y/m/d");

		  //Defines Length of key until expiration
		  $this->key_expiration = 30;


	}
	public function index(){

		$array = array(
			'Success' => 0,
			'Message' => '',
			'Error' => '',
		);
		
		$config = array(
			array(
				'field' => 'Reference_Number',
				'label' => 'Reference_Number',
				'rules' => 'required',
				'value' => $this->input->get_post('Reference_Number')
			),
			array(
				'field' => 'agree',
				'label' => 'agree',
				'rules' => 'required',
				'value' => $this->input->get_post('agree')
			),
			array(
				'field' => 'parent_agree',
				'label' => 'parent_agree',
				'rules' => 'required',
				'value' => $this->input->get_post('parent_agree')
			)
		);
		$validate = $this->api_input_validator->validate_input($config);
		if($validate['Status'] == TRUE){



			//Sets up inputs
			$inputarray = array(

				'Reference_Number' => $this->input->get_post('Reference_Number'),
				'Date' => $this->logdate,
				'System' => $this->system,

			);

			//Get decrypted reference number
			$inputarray['Reference_Number'] = $this->GetReference($inputarray);
			if($inputarray['Reference_Number'] == ''){
				$array['Error'] = 'An Error Occurred (Privacy Policy: Reference Number)';
				echo json_encode($array);
				exit();
			}


			//Inserts new row in Table: privacy_policy_agreement
			if($this->Logprivacy($inputarray) != ''){

				$array['Success'] = 1;
				echo json_encode($array);

			}else{

				$array['Error'] = 'An Error Occurred (Privacy Policy)';
				echo json_encode($array);

			}
			

		}else{

			$array['Error'] = 'You must agree to the terms and conditions to proceed';
			echo json_encode($array);
			return;
		}


	}
	private function Logprivacy($inputarray){

		return $this->Student_info->Insert_PrivacyPolicy($inputarray);
		

	}
	private function GetReference($inputarray){

		return $this->Student_info->GetReference_Decrypt($inputarray)[0]['Reference_Number'];

	}

	


	
}
