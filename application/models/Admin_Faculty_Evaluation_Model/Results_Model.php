<?php


class Results_Model extends CI_Model{

    //GET School Year
	public function Get_sy()
	{
		$this->db->select('schoolyear');
		$this->db->from('ie_legend');	
		$query = $this->db->get();
		return $query->result_array();
	}

	//GET Semester
	public function Get_sem()
	{
		$this->db->select('semester');
		$this->db->from('ie_legend');
		$query = $this->db->get();
		return $query->result_array();
	}


	public function Get_Prof($array_data)
	{
		$this->db->select('*');
		$this->db->from('instructor');
		$this->db->where('Active =','1');
		$this->db->like('Instructor_Name',$array_data['Proffesor']);
		$this->db->limit($array_data['perpage'],$array_data['offset']);
		$this->db->order_by('Instructor_Name','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function Get_Profs($array_data)
	{
		$this->db->select('*');
		$this->db->from('instructor');
		$this->db->where('Active =','1');
		$this->db->like('Instructor_Name',$array_data['Proffesor']);
		$this->db->order_by('Instructor_Name','ASC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function Get_EvaluateResults($array)
	{
		$this->db->select('*');
		$this->db->from('ie_evaluationresult');
		$this->db->where('instructor =',$array['Proffesor']);
		$this->db->where('Semester =',$array['sem']);
		$this->db->where('School_Year =',$array['sy']);
		$this->db->group_by('Reference_Number');
		$query = $this->db->get();
		return $query->num_rows();
	}

	// RESULT PAGE
	public function Get_description(){
			
		$this->db->select('*');
		$this->db->from('ie_area_description AS A');
		$this->db->join('ie_evaluation_type AS B','A.evaluation_type_id = B.id','INNER');
		$this->db->join('ie_area AS C','A.area_id = C.id','INNER');
		$this->db->order_by('C.orderr','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}




	public function Get_criteria(){
			
		$this->db->select('*');
		$this->db->from('ie_criteria');
		$this->db->order_by('ratings','DESC');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function Get_area(){
			
		$this->db->select('*');
		$this->db->from('ie_area');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function Get_result($array){
			
		$this->db->select('*');
		$this->db->from('ie_evaluationresult');
		$this->db->where('Semester      =',$array['sem']);
		$this->db->where('School_Year   =',$array['sy']);
		$this->db->where('instructor    =',$array['Prof_id']);
		$this->db->where('area_id       =',$array['areaID']);
		$this->db->where('question_id    =',$array['eval_id']);
		$this->db->where('eval_answers  =',$array['ratings']);

		$query = $this->db->get();
		return $query->num_rows();
	}


  



	  


}
?>