<?php


class Rubric extends CI_Model{

 
    public function SelectRubrics($InstructorID){
		$this->db->select('*');
		$this->db->from('lms_rubrics_table');
		$this->db->where('InstructorID',$InstructorID);
		$this->db->where('active','1');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function Rubrics($RubricsID){
		$this->db->select('*');
		$this->db->from('lms_rubrics_table');
		$this->db->where('rubrics_id',$RubricsID);
		$this->db->where('active',1);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function RubricsList(){
		$this->db->select('*');
		$this->db->from('lms_rubrics_table');
		$this->db->where('active',1);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function RubricsEscale($RubricsID){
		$this->db->select('*');
		$this->db->from('lms_rubrics_escale');
		$this->db->where('rubrics_id',$RubricsID);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function RubricsCriteria($RubricsID = ''){
		$this->db->select('*');
		$this->db->from('lms_rubrics_criteria AS A');
		$this->db->where('A.rubrics_id',$RubricsID);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function RubricsDescription($RubricsID){
		$this->db->select('*');
		$this->db->from('lms_criteria_description AS A');
		$this->db->where('A.rubrics_id',$RubricsID);
		$query = $this->db->get();
		return $query->result_array();
	}


	public function InsertRubricsTitle($insert){
		$this->db->insert('lms_rubrics_table',$insert);
		return $this->db->insert_id();
	}

	public function InsertEscaleRubric($insert1){
		$this->db->insert('lms_rubrics_escale',$insert1);
		return $this->db->insert_id();
	}

	public function InsertCriteriaRubric($insert2){
		$this->db->insert('lms_rubrics_criteria',$insert2);
		return $this->db->insert_id();
	}

	public function InsertDescriptionRubric($insert3){
		$this->db->insert('lms_criteria_description',$insert3);
	}

	public function UpdateRubrics($array){

		$this->db->set('rubrics', $array['RubricsTitle']);
		$this->db->set('description',$array['RubricsDescription']);
		$this->db->where('rubrics_id',$array['RubricsID']);
		$this->db->update('lms_rubrics_table');
		
	}

	public function UpdateRubricEscale($array){

		$this->db->set('escale',$array['escale']);
		$this->db->where('rubrics_id',$array['RubricsID']);
		$this->db->where('escale_id',$array['escaleid']);
		$this->db->update('lms_rubrics_escale');
		
	}

	public function UpdateRubricCriteria($array){

		$this->db->set('criteria',$array['criteria']);
		$this->db->where('rubrics_id',$array['RubricsID']);
		$this->db->where('criteria_id',$array['criteriaID']);
		$this->db->update('lms_rubrics_criteria');
		
	}

	public function UpdateRubricDescription($array){

		$this->db->set('description',$array['Description']);
		$this->db->where('rubrics_id',$array['RubricsID']);
		$this->db->where('description_id',$array['DescriptionID']);
		$this->db->update('lms_criteria_description');
		
	}

	public function DeleteRubrics($RubricsID){

		$this->db->set('active','0');
		$this->db->where('rubrics_id',$RubricsID);
		$this->db->update('lms_rubrics_table');
		
	}
}
?>