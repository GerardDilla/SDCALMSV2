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
			'AssessmentName' =>  '';
			'AssessmentDescription' => '';
			'RubricsID' => '';
			'QuestionData' => array();

		);
		$this->session->userdata('AssessmentBuilder_Session',$data);
		
	}
	public function Ajax_GetQuestion(){
		$QuestionType = $this->input->get_post('Type');

		//echo json_encode($data);
		if($QuestionType == 1){

			echo $this->load->view('QuestionTypesBuilder/MultipleChoice','',true);

		}
		if($QuestionType == 2){

			echo $this->load->view('QuestionTypesBuilder/TrueOrFalse','',true);

		}
		if($QuestionType == 3){

			echo $this->load->view('QuestionTypesBuilder/Identification','',true);

		}
		if($QuestionType == 4){

			echo $this->load->view('QuestionTypesBuilder/Essay','',true);

		}else{

			echo '';

		}
	}
	
}
	