<?php


class AssessmentModel extends CI_Model{
	

	public function SaveAssessmentQuestions($AssessmentQuestion,$code,$QuestionType,$choices,$question_answer,$point){

        $data = array(
            'AssessmentCode' => $code,
            'QuestionType' => $QuestionType,
            'Question' => $AssessmentQuestion,
            'Answer' => $question_answer,
            'Choice_A' => $choices['0'],
            'Choice_B' => $choices['1'],
            'Choice_C' => $choices['2'],
            'Choice_D' => $choices['3'],
            'Points' => $point
            
        );
        
        $this->db->insert('lms_assessment_questions', $data);

    }
    public function SaveAssessmentDetails($user_id,$title,$description,$start,$end,$timelimit,$code){

        $current = date("y-m-d h:i:s",NOW());
        $data = array(
            'AssessmentCode' => $code,
            'AssessmentName' => $title,
            'Description' => $description,
            'DateCreated' => $current,
            'CreatorID' => $user_id,
            'StartDate' => $start,
            'EndDate' => $end,
            'Timelimit' => $timelimit,
        );
        
        $this->db->insert('lms_assessment', $data);

    }
	public function CheckCodeAvailability($code){

		$this->db->where('AssessmentCode', $code);
		$this->db->where('Active', '1');
		$query = $this->db->get('lms_assessment');
		return $query;
    }
    public function GetAssessmentList_Student($array){

		$this->db->where('B.Student_Number', $array['Student_Number']);
        $this->db->where('B.Active', '1');
        $this->db->where('A.Active', '1');
        $this->db->join('lms_assessment_respondents as B','A.AssessmentCode = B.AssessmentCode');
        $this->db->join('Instructor as C','C.ID = A.InstructorID');
		$query = $this->db->get('lms_assessment as A');
        return $query->result_array();
        
    }
    public function GetAssessmentInfo($array){

		$this->db->where('A.AssessmentCode', $array['AssessmentCode']);
        $this->db->where('A.Active', '1');
        $this->db->join('Instructor as C','C.ID = A.InstructorID');
		$query = $this->db->get('lms_assessment as A');
        return $query->result_array();
        
    } 
    public function GetAssessmentLayout($array){

        $this->db->select('
        
        A.AssessmentName,
        A.AssessmentCode,
        A.Description,
        A.StartDate,
        A.Timelimit,
        A.EndDate,
        B.QuestionID,
        B.Question,
        B.Answer,
        B.Choice_A,
        B.Choice_B,
        B.Choice_C,
        B.Choice_D,
        B.Points,
        C.QuestionType,
        C.QuestionTypeID,
        D.Instructor_Name
        ');
        $this->db->join('lms_assessment_questions as B', 'A.AssessmentCode = B.AssessmentCode');
        $this->db->join('lms_assessment_question_types as C', 'B.QuestionType = C.QuestionTypeID');
        $this->db->join('Instructor as D', 'A.InstructorID = D.ID');
        $this->db->where('A.Active', '1');
        $this->db->where('A.AssessmentCode', $array['AssessmentCode']);
		$query = $this->db->get('lms_assessment as A');
		return $query->result_array();
    }
    public function TimeRecord($array){
        
        $this->db->insert('lms_assessment_timer', $array);
       
    }
    public function SubmitAnswer($data){
        
    
        $this->db->insert('lms_assessment_answers', $data);
         

    }
    public function CheckAnswers($array){

        $this->db->where('Student_Number',$array['Student_Number']);
        $this->db->where('AssessmentCode',$array['AssessmentCode']);
        $this->db->where('Active',1);
        $query = $this->db->get('lms_assessment_answers');
        return $query->result_array();
        
    }
    public function ValidateAnswers($array){

        $this->db->select('
            A.Question,
            A.`Answer` AS CorrectAnswer,
            B.`Answer`,
            B.Correct,
            A.Points,
            A.`AssessmentCode`,
            B.`Student_Number`,
            UNIX_TIMESTAMP(C.`End`) as Date,
        ');
        $this->db->select('TIMESTAMPDIFF(MINUTE, C.Start, C.End) AS Remaining');
        $this->db->join('lms_assessment_answers as B','A.AssessmentCode = B.AssessmentCode and A.QuestionID = B.QuestionID');
        $this->db->join('lms_assessment_respondents as C','A.AssessmentCode = C.AssessmentCode and B.Student_Number = C.Student_Number');
        $this->db->where('B.Student_Number',$array['Student_Number']);
        $this->db->where('A.AssessmentCode',$array['AssessmentCode']);
        $this->db->where('B.AssessmentCode',$array['AssessmentCode']);
        $this->db->where('A.Active',1);
        $this->db->where('B.Active',1);
        $this->db->where('C.Active',1);
        $query = $this->db->get('lms_assessment_questions as A');
        return $query->result_array();
        
    }
    public function GetAssessmentResult($ac,$uid){
        $date = $this->GetlatestAnswer($ac,$uid);
        $this->db->select('
        
        A.QuestionAnswer,
        A.Date,
        B.QuestionID,
        B.Question,
        B.Answer,
        B.Choice_A,
        B.Choice_B,
        B.Choice_C,
        B.Choice_D,
        B.Points,
        C.QuestionType,
        C.QuestionTypeID,
        D.AssessmentName,
        D.AssessmentCode,
        D.Description,
        D.StartDate,
        D.Timelimit,
        D.EndDate,

        ');
        
        $this->db->join('lms_assessment_questions as B', 'A.QuestionID = B.QuestionID');
        $this->db->join('lms_assessment_question_types as C', 'B.QuestionType = C.QuestionTypeID');
        $this->db->join('lms_assessment as D', 'D.AssessmentCode = A.AssessmentCode');
        $this->db->where('A.Active', '1');
        $this->db->where('A.AssessmentCode', $ac);
        $this->db->where('A.AccountID', $uid);
        $this->db->where('A.Date', $date);
        $query = $this->db->get('lms_assessment_answers as A');
		return $query;
         

    }
    public function GetlatestAnswer($ac,$uid){

        $this->db->select_max('Date');
        $this->db->where('AccountID', $uid);
        $this->db->where('AssessmentCode', $ac);
        $query = $this->db->get('lms_assessment_answers');
        foreach($query->result_array() as $row){
            return $row['Date'];
        }

    }
    public function CheckTimerSession($array){

        $this->db->where('AssessmentCode', $array['AssessmentCode']);
        $this->db->where('Student_Number', $array['Student_Number']);
        $this->db->where('Active', '1');
		$query = $this->db->get('lms_assessment_timer');
        return $query->result_array();
        
    }
    public function CheckTimerDifference($array){

        $this->db->select('TimeEnd');
        $this->db->select('TIMESTAMPDIFF(SECOND, \''.$array['TimeStarted'].'\', TimeEnd) AS Remaining');
        $this->db->where('AssessmentCode', $array['AssessmentCode']);
        $this->db->where('Student_Number', $array['Student_Number']);
        $this->db->where('Active', '1');
		$query = $this->db->get('lms_assessment_timer');
        return $query->result_array();

    }
    public function CheckAssessmentTime($array){

        $this->db->where('AssessmentCode', $array['AssessmentCode']);
        $this->db->where('StartDate <=', $array['TimeStarted']);
        $this->db->where('EndDate >=', $array['TimeStarted']);
        $this->db->where('Active', '1');
        $query = $this->db->get('lms_assessment');
		return $query->result_array();

    }
    public function InsertRespondent($array){

        $this->db->trans_start();
        $this->db->insert('lms_assessment_respondents', $array);
        $this->db->trans_complete();
        return $this->db->trans_status();
        
    }
    public function CheckRespondent($array){

        $this->db->where('Student_Number',$array['Student_Number']);
        $this->db->where('AssessmentCode',$array['AssessmentCode']);
        $this->db->where('Active',1);
        $this->db->limit(1);
        $query = $this->db->get('lms_assessment_respondents');
        return $query->result_array();

    }
	


}
?>