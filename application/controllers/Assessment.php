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

		  //Sets Timezone for
		  date_default_timezone_set('Asia/Manila');

		  //Defines log date
		  $this->logdate = date("Y/m/d");

	}
	public function index()
	{
        $this->data['Assessment_List'] = $this->AssessmentModel->GetAssessmentList_Student($this->student_data);
		$this->template($this->set_views->assessmentlist());
		
	}
	public function PreAssessment($AssessmentCode = ''){
		
		$this->data['Assessment_Data'] = $this->AssessmentModel->GetAssessmentInfo(array('AssessmentCode' => $AssessmentCode));
		
		if($this->input->post('AssessmentCode')){

			$SessionStatus = $this->Initiate_ExamSession($this->data['Assessment_Data'][0]);
			if($SessionStatus['Status'] == 0){

				echo $SessionStatus['Message'];
				return;
			}else{
				redirect('Assessment/Examination');
			}

		}
		
		$this->template($this->set_views->preassessment());


	}
	private function Initiate_ExamSession($assessmentdata = array()){

		//Sets the return data
		$status = array(
			'Status' => 0,
			'Message' => ''
		);

		//Sets the needed data
		$now = new DateTime();
		
		$data = array(
			'AssessmentCode' => $assessmentdata['AssessmentCode'],
			'TimeStarted' => $now->format('Y-m-d g:i:s'),
			'Student_Number' => $this->student_data['Reference_Number'],
			'TimeEnd' => $now->modify('+'.$assessmentdata['Timelimit'].' minutes')->format('Y-m-d g:i:s')
		);

		//Check if needed data is pressent
		if(!$this->student_data['Reference_Number'] || !$assessmentdata['AssessmentCode']){

			$status = array(
				'Status' => 0,
				'Message' => 'Incomplete Data'
			);
			return $status;
		}

		//Check if assessment is still ongoing
		$assessment_status = $this->AssessmentModel->CheckAssessmentTime($data);
		if(!$assessment_status){

			$status = array(
				'Status' => 0,
				'Message' => 'This Asssessment is no longer available'
			);
			return $status;
		}

		//Check if theres an existing session
		$session_status = $this->AssessmentModel->CheckTimerSession($data);
		if(!$session_status){

			$this->AssessmentModel->TimeRecord($data);
			echo 'Inserted a new timer: ';
			
		}else{

			$timer_status = $this->AssessmentModel->CheckTimerDifference($data);
			echo 'Resumed existing timer: ';
			//If there is a result, time has expired
			if($timer_status[0]['Remaining'] <= 0){

				$status = array(
					'Status' => 0,
					'Message' => 'Assessment time has already expired'
				);
				return $status;

			}

		}
		echo ('<hr>'); 
		echo json_encode($data);
		echo ('<hr>');
		echo 'Exam initiated: '.$data['TimeStarted'];
		echo ('<hr>');
		echo 'Assessment Code: '.$assessmentdata['AssessmentCode'];
		echo ('<hr>');
		return $status;


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
	