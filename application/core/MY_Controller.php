<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $template = array();
    public $data = array();
    public $middle = '';

	function __construct() {

        parent::__construct();
        
        $this->data['message'] = '';
        
    }
	

    public function template($middleParam = '',$modal='')
    {
        $this->load->library('Set_custom_session');
        $this->student_data = $this->set_custom_session->student_session();
        $this->data['Verified'] = $this->student_data['Verified'];

        if ($middleParam == '')
        {
            $middleParam = $this->middle;
        }
        if($this->data['Verified'] == 0){

            $modal = $this->load->view('Main/Verification.php', $this->data, true);
        }
        //$this->data['admin_data'] = $this->set_custom_session->navbar_session();
        $this->template['title'] = 'SDCALMS';
        $this->template['header'] = $this->load->view('Layout/Header.php', $this->data, true);
        $this->template['navbar'] = $this->load->view('Layout/Navbar.php', $this->data, true);
        $this->template['sidebar'] = $this->load->view('Layout/Sidebar.php', $this->data, true);
        $this->template['middle'] = $this->load->view($middleParam, $this->data, true);
        $this->template['footer'] = '';//$this->load->view('Layout/Scripts.php', $this->data, true);
        $this->template['script'] = $this->load->view('Layout/Scripts.php', $this->data, true);
        $this->template['modal'] = $modal;



        $this->load->view('Skeleton/main', $this->template);

    }

    public function loginpage($middleParam = '')
    {

        if ($middleParam == '')
        {
            $middleParam = $this->middle;
        }
        //$this->data['admin_data'] = $this->set_custom_session->navbar_session();
        $this->template['title'] = 'SDCALMS';
        $this->template['header'] = $this->load->view('Layout/Header.php', $this->data, true);
        $this->template['middle'] = $this->load->view($middleParam, $this->data, true);
        $this->template['footer'] = '';//$this->load->view('Layout/Scripts.php', $this->data, true);
        $this->template['script'] = $this->load->view('Layout/Scripts.php', $this->data, true);
        $this->load->view('Skeleton/login', $this->template);

    }

 

		

	
	
	
	
	
}
?>