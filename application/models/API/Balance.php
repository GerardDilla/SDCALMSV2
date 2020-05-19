<?php


class Balance extends CI_Model{
	
	
	public function getPaymentBreakdown($input){

		$this->db->where('md5(Reference_Number)',$input['Reference_Number']);
		$this->db->where('schoolyear',$input['schoolyear']);
		$this->db->where('semester',$input['semester']);
		$this->db->limit(1);
		$result = $this->db->get('Fees_Enrolled_College');
		return $result->result_array();
		
	}
	public function GetLatestBalDate_query($array){

		$this->db->where('md5(Reference_Number)',$array['Reference_Number']);
		$this->db->order_by('schoolyear','DESC');
		$this->db->order_by('semester','DESC');
		$this->db->limit(1);
		$result = $this->db->get('Fees_Enrolled_College');
		return $result->result_array();

	}
	public function semestralbalance($array){

		$this->db->select('Fees.InitialPayment, Fees.First_Pay, Fees.Second_Pay, Fees.Third_Pay,discount,
		SUM(InitialPayment + First_Pay + Second_Pay + Third_Pay + Fourth_Pay) AS Fees
		');
		/*
		$this->db->join('
		Fees_Enrolled_College_Item AS fees_item','Fees.id = fees_item.Fees_Enrolled_College_Id AND fees_item.valid = 1','inner');
		*/
		$this->db->where('md5(Fees.Reference_Number)',$array['Reference_Number']);
		$this->db->where('Fees.semester',$array['Semester']);
		$this->db->where('Fees.schoolyear',$array['School_Year']);
		$result = $this->db->get('Fees_Enrolled_College AS Fees');
		return $result->result_array();

	}
	public function gettotalpaidsemester($array){
		
		$this->db->select('
		SUM(AmountofPayment) AS AmountofPayment,semester, schoolyear
		');
		$this->db->where('md5(Reference_Number)',$array['Reference_Number']);
		$this->db->where('Semester',$array['Semester']);
		$this->db->where('SchoolYear',$array['School_Year']);
		$this->db->where('valid',1);
		$result = $this->db->get('EnrolledStudent_Payments_Throughput');
		return $result->result_array();

	}
	public function getOutstandingbal($array){

		$this->db->select('
		SUM(discount) as Discounts, SUM(InitialPayment + First_Pay + Second_Pay + Third_Pay + Fourth_Pay) AS Fees,
		semester,
		schoolyear
		');
		$this->db->where('md5(Reference_Number)',$array['Reference_Number']);
		$result = $this->db->get('Fees_Enrolled_College');
		return $result->result_array();

		
	}
	public function GetTotalAndPaid($array){

		$query = '
			SELECT 
			SUM(`TOTAL`) as `TOTAL`,
			SUM(`PAID`) as `PAID`
			FROM
			(SELECT 
				`fees`.`withdraw` AS `WITHDRAW`,
				CONCAT(
				`fees`.`semester`,
				"|",
				`fees`.`schoolyear`
				) AS `SEMESTER|SY`,
				IF(
				`fees`.`withdraw` < 1,
				(
					`fees`.`tuition_Fee` + SUM(
					(
						CASE
						WHEN (`FECI`.`Fees_Type` = "MISC") 
						THEN `FECI`.`Fees_Amount` 
						ELSE 0.00 
						END
					)
					) + SUM(
					(
						CASE
						WHEN (`FECI`.`Fees_Type` = "OTHER") 
						THEN `FECI`.`Fees_Amount` 
						ELSE 0.00 
						END
					)
					) + SUM(
					(
						CASE
						WHEN (`FECI`.`Fees_Type` = "LAB") 
						THEN `FECI`.`Fees_Amount` 
						ELSE 0.00 
						END
					)
					)
				),
				(SELECT 
					`fees`.`withdrawalfee` 
				FROM
					WithdrawInformation 
				WHERE Student_Number = '.$array['Student_Number'].' 
					AND semester = `fees`.`semester` 
					AND SchoolYear = `fees`.SchoolYear 
				LIMIT 1)
				) AS `TOTAL`,
				(SELECT 
				SUM(AmountofPayment) 
				FROM
				EnrolledStudent_Payments_Throughput 
				WHERE Reference_Number = `fees`.`Reference_Number` 
				AND itemPaid != "Excess"
				AND itemPaid != "REFUND"
				AND semester = `fees`.`semester` 
				AND schoolyear = `fees`.`schoolyear` 
				AND valid) AS `PAID` 
			FROM
				Fees_Enrowlled_College AS `fees` 
				INNER JOIN `Fees_Enrolled_College_Item` AS `FECI` 
				ON `fees`.`id` = `FECI`.`Fees_Enrolled_College_Id` 
				AND `FECI`.`valid` 
			WHERE md5(`fees`.`Reference_Number`) = "'.$array['Reference_Number'].'" 
			GROUP BY `SEMESTER|SY` 
			) a 
		';
		$result = $this->db->query($query);
		return $result->result_array();

	}
	public function GetBreakDown($array){
		
		$query = '
			SELECT 
			SUM(`TOTAL`) AS `TOTAL`,
			SUM(`PAID`) AS `PAID`,
			schoolyear,
			semester,
			IF(
				(SUM(`TOTAL`) - SUM(`PAID`)) < 1,
				0,
				(SUM(`TOTAL`) - SUM(`PAID`))
			) AS `BALANCE` 
			FROM
			(SELECT 
				`fees`.`withdraw` AS `WITHDRAW`,
				`fees`.`schoolyear`,
				`fees`.`semester`,
				IF(
				`fees`.`withdraw` < 1,
				(
					`fees`.`tuition_Fee` + SUM(
					(
						CASE
						WHEN (`FECI`.`Fees_Type` = "MISC") 
						THEN `FECI`.`Fees_Amount` 
						ELSE 0.00 
						END
					)
					) + SUM(
					(
						CASE
						WHEN (`FECI`.`Fees_Type` = "OTHER") 
						THEN `FECI`.`Fees_Amount` 
						ELSE 0.00 
						END
					)
					) + SUM(
					(
						CASE
						WHEN (`FECI`.`Fees_Type` = "LAB") 
						THEN `FECI`.`Fees_Amount` 
						ELSE 0.00 
						END
					)
					)
				),
				(SELECT 
					`fees`.`withdrawalfee` 
				FROM
					WithdrawInformation 
				WHERE Student_Number = '.$array['Student_Number'].' 
					AND semester = `fees`.`semester` 
					AND SchoolYear = `fees`.SchoolYear 
				LIMIT 1)
				) AS `TOTAL`,
				(SELECT 
				SUM(AmountofPayment) 
				FROM
				EnrolledStudent_Payments_Throughput 
				WHERE Reference_Number = `fees`.`Reference_Number` 
				AND itemPaid != "Excess" 
				AND itemPaid != "REFUND" 
				AND semester = `fees`.`semester` 
				AND schoolyear = `fees`.`schoolyear` 
				AND valid) AS `PAID` 
			FROM
				Fees_Enrolled_College AS `fees` 
				INNER JOIN `Fees_Enrolled_College_Item` AS `FECI` 
				ON `fees`.`id` = `FECI`.`Fees_Enrolled_College_Id` 
				AND `FECI`.`valid` 
			WHERE MD5(`fees`.`Reference_Number`) = "'.$array['Reference_Number'].'" 
			GROUP BY schoolyear,semester) a 
			GROUP BY schoolyear,semester
		';
		$result = $this->db->query($query);
		return $result->result_array();


	}
	public function gettotalpaid($array){

		$this->db->select('
			SUM(AmountofPayment) AS AmountofPayment,
			semester, 
			schoolyear
		');
		$this->db->where('md5(Reference_Number)',$array['Reference_Number']);
		$this->db->where('valid',1);
		$result = $this->db->get('EnrolledStudent_Payments_Throughput');
		return $result->result_array();

	}

	
		
}

?>