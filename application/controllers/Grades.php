<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grades extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library("Set_custom_session");
		  $this->load->model('Grading');
		  $this->student_data = $this->set_custom_session->student_session();

	}
	public function index()
	{
		//$this->load->view('welcome_message');
		$this->data['SchoolYear_List'] = $this->Grading->Get_Grading_SchoolYear($this->student_data);
		$this->data['Semester_List'] = $this->Grading->Get_Grading_Semester($this->student_data);
		$this->template($this->set_views->grade());
		
	}
	
}
