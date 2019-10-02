<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rubrics extends MY_Controller {

	function __construct() 
	{
		parent::__construct();

		$this->load->library("set_views");
		$this->load->library("Set_custom_session");
		$this->load->model('Rubric_Model/Rubric');
		$this->teacher_data = $this->set_custom_session->teacher_session();

	}
	public function index()
	{
		$Instructor = $this->teacher_data['Instructor_Unique_ID'];
	    $this->data['GetRubrics'] =	$this->Rubric->SelectRubrics($Instructor);
		$this->instructor_template($this->set_views->rubrics_table());
	}
	public function ChooseButton()
	{
		$array = array(
		  'Rid'   => $this->input->post('rubrics_id'),
		  'Vb'   => $this->input->post('ViewButton'),
		  'Db'   => $this->input->post('DeleteButton')
		);

		if (isset($array['Vb'])) {
			$this->view();
		}
		else if(isset($array['Db'])){
			$this->Delete_Rubrics();
		}
	}
	public function view()
	{
	   $RubricsID                        = $this->input->post('rubrics_id');
	   $this->data['GetRubrics']         =	$this->Rubric->Rubrics($RubricsID);
	   $this->data['RubricsEscale']      =	$this->Rubric->RubricsEscale($RubricsID);
	   $this->data['RubricsCriteria']    =	$this->Rubric->RubricsCriteria($RubricsID);
	   $this->data['RubricsDescription'] =	$this->Rubric->RubricsDescription($RubricsID);
	   $this->instructor_template($this->set_views->rubrics_view());
	}
	public function Create_Rubrics()
	{
		$this->instructor_template($this->set_views->rubrics());
	}
	public function Delete_Rubrics()
	{
		$RubricsID   = $this->input->post('rubrics_id');
		$this->Rubric->DeleteRubrics($RubricsID);
		redirect('Rubrics/index/');
     
	}
	public function Insert_Rubrics()
	{

		$RubricsTitle         = $this->input->post('RubricsTitle');
		$RubricsDescription   = $this->input->post('RubricsDescription');
		$Escale               = $this->input->post('escale');
		$Criteria             = $this->input->post('criteria');
		$Description          = $this->input->post('description');
	
		$insert['rubrics']             = $RubricsTitle;
		$insert['InstructorID']        = $this->teacher_data['Instructor_Unique_ID'];
	    $insert['description']         = $RubricsDescription;

	    
	   $rubrics_id  =	$this->Rubric->InsertRubricsTitle($insert);
		$count = 0;
		foreach ($Escale  as $row) {
			$insert1['escale']      = $row;
			$insert1['rubrics_id']  =  $rubrics_id;
			$escale_id[$count]  =	$this->Rubric->InsertEscaleRubric($insert1);
			$count++;
		}
		$count = 0;
		foreach ($Criteria  as $row) {
			$insert2['criteria']      = $row;
			$insert2['rubrics_id']  =  $rubrics_id;
			$criteria_id[$count]  =  $this->Rubric->InsertCriteriaRubric($insert2);
			$count++;
		}
		$count = 0;
		foreach($criteria_id as $rub_row){
			foreach($escale_id as $rub_col){

				$insert3['criteria_id']  = $rub_row;
				$insert3['escale_id']    = $rub_col;
				$insert3['rubrics_id']   = $rubrics_id;
				$insert3['description'] = $Description[$count];
				$this->Rubric->InsertDescriptionRubric($insert3);
				$count++;
			}
		}
		redirect('Rubrics/index/');
	 
	}
	public function Update_Rubrics()
	{
		
		$array = array(
			'RubricsID'           => $this->input->post('Rubrics_ID'),
			'RubricsTitle'        => $this->input->post('RubricsTitle'),
			'RubricsDescription'  => $this->input->post('RubricsDescription')
		);

		$this->Rubric->UpdateRubrics($array);

		$Escale               = $this->input->post('escale');
		$ESCALE_ID            = $this->input->post('Escale_ID');

		foreach($ESCALE_ID as $i => $row){

		   $array = array(
				'RubricsID'           =>$this->input->post('Rubrics_ID'),
				'escale'              =>$Escale[$i],
				'escaleid'            =>$row,
			);
			$this->Rubric->UpdateRubricEscale($array);
			
		}
		
		 $Criteria             = $this->input->post('criteria');
		 $CRITERIA_ID          = $this->input->post('Criteria_ID');

		 foreach($CRITERIA_ID as $i => $row){

			$array = array(
				 'RubricsID'      =>   $this->input->post('Rubrics_ID'),
				 'criteria'       =>   $Criteria[$i],
				 'criteriaID'     =>   $row,
			 );

			 $this->Rubric->UpdateRubricCriteria($array);
		 }


		$Description_ID       = $this->input->post('DESCRIPTION_ID');
		$Description          = $this->input->post('description');

		foreach($Description_ID as $i => $row){

			$array = array(
				 'RubricsID'         =>   $this->input->post('Rubrics_ID'),
				 'Description'       =>   $Description[$i],
				 'DescriptionID'     =>   $row,
			 );

			 $this->Rubric->UpdateRubricDescription($array);
		 }

		redirect('Rubrics/index/');
    
	}
					
		
	
	
	
		
	}


	

