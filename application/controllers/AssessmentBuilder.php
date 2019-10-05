<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AssessmentBuilder extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library('form_validation');
		  $this->load->library("user_sessionhandler");
		  //load file helper
		  $this->load->helper('file');
		  $this->teacher_data = $this->user_sessionhandler->user_session();
		  $this->load->model('AssessmentModel');
		  $this->load->model('Rubric_Model/Rubric');

		  //Sets Timezone for
		  date_default_timezone_set('Asia/Manila');

		  //Defines log date
		  $this->logdate = date("Y/m/d");

	}
	public function index()
	{
		//$this->data['Assessment_List'] = $this->AssessmentModel->GetAssessmentList_Student($this->student_data);
		$InstructorID = $this->teacher_data['Instructor_Unique_ID'];
		$this->data['RubricsList'] = $this->Rubric->RubricsList($InstructorID);
		$this->instructor_template($this->set_views->assesssment_builder());
	}
	public function Ajax_BuilderSession(){

		/*
		$data = array(

			'Student_Number' => $this->student_data['Student_Number'],
			'AssessmentName' =>  '',
			'AssessmentDescription' => '',
			'RubricsID' => '',
			'QuestionData' => array()

		);
		*/
		//$assessment = array();
		//$questions = array();
		$this->session->userdata('AssessmentBuilder_Session',$data);
		
	}
	public function Ajax_GetQuestion(){

		$data['QuestionType'] = $this->input->get_post('Type');
		$data['QuestionPoints'] = $this->input->get_post('Points');

		//echo json_encode($data);
		if($data['QuestionType'] == 1){

			echo $this->load->view('QuestionTypesBuilder/MultipleChoice',$data,true);

		}
		if($data['QuestionType'] == 2){

			echo $this->load->view('QuestionTypesBuilder/TrueOrFalse',$data,true);

		}
		if($data['QuestionType'] == 3){

			echo $this->load->view('QuestionTypesBuilder/Identification',$data,true);

		}
		if($data['QuestionType'] == 4){

			echo $this->load->view('QuestionTypesBuilder/Essay',$data,true);

		}else{

			echo '';

		}
	}
	public function SaveAssessment(){
		
		//Constructs the array for the general info of the assessment
		$AssessmentData = array(
			'AssessmentName' => $this->input->post('AssessmentName'),
			'AssessmentDescription' => $this->input->post('AssessmentDescription'),
			'RubricsID' => $this->input->post('Rubrics'),
		);

		//Constructs the array that will be used for inserting questions
		$QuestionData = array();
		$choicearray = array('Choice_A','Choice_B','Choice_C','Choice_D');
		$Questions = $this->input->post('Question') ? $this->input->post('Question') : array();
		foreach($Questions as $key => $question){

			$QuestionData[$key]['Question'] = $question;
			$QuestionData[$key]['QuestionType'] = $this->input->post('Type['.$key.']');
			$QuestionData[$key]['Answer'] = ''; // Set as default for questions without answers
			$QuestionData[$key]['criteria_id'] = 0;

			//echo $key;
			if($this->input->post('choice['.$key.'][]')){
				
				$answer = $this->input->post('Answer['.$key.']');
				$choices = $this->input->post('choice['.$key.']');
				foreach($choices as $key2 => $choice){
					$QuestionData[$key][$choicearray[$key2]] = $choice;
					$answerkey = $key2 + 1;
					if($answerkey == $answer){
						$QuestionData[$key]['Answer'] = $choice;
						//echo 'mult';
					}
				}

			}
			else{

				$QuestionData[$key]['Answer'] = $this->input->post('Answer['.$key.']');

			}

			$QuestionData[$key]['criteria_id'] = $this->input->post('Criteria['.$key.']');
			$QuestionData[$key]['Points'] = $this->input->post('Points['.$key.']');
		}

		//Inserts Assessment data while checking inputs are complete
		$InsertStatus = array(
			'Status' => 1,
			'Errors' => array()
		);

		$config = array(
			array(
					'field' => 'AssessmentName',
					'label' => 'Assessment Name',
					'rules' => 'required'
			),
			array(
					'field' => 'AssessmentDescription',
					'label' => 'Assessment Description',
					'rules' => 'required'
			),
			array(
				'field' => 'start_date',
				'label' => 'Start Date',
				'rules' => 'required'
			),
			array(
				'field' => 'start_time',
				'label' => 'Start Time',
				'rules' => 'required'
			),
			array(
				'field' => 'end_date',
				'label' => 'End Date',
				'rules' => 'required|callback_compare_startdates'
			),
			array(
				'field' => 'end_time',
				'label' => 'End Time',
				'rules' => 'required|callback_compare_starttime'
			),
			array(
				'field' => 'timelimit',
				'label' => 'Time limit',
				'rules' => 'required'
			)
		);
		
		$this->form_validation->set_rules($config);
		
		if($this->form_validation->run() == TRUE){

			//Gets the general info of Assessment and store to array for inserting
			$start = date('Y-m-d H:i:s', strtotime($this->input->post('start_date').' '.$this->input->post('start_time')));
			$end = date('Y-m-d H:i:s', strtotime($this->input->post('end_date').' '.$this->input->post('end_time')));
			$now = new DateTime();
			$AssessmentData = array(
				'AssessmentName' => $this->input->post('AssessmentName'),
				'Description' => $this->input->post('AssessmentDescription'),
				'InstructorID' => $this->teacher_data['Instructor_Unique_ID'],
				'rubrics_id' => $this->input->post('Rubrics'),
				'StartDate' => $start,
				'EndDate' => $end,
				'Timelimit' => $this->input->post('timelimit'),
				'AssessmentCode' => $this->ProduceUniqueKey(),
				'DateCreated' => $now->format('Y-m-d H:i:s')
			);
			if(!empty($QuestionData)){
				foreach($QuestionData as $i => $Data){
				
					$questionnumber = $i + 1;
					if($Data['Question'] == '' || $Data['Question'] == null){
						$InsertStatus['Status'] = 0;
						$InsertStatus['Errors'][] = 'No Question given for Question #'.$questionnumber;
					}
					if($Data['Answer'] == '' || $Data['Answer'] == null){
						$InsertStatus['Status'] = 0;
						$InsertStatus['Errors'][] = 'No Answer given for Question #'.$questionnumber;
					}
					if($Data['Points'] == '' || $Data['Points'] == null){
						$InsertStatus['Status'] = 0;
						$InsertStatus['Errors'][] = 'No Points given for Question #'.$questionnumber;
					}
					if($Data['QuestionType'] == '' || $Data['QuestionType'] == null){
						$InsertStatus['Status'] = 0;
						$InsertStatus['Errors'][] = 'Error for question #'.$questionnumber.': Did not get question type';
					}
				}
			}else{
				$InsertStatus['Status'] = 0;
				$InsertStatus['Errors'][] = 'Cannot create assessment: No questions added';
			}

		}else{
			$InsertStatus['Status'] = 0;
			$InsertStatus['Errors'][] = validation_errors();
		}


		if($InsertStatus['Status'] == 0){
			foreach($InsertStatus['Errors'] as $errors){
				$errormessage .= $errors.'<br>';
			}	
			$this->session->set_flashdata('message',$errormessage);
			redirect('AssessmentBuilder');
		}else{

			$assesesment_info_status = $this->AssessmentModel->InsertAssessmentInfo($AssessmentData);
			foreach($QuestionData as $q_data){
				$q_data['AssessmentCode'] = $AssessmentData['AssessmentCode'];
				$assessment_question_status = $this->AssessmentModel->InsertAssessmentQuestion($q_data);
			}
			$this->session->set_flashdata('message','Successfully created Assessment! Assessment Code:'.$AssessmentData['AssessmentCode']);
			redirect('AssessmentBuilder');
		}
		//print_r($InsertStatus);
		
	}
	public function compare_startdates(){

		$startdate = $this->input->post('start_date');
		$enddate = $this->input->post('end_date');

		if($startdate <= $enddate){

			return TRUE;

		}else{

			$this->form_validation->set_message('compare_startdates', 'Start date must be lower than End date');
			return FALSE;

		}

	}
	public function compare_starttime(){

		$startdate = $this->input->post('start_date');
		$enddate = $this->input->post('end_date');
		$starttime = $this->input->post('start_time');
		$endtime = $this->input->post('end_time');

		if($startdate == $enddate){
			
			if(strtotime($starttime) <= strtotime($endtime)){

				return TRUE;
	
			}else{
	
				$this->form_validation->set_message('compare_starttime', 'Start time must be lower than End time');
				return FALSE;
	
			}

		}else{
			return TRUE;
		}

	}
	public function Ajax_get_rubrics_criteria(){

		$rubrics_id = $this->input->get_post('rubrics_id');
		$result = $this->Rubric->RubricsCriteria($rubrics_id);
		echo json_encode($result);
	}
	private function ProduceUniqueKey($limit=8){

		$code['draft'] = strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit));
		$stop = 0;
		//Check availability of code
		if(empty($this->AssessmentModel->CheckCodeAvailability($code))){

			$code['final'] = $code['draft'];
		

		}else{

			while($stop < 1){

				$code['draft'] = strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit));
				if(empty($this->AssessmentModel->CheckCodeAvailability($code))){
					$code['final'] = $code['draft'];
					$stop++;
				}

			}

		}
		return $code['final'];

	}
}
	