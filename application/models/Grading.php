<?php


class Grading extends CI_Model{
	

	// STUDENT
	public function Get_Grading_SchoolYear($array)
	{	
		$this->db->select('
		`G`.`School_Year`
		');
		$this->db->where('G.Student_Number',$array['Student_Number']);
		$this->db->group_by('G.School_Year','DESC');
		$result = $this->db->get('Grading as G');
		return $result->result_array();
	
	}
	public function Get_Grading_Semester($array)
	{	
		$this->db->select('
		`G`.`Semester`
		');
		$this->db->where('G.Student_Number',$array['Student_Number']);
		$this->db->group_by('G.Semester','DESC');
		$result = $this->db->get('Grading as G');
		return $result->result_array();
	
	}


}
?>