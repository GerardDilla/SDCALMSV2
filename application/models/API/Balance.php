<?php


class Balance extends CI_Model{
	
	
	

	public function GetLatestBalDate_query($array){

		$this->db->where('md5(Reference_Number)',$array['Reference_Number']);
		$this->db->order_by('schoolyear','DESC');
		$this->db->order_by('semester','DESC');
		$this->db->limit(1);
		$result = $this->db->get('Fees_Enrolled_College');
		return $result->result_array();

	}
	public function semestralbalance($array){

		$this->db->select('Fees.InitialPayment, Fees.First_Pay, Fees.Second_Pay, Fees.Third_Pay,
		Fees.tuition_Fee + SUM(fees_item.Fees_Amount) AS Fees
		');
		$this->db->join('
		Fees_Enrolled_College_Item AS fees_item',
		'Fees.id = fees_item.Fees_Enrolled_College_Id`
		','inner');
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
		$this->db->where('Valid',1);
		$result = $this->db->get('EnrolledStudent_Payments_Throughput');
		return $result->result_array();

	}
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
	public function gettotalpaid($array){

		$this->db->select('
			SUM(AmountofPayment) AS AmountofPayment,
			semester, 
			schoolyear
		');
		$this->db->where('md5(Reference_Number)',$array['Reference_Number']);
		$result = $this->db->get('EnrolledStudent_Payments_Throughput');
		return $result->result_array();

	}
	
		
}

?>