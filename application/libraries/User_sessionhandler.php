<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_sessionhandler
{

	protected $CI;

	public function __construct()
    {
        // Do something with $params
        $this->CI =& get_instance();
        $this->CI->load->library('session');
        $this->CI->load->helper('url');

    }
	public function user_session($granted_access = array())
	{
		$data = array();
		if($this->CI->session->has_userdata('LoginData' ))
		{
			//IF user is student
			if($this->CI->session->userdata('LoginData')['UserType'] == 1){

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
					'UserType' => $this->CI->session->userdata('LoginData')['UserType'],

					//For General displaying of user's information
					'General_Name' => $this->CI->session->userdata('LoginData')['First_Name'].' '.$this->CI->session->userdata('LoginData')['Middle_Name'].' '.$this->CI->session->userdata('LoginData')['Last_Name'],
					'General_ID' => $this->CI->session->userdata('LoginData')['Student_Number'],
				);
				

			}
			//IF user is Instructor
			else if($this->CI->session->userdata('LoginData')['UserType'] == 2){

				$data = array( 
					'Instructor_Unique_ID' => $this->CI->session->userdata('LoginData')['Instructor_Unique_ID'],
					'Instructor_ID' => $this->CI->session->userdata('LoginData')['Instructor_ID'],
					'Instructor_Type' => $this->CI->session->userdata('LoginData')['Instructor_Type'],
					'Instructor_Name' => $this->CI->session->userdata('LoginData')['Instructor_Name'],
					'UserType' => $this->CI->session->userdata('LoginData')['UserType'],

					//For General displaying of user's information
					'General_Name' => $this->CI->session->userdata('LoginData')['Instructor_Name'],
					'General_ID' => $this->CI->session->userdata('LoginData')['Instructor_ID'],
					'Email' => '',
					'Verified' => '',
				);
				

				
			}
			//IF user is admin
			else if($this->CI->session->userdata('LoginData')['UserType'] == 3){
				$data = array();
			}
			else{
				$this->CI->session->set_flashdata('message','Error: User type is not defined');
				redirect('Main');
			}

		}else{

			$this->CI->session->set_flashdata('message','You must login first');
			redirect('Main');

		}
		$this->check_accessibility($granted_access,$data['UserType']);

		return $data;

	}
	public function check_accessibility($granted_access = array() , $usertype){

		/* 
			Guide:
			1 = student,
			2 = instructor,
			3 = parent,
			0 = all users (may cause errors)
		*/

		//print_r($granted_access);
		if(!empty($granted_access)){

			if(!in_array($usertype, $granted_access)){

				$this->CI->session->set_flashdata('message','You dont have access to this page');
				redirect('Main');

			}

		}

	}
	

	
}