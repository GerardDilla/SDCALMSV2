<?php


class Schedule extends CI_Model{
	

	// STUDENT
	public function Get_sched_info($SchedCode)
	{	
	
		$this->db->select('C.Day, I.Instructor_Name,B.Sched_Code, C.id AS sched_display_id, T1.Schedule_Time AS stime, T2.Schedule_Time AS etime');      
        $this->db->from('Sections AS A');
        $this->db->join('Sched AS B', 'A.Section_ID = B.Section_ID', 'inner');
        $this->db->join('Sched_Display AS C', 'B.Sched_Code = C.Sched_Code' ,'inner');
        //$this->db->join('Legend AS D', 'B.SchoolYear = D.School_Year AND B.Semester = D.Semester', 'inner');
        $this->db->join('`Subject` AS E', 'E.Course_Code = B.Course_Code', 'inner');
        $this->db->join('Room AS R', 'C.RoomID = R.ID', 'inner');
        $this->db->join('Time AS T1', 'C.Start_Time = T1.Time_From', 'inner');
        $this->db->join('Time AS T2', 'C.End_Time = T2.Time_To', 'inner');
        $this->db->join('Instructor AS I', 'I.ID = C.Instructor_ID', 'left');
        $this->db->where('B.Valid', 1);
        $this->db->where('C.Valid', 1);
        $this->db->where('B.Sched_Code', $SchedCode);

        $query = $this->db->get();
        // reset query
        $this->db->reset_query();

		return $query->result_array();
		
	}
	


}
?>