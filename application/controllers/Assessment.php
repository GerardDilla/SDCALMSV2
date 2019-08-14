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

		  $this->load->model('PortfolioModel');

		  //Defines log date
		  $this->logdate = date("Y/m/d");

		  $this->sectionlimit = 5;

		  
		  
	}
	public function index()
	{

		$this->template($this->set_views->assessmentlist());
		
	}
}
	