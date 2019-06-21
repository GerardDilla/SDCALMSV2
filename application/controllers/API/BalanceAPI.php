<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GradingAPI extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library("api_input_validator");
		$this->load->model("API/Grading");
		$this->load->model("Student_model/Student_info");


		//ONLY USE THE FOLLOWING INDEXES
		$this->data_input = array(
			'Error' => 0,
			'ResultCount' => 0,
			'Output' => '',
			'Message' => '',
			'Message_Array' => array(),
			'ErrorMessage' => '',
			'ErrorMessage_Array' => array()
		);

	}
	public function index()
	{

		$Value = array(
			array(
				'field' => 'Reference_Number',
				'label' => 'Reference Number',
				'rules' => 'required',
				'value' => $this->input->get('Reference_Number')
			),
			array(
				'field' => 'School_Year',
				'label' => 'School Year',
				'rules' => 'required',
				'value' => $this->input->get('School_Year')
			),
			array(
				'field' => 'Semester',
				'label' => 'Semester',
				'rules' => 'required',
				'value' => $this->input->get('Semester')
			)
		);
		$validate = $this->api_input_validator->validate_input($Value);
		if($validate['Status'] == TRUE){

			$input_array = array(

				'Reference_Number' => $this->input->get('Reference_Number'),
				'School_Year' => $this->input->get('School_Year'),
				'Semester' => $this->input->get('Semester')

			);

			//Check if reference number is valid
			$sn_result = $this->get_student_number($input_array);
			if(empty($sn_result)){

				$this->data_input['Error'] = 1;
				$this->data_input['ErrorMessage'] = 'Invalid Reference Number Key';
				$this->Output($this->data_input);

			}
			$input_array['Student_Number'] = $sn_result[0]['Student_Number'];


		}
		else{

			$this->data_input['Error'] = 1;
			$this->data_input['ErrorMessage'] = $validate['All_Errors'];
			$this->data_input['ErrorMessage_Array'] = $validate['Error'];
			$this->Output($this->data_input);
			
		}
		//echo $Reference_Number = $this->input->get('Reference_Number');
		//echo json_encode($output['Output']);

	}
	private function balance_constructor($input_array){

		
		$this->load->model('User_login');
		$this->load->model('Balance_model');
		$rn = $this->session->userdata('Reference_Number');
		$latestbal = $this->Balance_model->GetLatestBalDate_query($rn)->result_array();
		$sy = $latestbal[0]['schoolyear'];
		$sem = $latestbal[0]['semester'];

		//echo 'rn:'.$rn.'-sy:'.$sy.'-sem'.$sem;
		
		$outstanding = $this->Balance_model->getOutstandingbal($rn,$sy,$sem);
		$totalpaid = $this->Balance_model->gettotalpaid($rn,$sy,$sem);
		$sembalance = $this->Balance_model->semestralbalance($rn,$sy,$sem);
		$totalpaidsem = $this->Balance_model->gettotalpaidsemester($rn,$sy,$sem);
		foreach($outstanding->result_array() as $outstanding_row){
			$ob = $outstanding_row['Fees'];
		}
		foreach($totalpaid->result_array() as $totalpaid_row){
			$tp = $totalpaid_row['AmountofPayment'];
		}
		foreach($sembalance->result_array() as $sembalance_row){
			$sembal = $sembalance_row['Fees'];
		}
		foreach($totalpaidsem->result_array() as $totalpaidsem_row){
			$sempaid = $totalpaidsem_row['AmountofPayment'];
		}
		
		$data['Outstanding_Balance'] = $ob-$tp;
		$data['Semestral_Balance'] = $sembal;
		$data['Sem_total_Paid'] = $sempaid;
		$data['Total_Paid'] = $sembal - $sempaid;
		$data['Bal_Schoolyear'] = $sy;
		$data['Bal_Semester'] = $sem;

	}
	private function Output($data = array()){

		echo json_encode($data);
		exit();

	}


	
}
