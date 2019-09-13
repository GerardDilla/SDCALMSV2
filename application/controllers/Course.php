<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();
  
		  $this->load->library("set_views");
		  $this->load->library('form_validation');
		  $this->load->library("Set_custom_session");
		  //load file helper
		  $this->load->helper('file');
		  $this->student_data = $this->set_custom_session->student_session();

		  $this->load->model("Legends");
		  $this->load->model("API/Grading");
		  $this->load->model("API/Schedule");

		  //Sets Timezone for
		  date_default_timezone_set('Asia/Manila');

		  //Defines log date
		  $this->logdate = date("Y/m/d");

	}
	public function index($SchedCode = '')
	{

		if($SchedCode == ''){
			$this->courselist();
		}else{
			$this->coursefeed($SchedCode);
		}


	}
	private function courselist(){

		$this->data['Subjects'] = $this->construct_course_output();
		//$this->data['Assessment_List'] = $this->AssessmentModel->GetAssessmentList_Student($this->student_data);
		$this->template($this->set_views->courselist());

	}
	private function coursefeed($SchedCode){

		$this->data['SchedData'] = $this->Schedule->Get_sched_info($SchedCode);
		$this->template($this->set_views->coursewall());

	}
	private function construct_course_output(){

		$output = array();
		$count = 0;
		$legend = $this->Legends->Get_Legends();
		$array = array(
			'Student_Number' => $this->student_data['Student_Number'],
			'School_Year' => $legend[0]['School_Year'],
			'Semester' => $legend[0]['Semester']
		);
		$subjects = $this->Grading->Get_Subjects($array);
		foreach($subjects as $row){

			$output[$count]['Sched_Code'] = $row['Sched_Code'];
			$output[$count]['Course_Title'] = $row['Course_Title'];
			$output[$count]['Course_Code'] = $row['Course_Code'];

			$sched_info = $this->Schedule->Get_sched_info($row['Sched_Code']);

			$output[$count]['Instructor_Name'] = $sched_info[0]['Instructor_Name'];
			$count++;
		}
		return $output;

	}

}
	