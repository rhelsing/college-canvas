<?php

class Signin extends CI_Controller {

	function __construct() {
	
		parent::__construct();
	}
	
	function index() {
	
	
		$this->load->library('session');
		$idu = $this->session->userdata('user_id');
		
		
		
		//check if from post request
		if(isset($_POST['user'])){
			$this->load->model('User_model');
			
			
			//FORM VALIDATION
			$this->form_validation->set_rules('user', 'Username', 'required');
			$this->form_validation->set_rules('pass', 'Password', 'required');
			if ($this->form_validation->run()==FALSE){
				$data['error'] = validation_errors();
				$data['main_content'] = 'signin';
				$this->load->view('includes/template', $data);
			}else{
				if($this->User_model->signin($this->input->post('user'), $this->input->post('pass'))){
				$this->load->library('session');
				
				//get id
				$id = $this->User_model->getid($this->input->post('user'));
				
				$this->session->set_userdata('user_id', $id);
				
				redirect('shop');
			}else{
				$data['error'] = "Invalid username or password!";
				$data['main_content'] = 'signin';
				$this->load->view('includes/template', $data);
			}
			}
			
			//validate
		}else{
			//display signin page
			$this->load->library('session');
			$idu = $this->session->userdata('user_id');
			if($idu){
				redirect('shop');
			}else{
				$data['main_content'] = 'signin';
				$this->load->view('includes/template', $data);
			}
		}
		
	}
}