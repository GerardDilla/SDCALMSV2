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
		$errorall = '';
		$status = TRUE;
		$count = 0;
		foreach($config as $row){
			if(array_key_exists("rules",$row)){
				if($row['rules'] != '' || $row['rules'] != NULL){
					$rules = explode("|",$row['rules']);
<<<<<<< Updated upstream

					//Place Conditions inside the foreach below followed by setting the error message in the errors_translate() function
					foreach($rules as $rule_row){

						//For 'Boolean' rule
						if($rule_row == 'boolean'){
							//Condition
							if($row['value'] != '' || $row['value'] != NULL){
								if($row['value'] != 1){
									if($row['value'] != 0){
										$error[$row['field']] = $this->errors_translate(trim($rule_row,' '),$row['label']);
										$errorall .= $error[$row['field']].'<br>';
										$status = FALSE;
									} 
								}
							}
						}
						//---Boolean

						//For 'Required' rule
						if($rule_row == 'required'){
							//Condition
							if($row['value'] == '' || $row['value'] == NULL){
								$error[$row['field']] = $this->errors_translate(trim($rule_row,' '),$row['label']);
								//echo $error[$row['field']].'<hr>';
								$errorall .= $error[$row['field']].'<br>';
								$status = FALSE;
							}
						}
						//---Required

=======
					foreach($rules as $rule_row){
						//echo $row['label'].'--error:'.$rule_row.'<br>';
						if($row['value'] == '' || $row['value'] == NULL){
							$error[$row['field']] = $this->errors_translate(trim($rule_row,' '),$row['label']);
							//echo $error[$row['field']].'<hr>';
							$errorall .= $error[$row['field']].'<br>';
							$status = FALSE;
						}
>>>>>>> Stashed changes
					}
				}
			}

		}
		//print_r($error);
		//echo '<hr>';
		return array(
			'Status' => $status,
			'Error' => $error,
			'All_Errors' => $errorall
		);

	}
	private function errors_translate($error,$label){
		switch ($error) {
			case "required":
				return $label." is Required";
				break;
<<<<<<< Updated upstream
			case "boolean":
				return $label." only accepts boolean values";
=======
			case "test":
				return $label." is a test";
>>>>>>> Stashed changes
				break;
			default:
				return "Unknown Rule";
		}
	}


}