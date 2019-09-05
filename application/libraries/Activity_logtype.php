<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class activity_logtype 
{
	public function certificate_update($message)
	{
		return 'Uploaded <u>'.$message.'</u> Certificate';
	}
	public function organization_update($message)
	{
		return 'Added an Organization: '.$message;
	}
	public function experience_update($message)
	{
		return 'Added an Experience: '.$message;
	}
	public function assessment_update($message)
	{
		return 'Took <u>'.$message.'</u> Assessment ';

	}

}
?>
