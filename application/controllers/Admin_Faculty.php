<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Faculty extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library("Set_custom_session");
		  $this->load->library('pagination');
		  $this->load->model('Student_model/Student_info');
		  $this->load->model('Admin_Faculty_Evaluation_Model/Search_Student_Model');
		  $this->load->model('Admin_Faculty_Evaluation_Model/Prof_Search_Model');
		  $this->load->model('Admin_Faculty_Evaluation_Model/Proffesor_Model');
		  $this->load->model('Admin_Faculty_Evaluation_Model/Results_Model');
		  $this->student_data = $this->set_custom_session->student_session();

	}
/// SEARCH STUDENTS  MOUDLE
	public function Search_Student()
	{
		$this->data['get_sy']          = $this->Search_Student_Model->Get_sy();
		$this->data['get_sem']         = $this->Search_Student_Model->Get_sem();
		$this->data['get_course']      = $this->Search_Student_Model->Get_course();
		$this->data['get_yrlvl']       = $this->Search_Student_Model->Get_year();
		$this->template($this->set_views->Admin_Faculty());
     
	}

	//Get Sections
	function fetch_sections()
	{
	     if($this->input->post('Program_id'))
        	{
				$resultdata = $this->Search_Student_Model->GetSection_Name($this->input->post('Program_id'));
				echo json_encode($resultdata);
	       }
	}

  // GET STUDENTS WHO EVALUATE
	function fetch_students()
	{
	       $array = array(
			 'sy'         => $this->input->get('sy'),
			 'sem'        => $this->input->get('sem'),
			 'Program'    => $this->input->get('Program'),
			 'Section'    => $this->input->get('Section'),
			 'YearLevel'  => $this->input->get('YearLevel')
		   );
		   
			$resultdata = $this->Search_Student_Model->Get_Students($array);
			echo json_encode($resultdata);
	}
  // GET STUDENTS WHO NOT EVALUATE
	function fetch_studentsNon()
	{
	       $array = array(
			 'sy'         => $this->input->get('sy'),
			 'sem'        => $this->input->get('sem'),
			 'Program'    => $this->input->get('Program'),
			 'Section'    => $this->input->get('Section'),
			 'YearLevel'  => $this->input->get('YearLevel')
		   );
		   
			$resultdata = $this->Search_Student_Model->Get_StudentsNotDone($array);
			echo json_encode($resultdata);
	}

/// SEARCH PROFFESOR  MOUDLE

	public function Prof_Search()
	{
		$this->data['get_sy']                 = $this->Prof_Search_Model->Get_sy();
		$this->data['get_sem']                = $this->Prof_Search_Model->Get_sem();
		$this->template($this->set_views->Admin_Search_Prof());
     
	}

	///GET PROFFESOR
	function fetch_proff()
	{
	       $array = array(
			 'sy'         => $this->input->get('sy'),
			 'sem'        => $this->input->get('sem')
		   );
		   
			$resultdata = $this->Prof_Search_Model->Get_Instructor($array);
			echo json_encode($resultdata);
	} 

	///GET Course Title
	function fetch_course_title()
	{
		$array = array(
			'sy'             => $this->input->get('sy'),
			'sem'            => $this->input->get('sem'),
			'proffesor'      => $this->input->get('proffesor')
		  );
		
		$resultdata = $this->Prof_Search_Model->Get_CourseTitle($array);
		echo json_encode($resultdata);
	} 



	///GET Students Who Evaluate this Proff
	function fetch_students_proff()
	{
			$array = array(
				'sy'             => $this->input->get('sy'),
				'sem'            => $this->input->get('sem'),
				'proffesor'      => $this->input->get('proffesor'),
				'sched_code'     => $this->input->get('Course_Title'),
				'Section'        => $this->input->get('Section')
			  );
			
			$resultdata = $this->Prof_Search_Model->Get_Students($array);
			echo json_encode($resultdata);
	} 


		///GET Students Who not Done Evaluate this Proff
		function fetch_nonstudents_proff()
		{
				$array = array(
					'sy'             => $this->input->get('sy'),
					'sem'            => $this->input->get('sem'),
					'proffesor'      => $this->input->get('proffesor'),
					'sched_code'     => $this->input->get('Course_Title'),
					'Section'        => $this->input->get('Section')
				  );
				
				$resultdata = $this->Prof_Search_Model->Get_StudentsNotDone($array);
				echo json_encode($resultdata);
		} 
		
	///Professor Active or De active Module
   // Professor View
	public function Professor()
	{
	 $this->template($this->set_views->Admin_Professor());
	}

	//Get Prof All
	function fetch_professor()
	{	
		$array = array(
			'Proffesor'         => $this->input->get('Proffesor'),
			'ActiveDeactive'    => $this->input->get('ActiveDeactive'),
			'offset'            => $this->input->get('offset'),
			'perpage'           => $this->input->get('perpage')
		  );

	$resultdata = $this->Proffesor_Model->Get_all_Profs($array);
	echo json_encode($resultdata);
	} 

	//Get Prof All
	function fetch_professors()
	{	
		$array = array(
			'Proffesor'         => $this->input->get('Proffesor'),
			'ActiveDeactive'    => $this->input->get('ActiveDeactive')
		  );

	$resultdata = $this->Proffesor_Model->Get_all_Profss($array);
	echo $resultdata;
	} 

	//Change Active to Deactive
	function fetch_Active()
	{	
	$id   = $this->input->get('id');		
	$this->Proffesor_Model->UpdateDeactive($id);
	} 
	//Change Deactive to Active
	function fetch_Deactive()
	{	
	$id   = $this->input->get('id');		
	$this->Proffesor_Model->UpdateActive($id);
	} 
	
	
	/// RESULTS MODULE

	public function Professor_result()
	{
		$this->data['get_sy']          = $this->Results_Model->Get_sy();
		$this->data['get_sem']         = $this->Results_Model->Get_sem();
		$this->template($this->set_views->Admin_result());
     
	}

    //Get Prof All
	function fetch_professor_result()
	{	
		$array = array(
			'Proffesor'         => $this->input->get('Proffesor'),
			'offset'            => $this->input->get('offset'),
			'perpage'           => $this->input->get('perpage')
		  );

	$resultdata = $this->Results_Model->Get_Prof($array);
	echo json_encode($resultdata);
	} 

	//Get Pagination
	function fetch_professors_result()
	{	
		$array = array(
			'Proffesor'         => $this->input->get('Proffesor')
		  );

	$resultdata = $this->Results_Model->Get_Profs($array);
	echo $resultdata;
	} 
   // Total Numrows Evaluation Result
	function fetch_all_results()
	{	
		$array = array(
			'Proffesor'         => $this->input->get('Proffesor'),
			'sem'               => $this->input->get('Semester'),
			'sy'                => $this->input->get('SchoolYear')
		  );
	$resultdata = $this->Results_Model->Get_EvaluateResults($array);
	echo $resultdata;
	} 
  
  /// RESULTS PAGE MODULE
  public function result($prof_id="",$sem="",$sy="")
  {
    $this->data['prof_id'] = $prof_id;
	$this->data['sem'] = $sem;
	$this->data['sy'] = $sy;

	$this->data['getdescription']    = $this->Results_Model->Get_description();
	$this->data['getscriteria']      = $this->Results_Model->Get_criteria();


	$area = ''; 
		foreach($this->data['getdescription'] as $row1){
		     if($area != $row1['category_name']){

					
			
			echo 'Area: '.$row1['id'].'<br>';
			echo '<hr>';
			$area = $row1['category_name'];
		}//end if	
		//echo '<br>';
	
		echo 'Eval_ID: '.$row1['eval_id'].'<br>';
		//echo '<br>';

		$rating_average = array();
		$question_sum = 0;
		$total_evaluators = 0;
		$Quotient = 0;
		$Percentage = 0;
		$SumofAvgPerArea = 0;

		foreach($this->data['getscriteria'] as $row2){
			$array = array(
				'areaID'            => $row1['id'],
				'eval_id'           => $row1['eval_id'],
				'ratings'           => $row2['ratings'],
				'Prof_id'           => $prof_id,
				'sy'                => $sy,
				'sem'               => $sem
			);

			//Get all evaluators
			$numrows =	$this->Results_Model->Get_result($array);

			//Adds to total of evaluators
			$total_evaluators = $total_evaluators + $numrows;

			//Get average per ratings
			$rating_average[$array['ratings']] =  $numrows * $row2['ratings'];

	
/*
//echo  $numrows.'<br>';
// echo  $row2['ratings'].'<br> ';
$RowsXCrit =  $numrows * $row2['ratings'];
$TotalRows = $RowsXCrit;
$TotalRows1 = $numrows ;	
// echo $RowsXCrit.'<br>';
if($TotalRows != '0' || $TotalRows1 != '0'){
	$TotalQCrows = $TotalRows / $TotalRows1;
	$TotalPecentage = $TotalQCrows / 5 * 100;	
}
else{

	$TotalQCrows = '0';
	$TotalPecentage = '0';

}

$Test = $TotalQCrows;
$Test1 = $TotalPecentage;

round($TotalQCrows,2).'<br>';
round($TotalPecentage,2).'<br>';
*/

//$numrows1 = $this->data['getdescription']->num_rows();
//	$Avg  =  $Test / $numrows1;
// 	$Perce = $Test1 / $numrows1;	

//	echo 'AreaID:'.$row1['id'].'<br>';

//	echo 'Ratings: '.$row2['ratings'].'<br>';
//		echo 'NumberOfEvaluate: '.$numrows.'<br>';
//	echo 'SUM OF TOTAL OF EVALUATEE WHO ANSWER X BY RATINGS: '.$rating_average[$array['ratings']].'<br>';
//	echo 'TOTAL OF EVALUATEE WHO ANSWER: '.$TotalRows1.'<br>';
//	echo 'QUOTIENT OF TOTAL OF EVALUATEE WHO ANSWER X BY RATINGS AND  TOTAL OF EVALUATEE WHO ANSWER : '.$TotalQCrows.'<br>';
//  echo 'TotalPecentage: '.$TotalPecentage.'%<br>';
//  echo $Avg.'<br>';
//  echo $Perce.'<br>'; 

}//Criteria
	
		foreach($rating_average as $averange_row){

				$question_sum = $question_sum + $averange_row;
		}

		
					if($question_sum != '0' || $total_evaluators != '0'){
						$Quotient = $question_sum / $total_evaluators;
					
					}
					else{

					$question_sum = '0';
						$total_evaluators = '0';
				    }
			
			$Percentage =  $Quotient / 5 * 100;
			
		//	$SumofAvgPerArea = $SumofAvgPerArea + $Quotient;
		//	$SumofPercentage = $SumofPercentage + $Percentage;

			

			echo 'TOTAL OF EVALUATORS '.$total_evaluators.'<br>';
			echo 'TOTAL SUM OF QUESTION '.$question_sum.'<br>';
		    echo 'Average: '.$Quotient.'<br>';
			echo 'Percentage: '.$Percentage.'%<HR>';
			



		//	echo 'Total Average per Area: '.$SumofAvgPerArea.'<HR>';
		
		
		   // echo 'Total Percentage per Area: '.$SumofPercentage.'<HR>';
		}//Description
	
//	$this->template($this->set_views->Admin_ResultsPage());
   
  }
	
	
	
	
}
