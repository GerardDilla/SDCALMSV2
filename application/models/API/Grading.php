<?php


class Grading extends CI_Model{
	

	// STUDENT
	public function Get_grades($array)
	{	
		$this->db->select('
		`G`.`Student_Number`,
		`G`.`Sched_Code`,
		`G`.`School_Year`,
		`G`.`Semester`,
		`G`.`Prelim`,
		`G`.`Midterm`,
		`G`.`Finals`,
		`G`.`Final_Grade` AS `FG`,
		`G`.`Remarks_ID`,
		`R`.`Remarks` AS `R1`,
		`GC`.`Final_Grade` AS `FG2`,
		`GC`.`Remarks` AS `R2`,
		IFNULL(
		IF(
		  G.Remarks_ID = 3,
		  `GC`.`Final_Grade`,
		  G.Final_Grade
		),G.Final_Grade)
		AS FINALGRADE,
		IFNULL(
		UCASE(
		  IF(
			G.Remarks_ID = 3,
			`GC`.`Remarks`,
			R.Remarks
		  )
		),R.Remarks)
		AS REMARKS 
		');
		$this->db->where('G.Student_Number',$array['Student_Number']);
		$this->db->where('G.School_Year',$array['School_Year']);
		$this->db->where('G.Semester',$array['Semester']);
		$this->db->where('G.Sched_Code',$array['Sched_Code']);
		$this->db->join('Subject as S','G.Subject_Code = S.Course_Code','left');
		$this->db->join('Remarks as R','G.Remarks_ID = R.Remarks_ID');
		$this->db->join('GradeCompletion as GC','G.Student_Number = GC.Student_Number AND G.Sched_Code = GC.Schedcode','left');
		$result = $this->db->get('Grading as G');
		return $result->result_array();
	
	}
	public function Get_Subjects($array){
		
		$this->db->select('
		E.Student_Number,
		E.Reference_Number,
		E.School_Year,
		E.Semester,
		Sc.Sched_Code, 
		S.Course_Title,
		S.Course_Code
		');
		$this->db->where('E.Student_Number',$array['Student_Number']);
		$this->db->where('E.School_Year',$array['School_Year']);
		$this->db->where('E.Semester',$array['Semester']);
		$this->db->where('E.Dropped',0);
		$this->db->where('E.Cancelled',0);
		$this->db->join('Sched as Sc','E.Sched_Code = Sc.Sched_Code','left');
		$this->db->join('Subject as S','Sc.Course_Code = S.Course_Code','left');
		$result = $this->db->get('EnrolledStudent_Subjects as E');
		return $result->result_array();
	}
	public function Get_Subject_Load($array){
		
		$this->db->select('
		SC.Sched_Code,
		S.Course_Title,
		S.Course_Code,
		SC.SchoolYear,
		SC.Semester
		');
		$this->db->where('SD.Instructor_ID',$array['Instructor_ID']);
		if(array_key_exists('School_Year', $array)){
            $this->db->where('SC.SchoolYear',$array['School_Year']);
		}
		if(array_key_exists('Semester', $array)){
            $this->db->where('SC.Semester',$array['Semester']);
        }
		$this->db->where('SC.Valid',1);
		$this->db->join('Sched_Display as SD','SC.Sched_Code = SD.Sched_Code');
		$this->db->join('Instructor as I','I.ID = SC.Instructor_ID OR I.ID = SD.Instructor_ID');
		$this->db->join('Subject as S','SC.Course_Code = S.Course_Code','left');
		$this->db->group_by('SC.Sched_Code');
		$result = $this->db->get('Sched as SC');
		return $result->result_array();
	}
	public function Get_Outcomes($array){

		$this->db->where('AssessmentCode',$array['AssessmentCode']);
		$this->db->where('valid',1);
		$result = $this->db->get('lms_outcomes');
		return $result->result_array();

	}
	public function Get_SchoolYear_Choices(){

	}
	public function Get_Semester_Choices(){
		
	}


}
?>