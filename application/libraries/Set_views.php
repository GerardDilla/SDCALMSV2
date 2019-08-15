<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class set_views 
{
	private $main = 'Main';
	private $layout = 'Layout';
	private $skeleton = 'Skeleton';

	public function dashboard()
	{
		return $this->main.'/Dashboard';
	}
	public function portfolio()
	{
		return $this->main.'/Portfolio';
	}
	public function login()
	{
		return $this->main.'/Login';
	}
	public function registration()
	{
		return $this->main.'/Registration';
	}
	public function keygen()
	{
		return $this->main.'/Keygen';
	}
	public function verification()
	{
		return $this->main.'/Verification';
	}
	public function verification_final()
	{
		return $this->main.'/Verification_Final';
	}
	public function grade()
	{
		return $this->main.'/GradeSheet';
	}
	public function balance()
	{
		return $this->main.'/BalanceSheet';
	}
	public function schedule()
	{
		return $this->main.'/ScheduleSheet';
	}
	public function assessmentlist()
	{
		return $this->main.'/AssessmentList';
	}
	public function preassessment()
	{
		return $this->main.'/PreAssessment';
	}
	public function examination(){

		return $this->main.'/Examination';

	}
	public function classroom()
	{
		return $this->main.'/ScheduleSheet';
	}
	public function rubrics()
	{
		return $this->main.'/ScheduleSheet';
	}
	public function error()
	{
		return $this->main.'/ErrorPage';
	}
	
	///Student Portal Dashboard

		public function student_dashboard()
		{
			return $this->main.'/Dashboard';
		}
		
	///Student Portal Dashboard


	///Student Portal Prof Evaluation

	public function prof_evaluation()
	{
		return $this->main.'/Prof_Evaluation';
	}
		
	public function faculty()
	{
		return $this->main.'/Faculty';
	}
	  
	  ///Student Portal Prof Evaluation

	  /// Admin Faculty Evaluation

	public function Admin_Faculty()
	{
		return $this->main.'/Faculty_Evluation_Admin/Search_student';
	}
	public function Admin_Set_Evaluation()
	{
		return $this->main.'/Faculty_Evluation_Admin/Set_Evaluation';
	}
	public function Admin_Search_Prof()
	{
		return $this->main.'/Faculty_Evluation_Admin/Prof_Search';
	}
	public function Admin_Professor()
	{
		return $this->main.'/Faculty_Evluation_Admin/Professor';
	}
	 /// Admin Faculty Evaluation


	///Parent Dashboard

	public function parent_dashboard()
	{
		return $this->main.'/ParentDashboard';
	}

	///Parent Dashboard








}
?>
