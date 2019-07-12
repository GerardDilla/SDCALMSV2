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
		  $this->student_data = $this->set_custom_session->student_session();

	}

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


    //Get Sections
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

	public function set_evaluation()
	{

		$this->template($this->set_views->Admin_Set_Evaluation());
     
	}


	
	
	
	
}
