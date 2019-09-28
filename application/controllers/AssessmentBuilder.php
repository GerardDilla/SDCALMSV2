<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AssessmentBuilder extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library('form_validation');
		  $this->load->library("Set_custom_session");
		  //load file helper
		  $this->load->helper('file');
		  $this->student_data = $this->set_custom_session->student_session();
		  $this->teacher_data = array();
		  $this->load->model('AssessmentModel');

		  //Sets Timezone for
		  date_default_timezone_set('Asia/Manila');

		  //Defines log date
		  $this->logdate = date("Y/m/d");

	}
	public function index()
	{
		//$this->data['Assessment_List'] = $this->AssessmentModel->GetAssessmentList_Student($this->student_data);
		$this->template($this->set_views->assesssment_builder());
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
			)
		);
		
		$this->form_validation->set_rules($config);
		
		if($this->form_validation->run() == TRUE){

			//Gets the general info of Assessment and store to array for inserting
			$AssessmentData = array(
				'AssessmentName' => $this->input->post('AssessmentName'),
				'AssessmentDescription' => $this->input->post('AssessmentDescription'),
				'RubricsID' => $this->input->post('Rubrics'),
			);

			foreach($QuestionData as $i => $Data){

				$questionnumber = $i + 1;
				if($Data['Question'] == '' || $Data['Question'] == null){
					$InsertStatus['Status'] = 0;
					$InsertStatus['Errors'][] = 'No question given for Question #'.$questionnumber;
				}
				if($Data['Answer'] == '' || $Data['Answer'] == null){
					$InsertStatus['Status'] = 0;
					$InsertStatus['Errors'][] = 'No answer given for Question #'.$questionnumber;
				}
				if($Data['Points'] == '' || $Data['Points'] == null){
					$InsertStatus['Status'] = 0;
					$InsertStatus['Errors'][] = 'No points given for Question #'.$questionnumber;
				}
				if($Data['QuestionType'] == '' || $Data['QuestionType'] == null){
					$InsertStatus['Status'] = 0;
					$InsertStatus['Errors'][] = 'Error for question #'.$questionnumber.': Did not get question type';
				}
			}

		}else{
			$InsertStatus['Status'] = 0;
			$InsertStatus['Errors'][] = validation_errors();
		}


		if($InsertStatus['Status'] == 0){
			foreach($InsertStatus['Errors'] as $errors){
				echo '<hr>'.$errors;
			}
		}
		echo json_encode($AssessmentData);
		echo '<br>';
		echo json_encode($QuestionData);

	}
	
}
	