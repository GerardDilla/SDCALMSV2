<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grades extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library("user_sessionhandler");
		  $this->load->model('Grading');
		  $this->load->model("Legends");
		  $this->load->model('API/Balance');
		  $this->student_data = $this->user_sessionhandler->user_session();

		  $this->data['Page_icon'] = 'fa-tasks';
		  $this->data['Page_title'] = 'Grades';
		  

		  //Gets Legends
		  $this->legends = $this->Legends->Get_Legends("Legends")[0];
		  
	}
	public function index()
	{
		$PreviousBalance = $this->Get_previous_balance();
		if($PreviousBalance > 1){

			$this->data['ErrorMessage'] = '

			To view your grades, you must settle your remaining balance of <u>'.$PreviousBalance.'</u>.
			<br><br>
			Click <a href="'.base_url().'index.php/Balance">Here</a> to view your balance, proceed to the Accounting office for more information.
			
			';

			$this->template($this->set_views->error());
			return;

		}

		//$this->load->view('welcome_message');
		$this->data['SchoolYear_List'] = $this->Grading->Get_Grading_SchoolYear($this->student_data);
		$this->data['Semester_List'] = $this->Grading->Get_Grading_Semester($this->student_data);
		$this->template($this->set_views->grade());
		
		
	}
	private function Get_previous_balance(){

		$array['Reference_Number'] = $this->student_data['Reference_Number'];
		$outstanding = $this->Balance->getOutstandingbal($array);
		$totalpaid = $this->Balance->gettotalpaid($array);

		//Total of all Balance and Payments since enrolled
		$data['Overall_Fees'] = $outstanding[0]['Fees'];
		$data['Overall_Paid'] = $totalpaid[0]['AmountofPayment'];

		//Overall Outstanding Balance
		$outstanding_balance = number_format((float)$outstanding[0]['Fees'] - $totalpaid[0]['AmountofPayment'], 2, '.', '');
		return $data['Overall_Fees'] <= $data['Overall_Paid'] ? 0.00 : $outstanding_balance;
		

	}
	
}
