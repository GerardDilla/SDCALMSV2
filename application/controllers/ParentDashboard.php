<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ParentDashboard extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library("Set_custom_session");
		  $this->student_data = $this->set_custom_session->student_session();

	}

	public function index()
	{
		//$this->load->view('welcome_message');
		$this->template($this->set_views->parent_dashboard());

	}
	
	
}
