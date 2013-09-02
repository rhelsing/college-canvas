<?php

class Cart extends CI_Controller {

	function __construct() {
	
		parent::__construct();
	}
	
	function index() {
	
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
			$data['signedin']="1";
		}
	
	
		//get all from cart
		$data['main_content'] = 'cart';
		$this->load->view('includes/template', $data);
		
	}
	
	function add($id) {
	
		$this->cart->product_name_rules = '^.';
	
		$this->load->model('Item_model');
		$this->load->model('User_model');
		
		$product = $this->Item_model->item("id = ".$id);//get item
		if($product->seller_or_group == 0){
			$userid = $product->id_sg;
			$user = $this->User_model->getAlt("id = ".$userid);//get item
			$email = $user->email;
		}else{
			//get email of admin
			$g_id = $product->id_sg;
			$this->load->model('Group_model');
			$group = $this->Group_model->get("id = ".$g_id);
			$user = $this->User_model->getAlt("id = ".$group->admin_id);//get item
			$email = $user->email;
		}
		
		//if GROUP!
		//generate unique id
		
		$insert = array(
			'id' => $id,
			'qty' => 1,
			'price' => $product->price,
			'name' => $product->name,//CANT HAVE SPECIAL CHARACTERS
			'shipping' => $product->shipping_cost,
			'order_total' => $product->price+$product->shipping_cost,
			'email_add' => $email,
			'custom' => uniqid()
		);
		
		
		$this->cart->insert($insert);
		
		redirect('cart');
	
	}
	
	function done($id) {
		//set transaction completed in db
		//notify seller
		$this->load->library('session');
		$idu = $this->session->userdata('user_id');
		
		if($idu){
			$data['signedin']="1";
		}
		//show done page
		$data['id'] = $id;
		
		$data['main_content'] = 'cart_finished';
		$this->load->view('includes/template', $data);
	}
	
	function ipn() {
	
		$this->load->model('User_model');
		$seller_id = $this->User_model->getidfromE($this->input->post('receiver_email'));
		
		//get id of seller from email
		
		//check if already been inserted NEW
		$this->db->where('trans_id',$this->input->post('custom'));
		$query = $this->db->get('transactions');	
		if($query->num_rows() == 0){//does not exist
			//write to transaction db
			$this->load->model('Transaction_model');
			//perform insert
			$data = array(
				'date_c' => date("Y-m-d H:i:s"),
				'seller_id' => $seller_id,
				'receiver_email' => $this->input->post('receiver_email'),
				'address_status' => $this->input->post('address_status'),
				'payer_id' => $this->input->post('payer_id'),
				'item_name' => $this->input->post('item_name'),
				'item_number' => $this->input->post('item_number'),
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'address_street' => $this->input->post('address_street'),
				'address_city' => $this->input->post('address_city'),
				'address_state' => $this->input->post('address_state'),
				'address_zip' => $this->input->post('address_zip'),
				'address_country_code' => $this->input->post('address_country_code'),
				'address_country' => $this->input->post('address_country'),
				'address_name' => $this->input->post('address_name'),
				'payer_status' => $this->input->post('payer_status'),
				'quantity' => $this->input->post('quantity'),
				'payer_email' => $this->input->post('payer_email'),
				'mc_gross' => $this->input->post('mc_gross'),
				'payment_gross' => $this->input->post('payment_gross'),
				'shipping' => $this->input->post('shipping'),
				'payment_status' => $this->input->post('payment_status'),
				'trans_id' => $this->input->post('custom')
			);
			$this->Transaction_model->insert($data);
		
			$this->load->model('Item_model');
			$this->Item_model->saleMade($this->input->post('item_number'));
		}
		
		
		
		//create random file with all value
	}
	
	function remove($id) {
	
		$data = array(
			'rowid' => $id,
			'qty' => 0
			);
		$this->cart->update($data);
		
		redirect('cart');
	
	}
}