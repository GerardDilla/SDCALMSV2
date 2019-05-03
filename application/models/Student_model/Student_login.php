<?php


class Student_login extends CI_Model{
	

	// STUDENT
	public function verify_login($array)
	{
		$this->db->where('A.Student_Number',$array['student_id']);
		$this->db->where('A.Password',$array['student_password']);
		$this->db->join('Student_Info AS B','A.Student_Number = B.Student_Number');
		$result = $this->db->get('highered_accounts AS A');
		return $result->result_array();
	
	}


}
?>