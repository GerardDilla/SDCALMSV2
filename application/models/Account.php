<?php


class Account extends CI_Model{
	

	// STUDENT
	public function PreRegistration_insert($array)
	{	
		$this->db->select('
		`G`.`School_Year`
		');
		$this->db->where('G.Student_Number',$array['Student_Number']);
		$this->db->group_by('G.School_Year','DESC');
		$result = $this->db->get('Grading as G');
		return $result->result_array();
	
	}
	


}
?>