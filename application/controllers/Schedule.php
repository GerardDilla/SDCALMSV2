<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library("user_sessionhandler");
		  $this->load->model('Grading');
		  $this->load->model("Legends");
		  $this->student_data = $this->user_sessionhandler->user_session();

		  //Gets Legends
		  $this->legends = $this->Legends->Get_Legends("Legends")[0];
		  
	}
	public function index()
	{
		//$this->load->view('welcome_message');
		$this->data['SchoolYear_List'] = $this->Grading->Get_Grading_SchoolYear($this->student_data);
		$this->data['Semester_List'] = $this->Grading->Get_Grading_Semester($this->student_data);
		$this->template($this->set_views->schedule());
		
	}
	
}
