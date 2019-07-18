<?php


class Proffesor_Model extends CI_Model{

    //GET Proff
	public function Get_Prof(){
		
		$this->db->select('*');
		$this->db->from('instructor');
		$this->db->order_by('Instructor_Name','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	



}
?>