<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TeacherDashboard extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library("Set_custom_session");
		  $this->load->model('Grading');
		  $this->load->model("Legends");

		  //Gets Legends
		  $this->legends = $this->Legends->Get_Legends("Legends")[0];
		  
	}
	public function index()
	{
		$this->instructor_template($this->set_views->teacherdashboard());
		
	}
	
}
