<?php


class Search_Student_Model extends CI_Model{

    //GET School Year
	public function Get_sy(){
		
		$this->db->select('School_Year');
		$this->db->from('ie_evaluationresult');
		$this->db->group_by('School_Year');
		$query = $this->db->get();
		return $query->result_array();
	}

	//GET Semester
	public function Get_sem(){
		
		$this->db->select('Semester');
		$this->db->from('ie_evaluationresult');
		$this->db->group_by('Semester');
		$query = $this->db->get();
		return $query->result_array();
	}


	//GET Course
	public function Get_course(){
		
		$this->db->select('*');
		$this->db->from('programs');
		$this->db->order_by('Program_Code','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}

	//GET Year Level
	public function Get_year(){
		
		$this->db->select('Program_Duration');
		$this->db->from('programs');
		$this->db->order_by('Program_Duration','ASC');
		$this->db->group_by('Program_Duration');
		$query = $this->db->get();
		return $query->result_array();
	}


   //GET SECTION
	public function GetSection_Name($Program_id){
		$this->db->select('*,Section_Name as SN');
		$this->db->from('Programs');
		$this->db->join('Sections', 'Sections.Program_ID = Programs.Program_ID','LEFT');
		$this->db->where('Sections.Active','1');
		$this->db->where('Programs.Program_Code',$Program_id);
		$this->db->order_by('Sections.Section_Name');
		$query = $this->db->get();
		return $query->result_array();  
										
	  }


	//GET Student 
	public function Get_Students($array){
		$this->db->select('*');
		$this->db->from('ie_evaluationresult AS A');
		$this->db->join('Sched AS B', 'A.`sched_code` = B.`Sched_Code`','LEFT');
		$this->db->join('sections AS C', 'B.`Section_ID` = C.`Section_ID`','LEFT');
		$this->db->join('Student_Info AS D','A.`Reference_Number` = D.`Reference_Number`','LEFT');
		$this->db->join('fees_enrolled_college AS E','A.`Reference_Number` = E.`Reference_Number`','LEFT');


		if($array['Program'] != NULL){
			$this->db->where('E.`course` =',$array['Program']);
			//Where Conditions
			if(isset($array['Section'])){
			//  echo 'With sy <br>';
			$this->db->where('C.`Section_Name` =',$array['Section']);
			}
			if(isset($array['YearLevel'])){
				//  echo 'With sy <br>';
			$this->db->where('E.`YearLevel` =',$array['YearLevel']);
			}
		}

		$this->db->where('A.`Semester` =',$array['sem']);
		$this->db->where('B.`Semester` =',$array['sem']);
		$this->db->where('A.`School_Year`=',$array['sy']);
		$this->db->where('B.`SchoolYear` =',$array['sy']);
		$this->db->group_by('A.`Reference_Number`');
		$query = $this->db->get();
		return $query->result_array();  
										
	  }



}
?>