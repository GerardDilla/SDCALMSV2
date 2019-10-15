<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Files extends MY_Controller {

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


	}
	public function index()
	{

		$this->template($this->set_views->filemanager());
	
	}


}
	