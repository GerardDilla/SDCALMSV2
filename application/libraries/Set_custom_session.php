<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Set_custom_session 
{

	protected $CI;

	public function __construct()
    {
        // Do something with $params
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->helper('url');

    }
	public function student_session()
	{
		
		if ( $this->CI->session->has_userdata('LoginData' ) )
		{
			$data = array( 
				'Student_Number' => $this->CI->session->userdata('LoginData')['Student_Number'],
				'Reference_Number' => $this->CI->session->userdata('LoginData')['Reference_Number'],
				'First_Name' => $this->CI->session->userdata('LoginData')['First_Name'],
				'Middle_Name' => $this->CI->session->userdata('LoginData')['Middle_Name'],
				'Last_Name' => $this->CI->session->userdata('LoginData')['Last_Name']
			);
			return $data;
		}
		else
		{
			$this->CI->session->set_flashdata('message','You Must Login First');
			redirect('Main');
		}

	}
	public function test(){
		echo 'test';
	}
	

	
}