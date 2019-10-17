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
		$data = $result[0];
		$this->data_input['data'] = $input['FileType'];
		if($input['FileType'] == filetype::image){

			$this->data_input['data'] = $this->load->view('FileTypes/Image',$data,TRUE);

		}
		else if($input['FileType'] == filetype::video){

			$this->data_input['data'] = $this->load->view('FileTypes/Image',$data, TRUE);
			
		}
		else if($input['FileType'] == filetype::document){

			$this->data_input['data'] = $this->load->view('FileTypes/Image',$data, TRUE);


		}
		$this->Output($this->data_input);

	}
	private function Output($data = array()){

		echo json_encode($data);
		exit();

	}


	
}
