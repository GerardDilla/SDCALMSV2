<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BalanceAPI extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library("api_input_validator");
		$this->load->model("API/Grading");
		$this->load->model("Student_model/Student_info");
		$this->load->model('API/Balance');


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
				'value' => $this->input->get('School_Year')
			),
			array(
				'field' => 'Semester',
				'label' => 'Semester',
<<<<<<< Updated upstream
=======
				'rules' => '',
>>>>>>> Stashed changes
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

<<<<<<< Updated upstream
			//Validates Encrypted Reference Number
			$input_array['Student_Number'] = $this->validate_reference_number($input_array);
			
			//Gets and Displays Balance
=======
			$input_array['Student_Number'] = $this->validate_reference_number($input_array);

>>>>>>> Stashed changes
			$this->balance_constructor($input_array);

			$this->Output($this->data_input);
		}
		else{

			$this->data_input['Error'] = 1;
			$this->data_input['ErrorMessage'] = $validate['All_Errors'];
			$this->data_input['ErrorMessage_Array'] = $validate['Error'];
			$this->Output($this->data_input);
			
		}

	}
	private function balance_constructor($input_array){

		
		$outstanding = $this->Balance->getOutstandingbal($input_array);
		$totalpaid = $this->Balance->gettotalpaid($input_array);
		$sembalance = $this->Balance->semestralbalance($input_array);
		$totalpaidsem = $this->Balance->gettotalpaidsemester($input_array);
		
<<<<<<< Updated upstream
		//Total of all Balance and Payments since enrolled
		$data['Overall_Fees'] = $outstanding[0]['Fees'];
		$data['Overall_Paid'] = $totalpaid[0]['AmountofPayment'];

		//Overall Outstanding Balance
		$outstanding_balance = number_format((float)$outstanding[0]['Fees'] - $totalpaid[0]['AmountofPayment'], 2, '.', '');
		$data['Outstanding_Balance'] = $data['Overall_Fees'] <= $data['Overall_Paid'] ? 0.00 : $outstanding_balance;
=======
		print_r($outstanding);
		echo '<hr>';
		print_r($totalpaid);
		echo '<hr>';
		print_r($sembalance);
		echo '<hr>';
		print_r($totalpaidsem);
		echo '<hr>';

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
		$data['Bal_Schoolyear'] = $input_array['School_Year'];
		$data['Bal_Semester'] = $input_array['Semester'];

		$this->data_input['data'] = $data;
		$this->data_input['ResultCount'] = count($data);
		$this->Output($this->data_input);
>>>>>>> Stashed changes

		//Semestral Balance Based on Chosen SY and Sem
		$data['Semestral_Balance'] = number_format((float)$sembalance[0]['Fees'], 2, '.', '');
		$data['Semestral_Paid'] = number_format((float)$totalpaidsem[0]['AmountofPayment'], 2, '.', '');
		$data['Semestral_Total'] = number_format((float)$sembalance[0]['Fees'] - $totalpaidsem[0]['AmountofPayment'], 2, '.', '');

		//Outstanding balance excluding balance of chosen semester and schoolyear
		$data['Outstanding_Balance_SemSy_Excluded'] = number_format((float)($outstanding[0]['Fees'] - $totalpaid[0]['AmountofPayment'])-($sembalance[0]['Fees'] - $totalpaidsem[0]['AmountofPayment']), 2, '.', '');
		$data['Total_Paid_SemSy_Excluded'] = number_format((float)$outstanding[0]['Fees'] - $totalpaid[0]['AmountofPayment'], 2, '.', '');

		//Chosen Schoolyear and Semester
		$data['Chosen_Schoolyear'] = $input_array['School_Year'] != null ? $input_array['School_Year'] : 'None';
		$data['Chosen_Semester'] = $input_array['Semester'] != null ? $input_array['Semester'] : 'None';

		$this->data_input['data'] = $data;
		$this->Output($this->data_input);

	}
	private function validate_reference_number($input_array){

		//Check if reference number is valid
		$sn_result = $this->Student_info->Student_Info_byREF($input_array);
		if(empty($sn_result)){
			
			$this->data_input['Error'] = 1;
			$this->data_input['ErrorMessage'] = 'Invalid Reference Number Key';
			$this->Output($this->data_input);

		}
		return $sn_result[0]['Student_Number'];
	}
	private function validate_reference_number($input_array){

		//Check if reference number is valid
		$sn_result = $this->Student_info->Student_Info_byREF($input_array);
		if(empty($sn_result)){
			
			$this->data_input['Error'] = 1;
			$this->data_input['ErrorMessage'] = 'Invalid Reference Number Key';
			$this->Output($this->data_input);

		}
		return $sn_result[0]['Student_Number'];
		//$input_array['Student_Number'] = $sn_result[0]['Student_Number'];
	}
	private function Output($data = array()){

		echo json_encode($data);
		exit();

	}


	
}
