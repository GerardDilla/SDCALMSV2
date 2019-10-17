<?php


class FileManager extends CI_Model{
	

    public function get_folders($array){

        $this->db->where('md5(InstructorID)',$array['InstructorID']);
        $query = $this->db->get('lms_folders');
        return $query->result_array();
        
    }
    public function get_files($array){

        $this->db->where('A.InstructorID',$array['InstructorID']);
        if($array['Folder_ID'] != 0){
                $this->db->where('A.Folder_ID',$array['Folder_ID']);
        }
        $this->db->join('lms_folders as B','A.Folder_ID = B.Folder_ID','Left');
        $this->db->where('A.Valid',1);
        $this->db->order_by('A.File_ID');
        $query = $this->db->get('lms_files as A');
        return $query->result_array();
        
    }
    public function get_file_info($array){

        $this->db->where('A.InstructorID',$array['InstructorID']);
        $this->db->where('A.File_ID',$array['File_ID']);
        $this->db->join('lms_folders as B','A.Folder_ID = B.Folder_ID','Left');
        $this->db->where('A.Valid',1);
        $query = $this->db->get('lms_files as A');
        return $query->result_array();

    }
    public function add_folder($array){
        
        $this->db->insert('lms_folders',$array);
        return $this->db->insert_id();

    }
    public function add_file($array){
        
        $this->db->insert('lms_files',$array);
        return $this->db->insert_id();

    }
    public function update_folder($ID,$array){

        $this->db->update('lms_folders',$array);
        $this->db->where('Folder_ID',$ID);
        return $this->db->insert_id();

    }
    public function update_file($ID,$array){

        $this->db->where('File_ID',$ID);
        $this->db->update('lms_files',$array);
        

    }
    public function get_filepath(){

        $query = $this->db->get('lms_storage_path');
        return $query->result_array();

    }
    public function check_filename($filename){

        $this->db->where('FileName',$filename);
        $this->db->where('Valid',1);
        $query = $this->db->get('lms_files');
        return $query->result_array();

    }


}
?>