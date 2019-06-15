<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class api_input_validator 
{
	/*
		1. Call this library in controller: $this->load->library("api_input_validator");
		2. Make and array with indexes: field, label, rules, and value. All indexes must have a value
		3. Validate array by running this code $your_variable = $this->api_input_validator->validate_input($your_array_variable);
		4. Check if validation has error my checking if its true or false: if($your_variable['Status'] == TRUE){ echo 'No errors'; }
		5. Display errors by calling $your_variable['Error']


		Code sample:
		$this->load->library("api_input_validator");
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
				'rules' => 'required',
				'value' => $this->input->get('School_Year')
			),
			array(
				'field' => 'Semester',
				'label' => 'Semester',
				'rules' => 'required',
				'value' => $this->input->get('Semester')
			)
		);
		if($validate['Status'] == TRUE){
			//No error
		}else{
			//Has error
		}
	*/
	public function validate_input($config){

		$error = array();
		$status = TRUE;
		$count = 0;
		foreach($config as $row){
			if($row['value'] == '' || $row['value'] == NULL){
				$error[$row['field']] = $this->errors_translate($row['rules'],$row['label']);
				$status = FALSE;
			}
		}
		return array(
			'Status' => $status,
			'Error' => $error
		);

	}
	private function errors_translate($error,$label){
		switch ($error) {
			case "required":
				return $label." is Required";
				break;
			default:
				return "Invalid Error";
		}
	}


}