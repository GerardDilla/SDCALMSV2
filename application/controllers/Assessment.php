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
		$this->template($this->set_views->preassessment());


	}
	public function ExamStart(){

		$AssessmentCode = $this->input->post('AssessmentCode');
		if(!$AssessmentCode){
			redirect('Assessment');
		}
		$this->data['Assessment_Data'] = $this->AssessmentModel->GetAssessmentInfo(array('AssessmentCode' => $AssessmentCode));
		$status = $this->Initiate_ExamSession($this->data['Assessment_Data']);

		if($status['Status'] == 0){

			$this->session->set_flashdata('message',$status['Message']);
			redirect('Assessment/PreAssessment/'.$AssessmentCode);

		}else{

			redirect('Assessment/Examination/'.$AssessmentCode);

		}

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
			'AssessmentCode' => $assessmentdata[0]['AssessmentCode'],
			'TimeStarted' => $now->format('Y-m-d g:i:s'),
			'Student_Number' => $this->student_data['Student_Number'],
			'TimeEnd' => $now->modify('+'.$assessmentdata[0]['Timelimit'].' minutes')->format('Y-m-d g:i:s')
		);

		//print_r($data);
		//Check if needed data is present
		if(!$data['Student_Number'] || !$data['AssessmentCode']){

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

		//Check if already answered
		$AnswerStatus = $this->AssessmentModel->CheckAnswers($data);
		if($AnswerStatus){

			$status = array(
				'Status' => 0,
				'Message' => 'You already answered this Assessment'
			);
			return $status;
			

		}

		//Check if theres an existing session
		$session_status = $this->AssessmentModel->CheckTimerSession($data);
		if(!$session_status){

			$status = array(
				'Status' => 1
			);
			$this->AssessmentModel->TimeRecord($data);
			
		}else{

			$timer_status = $this->AssessmentModel->CheckTimerDifference($data);
			//If there is a result, time has expired
			if($timer_status[0]['Remaining'] <= 0){

				$status = array(
					'Status' => 0,
					'Message' => 'Assessment time has already expired'
				);
				return $status;

			}

		}
		$status = array(
			'Status' => 1
		);
		/*
		echo ('<hr>'); 
		echo json_encode($data);
		echo ('<hr>');
		echo 'Exam initiated: '.$data['TimeStarted'];
		echo ('<hr>');
		echo 'Assessment Code: '.$data['AssessmentCode'];
		echo ('<hr>');
		*/
		return $status;


	}
	public function Examination($Assessment_Code = ''){

		//$this->student_data;
		if($Assessment_Code == ''){

			redirect('Assessment');

		}

		$this->data['Session'] = $this->check_exam_session($Assessment_Code);
		if($this->data['Session']['Status'] == 0){

			$this->session->set_flashdata('message',$this->data['Session']['Message']);
			echo $Assessment_Code;
			redirect('Assessment/PreAssessment/'.$Assessment_Code);

		}
		//print_r($this->data['Session']);
		$this->display_assessment($Assessment_Code);
			

	}
	public function SubmitAssessment(){

		//Initialize Needed Data
		$AssessmentCode = $this->input->post('AssessmentCode');
		$AssessmentData = $this->AssessmentModel->GetAssessmentLayout(array('AssessmentCode' => $AssessmentCode));
		$AssessmentStats = array(

			'Score' => 0,
			'QuestionCount' => 0,
			'AnswersCount' => 0,
			'CorrectCount' => 0

		);
		$data = array(
			'Student_Number' => $this->student_data['Student_Number'],
			'AssessmentCode' => $AssessmentCode
		);

		//Check if already answered
		$AnswerStatus = $this->AssessmentModel->CheckAnswers($data);
		if($AnswerStatus){

			$this->session->set_flashdata('message','You already answered this Assessment');
			redirect('Assessment/PreAssessment/'.$AssessmentCode);

		}

		//Check and Record individual Answers
		foreach($AssessmentData as $row){


			$data['QuestionID'] = $row['QuestionID'];
			$data['Answer'] = $this->input->post($row['QuestionID']) == '' ? null : $this->input->post($row['QuestionID']);
			$data['Correct'] = $this->compare_answer($data['Answer'],$row['Answer']);
			$AssessmentStats['QuestionCount']++;
			
			if($data['Correct'] == 1){
				$AssessmentStats['Score'] = $AssessmentStats['Score'] + $row['Points'];
				$AssessmentStats['CorrectCount']++;
			}

			if($data['Answer'] != null){
				$AssessmentStats['AnswersCount']++;;
			}

			$this->AssessmentModel->SubmitAnswer($data);
			print_r($data);
			echo '<br>Correct Answer: '.$row['Answer'];
			echo '<hr>';
		}

		//Record this session
		$RespondentData = array(
			'AssessmentCode' => $data['AssessmentCode'],
			'Student_Number' => $data['Student_Number'],
			'RespondentName' => $this->student_data['Full_Name'],
			'Score' => $AssessmentStats['Score'],
		);
		$RespondenStatus = $this->AssessmentModel->InsertRespondent($RespondentData);

		if($RespondenStatus == TRUE){

			$this->session->set_flashdata('message','You\'ve Finished the Assessment!');
			redirect('Assessment/PreAssessment/'.$data['AssessmentCode']);

		}else{

			$this->session->set_flashdata('message','An Error Occured: Failed to save Respondent');
			redirect('Assessment/PreAssessment/'.$data['AssessmentCode']);

		}

		/*
		$this->data['AnswerStats'] = $this->compute_score($AssessmentStats);
		print_r($AssessmentStats);
		echo '<br>';
		print_r($this->data['AnswerStats']);
		*/
		/*
		echo '<hr>';
		echo 'Total Question:'.$AssessmentStats['QuestionCount'];
		echo '<br>Total Answers:'.$AssessmentStats['AnswersCount'];
		echo '<br>Correct Answers:'.$AssessmentStats['CorrectCount'];
		echo '<br>Total Points:'.$AssessmentStats['Score'];
		echo '<hr><hr>';
		*/

	}
	private function check_exam_session($AssessmentCode){

		//Sets the return data
		$status = array(
			'Status' => 0,
			'Message' => ''
		);

		//Check if Assessment Code is valid
		$AsssessmentData = $this->AssessmentModel->GetAssessmentInfo(array('AssessmentCode' => $AssessmentCode));
		if(!$AsssessmentData){

			$status = array(
				'Status' => 0,
				'Message' => 'Invalid Assessment Code'
			);
			return $status;

		}

		//Set Needed data
		$now = new DateTime();
		$data = array(
			
			'AssessmentCode' => $AsssessmentData[0]['AssessmentCode'],
			'TimeStarted' => $now->format('Y-m-d g:i:s'),
			'Student_Number' => $this->student_data['Student_Number']

		);
		
		//Check if needed data is present
		if(!$data['Student_Number'] || !$data['AssessmentCode']){

			$status = array(
				'Status' => 0,
				'Message' => 'Incomplete Data'
			);
			return $status;
		}

		//Check if Theres an active session
		$SessionStatus = $this->AssessmentModel->CheckTimerDifference($data);
		if(!$SessionStatus){

			$status = array(
				'Status' => 0,
				'Message' => 'You have no Active session of this Assessment'
			);
			return $status;

		}

		//Check if already answered
		$AnswerStatus = $this->AssessmentModel->CheckAnswers($data);
		if($AnswerStatus){

			$status = array(
				'Status' => 0,
				'Message' => 'You already answered this Assessment'
			);
			return $status;

		}

		//Check if time ran out
		if($SessionStatus[0]['Remaining'] <= 0){

			$status = array(
				'Status' => 0,
				'Message' => 'Your session has already Expired'
			);
			return $status;

		}

		$status = array(
			'Status' => 1,
			'Message' => '',
			'Timeleft' => $SessionStatus[0]['Remaining']
		);
		return $status;



	}
	private function display_assessment($AssessmentCode){

		$this->data['AssessmentData'] = $this->AssessmentModel->GetAssessmentLayout(array('AssessmentCode' => $AssessmentCode));
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
		$this->data['TotalQuestions'] = $count;
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
	private function compare_answer($answer = '',$correct = ''){

	
		$Answer = trim(strtoupper($answer));
		$CorrectAnswer = trim(strtoupper($correct));

		if($Answer == $CorrectAnswer){

			return 1;

		}else{

			return 0;

		}
		
	}
	private function compute_score($AssessmentStats){

		$data = array(

			'CorrectPercentage' => 0,
			'AnswerPercentage' => 0

		);

		$data['CorrectPercentage'] = number_format((float)$AssessmentStats['CorrectCount'] / $AssessmentStats['AnswersCount'] * 100,2,'.','');

		$data['AnswerPercentage'] = number_format((float)$AssessmentStats['AnswersCount'] / $AssessmentStats['QuestionCount'] * 100,2,'.','');

		return $data;

	}
	private function RecordRespondent(){



	}
}
	