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



}
?>