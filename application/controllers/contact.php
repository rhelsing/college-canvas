<?php

class Contact extends CI_Controller {

	function __construct() {
	
		parent::__construct();
	}
	
	function index() {
	
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
			$data['signedin']="1";
		}
	
		$data['main_content'] = 'contact';
		$this->load->view('includes/template', $data);
	}
	
	function send() {
		//send contents of form ro email of user
		$email = "rebecca@collegecanvas.org";
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');
		$from = $this->input->post('email');
		
		$this->load->library('email');

		$this->email->from($from, $from);
		$this->email->to($email);

		$this->email->subject("CollegeCanvas Contact Form Message: ".$subject);

		$this->email->message($message);

		$this->email->send();
		
		redirect('contact/success');
	}
	
	function seller($u_id) {
	
		$this->db->where('id',$u_id);
		$query = $this->db->get('sellers');	
		if($query->num_rows() == 0){//does not exist
			redirect('pagenotfound');
		}
	
		//show form and send to email of user
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
			$data['signedin']="1";
		}
		
		$this->load->model('User_model');
		$user = $this->User_model->getAlt("id = ".$u_id);
		$data['name'] = $user->name;
		if($data['name']==""){
			$data['name'] = $user->username;
		}
		
		$data['id'] = $u_id;
	
		$data['main_content'] = 'contact_seller';
		$this->load->view('includes/template', $data);
	
	}
	
	function sellerSend($id) {
	
		//send contents of form ro email of user
		$this->load->model('User_model');
		$user = $this->User_model->getAlt("id = ".$id);
		$email = $user->email;
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');
		$from = $this->input->post('email');
		
		$this->load->library('email');

		$this->email->from($from, $from);
		$this->email->to($email);

		$this->email->subject("CollegeCanvas personal message: ".$subject);

		$this->email->message($message);

		$this->email->send();
		
		redirect('contact/success');
	
	}
	
	function group($g_id) {
	
		$this->db->where('id',$g_id);
		$query = $this->db->get('groups');	
		if($query->num_rows() == 0){//does not exist
			redirect('pagenotfound');
		}
	
		//show form and send to email of admin
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
			$data['signedin']="1";
		}
		
		$this->load->model('Group_model');
		//get name of group
		$group = $this->Group_model->get("id = ".$g_id);
		$data['name'] = $group->name;
		
		$data['id'] = $g_id;
	
		$data['main_content'] = 'contact_group';
		$this->load->view('includes/template', $data);
	
	}
	
	function groupSend($id) {
	
		//send contents of form ro email of group
		$this->load->model('Group_model');
		$this->load->model('User_model');
		$group = $this->Group_model->get("id = ".$id);
		$user = $this->User_model->getAlt("id = ".$group->admin_id);
		$email = $user->email;
		$subject = $this->input->post('subject');
		$message = $this->input->post('message');
		$from = $this->input->post('email');
		
		//send message to email
		$this->load->library('email');

		$this->email->from($from);
		$this->email->to($email); 

		$this->email->subject("CollegeCanvas: ".$subject);
		$this->email->message($message);	

		$this->email->send();
		redirect('contact/success');
	
	}
	
	function success() {
	
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
			$data['signedin']="1";
		}
	
		$data['main_content'] = 'contact_success';
		$this->load->view('includes/template', $data);
	
	}
}