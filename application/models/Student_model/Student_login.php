<?php


class Student_login extends CI_Model{
	
	public function verify_login($array)
	{
		$this->db->select('
		B.Student_Number,
		MD5(B.Reference_Number) AS Reference_Number,
		A.Account_Picture,
		IF(A.Email = "","N/A",A.Email) AS Email,
		CONCAT(B.First_Name,\' \',B.`Middle_Name`,\' \',B.`Last_Name`) AS FULLNAME,
		B.`First_Name`,
		B.`Middle_Name`,
		B.`Last_Name`,
		B.Course,
		B.Major,
		A.Verified,
		A.ViaRegistration
		');
		$this->db->where('A.Student_Number',$array['student_id']);
		$this->db->where('A.Password',MD5($array['student_password']));
		// $this->db->where('A.Password',$array['student_password']);
		$this->db->where('A.Student_Number <>',NULL);
		$this->db->where('A.Student_Number <>','0');
		$this->db->where('A.Active','1');
		$this->db->join('Student_Info AS B','A.Student_Number = B.Student_Number');
		$result = $this->db->get('highered_accounts_v2 AS A');
		return $result->result_array();
	
	}


}
?>