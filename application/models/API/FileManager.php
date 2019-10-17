<?php


class FileManager extends CI_Model{
	

    public function get_folders($array){

        $this->db->where('md5(InstructorID)',$array['InstructorID']);
        $query = $this->db->get('lms_folders');
        return $query->result_array();
        
    }
    public function get_files($array){

        $this->db->where('md5(InstructorID)',$array['InstructorID']);
        $this->db->where('Folder_ID',$array['Folder_ID']);
        $query = $this->db->get('lms_files');
        return $query->result_array();
        
    }
    public function get_file_info($array){

        $this->db->where('md5(InstructorID)',$array['InstructorID']);
        $this->db->where('File_ID',$array['File_ID']);
        $query = $this->db->get('lms_files');
        return $query->result_array();

    }
    public function add_folder($array){
        
        $this->db->insert('lms_folders',$array);
        return $this->db->insert_id();

    }
    public function update_folder($ID,$array){

        $this->db->update('lms_folders',$array);
        $this->db->where('Folder_ID',$ID);
        return $this->db->insert_id();

    }
    public function get_filepath(){

        $query = $this->db->get('lms_storage_path');
        return $query->result_array();

    }


}
?>