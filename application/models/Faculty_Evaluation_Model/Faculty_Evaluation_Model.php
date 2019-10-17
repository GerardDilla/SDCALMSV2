<?php


class Faculty_Evaluation_Model extends CI_Model{

    //GET LEGEND
	public function Get_legend(){
		
		$this->db->select('*');
		$this->db->from('ie_legend');
		$query = $this->db->get();
		return $query->result_array();
	}

	 //GET LEGEND
	 public function Get_Enrolled($array){
		
		$this->db->select('*');
		$this->db->from('Fees_Enrolled_College');
		$this->db->where('Reference_Number =',$array['ref']);    
		$this->db->where('Semester =',$array['sem']);
		$this->db->where('schoolyear =',$array['sy']);
		$query = $this->db->get();
		return $query;
	}
		
		

	//CHECK EVALUTION DONE
	public function Get_evaluation_done($array2){
		
		$this->db->select('*');
		$this->db->from('ie_evaluationresult');
		$this->db->where('student_number =',$array2['stu_num']);  
		$this->db->where('Semester =',$array2['sem']);
		$this->db->where('School_Year =',$array2['sy']);
		$this->db->where('Instructor =',$array2['Instructor_id']);
		$this->db->where('Sched_Code =',$array2['sched_code']);
		$query = $this->db->get();
		return $query;
	}
		

	// GET FACULTY NAME AND SUBJECTS
	public function Get_Subjects($array){
		
		$this->db->select('
		D.`Course_Code`,
		D.`Sched_Code`,
		D.`SchoolYear`,
		D.`Semester`,
		C.`Instructor_Name`,
		B.`Instructor_ID`,
		E.Course_Title, 
		E.`Course_Lab_Unit`,
		E.`Course_Lec_Unit`,
		A.Section
		');
		$this->db->from('EnrolledStudent_Subjects AS A');
		$this->db->join('Sched_Display AS B','B.`Sched_Code` = A.`Sched_Code`','left');
		$this->db->join('Instructor AS C','C.ID = B.`Instructor_ID`','left');
		$this->db->join('Sched AS D','D.`Sched_Code` = B.`Sched_Code`','left');
		$this->db->join('Subject AS E','E.`Course_Code` = D.`Course_Code`','left');
		$this->db->join('Sections AS F','F.`Section_ID` = D.`Section_ID`','left');
		$this->db->where('A.Reference_Number =',$array['ref']);    
		$this->db->where('A.Student_Number =',$array['stu_num']);  
		$this->db->where('A.Semester =',$array['sem']);
		$this->db->where('C.Instructor_ID !=','');
		$this->db->where('C.Instructor_ID !=','0');
		$this->db->where('A.School_Year =',$array['sy']);
		//$this->db->where('F.Section_Name =','BMMA1B');
		$this->db->where('A.Dropped =',0);
		$this->db->where('A.Cancelled =',0);
		$query = $this->db->get();
        return $query->result_array();
	}


	//GET Area
	public function Get_area(){
		
		$this->db->select('*');
		$this->db->from('ie_area');
		$query = $this->db->get();
		return $query->result_array();
	}

	//GET CRITERIA
	public function Get_criteria(){
		
		$this->db->select('ratings');
		$this->db->from('ie_criteria');
		$this->db->order_by('ratings','DESC');
		$query = $this->db->get();
        return $query->result_array();
	}
	
	//GET  SCALE
	public function Get_scale(){
		
		$this->db->select('ecale');
		$this->db->from('ie_eval_scale');
		$query = $this->db->get();
        return $query->result_array();
	}

	//GET DESCRIPTION
	public function Get_description(){
		
		$this->db->select('*
		');
		$this->db->from('ie_area_description AS A');
		$this->db->join('ie_evaluation_type AS B','A.evaluation_type_id = B.id','INNER');
		$this->db->join('ie_area AS C','A.area_id = C.id','INNER');
		$this->db->order_by('C.orderr','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
		

	//GET INSTRUCTOR
	public function Get_Instructor($Instructor_id){
		
		$this->db->select('*');
		$this->db->from('Instructor');
		$this->db->where('ID =',$Instructor_id);
		$query = $this->db->get();
		return $query->result_array();
	}
		
    //GET DESCRIPTION INSERT
	public function Get_descriptions($aread_id){
		
		$this->db->select('*
		');
		$this->db->from('ie_area_description AS A');
		$this->db->join('ie_evaluation_type AS B','A.evaluation_type_id = B.id','INNER');
		$this->db->join('ie_area AS C','A.area_id = C.id','INNER');
		$this->db->where('A.area_id =',$aread_id);
		$this->db->order_by('C.orderr','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
		
	

	public function InsertFaculty($insert){

		$this->db->insert('ie_evaluationresult',$insert);
	  
	  }
	  
	  

}
?>