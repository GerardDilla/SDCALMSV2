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

				$this->Output(0,'Invalid Reference Number');
				return;
			}
			$input_array['Student_Number'] = $sn_result[0]['Student_Number'];

			//Get Grades
			$grades_data = $this->get_grades($input_array);
			if(empty($grades_data)){

				$this->Output(1,'No Grading Data');
				return;

			}else{
				
				$this->Output(0,$grades_data);
				
			}

			$this->Output(0,$input_array['Student_Number']);

		}else{
			
			$this->Output(1,$validate['Error']);
			
		}
		//echo $Reference_Number = $this->input->get('Reference_Number');
		//echo json_encode($output['Output']);


	}
	private function get_grades($array){

		$result = $this->Grading->Get_grades($array);
		return $result;

	}
	private function get_student_number($array){

		$result = $this->Student_info->Student_Info_byREF($array);
		return $result;

	}
	private function Output($status,$output){

		$output = array(
			'Status' => $status,
			'Output' => $output
		);
		if($output['Status'] == 1){
			echo 'returned with errors';
		}
		echo json_encode($output);

	}


	
}
