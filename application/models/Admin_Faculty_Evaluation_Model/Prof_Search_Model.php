<?php


class Prof_Search_Model extends CI_Model{

   
   //GET School Year
	public function Get_sy(){
		
		$this->db->select('School_Year');
		$this->db->from('enrolledstudent_subjects');
		$this->db->order_by('School_Year','DESC');
		$this->db->group_by('School_Year');
		$query = $this->db->get();
		return $query->result_array();
	}

	//GET Semester
	public function Get_sem(){
		
		$this->db->select('Semester');
		$this->db->from('enrolledstudent_subjects');
		$this->db->order_by('Semester','DESC');
		$this->db->group_by('Semester');
		$query = $this->db->get();
		return $query->result_array();
	}



	//GET STUDENTS WHO EVALUATE
	public function Get_Instructor($array){
		$this->db->select('B.`Instructor_ID`,C.`ID`,C.`Instructor_Name`');
		$this->db->from('sched AS A');
		$this->db->join('sched_display AS B', 'A.`Sched_Code` = B.`Sched_Code`','LEFT');
		$this->db->join('Instructor AS C','C.`ID` = B.`Instructor_ID`','LEFT');
		$this->db->where('A.`Semester`=', $array['sem']);
		$this->db->where('A.`SchoolYear`=',$array['sy']);
		$this->db->where('B.`Instructor_ID` !=','');
		$this->db->where('C.`Active` = ','1');
		$this->db->group_by('C.`ID`');
		$this->db->order_by('C.`Instructor_Name`','ASC');
		$query = $this->db->get();
		return $query->result_array();  
										
	  }


	  //GET Course Title
	public function Get_CourseTitle($array){
		$this->db->select('*');
		$this->db->from('sched AS A');
		$this->db->join('sched_display AS B', 'A.`Sched_Code` = B.`Sched_Code`','LEFT');
		$this->db->join('subject AS D', 'A.`Course_Code` = D.`Course_Code`','LEFT');
		$this->db->join('sections AS E', 'E.`Section_ID` = A.`Section_ID`','LEFT');
		$this->db->join('Instructor AS C','C.`ID` = B.`Instructor_ID`','LEFT');
		$this->db->where('A.`Semester`=', $array['sem']);
		$this->db->where('A.`SchoolYear`=',$array['sy']);
		$this->db->where('B.`Instructor_ID` =',$array['proffesor']);
		$this->db->group_by('A.Sched_Code');
		$query = $this->db->get();
		return $query->result_array();  
										
	  }


	  //GET Section
	public function Get_Section($array){
		$this->db->select('*');
		$this->db->from('sched AS A');
		$this->db->join('sched_display AS B', 'A.`Sched_Code` = B.`Sched_Code`','LEFT');
		$this->db->join('sections AS C', 'A.`Section_ID` = C.`Section_ID`','LEFT');
		$this->db->where('A.`Semester`=', $array['sem']);
		$this->db->where('A.`Semester`=', $array['sem']);
		$this->db->where('A.`Sched_Code`=',$array['Course_Title']);
		$this->db->group_by('A.Sched_Code');
		$query = $this->db->get();
		return $query->result_array();  
										
	  }


	//GET STUDENTS WHO EVALUATE
	public function Get_Students($array){
		$this->db->select('A.`Reference_Number`,A.Student_Number,D.`First_Name`,D.`Middle_Name`,D.`Last_Name`,F.`Course`,C.`Section_Name`,F.`YearLevel`');
		$this->db->from('ie_evaluationresult AS A');
		$this->db->join('Sched AS B', 'A.`sched_code` = B.`Sched_Code`','LEFT');
		$this->db->join('sections AS C', 'B.`Section_ID` = C.`Section_ID`','LEFT');
		$this->db->join('Student_Info AS D','A.`Reference_Number` = D.`Reference_Number`','LEFT');
		$this->db->join('`Fees_Enrolled_College` AS `F` ','F.`Reference_Number` = A.`Reference_Number`','LEFT');
		$this->db->where('A.`Semester` =',$array['sem']);
		$this->db->where('B.`Semester` =',$array['sem']);
		$this->db->where('A.`School_Year`=',$array['sy']);
		$this->db->where('B.`SchoolYear` =',$array['sy']);
		$this->db->where('A.`Instructor` =',$array['proffesor']);
		$this->db->where('C.`Section_Name` =',$array['Section']);
		$this->db->group_by('A.`Reference_Number`');
		$query = $this->db->get();
		return $query->result_array();  
										
	}


	  
	//GET STUDENTS WHO NOT DONE EVALUATE
	 public function Get_StudentsNotDone($array){
		$this->db->select('A.`Reference_Number`,A.Student_Number,E.`First_Name`,E.`Middle_Name`,E.`Last_Name`,F.`Course`,D.`Section_Name`,F.`YearLevel`');
		$this->db->from('`EnrolledStudent_Subjects` AS `A`');
		$this->db->join('Sched AS C', 'A.`Sched_Code` = C.`Sched_Code`','LEFT');
		$this->db->join('`Sections` AS `D`','D.`Section_ID` = C.`Section_ID` ','LEFT');
		$this->db->join('`Student_Info` AS `E`',' E.`Reference_Number` = A.`Reference_Number`','LEFT');
		$this->db->join('ie_evaluationresult  AS B','A.`Reference_Number` = B.`Reference_Number`','LEFT');
		$this->db->join('`Fees_Enrolled_College` AS `F` ','F.`Reference_Number` = A.`Reference_Number`','LEFT');
		$this->db->join('sched_display  AS G','G.`Sched_Code` = C.`Sched_Code`','LEFT');
		$this->db->where('A.`Semester` =',$array['sem']);
		$this->db->where('C.`Semester` =',$array['sem']);
		$this->db->where('A.`School_Year`=',$array['sy']);
		$this->db->where('C.`SchoolYear` =',$array['sy']);
		$this->db->where('G.`Instructor_ID` =',$array['proffesor']);
		$this->db->where('D.`Section_Name` =',$array['Section']);
		$this->db->group_by('A.`Reference_Number`');
		$query = $this->db->get();
		return $query->result_array();  
											
		  }












}
?>