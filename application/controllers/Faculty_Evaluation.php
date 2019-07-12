<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faculty_Evaluation extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library("Set_custom_session");
		  $this->load->model('Student_model/Student_info');
		  $this->load->model('Faculty_Evaluation_Model/Faculty_Evaluation_Model');
		  $this->student_data = $this->set_custom_session->student_session();

	}

	public function Form()
	{
		$instructor_id = $this->input->post('instrutor_id');
		$this->data['sched_code']      = $this->input->post('sched_code');
		$this->data['sem']             = $this->input->post('sem');
		$this->data['term']            = $this->input->post('term');
		$this->data['sy']              = $this->input->post('school_year');
		$this->data['getscriteria']    = $this->Faculty_Evaluation_Model->Get_criteria();
		$this->data['getscale']        = $this->Faculty_Evaluation_Model->Get_scale();
		$this->data['getdescript']     = $this->Faculty_Evaluation_Model->Get_description();
		$this->data['getinstructor']   = $this->Faculty_Evaluation_Model->Get_instructor($instructor_id);
		$this->template($this->set_views->prof_evaluation());
     
	}

	public function Faculty()
	{
		$this->data['getlegend']   = $this->Faculty_Evaluation_Model->Get_legend();
			$array = array(
				'sem'     =>  $this->data['getlegend'][0]['semester'],
				'sy'      =>  $this->data['getlegend'][0]['schoolyear'],
				'stu_num' =>  $this->student_data['Student_Number'],
				'ref'     =>  $this->Student_info->Student_Info_byREF($this->student_data)[0]['Reference_Number']
 			);
		$this->data['data']             = $this->Faculty_Evaluation_Model->Get_Subjects($array);
		$this->data['getenrolled']      = $this->Faculty_Evaluation_Model->Get_Enrolled($array);
		$this->data['getdone'] = array();
		foreach($this->data['data'] as $row) {
			$array2 = array(
				'sem'            =>  $this->data['getlegend'][0]['semester'],
			     'sy'            =>  $this->data['getlegend'][0]['schoolyear'],
				'stu_num'        =>  $this->student_data['Student_Number'],
				'instructor_id'  =>  $row['Instructor_ID'],
				'sched_code'     =>  $row['Sched_Code']
			  );
			$this->data['getdone'][$row['Sched_Code']]  =    $this->Faculty_Evaluation_Model->Get_evaluation_done($array2)->num_rows();  
		}		
		  
     $this->template($this->set_views->faculty());
	}


	public function Insert()
	{
		$instructor_id            = $this->input->post('instrutor_id');
		$student_number           = $this->student_data['Student_Number'];
		$Reference_Number         = $this->Student_info->Student_Info_byREF($this->student_data)[0]['Reference_Number'];
		$sem                      = $this->input->post('sem');
		$term                     = $this->input->post('term');
		$sy                       = $this->input->post('sy');
		$sched_code               =  $this->input->post('sched_code');
		$this->data['getarea']     = $this->Faculty_Evaluation_Model->Get_area();
	     	foreach($this->data['getarea'] as $row) {
		     	$aread_id = $row['id'];	
		   
				 $this->data['getdes']     = $this->Faculty_Evaluation_Model->Get_descriptions($aread_id);
				    foreach($this->data['getdes'] as $row) {


						 $increment     = "eval_".$row['eval_id'];
						 $question_id   = $row['eval_id'];
						 $question_type = $row['evaluation_type_id'];

						 $val = $this->input->post($increment);
						 $val = str_replace("'","\&#39;", $val);
						 $val = stripslashes($val);
		   
                    /*
						echo 'INSTRUCTOR: '.$instructor_id.'<br>';
						echo 'STUDENT NUMBER: '.$student_number.'<br>';
						echo 'REFERENCE NUMBER: '.$Reference_Number.'<br>';
						echo 'SEMESTER: '.$sem.'<br>';
						echo 'TERM: '.$term.'<br>';
						echo 'SCHOOL  YEAR: '.$sy.'<br>';
						echo 'AREA ID: '.$aread_id.'<br>';
						echo 'QUESTION ID: '.$question_id.'<br>';
						echo 'QUESTION TYPE ID: '.$question_type.'<br>';
						echo 'EVAL ANSWER: '.$val.'<br>';
						echo 'SCHED_CODE: '.$sched_code.'<br>';
						echo 'DATIME: <br>';
						echo  '<br>'; */

                        $insert = array();			
						$insert['instructor']         = $instructor_id;
						$insert['student_number']     = $student_number;
						$insert['Reference_Number']   = $Reference_Number;
						$insert['Term']               = $term;
						$insert['Semester']           = $sem;
						$insert['School_Year']        = $sy;
						$insert['area_id']            = $aread_id;
						$insert['question_id']        = $question_id;
						$insert['question_type']      = $question_type;
						$insert['eval_answers']       = $val;
						$insert['sched_code']         = $sched_code;
						$insert['datetime']           = date('Y-m-d H:i:s');
			 
			
					$this->Faculty_Evaluation_Model->InsertFaculty($insert);
					
					}

		}

	redirect('/Faculty_Evaluation/Faculty','refresh');
	

	}
	
	
	
}
