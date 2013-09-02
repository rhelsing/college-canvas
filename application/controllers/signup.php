<?php

class Signup extends CI_Controller {

	function __construct() {
	
		parent::__construct();
	}
	
	function index() {
	
		//check that from valid place
		if(isset($_POST['pw2'])){
			//sign them up!!
			$this->load->model('User_model');
			
			$hash = $this->input->post('hash');
			
			//validat fields
			$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[28]|xss_clean');
			$this->form_validation->set_rules('pw1', 'Password', 'trim|required|min_length[6]|matches[pw2]');
			$this->form_validation->set_rules('pw2', 'Password Repeat', 'trim|required');
			if ($this->form_validation->run()==FALSE){
				redirect('signup/seller/'.$hash.'/invalid_input');
			}else{
				//if username already exists, choose another
				if($this->User_model->checkUser($this->input->post('username'))){
					//error
					redirect('signup/seller/'.$hash.'/error_username_taken');
				}
				
				$this->User_model->signup();
			
			
				//authenticate and...
				$this->load->library('session');
				$this->session->set_userdata('user_id', $this->input->post('id'));
			
				//redirect to store
			
				redirect('shop');
			}
			
			
			
		}else{
			//bad request
			$data['main_content'] = 'error';
			$this->load->view('includes/template', $data);
		}
	
		
	}
	
	function seller($hash, $error = "") {
		//show signup page if $hash is in db and if that user signup = 0. load content
		$this->load->model('User_model');
		if($id = $this->User_model->check($hash)){
			//show signup..send some data?
			$data['errors'] = $error;
			$data['main_content'] = 'signup';
			$data['id'] = $id;
			$data['hash'] = $hash;
			$this->load->view('includes/template', $data);
		}else{
			//invalid
			$data['main_content'] = 'error';
			$this->load->view('includes/template', $data);
		}
	}
}