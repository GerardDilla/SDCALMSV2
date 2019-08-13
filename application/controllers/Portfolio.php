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

		  $this->sectionlimit = 5;

		  
		  
	}
	public function index()
	{
		$array = array(
			'Student_Number' => $this->student_data['Student_Number'],
			'Search' => '',
			'Limit' => $this->sectionlimit
		);
		$this->data['CertificateList'] = $this->PortfolioModel->GetCertificates($array);
		$this->template($this->set_views->portfolio());
		
	}
	public function Ajax_GetCertNumber(){

		$array = array(
			'Student_Number' => $this->student_data['Student_Number'],
			'Limit' => $this->input->get_post('Limit'),
			'Search' => $this->input->get_post('Search'),
		);
		echo json_encode($this->PortfolioModel->GetCertificates($array));

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
				'Certificate' => $this->Get_Unique_CertName($this->student_data['Student_Number'].'_'.trim($this->input->post('CertName')),5),
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
				$extensionupdate = $this->PortfolioModel->update_certificate_extension($certID,array('Extension' => $this->upload->data('file_ext')));

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
	public function Get_Unique_CertName($name,$limit){


		//md5($name.'_'.$UniqueCode))

		$data['Certificate'] = md5($name.'_'.strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit)));
		$stop = 0;
		//Check availability of code
		if(empty($this->PortfolioModel->Check_Certname_Availability($data))){

			$data['final'] = $data['Certificate'];
		

		}else{

			while($stop < 1){

				$name['Certificate'] = md5($name.'_'.strtoupper(substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit)));
				if(empty($this->PortfolioModel->Check_Certname_Availability($data))){
					$data['final'] = $data['Certificate'];
					$stop++;
				}

			}

		}
		return $data['final'];

	}
	public function remove_certificate(){

		$info = array(
			'Student_Number' => $this->student_data['Student_Number'],
			'ID' => $this->input->get_post('ID')
		);
		$array = array(
			'Valid' => 0,
		);
		$this->PortfolioModel->remove_certificate($info,$array);
		
	}
	
}
