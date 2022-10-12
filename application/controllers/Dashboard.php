<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	function __construct() 
	{
		parent::__construct();

		$this->load->library("set_views");
		$this->load->library("user_sessionhandler");
		$this->load->model('Grading');
		$this->load->model("Legends");
		$this->user_data = $this->user_sessionhandler->user_session(array('1'));

		$this->load->model('Dashboard_Model/Dashboard_Model');

		//Gets Legends
		$this->legends = $this->Legends->Get_Legends("Legends")[0];
		  
	}
	public function index()
	{
		
		$getStudentClasses = $this->Dashboard_Model->getStudentClasses(array(
			'student_number' => $this->session->userdata('LoginData')['Student_Number'],
			'sy' => $this->legends['School_Year'],
			'sem' => $this->legends['Semester']
		));
		$this->data['classes'] = $getStudentClasses;
		// echo date("H:i",strtotime('7:00PM'));
		// exit;
		// echo '<pre>'.print_r($getStudentClasses,1).'</pre>';exit;

		$this->template($this->set_views->dashboard());
		
	}
	public function getClasses(){
		$getStudentClasses = $this->Dashboard_Model->getStudentClasses(array(
			'student_number' => $this->session->userdata('LoginData')['Student_Number'],
			'sy' => $this->legends['School_Year'],
			'sem' => $this->legends['Semester']
		));
		$count = 0;
		foreach($getStudentClasses as $list){
			// $list['']
			$getStudentClasses[$count]['time_start'] = date("H:i:s",strtotime($list['time_start']));
			$getStudentClasses[$count]['time_end'] = date("H:i:s",strtotime($list['time_end']));
			$count++;
		}
		echo json_encode($getStudentClasses);
		// echo '<pre>'.print_r($getStudentClasses,1).'</pre>';exit;
	}
	
}
