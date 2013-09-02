<?php

class Pagenotfound extends CI_Controller {

	function __construct() {
	
		parent::__construct();
	}
	
	function index() {
	
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		
		if($id){
			$data['signedin']="1";
		}
			$data['main_content'] = 'notfound';
			$this->load->view('includes/template', $data);
		
	}
}