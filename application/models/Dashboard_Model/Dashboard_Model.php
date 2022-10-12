<?php

class Dashboard_Model extends CI_Model{
    public function getInstructorClasses($data){

    }
    public function getStudentClasses($data){
        $this->db->select('a.*,c.*,d.*,e.Schedule_Time as time_start,f.Schedule_Time as time_end');
        $this->db->from('EnrolledStudent_Subjects as a');
        $this->db->join('Sched as b','a.Sched_Code = b.Sched_Code','left');
        $this->db->join('Sched_Display as c','b.Sched_Code = c.Sched_Code','left');
        $this->db->join('Subject as d','b.Course_Code = d.Course_Code','left');
        $this->db->join('Time as e','c.Start_Time = e.Time_From','left');
        $this->db->join('Time as f','c.End_Time = f.Time_To','left');
        $this->db->where('Cancelled',0);
        $this->db->where('Dropped',0);
        $this->db->where('a.Student_Number',$data['student_number']);
        $this->db->where('a.School_Year',$data['sy']);
        $this->db->where('a.Semester',$data['sem']);
        $query = $this->db->get();
        return $query->result_array();
    }
}

?>