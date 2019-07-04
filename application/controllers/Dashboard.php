<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library("Set_custom_session");
		  $this->load->model('Grading');
		  $this->load->model("Legends");
		  $this->student_data = $this->set_custom_session->student_session();

		  //Gets Legends
		  $this->legends = $this->Legends->Get_Legends("Legends")[0];
		  
	}
	public function index()
	{
		
		$this->template($this->set_views->dashboard());
		
	}
	
}
