<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends MY_Controller {

	function __construct() 
	{
		parent::__construct();

		$this->load->library("set_views");
		$this->load->library('form_validation');
		$this->load->library("user_sessionhandler");
		//load file helper
		$this->load->helper('file');
		$this->user_data = $this->user_sessionhandler->user_session();

		$this->load->model("Legends");
		$this->load->model('AssessmentModel');
		$this->load->model("Courseware");
		$this->load->model("API/Grading");
		$this->load->model("API/Schedule");

		//Sets Timezone for
		date_default_timezone_set('Asia/Manila');

		//Defines log date
		$this->now = new DateTime();
		$this->logdatetime =  $this->now->format('Y-m-d H:i:s');
		$this->logdate = date("Y/m/d");

		//Defines the token needed for attachments to function properly
		if($this->user_data['UserType'] == '1'){
			$this->data['Usertype'] = 'student';
			$this->data['Usertoken'] = md5($this->user_data['Student_Number']); 
		}
		else if($this->user_data['UserType'] == '2'){
			$this->data['Usertype'] = 'instructor';
			$this->data['Usertoken'] = md5($this->user_data['Instructor_Unique_ID']); 
		}

		$this->randcolors = array(
			0 => 'C7B540',
			1 => 'A3B0BC',
			2 => '979E92',
			3 => '404357', 
			4 => 'E91E63', 
			5 => '2196F3', 
			6 => '4caf50'
		);


	}
	public function index($SchedCode = '')
	{

		if($SchedCode == ''){

			$this->courselist();
		
		}else{
			//echo $this->input->post('Post');
			if($this->input->post('Post')){

				$poststatus = $this->CoursePost($SchedCode);
				echo $poststatus['Message'];
				if($poststatus['Status'] == 1){
					//echo $poststatus['Message'];
					redirect('Course/index/'.$SchedCode.'/test');
				}
				$this->coursefeed($SchedCode);

			}else{

				$this->coursefeed($SchedCode);

			}
		}

	}
	public function Ajax_get_assessments(){

		//Temporary. Should be in teacher's side
		echo json_encode($this->AssessmentModel->Get_Assessment_List(array('Instructor_ID' => $this->user_data['Instructor_Unique_ID'])));

	}
	private function CoursePost($SchedCode){

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('Post','Organization Name', 'required|max_length[300]');

		$AttachmentTypeArray = $this->input->post('AttachmentType');
		$AttachmentValueArray = $this->input->post('AttachmentValue');
		$FileAttachments = $this->input->post('File_ID');
		$attachment_error_status = 0;
		if(isset($AttachmentTypeArray)){
			foreach($AttachmentTypeArray as $key => $typeID){
				if($typeID == ''){
					$attachment_error_status = 1;
				}
			}
		}
		if(isset($AttachmentValueArray)){
			foreach($AttachmentValueArray as $key1 => $AttchValue){
				if($AttchValue == ''){
					$attachment_error_status = 1;
				}
			}
		}
		if(isset($FileAttachments)){
			foreach($FileAttachments as $key2 => $AttchFileVal){
				if($AttchFileVal == ''){
					$attachment_error_status = 1;
				}
			}
		}
		//Validate if Title input is given
		if($this->form_validation->run() == FALSE) {

			$result['Status'] = 0;
			$result['Message'] = validation_errors();

		}
		else if($attachment_error_status == 1){

			$result['Status'] = 0;
			$result['Message'] = 'Error in uploading attachment(s)';

		}
		else{

			$array = array(
				'Student_Number' => $this->user_data['Student_Number'] ? $this->user_data['Student_Number'] : null,
				'Instructor_ID' => $this->user_data['Instructor_Unique_ID'] ? $this->user_data['Instructor_Unique_ID'] : null,
				'SchedCode' => $SchedCode,
				'Description' => $this->input->post('Post'),
				'Date' => $this->logdatetime,
			);
			$post_status = $this->Courseware->insert_post($array);
			if($post_status){
	
				$result['Status'] = 1;
				$result['Message'] = 'Posting Successful!';

				$attachment_array = array();
				if(isset($AttachmentTypeArray) && isset($AttachmentValueArray)){

					$attachment_insert_status = 0;
					$assessment_duplicate_check = '';
					$attachment_array = array(
						'PostID' => $post_status,
					);
					foreach($AttachmentTypeArray as $index => $AttachType){

						//IF Attachment Type is an Assessment
						if($AttachType == 1){
							if($assessment_duplicate_check != $AttachmentValueArray[$index]){
								$attachment_array['AssessmentCode'] = $AttachmentValueArray[$index];
								$assessment_status = $this->Courseware->attach_assessment($attachment_array);
								$assessment_duplicate_check = $AttachmentValueArray[$index];
								$attachment_insert_status = 1;
							}
						}
						//-----
					}
					
					if($attachment_insert_status == 0){

						$result['Status'] = 0;
						$result['Message'] = 'Posting Successful but failed on attachment';

					}else{

						$result['Status'] = 1;
						$result['Message'] = 'Posting Successful with attachment!';

					}
					


				}

				if(isset($FileAttachments)){

					foreach($FileAttachments as $index2 => $AttachFile){

						$array = array(
							'PostID' => $post_status,
							'AttachmentType' => $AttachFile
						);
						$this->Courseware->attach_file($array);
						
					}
				}

			}else{

				$result['Status'] = 0;	
				$result['Message'] = 'An Error occured: Posting';

			}

		}
		//echo json_encode($result);
		return $result;

	}
	private function courselist(){

		if($this->user_data['UserType'] == 1){
			$this->data['Subjects'] = $this->construct_course_output();
		}
		else if($this->user_data['UserType'] == 2){
			$this->data['Subjects'] = $this->instructor_construct_course_output();
		}
		//$this->data['Assessment_List'] = $this->AssessmentModel->GetAssessmentList_Student($this->user_data);
		$this->template($this->set_views->courselist());

	}
	private function coursefeed($SchedCode){

		$this->data['SchedData'] = $this->Schedule->Get_sched_info($SchedCode);
		$this->data['CourseFeed'] = $this->contruct_course_feed($SchedCode);
		$this->template($this->set_views->coursewall());

	}
	private function construct_course_output(){

		$output = array();
		$count = 0;
		$legend = $this->Legends->Get_Legends();
		$array = array(
			'Student_Number' => $this->user_data['Student_Number'],
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
	private function instructor_construct_course_output(){

		$output = array();
		$count = 0;
		$legend = $this->Legends->Get_Legends();
		$array = array(
			'Instructor_ID' => $this->user_data['Instructor_Unique_ID'],
			'School_Year' => $legend[0]['School_Year'],
			'Semester' => $legend[0]['Semester']
		);
		$subjects = $this->Grading->Get_Subject_Load($array);
		foreach($subjects as $row){

			$output[$count]['Sched_Code'] = $row['Sched_Code'];
			$output[$count]['Course_Title'] = $row['Course_Title'];
			$output[$count]['Course_Code'] = $row['Course_Code'];

			$sched_info = $this->Schedule->Get_sched_info($row['Sched_Code']);
			if($sched_info){
				$output[$count]['Instructor_Name'] = $sched_info[0]['Instructor_Name'];
			}
			$count++;
		}
		return $output;

	}
	private function contruct_course_feed($SchedCode = '', $ajax = ''){

		$output = array();
		$months = array();
		$postview = array();
		$count = 0;
		$monthcheck = '';
		$array = array(
			'SchedCode' => $SchedCode,
			'CurrentDate' => $this->logdatetime
		);
		$posts = $this->Courseware->GetCoursePosts($array);
		foreach($posts as $row){

			if($row['Month'] != $monthcheck){
				$months[$count] = $row['Month'];
				$monthcheck = $row['Month'];
			}
			$row['Attachments'] = $this->get_attachments($row['CoursePost_ID']);
			$row['FileAttachments'] = $this->get_file_attachments($row['CoursePost_ID']);
			$postview[$row['Month']][$count] = $this->load->view('PostTypes/Standard',$row,TRUE);
			$count++;
		}
		$output = array(
			'Months' => $months,
			'Posts' => $postview,
		);
		if($ajax == 1){
			echo json_encode($output);
			return;
		}
		return $output;

	}
	private function get_attachments($postID){

		$result = array(
			'Status' => 0,
			'Assessment' => array(),
			'PostID' => $postID
		);
		$assessments = $this->Courseware->get_assessment_attachments($result);
		if($assessments){

			$result['Status'] = 1;
			$result['Assessment'] = $assessments;

		}
		return $result;

	}
	private function get_file_attachments($postID){

		$result = array(
			'Status' => 0,
			'Files' => array(),
			'PostID' => $postID
		);
		$files = $this->Courseware->get_file_attachments($result);
		if($files){

			$result['Status'] = 1;
			$result['Files'] = $files;

		}
		return $result;

	}


}
	