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
	public function login()
	{
		return $this->main.'/Login';
	}
	public function registration()
	{
		return $this->main.'/Registration';
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
		
		///Student Portal Prof Evaluation


	///Parent Dashboard

	public function parent_dashboard()
	{
		return $this->main.'/ParentDashboard';
	}

	///Parent Dashboard








}
?>
