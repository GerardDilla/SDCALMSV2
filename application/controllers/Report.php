<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {

	function __construct() 
	{
		  parent::__construct();
		  
		  $this->load->library("set_views");
		  $this->load->library("Set_custom_session");
		  $this->load->model('Report/Model_Class_List');
		  $this->student_data = $this->set_custom_session->student_session();

	}

	public function Classlist(){
		$submit =	$this->input->post('submit');
		$export =	$this->input->post('export');

		 //Checker of pages
		 if(isset($submit)){
			$this->Class_List();
		}
		  else if(isset($export)){
			$this->Class_Listing_Excel();
		  }
	}

	public function Class_List()
	{   
	    $sc  = 	$this->input->post('Section');
		$this->data['get_legend']         = $this->Model_Class_List->Get_legend();
		$this->data['get_schoolyear']     = $this->Model_Class_List->Get_Year();
		$this->data['get_classlist']      = $this->Model_Class_List->get_class_list($sc);
		$this->template($this->set_views->report_class_list());
     
	}

	//Get Sections
	function fetch_sections()
	{
		$array = array(
			'sy'         => $this->input->get('sy'),
			'sem'        => $this->input->get('sem'),
			'Prof'       => '2668',
		  );
		  
		   $resultdata = $this->Model_Class_List->Get_CourseTitle($array);
		   echo json_encode($resultdata);
	}
	
	public function Class_Listing_Excel()
	{
  
		$sc  = 	$this->input->post('Section');
		
		  $this->load->library("Excel");
		  $object = new PHPExcel();
		  $table_columns = array("#","NAME","STUDENT NUMBER", "GRADE LEVEL","GENDER","ADDRESS","CONTACT NUMBER","BIRTHDAY","NATIONALITY");
	
	
		
	
		  $column = 0;
		  foreach($table_columns as $field)
		  {
		   $object->getActiveSheet()->setCellValueByColumnAndRow($column, 2, $field);
		   $column++;
		  }
		
		  $employee_data = $this->Model_Class_List->get_class_list($sc);  
		
		  $excel_row = 3;
		  $count = 1;
		  foreach($employee_data as $row)
		  {
		
		   $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row,  $count);
		   $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row,  strtoupper($row['Last_Name'].' '.$row['First_Name'].' '.$row['Middle_Name']));
		   $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row,  $row['Student_Number']);
		  
		   $count = $count + 1;
		   $excel_row++;
		  }
		
		  $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		  header('Content-Type: application/vnd.ms-excel');
		  header('Content-Disposition: attachment;filename="ClassList.xls"');
		  $object_writer->save('php://output');

		
	}
	
	
}
