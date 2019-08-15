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

		$Assessment_Code = $this->input->post('AssessmentCode');
		$this->display_assessment($Assessment_Code);
			

	}
	private function display_assessment($Assessment_Code){

		echo $Assessment_Code;
		$this->assessmentpage($this->set_views->examination());

	}
}
	