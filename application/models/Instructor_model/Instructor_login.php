<?php


class Instructor_login extends CI_Model{
	
	public function verify_login($array)
	{
		$this->db->where('Instructor_ID',$array['Instructor_ID']);
		$this->db->where('Passkey',$array['Passkey']);
		$result = $this->db->get('instructor');
		return $result->result_array();
			
	}


}
?>