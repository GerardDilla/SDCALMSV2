<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Faculty extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library("Set_custom_session");
		  $this->load->model('Student_model/Student_info');
		  $this->load->model('Admin_Faculty_Evaluation_Model/Search_Student_Model');
		  $this->load->model('Admin_Faculty_Evaluation_Model/Prof_Search_Model');
		  $this->load->model('Admin_Faculty_Evaluation_Model/Proffesor_Model');
		  $this->student_data = $this->set_custom_session->student_session();

	}
/// SEARCH STUDENTS  MOUDLE
	public function Search_Student()
	{
		$this->data['get_sy']          = $this->Search_Student_Model->Get_sy();
		$this->data['get_sem']         = $this->Search_Student_Model->Get_sem();
		$this->data['get_course']      = $this->Search_Student_Model->Get_course();
		$this->data['get_yrlvl']       = $this->Search_Student_Model->Get_year();
		$this->template($this->set_views->Admin_Faculty());
     
	}

	//Get Sections
	function fetch_sections()
	{
	     if($this->input->post('Program_id'))
        	{
				$resultdata = $this->Search_Student_Model->GetSection_Name($this->input->post('Program_id'));
				echo json_encode($resultdata);
	       }
	}

  // GET STUDENTS WHO EVALUATE
	function fetch_students()
	{
	       $array = array(
			 'sy'         => $this->input->get('sy'),
			 'sem'        => $this->input->get('sem'),
			 'Program'    => $this->input->get('Program'),
			 'Section'    => $this->input->get('Section'),
			 'YearLevel'  => $this->input->get('YearLevel')
		   );
		   
			$resultdata = $this->Search_Student_Model->Get_Students($array);
			echo json_encode($resultdata);
	}
  // GET STUDENTS WHO NOT EVALUATE
	function fetch_studentsNon()
	{
	       $array = array(
			 'sy'         => $this->input->get('sy'),
			 'sem'        => $this->input->get('sem'),
			 'Program'    => $this->input->get('Program'),
			 'Section'    => $this->input->get('Section'),
			 'YearLevel'  => $this->input->get('YearLevel')
		   );
		   
			$resultdata = $this->Search_Student_Model->Get_StudentsNotDone($array);
			echo json_encode($resultdata);
	}

/// SEARCH PROFFESOR  MOUDLE

	public function Prof_Search()
	{
		$this->data['get_sy']                 = $this->Prof_Search_Model->Get_sy();
		$this->data['get_sem']                = $this->Prof_Search_Model->Get_sem();
		$this->template($this->set_views->Admin_Search_Prof());
     
	}

	///GET PROFFESOR
	function fetch_proff()
	{
	       $array = array(
			 'sy'         => $this->input->get('sy'),
			 'sem'        => $this->input->get('sem')
		   );
		   
			$resultdata = $this->Prof_Search_Model->Get_Instructor($array);
			echo json_encode($resultdata);
	} 

	///GET Course Title
	function fetch_course_title()
	{
		$array = array(
			'sy'             => $this->input->get('sy'),
			'sem'            => $this->input->get('sem'),
			'proffesor'      => $this->input->get('proffesor')
		  );
		
		$resultdata = $this->Prof_Search_Model->Get_CourseTitle($array);
		echo json_encode($resultdata);
	} 



	///GET Students Who Evaluate this Proff
	function fetch_students_proff()
	{
			$array = array(
				'sy'             => $this->input->get('sy'),
				'sem'            => $this->input->get('sem'),
				'proffesor'      => $this->input->get('proffesor'),
				'sched_code'     => $this->input->get('Course_Title'),
				'Section'        => $this->input->get('Section')
			  );
			
			$resultdata = $this->Prof_Search_Model->Get_Students($array);
			echo json_encode($resultdata);
	} 


		///GET Students Who not Done Evaluate this Proff
		function fetch_nonstudents_proff()
		{
				$array = array(
					'sy'             => $this->input->get('sy'),
					'sem'            => $this->input->get('sem'),
					'proffesor'      => $this->input->get('proffesor'),
					'sched_code'     => $this->input->get('Course_Title'),
					'Section'        => $this->input->get('Section')
				  );
				
				$resultdata = $this->Prof_Search_Model->Get_StudentsNotDone($array);
				echo json_encode($resultdata);
		} 
		
	///Professor Active or De active Module

	public function Professor()
	{

		$this->template($this->set_views->Admin_Professor());
     
	}


	function fetch_professor()
	{
					
			$resultdata = $this->Proffesor_Model->Get_Prof();
			echo json_encode($resultdata);
	} 
	


	public function set_evaluation()
	{

		$this->template($this->set_views->Admin_Set_Evaluation());
     
	}






	
	
	
	
}
