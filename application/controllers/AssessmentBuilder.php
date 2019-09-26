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

		$data = array(

			'Student_Number' => $this->student_data['Student_Number'],
			'AssessmentName' =>  '',
			'AssessmentDescription' => '',
			'RubricsID' => '',
			'QuestionData' => array()

		);
		$this->session->userdata('AssessmentBuilder_Session',$data);
		
	}
	public function Ajax_GetQuestion(){

		$data['QuestionType'] = $this->input->get_post('Type');
		$data['QuestionData'] = $this->input->get_post('Count');

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
		
		$AssessmentData = array(
			'AssessmentName' => $this->input->post('AssessmentName'),
			'AssessmentDescription' => $this->input->post('AssessmentDescription'),
			'RubricsID' => $this->input->post('Rubrics'),
		);
		$QuestionData = array();

		$choicearray = array('Choice_A','Choice_B','Choice_C','Choice_D');

		$Questions = $this->input->post('Question') ? $this->input->post('Question') : array();
		foreach($Questions as $key => $question){

			$QuestionData[$key]['Question'] = $question;

			if($this->input->post('choice['.$key.']')){
				$answer = $this->input->post('correct['.$key.']');
				$choices = $this->input->post('choice['.$key.']');
				foreach($choices as $key2 => $choice){
					$QuestionData[$key][$choicearray[$key2]] = $choice;
					$answerkey = $key2 + 1;
					if($answerkey == $answer){
						$QuestionData[$key]['Answer'] = $choice;
					}
				}
			}
			else{
				$QuestionData[$key]['Answer'] = $this->input->post('Answer['.$key.']');
			}


		}
		print_r($AssessmentData);
		echo '<br>';
		print_r($QuestionData);

	}
	
}
	