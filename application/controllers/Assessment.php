<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Assessment extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library('form_validation');
		  $this->load->library("Set_custom_session");
		  //load file helper
		  $this->load->helper('file');
		  $this->student_data = $this->set_custom_session->student_session();

		  $this->load->model('AssessmentModel');

		  //Defines log date
		  $this->logdate = date("Y/m/d");

		  $this->sectionlimit = 5;

		  
		  
	}
	public function index()
	{
        $this->data['Assessment_List'] = $this->AssessmentModel->GetAssessmentList_Student($this->student_data);
		$this->template($this->set_views->assessmentlist());
		
	}
	public function PreAssessment($AssessmentCode = ''){
		
		$this->data['Assessment_Data'] = $this->AssessmentModel->GetAssessmentInfo(array('AssessmentCode' => $AssessmentCode));
		$this->template($this->set_views->preassessment());
	}
	public function Examination(){

		$AssessmentCode = $this->input->post('AssessmentCode');
		$this->session->set_userdata('AssessmentCode',$AssessmentCode);
		$this->display_assessment();
			

	}
	private function display_assessment(){

		$this->data['AssessmentData'] = $this->AssessmentModel->GetAssessmentLayout(array('AssessmentCode' => $this->session->userdata('AssessmentCode')));
		$this->data['AssessmentQuestions'] = array();
		$count = 0; 
		$questiondata = array();
		foreach($this->data['AssessmentData'] as $question){

			$questiondata = array(
				'Data' => $question,
				'Number' => $count + 1
			);

			$this->data['AssessmentQuestions'][$count] = $this->get_question_format($questiondata);
			$count++;
		}
		
		$this->assessmentpage($this->set_views->examination());

	}
	private function get_question_format($questiondata){

		//echo json_encode($data);
		if($questiondata['Data']['QuestionTypeID'] == 1){

			return $this->load->view('QuestionTypes/MultipleChoice',$questiondata,true);

		}
		if($questiondata['Data']['QuestionTypeID'] == 2){

			return $this->load->view('QuestionTypes/TrueOrFalse',$questiondata,true);

		}
		if($questiondata['Data']['QuestionTypeID'] == 3){

			return $this->load->view('QuestionTypes/Identification',$questiondata,true);

		}
		if($questiondata['Data']['QuestionTypeID'] == 4){

			return $this->load->view('QuestionTypes/Essay',$questiondata,true);

		}else{

			return '';

		}

	}
}
	