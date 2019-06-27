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
	public function grade()
	{
		return $this->main.'/GradeSheet';
	}
	public function balance()
	{
		return $this->main.'/BalanceSheet';
	}
	


}
?>
