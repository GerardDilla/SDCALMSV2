<?php


class PortfolioModel extends CI_Model{
	

	public function Insert_certificate($array)
	{	
		
                $this->db->insert('studentportfolio_certificates', $array);

                return $this->db->insert_id();
		
        }
        public function update_certificate_extension($ID,$array)
	{	
                $this->db->trans_start();
		$this->db->where('ID',$ID);
                $this->db->update('studentportfolio_certificates', $array);
                $this->db->trans_complete();
                return $this->db->trans_status();
		
        }
        public function GetCertificates($array)
	{	
                $this->db->where('Student_Number',$array['Student_Number']);

                if($array['Search']){
                        $this->db->like('Title',$array['Search']);
                }
                
                $this->db->where('Valid',1);
                $this->db->order_by('ID', 'DESC');

                if($array['Limit']){
                        $this->db->limit($array['Limit']);
                }

                $result = $this->db->get('studentportfolio_certificates');
                return $result->result_array();

        }
        public function remove_certificate($info,$array)
	{	
                $this->db->trans_start();
                $this->db->where('Student_Number',$info['Student_Number']);
                $this->db->where('ID',$info['ID']);
                $this->db->update('studentportfolio_certificates', $array);
                $this->db->trans_complete();
                return $this->db->trans_status();
	
        }
        public function Check_Certname_Availability($array)
	{	
                $this->db->where('Certificate',$array['Certificate']);
                $this->db->where('Valid',1);
                $result = $this->db->get('studentportfolio_certificates');
                return $result->result_array();

        }
        public function GetOrganizations($array)
	{	
                $this->db->where('Student_Number',$array['Student_Number']);

                if($array['Search']){
                        $this->db->like('Organization',$array['Search']);
                        $this->db->or_like('Description',$array['Search']);
                }
                
                $this->db->where('Valid',1);
                $this->db->order_by('ID', 'DESC');

                if($array['Limit']){
                        $this->db->limit($array['Limit']);
                }

                $result = $this->db->get('studentportfolio_organization');
                return $result->result_array();

        }
        public function GetOrganizationData($array)
	{	
                $this->db->where('Student_Number',$array['Student_Number']);
                $this->db->like('ID',$array['Search']);
                $this->db->where('Valid',1);
                $this->db->limit(1);
                $result = $this->db->get('studentportfolio_organization');
                return $result->result_array();

        }
        public function insert_organization($array){

                $this->db->insert('studentportfolio_organization', $array);
                return $this->db->insert_id();
                
        }
        public function update_organization($data,$array)
	{	
                $this->db->trans_start();
                $this->db->where('ID',$data['ID']);
                $this->db->where('Student_Number',$data['Student_Number']);
                $this->db->update('studentportfolio_organization', $array);
                $this->db->trans_complete();
                return $this->db->trans_status();
		
        }
        public function GetExperience($array)
	{	
                $this->db->where('Student_Number',$array['Student_Number']);

                if($array['Search']){
                        $this->db->like('Experience',$array['Search']);
                }
                
                $this->db->where('Valid',1);
                $this->db->order_by('ID', 'DESC');

                if($array['Limit']){
                        $this->db->limit($array['Limit']);
                }

                $result = $this->db->get('studentportfolio_experience');
                return $result->result_array();
        }
        public function GetExperienceData($array)
	{	
                $this->db->where('Student_Number',$array['Student_Number']);
                $this->db->like('ID',$array['Search']);
                $this->db->where('Valid',1);
                $this->db->limit(1);
                $result = $this->db->get('studentportfolio_experience');
                return $result->result_array();

        }
        public function insert_experiences($array){

                $this->db->insert('studentportfolio_experience', $array);
                return $this->db->insert_id();
                
        }
        public function update_experiences($data,$array)
	{	
                $this->db->trans_start();
                $this->db->where('ID',$data['ID']);
                $this->db->where('Student_Number',$data['Student_Number']);
                $this->db->update('studentportfolio_experience', $array);
                $this->db->trans_complete();
                return $this->db->trans_status();
        }
        public function GetActivities($array)
	{	
                $this->db->select('ID,Activity,Type,`Date`,MONTHNAME(`Date`) as ActivityMonth, YEAR(`Date`) as ActivityYear');
                $this->db->select('TIMESTAMPDIFF(MONTH, `Date`, \''.$array['CurrentDate'].'\') AS ElapsedMonth');
                $this->db->select('TIMESTAMPDIFF(WEEK,  `Date`, \''.$array['CurrentDate'].'\') AS ElapsedWeek');
                $this->db->select('TIMESTAMPDIFF(DAY,  `Date`, \''.$array['CurrentDate'].'\') AS ElapsedDay');
                $this->db->select('TIMESTAMPDIFF(HOUR,  `Date`, \''.$array['CurrentDate'].'\') AS ElapsedHour');
                $this->db->select('TIMESTAMPDIFF(MINUTE,  `Date`, \''.$array['CurrentDate'].'\') AS ElapsedMinute');
                $this->db->select('TIMESTAMPDIFF(SECOND,  `Date`, \''.$array['CurrentDate'].'\') AS ElapsedSecond');
                $this->db->where('Student_Number',$array['Student_Number']);

                if($array['Search']){
                        $this->db->like('Activity',$array['Search']);
                }
                
                $this->db->where('Valid',1);
                $this->db->order_by('Date', 'DESC');

                if($array['Limit']){
                        $this->db->limit($array['ActivitiesLimit']);
                }

                $result = $this->db->get('lms_activity_feed');
                return $result->result_array();
        }
        public function update_activitylog($data,$array)
	{	
                $this->db->trans_start();
                $this->db->where('ID',$data['ID']);
                $this->db->where('Student_Number',$data['Student_Number']);
                $this->db->update('lms_activity_feed', $array);
                $this->db->trans_complete();
                return $this->db->trans_status();
		
        }



}
?>