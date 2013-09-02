<?php

class Logout extends CI_Controller {

	function __construct() {
	
		parent::__construct();
	}
	
	function index() {
		
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
			//sign out
			$this->session->unset_userdata('user_id');
			$this->session->sess_destroy();
			$data['error'] = "You have logged out.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
		
	}
}