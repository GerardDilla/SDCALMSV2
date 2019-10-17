<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();
		  
		  $this->load->library("set_views");
		  $this->load->library("User_sessionhandler");
		  $this->load->model('Report/Model_Class_List');
		  $this->user_data = $this->user_sessionhandler->user_session();

	}

	
	public function Class_List()
	{   
	    $sc  = 	$this->input->post('Section');
		$this->data['get_legend']         = $this->Model_Class_List->Get_legend();
		$this->data['get_schoolyear']     = $this->Model_Class_List->Get_Year();
		$this->data['get_classlist']      = $this->Model_Class_List->get_class_list($sc);
		$this->template($this->set_views->report_class_list());
     
	}

	//Get Sections
	function fetch_sections()
	{
		$array = array(
			'sy'         => $this->input->get('sy'),
			'sem'        => $this->input->get('sem'),
			'Prof'       => $this->user_data['Instructor_Unique_ID'],//ID NG PROF
		  );
		  
		   $resultdata = $this->Model_Class_List->Get_CourseTitle($array);
		   echo json_encode($resultdata);
	}
	

	
}
