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

        $this->db->select('
        *,
        B.ID AS RespondentID,
        DATE_FORMAT(B.End,"%M %d , %Y") as Date,
        ',false);
		$this->db->where('B.Student_Number', $array['Student_Number']);
        $this->db->where('B.Active', '1');
        $this->db->where('A.Active', '1');
        $this->db->join('lms_assessment_respondents as B','A.AssessmentCode = B.AssessmentCode');
        $this->db->join('Instructor as C','C.ID = A.InstructorID');
        if(array_key_exists('Limit', $array)){
            $this->db->limit($array['Limit']);
        }
        $this->db->order_by('RespondentID','DESC');
		$query = $this->db->get('lms_assessment as A');
        return $query->result_array();
        
    }
    public function GetAssessmentInfo($array){

        $this->db->select('
        *,
        UNIX_TIMESTAMP(A.`StartDate`) as StartDate,
        UNIX_TIMESTAMP(A.`EndDate`) as EndDate
        ');
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
    public function ValidateAnswers($array){

        $this->db->select('
            Q.Question,
            Q.`Answer` AS CorrectAnswer,
            Ans.`Answer`,
            Ans.Correct,
            Q.Points,
            Q.`AssessmentCode`,
            out.ID as OutcomeID,
            out.Outcome,
            Ans.`Student_Number`,
            UNIX_TIMESTAMP(Resp.`End`) as Date,
        ');
        $this->db->select('TIMESTAMPDIFF(MINUTE, Resp.Start, Resp.End) AS Remaining');
        $this->db->join('lms_assessment_respondents as Resp','Q.AssessmentCode = Resp.AssessmentCode');
        $this->db->join('lms_assessment_answers as Ans','Resp.ID = Ans.RespondentID and Q.QuestionID = Ans.QuestionID');
        $this->db->join('grading_outcomes as out','out.ID = Q.OutcomeID and out.Valid = 1','left');
        $this->db->where('Ans.Student_Number',$array['Student_Number']);
        $this->db->where('Q.AssessmentCode',$array['AssessmentCode']);
        $this->db->where('Ans.AssessmentCode',$array['AssessmentCode']);
        $this->db->where('Q.Active',1);
        $this->db->where('Ans.Active',1);
        $this->db->where('Resp.Active',1);
        $query = $this->db->get('lms_assessment_questions as Q');
        return $query->result_array();
        
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

        $this->db->insert('lms_assessment_respondents', $array);
        return $this->db->insert_id();
        
    }
    public function UpdateRespondentScore($ID,$array){

        $this->db->trans_start();
        $this->db->where('ID',$ID);
        $this->db->update('lms_assessment_respondents', $array);
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
    public function Get_Assessment_List($array = array()){

        $this->db->select('*');
        $this->db->where('A.Active', '1');
        $this->db->join('Instructor as C','C.ID = A.InstructorID');
        if(array_key_exists('Limit', $array)){
            $this->db->limit($array['Limit']);
        }
		$query = $this->db->get('lms_assessment as A');
        return $query->result_array();

    }
    public function Validate_Outcome($ID){

        $this->db->where('ID', $ID);
        $this->db->where('Valid', '1');
        $query = $this->db->get('grading_outcomes');
        return $query->result_array();
    }   
	


}
?>