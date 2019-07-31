<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grades extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library("Set_custom_session");
		  $this->load->model('Grading');
		  $this->load->model("Legends");
		  $this->student_data = $this->set_custom_session->student_session();

		  $this->data['Page_icon'] = 'fa-tasks';
		  $this->data['Page_title'] = 'Grades';
		  

		  //Gets Legends
		  $this->legends = $this->Legends->Get_Legends("Legends")[0];
		  
	}
	public function index()
	{
		$this->data['ErrorMessage'] = '

		To view your grades, you must settle your remaining balance.
		<br><br>
		Click <a href="'.base_url().'index.php/Balance">Here</a> to view your balance, proceed to the Accounting office for more information.
		
		';
		//$this->load->view('welcome_message');
		$this->data['SchoolYear_List'] = $this->Grading->Get_Grading_SchoolYear($this->student_data);
		$this->data['Semester_List'] = $this->Grading->Get_Grading_Semester($this->student_data);

		$this->template($this->set_views->error());
		
	}
	private function Get_previous_balance(){

		

	}
	
}
