<?php


class Courseware extends CI_Model{
	

	// STUDENT
	public function GetCoursePosts($array)
	{	
		$this->db->select('post.CoursePost_ID,post.Description,SI.First_Name,SI.Last_Name,SI.Student_Number');
		$this->db->select('TIMESTAMPDIFF(MONTH, `Date`, \''.$array['CurrentDate'].'\') AS ElapsedMonth');
		$this->db->select('TIMESTAMPDIFF(WEEK,  `Date`, \''.$array['CurrentDate'].'\') AS ElapsedWeek');
		$this->db->select('TIMESTAMPDIFF(DAY,  `Date`, \''.$array['CurrentDate'].'\') AS ElapsedDay');
		$this->db->select('TIMESTAMPDIFF(HOUR,  `Date`, \''.$array['CurrentDate'].'\') AS ElapsedHour');
		$this->db->select('TIMESTAMPDIFF(MINUTE,  `Date`, \''.$array['CurrentDate'].'\') AS ElapsedMinute');
		$this->db->select('TIMESTAMPDIFF(SECOND,  `Date`, \''.$array['CurrentDate'].'\') AS ElapsedSecond');
		$this->db->select('DATE_FORMAT(Date,\'%l:%i:%p\') as Time');
		$this->db->select('DATE_FORMAT(Date,\'%M\') as Month');
		$this->db->where('post.SchedCode',$array['SchedCode']);
		$this->db->where('post.Valid',1);		
		$this->db->join('Student_Info as SI','SI.Student_Number = post.Student_Number','inner');
		$this->db->join('Sched as Sc','post.SchedCode = Sc.Sched_Code','inner');
		$this->db->join('Subject as Subj','Sc.Course_Code = Subj.Course_Code','left');
		$this->db->order_by('post.Date', 'Desc');
		$result = $this->db->get('lms_course_posts as post');
		return $result->result_array();
	}
	public function insert_post($array){

		$this->db->insert('lms_course_posts',$array);
		return $this->db->insert_id();

	}
	public function attach_assessment($array){
	
		$this->db->insert('lms_assessment_post_assign',$array);
		return $this->db->insert_id();
	}
	public function get_assessment_attachments($array){

		$this->db->select('PA.AssessmentCode, LA.AssessmentName, I.Instructor_Name');
		$this->db->where('PA.PostID',$array['PostID']);
		$this->db->where('PA.Valid',1);	
		$this->db->where('LA.Active',1);	
		$this->db->join('lms_assessment as LA','PA.AssessmentCode = LA.AssessmentCode','inner');
		$this->db->join('Instructor as I','I.ID = LA.InstructorID','left');
		$result = $this->db->get('lms_assessment_post_assign as PA');
		return $result->result_array();

	}
	
	


}
?>