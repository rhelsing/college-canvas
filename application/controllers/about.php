<?php

class About extends CI_Controller {

	function __construct() {
	
		parent::__construct();
	}
	
	function index() {
	
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
			$data['signedin']="1";
		}
	
		$data['main_content'] = 'about';
		$this->load->view('includes/template', $data);
	}
	
	function terms() {
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
			$data['signedin']="1";
		}
	
		$data['main_content'] = 'terms';
		$this->load->view('includes/template', $data);
	}
	
	function privacy() {
	
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
			$data['signedin']="1";
		}
		$data['main_content'] = 'privacy';
		$this->load->view('includes/template', $data);
	}
	
	function copyright() {
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
			$data['signedin']="1";
		}
		$data['main_content'] = 'copyright';
		$this->load->view('includes/template', $data);
	}
	function beta() {
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
			$data['signedin']="1";
		}
		$data['main_content'] = 'beta';
		$this->load->view('includes/template', $data);
	}
	
	public function add() {
	
	$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
			$data['signedin']="1";
		}
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[4]|max_length[255]');
		
		if($this->form_validation->run() == FALSE){
		
		
			$data['error'] = 'Please enter a valid email address.';
			$data['main_content'] = 'about';
			$this->load->view('includes/template', $data);
			
		}else{

			$this->load->model('Splash_model');
		
			$insert = $this->Splash_model->insert($this->input->post('email'));
			
			//load with result
			if($insert){
				$data['error'] = 'Thanks for signing up!';
			}else{
				$data['error'] = 'Something went wrong! We are working on it!';
			}
	
			$data['main_content'] = 'about';
			$this->load->view('includes/template', $data);
		}
	}
}