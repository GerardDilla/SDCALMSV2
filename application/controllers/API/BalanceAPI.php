<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BalanceAPI extends CI_Controller {

	function __construct() 
	{

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE, OPTIONS');
		header('Access-Control-Request-Headers: Content-Type');
		
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library("api_input_validator");
		$this->load->model("API/Grading");
		$this->load->model("Student_model/Student_info");
		$this->load->model('API/Balance');


		//ONLY USE THE FOLLOWING INDEXES
		$this->data_output = array(
			'Error' => 0,
			'ResultCount' => 0,
			'Output' => '',
			'Message' => '',
			'Message_Array' => array(),
			'ErrorMessage' => '',
			'ErrorMessage_Array' => array()
		);

	}
	public function index()
	{

		$Value = array(
			array(
				'field' => 'Reference_Number',
				'label' => 'Reference Number',
				'rules' => 'required',
				'value' => $this->input->get('Reference_Number')
			),
			array(
				'field' => 'School_Year',
				'label' => 'School Year',
				'value' => $this->input->get('School_Year')
			),
			array(
				'field' => 'Semester',
				'label' => 'Semester',
				'value' => $this->input->get('Semester')
			)
		);
		$validate = $this->api_input_validator->validate_input($Value);
		if($validate['Status'] == TRUE){

			$input_array = array(

				'Reference_Number' => $this->input->get('Reference_Number'),
				'School_Year' => $this->input->get('School_Year'),
				'Semester' => $this->input->get('Semester')

			);

			//Validates Encrypted Reference Number
			$input_array['Student_Number'] = $this->validate_reference_number($input_array);
			
			//Gets and Displays Balance
			$this->
			($input_array);

			$this->Output($this->data_output);
		}
		else{

			$this->data_output['Error'] = 1;
			$this->data_output['ErrorMessage'] = $validate['All_Errors'];
			$this->data_output['ErrorMessage_Array'] = $validate['Error'];
			$this->Output($this->data_output);
			
		}

	}
	private function balance_constructor($input_array){

		
		$TotalAndPaid = $this->Balance->GetTotalAndPaid($input_array);
		//echo json_encode($TotalAndPaid);

		$outstanding = $this->Balance->getOutstandingbal($input_array);
		$totalpaid = $this->Balance->gettotalpaid($input_array);
		$sembalance = $this->Balance->semestralbalance($input_array);
		$totalpaidsem = $this->Balance->gettotalpaidsemester($input_array);
		
		//Total of all Balance and Payments since enrolled
		$data['Overall_Fees'] = $TotalAndPaid[0]['TOTAL'];
		$data['Overall_Discount'] = $outstanding[0]['Discounts'];
		$data['Overall_Paid'] = $TotalAndPaid[0]['PAID'];


		//Semestral Balance Based on Chosen SY and Sem
		$data['Semestral_Balance'] = number_format((float)$sembalance[0]['Fees'], 2, '.', '');
		$data['Semestral_Discount'] = number_format((float)$sembalance[0]['discount'], 2, '.', '');
		$data['Semestral_Paid'] = number_format((float)$totalpaidsem[0]['AmountofPayment'], 2, '.', '');
		$data['Semestral_Total'] = number_format((float)$sembalance[0]['Fees'] - $totalpaidsem[0]['AmountofPayment'], 2, '.', '');

		//Outstanding balance excluding balance of chosen semester and schoolyear
		$data['Total_Paid_SemSy_Excluded'] = number_format((float)$data['Overall_Fees'] - $data['Overall_Paid'], 2, '.', '');
		$data['Total_Discount_SemSy_Excluded'] = number_format((float)$data['Overall_Discount'] - $data['Semestral_Discount'],2,'.','');
		$semestral_balance = number_format((float)$data['Overall_Fees'] - $data['Overall_Paid'] - $data['Semestral_Total'] - $data['Total_Discount_SemSy_Excluded'], 2, '.', '');
		$data['Outstanding_Balance_SemSy_Excluded'] = number_format((float)$semestral_balance <= 0 ? 0.00 : $semestral_balance, 2, '.', '');

		//Upon Registration, Prelim, Midterm, and Finals Fees
		$data['UponRegistration'] = number_format((float)$sembalance[0]['InitialPayment'] == null ? 0.00 : $sembalance[0]['InitialPayment'],2,'.', '');
		$data['Prelim'] = number_format((float)$sembalance[0]['First_Pay'] == null ? 0.00 : $sembalance[0]['First_Pay'],2,'.', '');
		$data['Midterm'] = number_format((float)$sembalance[0]['Second_Pay'] == null ? 0.00 : $sembalance[0]['Second_Pay'],2,'.', '');
		$data['Finals'] = number_format((float)$sembalance[0]['Third_Pay'] == null ? 0.00 : $sembalance[0]['Third_Pay'],2,'.', '');

		//Overall Outstanding Balance
		$outstanding_balance = number_format((float)$data['Overall_Fees'] - $data['Overall_Paid'], 2, '.', '');
		$data['Outstanding_Balance'] = $data['Overall_Fees'] <= $data['Overall_Paid'] ? 0.00 : $outstanding_balance;
		
		//PERIODICAL BALANCE
		$Payment_distribute = $data['Semestral_Paid'];
		$data['dist1'] = $Payment_distribute;

		//UPON REGISTRATION BALANCE
		if($Payment_distribute >= $data['UponRegistration']){

			$data['UponRegistrationBalance'] = number_format((float)0.00,2,'.','');
			$Payment_distribute = number_format((float)$Payment_distribute - $data['UponRegistration'],2,'.','');

		}else{

			$data['UponRegistrationBalance'] = number_format((float)$data['UponRegistration'] - $Payment_distribute,2,'.','');
			$Payment_distribute = number_format((float)0.00,2,'.','');

		}
		$data['dist2'] = $Payment_distribute;

		//PRELIM BALANCE
		if($Payment_distribute >= $data['Prelim']){

			$data['PrelimBalance'] = number_format((float)0.00,2,'.','');
			$Payment_distribute = number_format((float)$Payment_distribute - $data['Prelim'],2,'.','');

		}else{

			$data['PrelimBalance'] = number_format((float)$data['Prelim'] - $Payment_distribute,2,'.','');
			$Payment_distribute = number_format((float)0.00,2,'.','');
		}
		$data['dist3'] = $Payment_distribute;

		//MIDTERM BALANCE
		if($Payment_distribute >= $data['Midterm']){

			$data['MidtermBalance'] = number_format((float)0.00,2,'.','');
			$Payment_distribute = number_format((float)$Payment_distribute - $data['Midterm'],2,'.','');

		}else{

			$data['MidtermBalance'] = number_format((float)$data['Midterm'] - $Payment_distribute,2,'.','');
			$Payment_distribute = number_format((float)0.00,2,'.','');
		}
		$data['dist4'] = $Payment_distribute;

		//FINALS BALANCE
		if($Payment_distribute >= $data['Finals']){

			$data['FinalsBalance'] = number_format((float)0.00,2,'.','');
			$Payment_distribute = number_format((float)$Payment_distribute - $data['Finals'],2,'.','');

		}else{

			$data['FinalsBalance'] = number_format((float)$data['Finals'] - $Payment_distribute,2,'.','');
			$Payment_distribute = number_format((float)0.00,2,'.','');
		}
		$data['dist5'] = $Payment_distribute;

		//Chosen Schoolyear and Semester
		$data['Chosen_Schoolyear'] = $input_array['School_Year'] != null ? $input_array['School_Year'] : 'None';
		$data['Chosen_Semester'] = $input_array['Semester'] != null ? $input_array['Semester'] : 'None';

		$this->data_output['data'] = $data;
		$this->Output($this->data_output);

	}
	private function 
	($input_array){

		$data = array(
			'Overall_Fees' => 0,
			'Overall_Paid' => 0,
			//--Current Semestral Data
			'Semestral_Balance' => 0,
			'Semestral_Paid' => 0,
			'Semestral_Fee' => 0,
			'InitialPayment' => 0,
			'Prelim' => 0,
			'Midterm' => 0,
			'Finals' => 0,
			'UponRegistrationBalance' => 0,
			'PrelimBalance' => 0,
			'MidtermBalance' => 0,
			'FinalsBalance' => 0,
			//--Current Semestral Data
			'Outstanding_Balance' => 0,
			'Previous_Balance' => 0,
			'Chosen_Schoolyear' => $input_array['School_Year'],
			'Chosen_Semester' => $input_array['Semester'], 
			'SemestralData' => array()
		);

		//Check if Currently Enrolled
		$CurrentlyEnrolled = $this->Balance->CheckFeesData($input_array);
		
		//Sets SY and Sem to default
		if($CurrentlyEnrolled == 0){
			$input_array = array(
				'School_Year' => '',
				'Semester' => ''
			);
		}

		//Get All Fees Data 
		$Breakdown = $this->Balance->GetBreakDown($input_array);

		



		foreach($Breakdown as $index=>$fee){

			$data['SemestralData'][$index] = array(
				'schoolyear' => $fee['schoolyear'],
				'semester' => $fee['semester'],
				'total' => $fee['TOTAL'],
				'paid' =>  $fee['PAID'],
				'balance' => $fee['BALANCE'],
				'InitialPayment' => '',
				'Prelim' => '',
				'Midterm' => '',
				'Finals' => '',
				'UponRegistrationBalance' => '',
				'PrelimBalance' => '',
				'MidtermBalance' => '',
				'FinalsBalance' => '',
			);
			$input = array(
				'Reference_Number' => $input_array['Reference_Number'],
				'schoolyear' => $data['SemestralData'][$index]['schoolyear'],
				'semester' => $data['SemestralData'][$index]['semester'],
			);
			$paymentScheme = $this->Balance->getPaymentBreakdown($input);
			$data['SemestralData'][$index]['InitialPayment'] = $paymentScheme[0]['InitialPayment'];
			$data['SemestralData'][$index]['Prelim'] = $paymentScheme[0]['First_Pay'];
			$data['SemestralData'][$index]['Midterm'] = $paymentScheme[0]['Second_Pay'];
			$data['SemestralData'][$index]['Finals'] = $paymentScheme[0]['Third_Pay'];

			$sempaid = $data['SemestralData'][$index]['paid'];
			//Compute Initial Payment Balance
			$fees = array(
				'UponRegistrationBalance' => $data['SemestralData'][$index]['InitialPayment'],
				'PrelimBalance' => $data['SemestralData'][$index]['Prelim'],
				'MidtermBalance' => $data['SemestralData'][$index]['Midterm'],
				'FinalsBalance' => $data['SemestralData'][$index]['Finals']
			);
			$Breakdown = $this->ComputePaymentBreakdown($fees,$sempaid);

			$data['SemestralData'][$index]['UponRegistrationBalance'] = $Breakdown['UponRegistrationBalance'];
			$data['SemestralData'][$index]['PrelimBalance'] = $Breakdown['PrelimBalance'];
			$data['SemestralData'][$index]['MidtermBalance'] = $Breakdown['MidtermBalance'];
			$data['SemestralData'][$index]['FinalsBalance'] = $Breakdown['FinalsBalance'];
			
			/*
			$data['SemestralData'][$index]['UponRegistrationBalance'] = $data['SemestralData'][$index]['InitialPayment'] < $sempaid ? 0.00 : $sempaid - $data['SemestralData'][$index]['InitialPayment'];
			$data['SemestralData'][$index]['UponRegistrationBalance'] = $data['SemestralData'][$index]['UponRegistrationBalance'] < 0 ? 0.00 : $data['SemestralData'][$index]['UponRegistrationBalance'];
			$sempaid = $sempaid - $data['SemestralData'][$index]['InitialPayment'] < 0 ? 0.00 : $sempaid - $data['SemestralData'][$index]['InitialPayment'];
			
			//Compute Prelim Balance
			$data['SemestralData'][$index]['PrelimBalance'] = $data['SemestralData'][$index]['Prelim'] < $sempaid ? 0.00 : $sempaid - $data['SemestralData'][$index]['Prelim'];
			$data['SemestralData'][$index]['PrelimBalance'] = $data['SemestralData'][$index]['PrelimBalance'] < 0 ? 0.00 : $data['SemestralData'][$index]['PrelimBalance'];
			$sempaid = $sempaid - $data['SemestralData'][$index]['Prelim'] < 0 ? 0.00 : $sempaid - $data['SemestralData'][$index]['Prelim'];

			//Compute Prelim Balance
			$data['SemestralData'][$index]['MidtermBalance'] = $data['SemestralData'][$index]['Midterm'] < $sempaid ? 0.00 : $sempaid - $data['SemestralData'][$index]['Midterm'];
			$data['SemestralData'][$index]['MidtermBalance'] = $data['SemestralData'][$index]['MidtermBalance'] < 0 ? 0.00 : $data['SemestralData'][$index]['MidtermBalance'];
			$sempaid = $sempaid - $data['SemestralData'][$index]['Midterm'] < 0 ? 0.00 : $sempaid - $data['SemestralData'][$index]['Midterm'];

			//Compute Prelim Balance
			$data['SemestralData'][$index]['FinalsBalance'] = $data['SemestralData'][$index]['Finals'] < $sempaid ? 0.00 : $sempaid - $data['SemestralData'][$index]['Finals'];
			$data['SemestralData'][$index]['FinalsBalance'] = $data['SemestralData'][$index]['FinalsBalance'] < 0 ? 0.00 : $data['SemestralData'][$index]['FinalsBalance'];
			$sempaid = $sempaid - $data['SemestralData'][$index]['Finals'] < 0 ? 0.00 : $sempaid - $data['SemestralData'][$index]['Finals'];
			*/

			//$data['SemestralData'][$index]['Sempaid'] = $sempaid;
			
			$data['Overall_Fees'] += $data['SemestralData'][$index]['total'];

			$data['Overall_Paid'] += $data['SemestralData'][$index]['paid'];

			if($data['Chosen_Schoolyear'] == $data['SemestralData'][$index]['schoolyear'] && $data['Chosen_Semester'] == $data['SemestralData'][$index]['semester']){

				$data['Semestral_Fee'] = $data['SemestralData'][$index]['total'];
				$data['Semestral_Paid'] = $data['SemestralData'][$index]['paid'];
				$data['Semestral_Balance'] = $data['SemestralData'][$index]['balance'];
				
				$data['InitialPayment'] = $data['SemestralData'][$index]['InitialPayment'];
				$data['Prelim'] = $data['SemestralData'][$index]['Prelim'];
				$data['Midterm'] = $data['SemestralData'][$index]['Midterm'];
				$data['Finals'] = $data['SemestralData'][$index]['Finals'];

				$data['UponRegistrationBalance'] = $data['SemestralData'][$index]['UponRegistrationBalance'];
				$data['PrelimBalance'] = $data['SemestralData'][$index]['PrelimBalance'];
				$data['MidtermBalance'] = $data['SemestralData'][$index]['MidtermBalance'];
				$data['FinalsBalance'] = $data['SemestralData'][$index]['FinalsBalance'];


			}

			if($data['SemestralData'][$index]['balance'] > 0){

				$data['Outstanding_Balance'] += $data['SemestralData'][$index]['balance'];

			}

			//echo $fee['schoolyear'].'='.$fee['semester'].'-'.$fee['TOTAL'].':'.$fee['PAID'].':'.$fee['BALANCE'].'<br>';

		}
		$data['Previous_Balance'] = $data['Outstanding_Balance'] - $data['Semestral_Balance'];

		$this->data_output['Output'] = $data;




	}
	private function ComputePaymentBreakdown($data = array(),$payment){

		$return = array();
		
		foreach($data as $bal=>$fees){

			$balance = $fees - $payment;
			$return[$bal] = number_format($balance < 0 ? 0.00 : $balance, 2, '.', '');
			$pay = $payment - $fees; 
			$payment = $pay < 0 ? 0.00 : $pay;

		}

		return $return;

	}
	private function validate_reference_number($input_array){

		//Check if reference number is valid
		$sn_result = $this->Student_info->Student_Info_byREF($input_array);
		if(empty($sn_result)){
			
			$this->data_output['Error'] = 1;
			$this->data_output['ErrorMessage'] = 'Invalid Reference Number Key';
			$this->Output($this->data_output);

		}
		return $sn_result[0]['Student_Number'];
	}
	private function Output($data = array()){

		echo json_encode($data);
		exit();

	}


	
}
