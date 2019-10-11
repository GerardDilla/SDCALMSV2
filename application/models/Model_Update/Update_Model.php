<?php


class Update_Model extends CI_Model{


  public function check_oldpass($password,$student_number) 
    {
      $this->db->select('*');
      $this->db->from('highered_accounts');
      $this->db->where('Student_Number',$student_number);
      $this->db->where('Password',$password);
      $query = $this->db->get();
      return $query;
        
    }

  public function UpdateEmailPass($array){
    $data = array(
        'Password' => $array['npassword'],
        'Email'    => $array['email']
    );
    $this->db->where('Student_Number',$array['Student_Number']);
    $this->db->update('highered_accounts', $data);

    
  }

}
?>