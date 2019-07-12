<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library('form_validation');
		  $this->load->library('Set_custom_session');
		  $this->load->model('Student_model/Student_login');
	}
	public function index()
	{
		
		$this->loginpage($this->set_views->registration());

	}


	
}
