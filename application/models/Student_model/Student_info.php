<?php


class Student_info extends CI_Model{
	

	// STUDENT
	public function Student_Info_byREF($array)
	{
		
		$this->db->where('md5(Reference_Number)',$array['Reference_Number']);
		$result = $this->db->get('Student_Info');
		return $result->result_array();
	
	}
	public function ValidateStudentNumber($array){

		$this->db->where('A.Student_Number',$array['Student_Number']);
		$this->db->where('A.Student_Number <>',NULL);
		$this->db->where('A.Student_Number <>','0');
		$result = $this->db->get('Student_Info AS A');
		return $result->result_array();

	}
	public function ValidateAccountExists($array)
	{

		$this->db->select('A.Student_Number AS SI_Student_Number, B.Student_Number AS HA_Student_Number');
		$this->db->where('A.Student_Number',$array['Student_Number']);
		$this->db->where('A.Student_Number <>',NULL);
		$this->db->where('A.Student_Number <>','0');
		$this->db->join('highered_accounts AS B','A.Student_Number = B.Student_Number');
		$result = $this->db->get('Student_Info AS A');
		return $result->result_array();
		
	}
	
}
?>