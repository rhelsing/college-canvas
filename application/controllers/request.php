<?php

class Request extends CI_Controller {

	function __construct() {
	
		parent::__construct();
	}
	
	function index() {
	
	
		$this->form_validation->set_rules('email', 'Email Address', 'required|valid_email');
		if ($this->form_validation->run()==FALSE){
				$data['error'] = validation_errors();
				$data['main_content'] = 'signin';
				$this->load->view('includes/template', $data);
		}else{
			//handle email
		//put into using model
			$this->load->model('Request_model');
			$insert = $this->Request_model->seller($this->input->post('email'));
			//show with notice
			$this->load->library('session');
			$id = $this->session->userdata('user_id');
		
			if($id){
				$data['signedin']="1";
				}
				
				$data['error']="Thank you for your request to sell! You should receive an email in 1-2 days with a link to begin listing your work.";
				$data['main_content'] = 'signin';
				$this->load->view('includes/template', $data);	
		}
	
		
	}
}