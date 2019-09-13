<?php


class Legends extends CI_Model{
	

	// STUDENT
	public function Get_Legends()
	{	
		$result = $this->db->get('Legend');
		return $result->result_array();
	
	}
	


}
?>