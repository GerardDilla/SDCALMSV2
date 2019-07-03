<?php


class Balance extends CI_Model{
	
	
	
	/* OLD
	public function GetLatestBalDate_query($rn){

		$sql =
		"
		SELECT * FROM Fees_Enrolled_College 
		WHERE Reference_Number = '$rn'
		ORDER BY schoolyear DESC, semester DESC
		LIMIT 1
		";
		$result = $this->db->query($sql);

		return $result;
	}*/
	public function GetLatestBalDate_query($array){

		$this->db->where('md5(Reference_Number)',$array['Reference_Number']);
		$this->db->order_by('schoolyear','DESC');
		$this->db->order_by('semester','DESC');
		$this->db->limit(1);
		$result = $this->db->get('Fees_Enrolled_College');
		return $result->result_array();

	}
	/*
	public function semestralbalance($rn,$sy,$sem){

		$sql = 
		"
			SELECT 
			`Fees`.`tuition_Fee` + SUM(`fees_item`.`Fees_Amount`) AS `Fees`
			FROM
			Fees_Enrolled_College AS `Fees` 
			INNER JOIN Fees_Enrolled_College_Item `fees_item` 
			ON `Fees`.`id` = `fees_item`.`Fees_Enrolled_College_Id`  
			WHERE `Fees`.`Reference_Number` = '$rn'
			AND `Fees`.`semester` = '$sem'
			AND `Fees`.`schoolyear` = '$sy'

		";
		$result = $this->db->query($sql);
		
		return $result;
	}*/
	public function semestralbalance($array){

		$this->db->select('
		Fees.tuition_Fee + SUM(fees_item.Fees_Amount) AS Fees
		');
		$this->db->join('
		Fees_Enrolled_College_Item AS fees_item',
		'Fees.id = fees_item.Fees_Enrolled_College_Id`
		','inner');
<<<<<<< Updated upstream
		$this->db->where('md5(Fees.Reference_Number)',$array['Reference_Number']);
		$this->db->where('Fees.semester',$array['Semester']);
		$this->db->where('Fees.schoolyear',$array['School_Year']);
		$result = $this->db->get('Fees_Enrolled_College AS Fees');
		return $result->result_array();
=======
		$this->db->where('Fees.Reference_Number',$array['Reference_Number']);
		$this->db->where('Fees.semester',$array['Semester']);
		$this->db->where('Fees.schoolyear',$array['School_Year']);
		$result = $this->db->get('Fees_Enrolled_College AS Fees');
		return $result;
>>>>>>> Stashed changes

	}
	/*
	public function gettotalpaidsemester($rn,$sy,$sem){

		$sql = 
		"

		SELECT SUM(AmountofPayment) AS AmountofPayment,semester, schoolyear 
		FROM EnrolledStudent_Payments_Throughput WHERE Reference_Number = '$rn' AND Semester = '$sem' AND SchoolYear = '$sy' AND valid
		
		";
		$result = $this->db->query($sql);
		
		return $result;	
	}
	*/
	public function gettotalpaidsemester($array){
		
		$this->db->select('
		SUM(AmountofPayment) AS AmountofPayment,semester, schoolyear
		');
<<<<<<< Updated upstream
		$this->db->where('md5(Reference_Number)',$array['Reference_Number']);
=======
		$this->db->where('Reference_Number',$array['Reference_Number']);
>>>>>>> Stashed changes
		$this->db->where('Semester',$array['Semester']);
		$this->db->where('SchoolYear',$array['School_Year']);
		$this->db->where('Valid',1);
		$result = $this->db->get('EnrolledStudent_Payments_Throughput');
<<<<<<< Updated upstream
		return $result->result_array();
=======
		return $result;
>>>>>>> Stashed changes

	}
	/* OLD
	public function getOutstandingbal($rn,$sy,$sem){

		$sql = 
		"

		SELECT SUM(InitialPayment + First_Pay + Second_Pay + Third_Pay + Fourth_Pay) AS Fees,semester,schoolyear 
		FROM Fees_Enrolled_College 
		WHERE Reference_Number = '$rn'
		
		";

		$result = $this->db->query($sql);
		
		return $result;
	}*/
	public function getOutstandingbal($array){

		$this->db->select('
		SUM(InitialPayment + First_Pay + Second_Pay + Third_Pay + Fourth_Pay) AS Fees,
		semester,
		schoolyear
		');
		$this->db->where('md5(Reference_Number)',$array['Reference_Number']);
		$result = $this->db->get('Fees_Enrolled_College');
		return $result->result_array();

	}
	/*
	public function gettotalpaid($rn,$sy,$sem){

		$sql = 
		"

		SELECT SUM(AmountofPayment) AS AmountofPayment,semester, schoolyear 
		FROM EnrolledStudent_Payments_Throughput WHERE Reference_Number = '$rn' 
		
		";
		$result = $this->db->query($sql);
		
		return $result;	
	}
	*/
	public function gettotalpaid($array){

		$this->db->select('
			SUM(AmountofPayment) AS AmountofPayment,
			semester, 
			schoolyear
		');
<<<<<<< Updated upstream
		$this->db->where('md5(Reference_Number)',$array['Reference_Number']);
		$result = $this->db->get('EnrolledStudent_Payments_Throughput');
		return $result->result_array();
=======
		$this->db->where('Reference_Number',$array['Reference_Number']);
		$result = $this->db->get('EnrolledStudent_Payments_Throughput');
		return $result;
>>>>>>> Stashed changes

	}
	
		
}

?>