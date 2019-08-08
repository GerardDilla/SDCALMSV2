<?php


class PortfolioModel extends CI_Model{
	

	public function Insert_certificate($array)
	{	
		
                $this->db->insert('studentportfolio_certificates', $array);

                return $this->db->insert_id();
		
        }
        public function updare_certificate_extension($ID,$array)
	{	
                $this->db->trans_start();
		$this->db->where('ID',$ID);
                $this->db->update('studentportfolio_certificates', $array);
                $this->db->trans_complete();
                return $this->db->trans_status();
		
        }



}
?>