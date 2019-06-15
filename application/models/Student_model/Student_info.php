<?php


class Student_info extends CI_Model{
	

	// STUDENT
	public function Student_Info_byREF($array)
	{
		
		$this->db->where('md5(Reference_Number)',$array['Reference_Number']);
		$result = $this->db->get('Student_Info');
		return $result->result_array();
	
	}


}
?>