<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class filetype{

	
	const image = 1;
	const video = 2;
	const document = 3;

}
class FileManagerAPI extends CI_Controller {

	function __construct() 
	{

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE, OPTIONS');
		header('Access-Control-Request-Headers: Content-Type');
		
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->library("api_input_validator");
		$this->load->model("API/FileManager");
		$this->load->helper('file');

		//ONLY USE THE FOLLOWING INDEXES
		$this->data_input = array(
			'Error' => 0,
			'ResultCount' => 0,
			'data' => '',
			'Message' => '',
			'Message_Array' => array(),
			'ErrorMessage' => '',
			'ErrorMessage_Array' => array()
		);

		//Sets Timezone for
		date_default_timezone_set('Asia/Manila');
		//echo date("Y-m-d H:i:s");

	}
	public function index()
	{

		$Value = array(
			array(
				'field' => 'Command',
				'label' => 'Command',
				'rules' => 'required',
				'value' => $this->input->get_post('Command')
			),
			array(
				'field' => 'InstructorID',
				'label' => 'User Token',
				'rules' => 'required',
				'value' => $this->input->get_post('InstructorID')
			),
		);
		
		$validate = $this->api_input_validator->validate_input($Value);
		if($validate['Status'] == TRUE){

			$inputarray = array(
				'Command' => $this->input->get_post('Command'),
				'InstructorID' => $this->input->get_post('InstructorID'),
				'Folder_ID' => $this->input->get_post('Folder_ID'),
				'File_ID' => $this->input->get_post('File_ID'),
				'FileType' => $this->input->get_post('FileType'),
			);
			//echo json_encode($inputarray);
			if($inputarray['Command'] == 'getfolder'){

				$this->getfolder($inputarray);

			}
			else if($inputarray['Command'] == 'getfiles'){

				$this->getfiles($inputarray);

			}
			else if($inputarray['Command'] == 'file_path'){

				$this->data_input['data'] = $this->file_path($inputarray);
				$this->Output($this->data_input);

			}
			else if($inputarray['Command'] == 'get_file_output'){

				//echo $inputarray['FileType'];
				$this->data_input['data'] = $this->get_file_output($inputarray);
				$this->Output($this->data_input);

			}
			else if($inputarray['Command'] == 'file_upload'){

				//echo $inputarray['FileType'];
				$this->data_input['data'] = $this->file_upload($inputarray);
				$this->Output($this->data_input);

			}
			else if($inputarray['Command'] == 'delete_file'){

				$this->data_input['data'] = $this->delete_file($inputarray);
				$this->Output($this->data_input);
				
			} 
			

		}
		else{

			$this->data_input['Error'] = 1;
			$this->data_input['ErrorMessage'] = $validate['All_Errors'];
			$this->data_input['ErrorMessage_Array'] = $validate['Error'];
			$this->Output($this->data_input);
			
		}

	}
	private function getfolder($inputs){

		$result = $this->FileManager->get_folders($inputs);
		if($result){

			$this->data_input['data'] = $result;
			$this->data_input['ResultCount'] = count($result);

		}else{
			$this->data_input['Error'] = 1;

		}

		$this->Output($this->data_input);

	}
	private function delete_file($inputs){

		$ID = $inputs['File_ID'];
		$deletearray['Valid'] = 0;
		if($this->FileManager->update_file($ID,$deletearray)){

			$this->data_input['Message'] = 'File Deleted!';

		}else{
			$this->data_input['Error'] = 1;

		}

		$this->Output($this->data_input);

	}
	private function getfiles($inputs){
		
		$result = $this->FileManager->get_files($inputs);
		if($result){

			$this->data_input['data'] = $result;
			$this->data_input['ResultCount'] = count($result);


		}else{

			$this->data_input['Error'] = 1;

		}

		$this->Output($this->data_input);

	}
	private function file_path(){

		return $this->FileManager->get_filepath()[0]['FileStorage_Path'];

	}
	private function get_file_output($input){

		//echo filetype::jpeg.'test';

		$result = $this->FileManager->get_file_info($input);
		if(!$result){

			return;

		}
		$data = $result[0];
		$this->data_input['data'] = $input['FileType'];
		if($input['FileType'] == filetype::image){

			$this->data_input['data'] = $this->load->view('FileTypes/Image',$data,TRUE);

		}
		else if($input['FileType'] == filetype::video){

			$this->data_input['data'] = $this->load->view('FileTypes/Video',$data, TRUE);
			
		}
		else if($input['FileType'] == filetype::document){

			$this->data_input['data'] = $this->load->view('FileTypes/Document',$data, TRUE);

		}else{

			$this->data_input['Error'] = 1;
			$this->data_input['Message'] = 'No File Type Indicated';
			
		}
		$this->Output($this->data_input);

	}
	public function file_upload($input){

		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('FileName','File Name', 'required');

		//Validate if Title input is given
		if($this->form_validation->run() == FALSE) {

			$this->data_input['Message'] = validation_errors();
			$this->data_input['Error'] = 1;
			$this->Output($this->data_input);

		}
	
		$config['upload_path']= './filestorage/';
		$config['allowed_types']='jpg|png|docx|xls|pdf|mp4';
		$config['max_size'] = 100000;
		$config['file_name'] = $this->Get_Unique_FileName(15);
		//Upload File of Cert
		$this->load->library('upload',$config);
		if($this->upload->do_upload('CertFile')){

			$upload_array = array(
				'InstructorID' => $input['InstructorID'],
				'Name' => $this->input->post('FileName'),
				'FileName' => $config['file_name']  ,
				'FileExtension' => $this->upload->data('file_ext'),
				'FileType' => '',
				'Folder_ID' =>$this->input->post('FolderID'),
				'Date' => date("Y-m-d H:i:s"),
			);
			if($this->upload->data('file_ext') == '.jpg' || $this->upload->data('file_ext') == '.png'){
				$upload_array['FileType'] = filetype::image;
			}
			else if($this->upload->data('file_ext') == '.docx' || $this->upload->data('file_ext') == '.xls' || $this->upload->data('file_ext') == '.pdf'){
				$upload_array['FileType'] = filetype::document;
			}
			else if($this->upload->data('file_ext') == '.mp4'){
				$upload_array['FileType'] = filetype::video;
			}
			$this->FileManager->add_file($upload_array);
			$this->data_input['Message'] = $upload_array;

		}else{

			$this->data_input['Message'] = $this->upload->display_errors();
			$this->data_input['Error'] = 1;
		}
		$this->Output($this->data_input);


	}
	private function Get_Unique_FileName($limit=''){


		//md5($name.'_'.$UniqueCode))

		$filename = md5(strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit)));
		$stop = 0;
		//Check availability of code
		if(empty($this->FileManager->check_filename($filename))){

			return $filename;
		

		}else{

			while($stop < 1){

				$filename = md5(strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit)));
				if(empty($this->FileManager->check_filename($data))){
					return $filename;
					$stop++;
				}

			}

		}

	}
	private function Output($data = array()){

		echo json_encode($data);
		exit();

	}


	
}
