<?php


class Proffesor_Model extends CI_Model{

    
	//GET Proff
	  public function Get_all_Profs($array_data){
		$this->db->select('*');
		$this->db->from('instructor');
		
		if($array_data['ActiveDeactive'] == 1){
			$this->db->where('Active =','1');
	     	}
		elseif($array_data['ActiveDeactive'] == 2){
				$this->db->where('Active !=','1');
			}
			
		$this->db->like('Instructor_Name',$array_data['Proffesor']);
		$this->db->order_by('Instructor_Name','ASC');
		$this->db->limit($array_data['perpage'],$array_data['offset']);
		$query = $this->db->get();
		return $query->result_array();
		
	}

	//GET Proff
	public function Get_all_Profss($array_data){
		$this->db->select('*');
		$this->db->from('instructor');

		if($array_data['ActiveDeactive'] == 1){
			$this->db->where('Active =','1');
	     	}
		elseif($array_data['ActiveDeactive'] == 2){
				$this->db->where('Active !=','1');
			}
			
		$this->db->like('Instructor_Name',$array_data['Proffesor']);
		$this->db->order_by('Instructor_Name','ASC');
		$query = $this->db->get();
		return $query->num_rows();
	}




	public function UpdateDeactive($id){
		$this->db->set('Active', '0');
		$this->db->where('ID', $id);
		$this->db->update('instructor'); 
	}


	public function UpdateActive($id){
		$this->db->set('Active', '1');
		$this->db->where('ID',$id);
		$this->db->update('instructor'); 
	}

	



}
?>