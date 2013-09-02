<?php

class Shop extends CI_Controller {

	function __construct() {
	
		parent::__construct();
	}
	
	
	function index() {
	
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
			//session valid!!**
			
			$this->load->model('User_model');
			$this->load->model('Item_model');
			$this->load->model('Transaction_model');
			//username
			$data = $this->User_model->getUser($id);
			$seller = $this->User_model->getSeller($id);	
			//about
			$data['shop_name'] = $seller['shop_name'];
			$data['shop_banner'] = $seller['shop_banner'];
			$data['picture'] = $seller['picture'];
			$data['year'] = $seller['year'];
			$data['school'] = $seller['school'];
			$data['school_id'] = $seller['school_id'];
			$data['major'] = $seller['major'];
			$data['about'] = $seller['about'];
			$data['hometown'] = $seller['hometown'];
			$data['facebook'] = $seller['facebook'];
			$data['twitter'] = $seller['twitter'];
			$data['pinterest'] = $seller['pinterest'];
			$data['blog'] = $seller['blog'];
			$data['id_sg'] = $id;
			
			//load in items as array
			if($query = $this->Item_model->getItems($id)){
				$data['items'] = $query;
			}
			
			$transactions = $this->Transaction_model->get_all("seller_id = ".$id);
			$data["trans_num"] = count($transactions);
			$revinue = 0;
			foreach($transactions as $transaction){
				$revinue = $revinue+$transaction->payment_gross; //minus shipping?
			}
			$data['revinue'] = money_format('%i', $revinue);
			//sum
			 
			$this->db->where('seller_id',$id);
			$this->db->where('shipped',0);
			$this->db->where('isGroup',0);
			$query = $this->db->get('transactions');	
			if($query->num_rows() > 0){//does not exist
				$data['error'] = "You have items waiting to be shipped! <a href='".base_url()."shop/ship'>Click here</a>";
			}
			
			$data['signedin']="1";
			
			$data['main_content'] = 'shop';
			$this->load->view('includes/template', $data);
		}else{
			//error
			$data['error'] = "You need to be signed in to do that.";
				$data['main_content'] = 'signin';
				$this->load->view('includes/template', $data);
		}
	}
	
	function ship() {
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		if($id){
			//load all items for seller_id and shipped = 0 and isGroup = 0
			$this->db->where('seller_id',$id);
			$this->db->where('shipped',0);
			$this->db->where('isGroup',0);
			$query = $this->db->get('transactions');
			if($query->num_rows() == 0){
				redirect('shop');
			}
			$data['transactions'] = $query->result();
			
			$data['signedin']="1";
			
			$data['main_content'] = 'ship';
			$this->load->view('includes/template', $data);
		}else{
			//error
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
	}
	
	function shipped() {
		$id = $this->input->post('itemid');
		if($id != ""){
			$this->load->model('Transaction_model');
			$data = array(
				'shipped' => 1
			);
			$this->Transaction_model->update($data, $id);
		}
		redirect('shop/ship');
	}
	
	function people($id) {
	
		$this->db->where('id',$id);
		$query = $this->db->get('users');	
		if($query->num_rows() == 0){//does not exist
			redirect('pagenotfound');
		}
	
		$this->load->library('session');
		$idu = $this->session->userdata('user_id');
		//show public profile for user
		$this->load->model('User_model');
		$this->load->model('Item_model');
		
		
		if(isset($id)){
			if($idu==$id){
				redirect('shop');
			}
			$data = $this->User_model->getUser($id);
			$seller = $this->User_model->getSeller($id);	
			//about
			$data['shop_name'] = $seller['shop_name'];
			$data['shop_banner'] = $seller['shop_banner'];
			$data['picture'] = $seller['picture'];
			$data['year'] = $seller['year'];
			$data['school'] = $seller['school'];
			$data['school_id'] = $seller['school_id'];
			$data['major'] = $seller['major'];
			$data['about'] = $seller['about'];
			$data['hometown'] = $seller['hometown'];
			$data['facebook'] = $seller['facebook'];
			$data['twitter'] = $seller['twitter'];
			$data['pinterest'] = $seller['pinterest'];
			$data['blog'] = $seller['blog'];
			$data['id_sg'] = $id;
			
			if($idu){
				$data['signedin']="1";
			}
			
			if($query = $this->Item_model->getItems($id)){
				$data['items'] = $query;
			}
			
			
			
			$data['main_content'] = 'public_shop';
			$this->load->view('includes/template', $data);
		}else{
			$data['error'] = "Something went wrong!";
			$data['main_content'] = 'home';
			$this->load->view('includes/template', $data);
		}
	}
	
	function edit() {
	
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
		
			
			$this->load->model('User_model');
			$data = $this->User_model->getUser($id);
			$seller = $this->User_model->getSeller($id);	
			//about
			$data['shop_name'] = $seller['shop_name'];
			$data['shop_banner'] = $seller['shop_banner'];
			$data['picture'] = $seller['picture'];
			$data['year'] = $seller['year'];
			$data['school'] = $seller['school'];
			$data['school_id'] = $seller['school_id'];
			$data['major'] = $seller['major'];
			$data['about'] = $seller['about'];
			$data['hometown'] = $seller['hometown'];
			$data['facebook'] = $seller['facebook'];
			$data['twitter'] = $seller['twitter'];
			$data['pinterest'] = $seller['pinterest'];
			$data['blog'] = $seller['blog'];
			$data['signedin']="1";
			$data['main_content'] = 'edit_shop';
			$this->load->view('includes/template', $data);
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
			
		}
	
	}
	
	function save() {
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		if($id){	
		
		
			//validation
			$this->form_validation->set_rules('name', 'Name', 'trim|xss_clean');
			$this->form_validation->set_rules('about', 'About', 'trim|xss_clean');
			$this->form_validation->set_rules('hometown', 'Hometown', 'trim|xss_clean');
			$this->form_validation->set_rules('shop_name', 'Shop Name', 'trim|xss_clean');
			$this->form_validation->set_rules('major', 'Major', 'trim|xss_clean');
			$this->form_validation->set_rules('year', 'Year', 'trim|xss_clean');
			$this->form_validation->set_rules('school', 'School', 'trim|xss_clean');
			$this->form_validation->set_rules('facebook', 'Facebook', 'trim|xss_clean');
			$this->form_validation->set_rules('twitter', 'Twitter', 'trim|xss_clean');
			$this->form_validation->set_rules('pinterest', 'Pinterest', 'trim|xss_clean');
			$this->form_validation->set_rules('blog', 'Blog', 'trim|xss_clean');
			
			if ($this->form_validation->run()==FALSE){
			
				$this->load->model('User_model');
				$data = $this->User_model->getUser($id);
				$seller = $this->User_model->getSeller($id);	
				//about
				$data['shop_name'] = $seller['shop_name'];
				$data['shop_banner'] = $seller['shop_banner'];
				$data['picture'] = $seller['picture'];
				$data['year'] = $seller['year'];
				$data['school'] = $seller['school'];
				$data['school_id'] = $seller['school_id'];
				$data['major'] = $seller['major'];
				$data['about'] = $seller['about'];
				$data['hometown'] = $seller['hometown'];
				$data['facebook'] = $seller['facebook'];
				$data['twitter'] = $seller['twitter'];
				$data['pinterest'] = $seller['pinterest'];
				$data['blog'] = $seller['blog'];
				$data['signedin']="1";
				$data['main_content'] = 'edit_shop';
				//errors
				$data['error'] = validation_errors();
				
				$this->load->view('includes/template', $data);
			}else{
			
				$this->load->model('User_model');
				$this->User_model->saveProfile($id);
				$this->User_model->do_upload();
				//handle images
				redirect('shop');
			}
			
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
	}
}