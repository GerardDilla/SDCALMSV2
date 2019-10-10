<?php


class Model_Class_List extends CI_Model{

	//GET Legends
	public function Get_legend(){
		
		$this->db->select('*');
		$this->db->from('Legend');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function Get_Year(){
		
		$this->db->select('*');
		$this->db->from('SchoolYear');
		$query = $this->db->get();
		return $query->result_array();
	}



  //GET Course Title
  public function Get_CourseTitle($array){
	$this->db->select('*, A.Sched_Code AS SC');
	$this->db->from('sched AS A');
	$this->db->join('sched_display AS B', 'A.`Sched_Code` = B.`Sched_Code`','LEFT');
	$this->db->join('subject AS D', 'A.`Course_Code` = D.`Course_Code`','LEFT');
	$this->db->join('sections AS E', 'E.`Section_ID` = A.`Section_ID`','LEFT');
	$this->db->join('instructor AS C','C.`ID` = B.`Instructor_ID`','LEFT');
	$this->db->where('A.`Semester`=', $array['sem']);
	$this->db->where('A.`SchoolYear`=',$array['sy']);
	$this->db->where('B.`Instructor_ID` =',$array['Prof']);
	$this->db->group_by('A.Sched_Code');
	$query = $this->db->get();
	return $query->result_array();  
									
  }

  public function get_class_list($sc){
    $this->db->select
    ('
    A.`Sched_Code`,
    A.`Semester`,
    A.`SchoolYear`,
    A.`Course_Code`,
    B.`Program`,
    B.`Reference_Number`,
    B.`Student_Number`,
    I.`Section_Name`,
    B.`Year_Level`,
    C.`First_Name`,
    C.`Middle_Name`,
    C.`Last_Name`,
    D.`Day`,
    E.`Room`,
    F.`Schedule_Time AS Startime`,
    F2.`Schedule_Time AS Endtime`,
    G.`Instructor_Name`,
    H.Course_Title,
    H.Course_Lec_Unit,
    H.Course_Lab_Unit
    ');
    $this->db->from('Sched AS A');
    $this->db->join('EnrolledStudent_Subjects AS B ', 'A.`Sched_Code` = B.`Sched_Code`', 'inner');
    $this->db->join('Student_Info AS C', 'B.`Student_Number` = C.`Student_Number`' ,'left');
    $this->db->join('Sched_Display AS D', 'D.`Sched_Code` = A.`Sched_Code`', 'left');
    $this->db->join('Room AS E', 'E.`ID` = D.`RoomID`');
    $this->db->join('Time AS F', 'F.`Time_From` = D.`Start_Time`', 'left');
    $this->db->join('Time AS F2', 'F2.`Time_To` = D.`End_Time`','LEFT');
    $this->db->join('Instructor AS G', 'D.`Instructor_ID` = G.`ID`','left');
    $this->db->join('Subject AS H', 'H.`Course_Code`= A.`Course_Code`','left');
    $this->db->join('Sections AS I', 'I.`Section_ID`= A.`Section_ID`','left');
    $this->db->where('A.Sched_Code =',$sc);
    $this->db->where('B.Dropped  !=','1');
    $this->db->where('B.Cancelled !=','1');
    $this->db->order_by('C.Last_Name','ASC');
    $this->db->group_by('B.Reference_Number');
	$query = $this->db->get();
	return $query->result_array();  
  }



	

}
?>