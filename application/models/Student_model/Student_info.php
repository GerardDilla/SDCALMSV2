<?php


class Student_info extends CI_Model
{


	// STUDENT
	public function Student_Info_byREF($array)
	{

		$this->db->where('md5(Reference_Number)', $array['Reference_Number']);
		$result = $this->db->get('Student_Info');
		return $result->result_array();
	}
	public function ValidateStudentNumber($array)
	{

		$this->db->where('A.Student_Number', $array['Student_Number']);
		$this->db->where('A.Student_Number <>', NULL);
		$this->db->where('A.Student_Number <>', '0');
		$result = $this->db->get('Student_Info AS A');
		return $result->result_array();
	}
	public function GetReference_Decrypt($array)
	{

		$this->db->select('A.Reference_Number');
		$this->db->where('md5(A.Reference_Number)', $array['Reference_Number']);
		$result = $this->db->get('Student_Info AS A');
		return $result->result_array();
	}
	public function ValidateEmailDuplicate($array)
	{

		$this->db->where('Email', $array['Email']);
		$this->db->where('Active', 1);
		$result = $this->db->get('highered_accounts_v2');
		return $result->result_array();
	}
	public function ValidateAccountExists($array)
	{

		$this->db->select('A.Student_Number AS SI_Student_Number, B.Student_Number AS HA_Student_Number');
		$this->db->where('A.Student_Number', $array['Student_Number']);
		$this->db->where('A.Student_Number <>', NULL);
		$this->db->where('A.Student_Number <>', '0');
		$this->db->where('B.Active', '1');
		$this->db->join('highered_accounts_v2 AS B', 'A.Student_Number = B.Student_Number');
		$result = $this->db->get('Student_Info AS A');
		return $result->result_array();
	}
	public function AccountDetails($array)
	{
		$this->db->select('*,B.Email as AccountEmail');
		$this->db->where('A.Student_Number', $array['Student_Number']);
		$this->db->where('A.Student_Number <>', NULL);
		$this->db->where('A.Student_Number <>', '0');
		$this->db->where('B.Active', '1');
		$this->db->group_by('A.Student_Number');
		$this->db->join('highered_accounts_v2 AS B', 'A.Student_Number = B.Student_Number');
		$result = $this->db->get('Student_Info AS A');
		return $result->result_array();
	}
	public function ValidateActivationCode($array)
	{

		$this->db->where('Student_Number', $array['Student_Number']);
		$this->db->where('Activation_Code', $array['Activation_Code']);
		$this->db->where('Student_Number <>', NULL);
		$this->db->where('Student_Number <>', '0');
		$this->db->where('valid', '1');
		$result = $this->db->get('portal_activationcode');
		return $result->result_array();
	}
	public function CheckExistingCodeData($array)
	{

		$this->db->where('Student_Number', $array['Student_Number']);
		$this->db->where('Student_Number <>', NULL);
		$this->db->where('Student_Number <>', '0');
		$this->db->where('valid', '1');
		$result = $this->db->get('portal_activationcode');
		return $result->result_array();
	}
	public function CheckCodeAvailability($array)
	{

		$this->db->where('Activation_Code', $array['draft']);
		$this->db->where('valid', '1');
		$result = $this->db->get('portal_activationcode');
		return $result->result_array();
	}
	public function ValidatedCurrentEnrollment($array)
	{

		$this->db->where('A.Student_Number', $array['Student_Number']);
		$this->db->where('A.Dropped', '0');
		$this->db->where('A.Cancelled', '0');
		$this->db->join('Legend AS L', 'A.School_Year = L.School_Year AND A.Semester = L.Semester');
		$result = $this->db->get('EnrolledStudent_Subjects AS A');
		return $result->result_array();
	}
	public function InsertCode($array)
	{

		$this->db->insert('portal_activationcode', $array);
		return $this->db->insert_id();
	}
	public function UpdateCode($array, $id)
	{

		$this->db->where('ID', $id);
		$this->db->update('portal_activationcode', $array);
		return $this->db->affected_rows();
	}
	public function InsertNewAccount($array)
	{

		$this->db->insert('highered_accounts_v2', $array);
		return $this->db->insert_id();
	}
	public function VerifyEmail($array)
	{

		$this->db->where('Student_Number', $array['Student_Number']);
		$this->db->where('Active', 1);
		$this->db->update('highered_accounts_v2', $array);
		return $this->db->affected_rows();
	}
	public function Check_Verification_Stat($array)
	{

		$this->db->where('Student_Number', $array['Student_Number']);
		$this->db->where('Verified', 1);
		$this->db->where('Active', 1);
		$result = $this->db->get('highered_accounts_v2');
		return $result;
	}
	public function Check_privacy_agreement($array)
	{

		$this->db->where('md5(Reference_Number)', $array['Reference_Number']);
		$this->db->where('System', $array['System']);
		$this->db->where('active', 1);
		$result = $this->db->get('privacy_policy_agreement');
		return $result->num_rows();
	}
	public function Insert_PrivacyPolicy($array)
	{

		$this->db->insert('privacy_policy_agreement', $array);
		return $this->db->insert_id();
	}
	public function Record_Activity($array)
	{

		$this->db->insert('lms_activity_feed', $array);
		return $this->db->insert_id();
	}
}
