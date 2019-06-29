<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ScheduleAPI extends CI_Controller {

	function __construct() 
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library("api_input_validator");
		$this->load->model("API/Schedule");
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
			//Validates reference number hash and returns student number
			$input_array['Student_Number'] = $this->validate_reference_number($input_array);

			//Constructs and displays the schedule
			$sched_data = $this->sched_constructor($input_array);

		}
		else{

			$this->data_input['Error'] = 1;
			$this->data_input['ErrorMessage'] = $validate['All_Errors'];
			$this->data_input['ErrorMessage_Array'] = $validate['Error'];
			$this->Output($this->data_input);
			
		}

	}
	private function sched_constructor($input_array){
	
		$subjects = $this->get_subjects($input_array);
		
		$sched_array = array();
		$count = 0;
		$subjects = $this->get_subjects($input_array);
		
		foreach($subjects as $row){

			
			$sched = $this->get_sched($row['Sched_Code']);

			$sched_array[$count] = array(
				'Sched_Code' => $row['Sched_Code'],
				'Course_Code' => $row['Course_Code'] != null ? $row['Course_Code'] : 'Available in Old Portal',
				'Course_Title' => $row['Course_Title'] != null ? $row['Course_Title'] : '-',
				'Day' => '',
				'Time' => '',
				'End_Time' => '',
				'Instructor' => '',
				'sched_display_id' => ''
			);
			$separator = '';
			$sched_count = 0;
			foreach($sched as $schedrow){

				$separator = $sched_count != 0 ? ' | ' : $separator;
				$sched_array[$count]['Day'] .= $schedrow['sched_display_id'] != null ? $separator.''.$schedrow['Day'] : '-';
				$sched_array[$count]['Time'] .= $schedrow['sched_display_id'] != null ? $separator.''.$schedrow['stime'].' - '.$schedrow['etime'] : '-';
				//$sched_array[$count]['End_Time'] .= $separator.''.$schedrow['etime'];
				$sched_array[$count]['Instructor'] .= $schedrow['sched_display_id'] != null ? $separator.''.$schedrow['Instructor_Name'] : '-';
				$sched_array[$count]['sched_display_id'] .= $schedrow['sched_display_id'] != null ? $separator.''.$schedrow['sched_display_id'] : '-';
				$sched_count++;
			}
			
			$sched_array[$count]['Schedule_Array'] = $sched;

			$count++;	
		}

		if(empty($subjects)){

			$this->data_input['Error'] = 1;
			$this->data_input['ErrorMessage'] = 'No Schedule Data';
			$this->Output($this->data_input);

		}else{

			$this->data_input['data'] = $sched_array;
			$this->data_input['ResultCount'] = count($sched_array);
			$this->Output($this->data_input);
			
		}
		//return $sched_array;

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
	private function get_subjects($array){

		$result = $this->Grading->Get_Subjects($array);
		return $result;

	}
	private function get_sched($SchedCode){

		$result = $this->Schedule->Get_sched_info($SchedCode);
		return $result;

	}
	private function Output($data = array()){

		echo json_encode($data);
		exit();

	}


	
}
