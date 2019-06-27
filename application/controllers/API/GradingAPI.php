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
			'data' => '',
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
				'rules' => 'required|test',
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

			//Validates reference number hash and returns student number
			$input_array['Student_Number'] = $this->validate_reference_number($input_array);

			//Constructs and displays grades
			$grades_data = $this->grade_constructor($input_array);



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
	private function grade_constructor($input_array){
		//Gets all subjects then gets each of the subject's grades
		$grading_array = array();
		$count = 0;
		$subjects = $this->get_subjects($input_array);
		
		foreach($subjects as $row){


			//Gets Grade of Subject
			$grade_fetch = array(
				'Student_Number' => $row['Student_Number'],
				'School_Year' => $row['School_Year'],
				'Semester' => $row['Semester'],
				'Sched_Code' => $row['Sched_Code']
			);
			$grade = $this->get_grades($grade_fetch);

			$grading_array[$count] = array(
				//'Sched_Code' => $row['Sched_Code'],
				//'Reference_Number' => $row['Reference_Number'],
				//'Student_Number' => $row['Student_Number'],
				'Course_Code' => $row['Course_Code'],
				'Course_Title' => $row['Course_Title'],
				//'School_Year' => $row['School_Year'],
				//'Semester' => $row['Semester'],
				'Prelim' => count($grade) <= 0 ? '0.00' : $grade[0]['Prelim'],
				'Midterm' => count($grade) <= 0 ? '0.00' : $grade[0]['Midterm'],
				'Finals' => count($grade) <= 0 ? '0.00' : $grade[0]['Finals'],
				//'Final_grade_raw' => count($grade) <= 0 ? '0.00' : $grade[0]['FG'],
				//'Final_grade_completion' => count($grade) <= 0 ? '0.00' : $grade[0]['FG2'],
				//'remarks_raw' => count($grade) <= 0 ? '0.00' : $grade[0]['R1'],
				//'remarks_completion' => count($grade) <= 0 ? '0.00' : $grade[0]['R2'],
				'FINALGRADE' => count($grade) <= 0 ? '0.00' : $grade[0]['FINALGRADE'],
				'REMARKS' => count($grade) <= 0 ? 'Not Encoded' : $grade[0]['REMARKS']
			);
			
			$count++;

		}

		if(empty($grading_array)){

			$this->data_input['Error'] = 1;
			$this->data_input['ErrorMessage'] = 'No Grading Data';
			$this->Output($this->data_input);

		}else{

			$this->data_input['data'] = $grading_array;
			$this->data_input['ResultCount'] = count($grading_array);
			$this->Output($this->data_input);
			
		}
		//return $grading_array;

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
	private function get_subjects($array){

		$result = $this->Grading->Get_Subjects($array);
		return $result;

	}
	private function get_grades($array){

		$result = $this->Grading->Get_grades($array);
		return $result;

	}
	private function Output($data = array()){

		echo json_encode($data);
		exit();

	}


	
}
