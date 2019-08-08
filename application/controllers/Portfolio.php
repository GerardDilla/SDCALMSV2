<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();

		  $this->load->library("set_views");
		  $this->load->library('form_validation');
		  $this->load->library("Set_custom_session");
		  //load file helper
		  $this->load->helper('file');
		  $this->student_data = $this->set_custom_session->student_session();

		  $this->load->model('PortfolioModel');

		  //Defines log date
		  $this->logdate = date("Y/m/d");

		  
		  
	}
	public function index()
	{
		
		$this->template($this->set_views->portfolio());
		
	}
	public function certificate_upload(){


		$this->form_validation->set_error_delimiters('', '');
		$this->form_validation->set_rules('CertName','Achievement / Certificate', 'required');

		//Validate if Title input is given
		if($this->form_validation->run() == FALSE) {

			$result['Status'] = 0;
			$result['Message'] = validation_errors();

		}else{

			$result = array(

				'Status' => 0,
				'Message' => '',

			);
			$array = array(
				'Student_Number' => $this->student_data['Student_Number'],
				'Title' => $this->input->post('CertName'),
				'Date' => $this->logdate,
				'Certificate' => md5($this->student_data['Student_Number'].'_'.trim($this->input->post('CertName'))),
			);
			$config['upload_path']= './personaldata/Certificates/';
			$config['allowed_types']='jpg|png';
			$config['file_name'] = $array['Certificate'];
			
			//Upload File of Cert
			$this->load->library('upload',$config);
			if($this->upload->do_upload('CertFile')){

				//Inserts Certificate info in DB
				$certID = $this->PortfolioModel->Insert_certificate($array);
				
				//Updates thew file extension of the file
				$extensionupdate = $this->PortfolioModel->updare_certificate_extension($certID,array('Extension' => $this->upload->data('file_ext')));

				if($extensionupdate == TRUE){

					$data = array('upload_data' => $this->upload->data());
					$result['Status'] = 1;
					$result['Message'] = 'Achievement Submitted!';
					//redirect('Portfolio');

				}else{
					
					$data = array('upload_data' => $this->upload->data());
					$result['Status'] = 0;
					$result['Message'] = 'Error in Updating File Extension';

				}

			}else{
				$result['Status'] = 0;
				$result['Message'] = $this->upload->display_errors(); 

			}
	
			

		}


		echo json_encode($result);
	}
	
}
