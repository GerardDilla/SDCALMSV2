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
				'Last_Name' => $this->CI->session->userdata('LoginData')['Last_Name'],
				'Full_Name' => $this->CI->session->userdata('LoginData')['First_Name'].' '.$this->CI->session->userdata('LoginData')['Middle_Name'].' '.$this->CI->session->userdata('LoginData')['Last_Name'],
				'Email' => $this->CI->session->userdata('LoginData')['Email'],
				'ViaRegistration' => $this->CI->session->userdata('LoginData')['ViaRegistration'],
				'Verified' => $this->CI->session->userdata('LoginData')['Verified'],
				
			);
			return $data;
		}
		else
		{
			$this->CI->session->set_flashdata('message','You Must Login First');
			redirect('Main');
		}

	}
	public function teacher_session()
	{
		
		if ( $this->CI->session->has_userdata('Instructor_LoginData' ) )
		{
			$data = array( 
				'Instructor_Unique_ID' => $this->CI->session->userdata('Instructor_LoginData')['Instructor_Unique_ID'],
				'Instructor_ID' => $this->CI->session->userdata('Instructor_LoginData')['Instructor_ID'],
				'Instructor_Type' => $this->CI->session->userdata('Instructor_LoginData')['Instructor_Type'],
				'Instructor_Name' => $this->CI->session->userdata('Instructor_LoginData')['Instructor_Name']	
			);
			return $data;
		}
		else
		{
			$this->CI->session->set_flashdata('instructor_message','You Must Login First');
			redirect('Main');
		}

	}

	
}