<?php

class Item extends CI_Controller {

	function __construct() {
	
		parent::__construct();
	}
	
	function index() {
		//default
		
	}
	
	function listing($id) {
	
		$data['id'] = $id;
		
		$this->load->library('session');
		$idu = $this->session->userdata('user_id');
		
		
		
		//load all content for item
		$this->load->model('Item_model');
		$data = $this->Item_model->getItem($id);
		
		
		if($idu){
			$data['signedin']="1";
		}
		
		if(isset($data['name'])){
			$data['page_title'] = $data['name'];
			$data['main_content'] = 'item';
			$this->load->view('includes/template', $data);
		}else{
			$data['error'] = "No such item exists";
			$data['main_content'] = 'home';
			$this->load->view('includes/template', $data);
		}
		
	}
	
	function delete($id) {
		$this->load->library('session');
		$idu = $this->session->userdata('user_id');
		//remove and direct to shop
		$this->load->model('Item_model');
		$data = $this->Item_model->getItem($id);
			if($data['id_sg'] != $idu){
				redirect('pagenotfound');
			}
		$data = $this->Item_model->deleteItem($id);
		
		//clean up images
		redirect('shop');
	}
	
	function deleteGroup($id, $g_id) {
		//remove and direct to shop
		$this->load->model('Item_model');
		$data = $this->Item_model->deleteItem($id);
		
		//clean up images
		redirect('group/page/'.$g_id);
	}
	
	function add() {
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		
		if($id){
			$data['signedin']="1";
			$data['main_content'] = 'add_item';
			$this->load->view('includes/template', $data);
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
	}
	
	function edit($item) {
	
		$this->db->where('id',$item);
		$query = $this->db->get('items');	
		if($query->num_rows() == 0){//does not exist
			redirect('pagenotfound');
		}
		
		//check that can edit this item
	
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
			//preload all data
			$this->load->model('Item_model');
			$data = $this->Item_model->getItem($item);
			if($data['seller_or_group'] != 0){
				redirect('pagenotfound');
			}
			if($data['id_sg'] != $id){
				redirect('pagenotfound');
			}
			$data['signedin']="1";
			$data['main_content'] = 'edit_item';
			$this->load->view('includes/template', $data);
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
	}
	
	function update($itemid) {
		$this->db->where('id',$itemid);
		$query = $this->db->get('items');	
		if($query->num_rows() == 0){//does not exist
			redirect('pagenotfound');
		}
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		if($id){	
		
			$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[56]|xss_clean');//required, length
			$this->form_validation->set_rules('about', 'About', 'trim|required|min_length[5]|xss_clean');//required length
			$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|numeric|required|xss_clean');
			$this->form_validation->set_rules('shipping_cost', 'Shipping Cost', 'trim|numeric|required|xss_clean');
			$this->form_validation->set_rules('size', 'Size', 'trim|xss_clean');
			$this->form_validation->set_rules('dimensions', 'Dimensions', 'trim|xss_clean');
			$this->form_validation->set_rules('color', 'Color', 'trim|xss_clean');
			$this->form_validation->set_rules('material', 'Material', 'trim|xss_clean');
			$this->form_validation->set_rules('tags', 'Tags', 'trim|xss_clean');
			$this->form_validation->set_rules('how_it_is_made', 'How it\'s made', 'trim|xss_clean');
			//validate
			if ($this->form_validation->run()==FALSE){
				$this->load->model('Item_model');
				$data = $this->Item_model->getItem($itemid);
				$data['signedin']="1";
				$data['error'] = validation_errors();
				$data['main_content'] = 'edit_item';
				$this->load->view('includes/template', $data);
			}else{
				$this->load->model('Item_model');
			
				$this->load->model('User_model');
				$row = $this->User_model->getAlt('id = '.$id);
				$username = $row->username;
				$name = $row->name;
			
				if($name == ""){
					$name = $username;
				}	
			
				$this->Item_model->updateItem($itemid, $username, $name);//update
				$val = $this->Item_model->do_upload($itemid);
				if($val=="no"){
					$this->load->model('Item_model');
					$data = $this->Item_model->getItem($itemid);
					$data['signedin']="1";
					$data['error'] = "Please upload a lower resolution image. Must be smaller than 2400px by 2400px.";
					$data['main_content'] = 'edit_item';
					$this->load->view('includes/template', $data);
				}else{
					redirect('shop');
				}
				//handle images
			}
			
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
	}
	
	function update_group($itemid) {
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		if($id){	
			
			$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[56]|xss_clean');//required, length
			$this->form_validation->set_rules('about', 'About', 'trim|required|min_length[5]|xss_clean');//required length
			$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('shipping_cost', 'Shipping Cost', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('size', 'Size', 'trim|xss_clean');
			$this->form_validation->set_rules('dimensions', 'Dimensions', 'trim|xss_clean');
			$this->form_validation->set_rules('color', 'Color', 'trim|xss_clean');
			$this->form_validation->set_rules('material', 'Material', 'trim|xss_clean');
			$this->form_validation->set_rules('tags', 'Tags', 'trim|xss_clean');
			$this->form_validation->set_rules('how_it_is_made', 'How it\'s made', 'trim|xss_clean');
			//validate
			if ($this->form_validation->run()==FALSE){
				//load prev with content
				$this->load->model('Item_model');
				$g_id = $this->input->post('g_id');
				$data = $this->Item_model->getItem($itemid);
				$data['error'] = validation_errors();
				$data['g_id']=$g_id;
				$data['signedin']="1";
				$data['main_content'] = 'group_edit_item';
				$this->load->view('includes/template', $data);
			}else{
				$this->load->model('Item_model');
				$g_id = $this->input->post('g_id');
			
				$this->Item_model->updateItemGroup($itemid);//update
				$this->Item_model->do_upload($itemid);
				//handle images
				redirect('group/page/'.$g_id);
			}
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
			
			$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[56]|xss_clean');//required, length
			$this->form_validation->set_rules('about', 'About', 'trim|required|min_length[5]|xss_clean');//required length
			$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('shipping_cost', 'Shipping Cost', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('size', 'Size', 'trim|xss_clean');
			$this->form_validation->set_rules('dimensions', 'Dimensions', 'trim|xss_clean');
			$this->form_validation->set_rules('color', 'Color', 'trim|xss_clean');
			$this->form_validation->set_rules('material', 'Material', 'trim|xss_clean');
			$this->form_validation->set_rules('tags', 'Tags', 'trim|xss_clean');
			$this->form_validation->set_rules('how_it_is_made', 'How it\'s made', 'trim|xss_clean');
			//validate
			if ($this->form_validation->run()==FALSE){
				$data['signedin']="1";
				$data['main_content'] = 'add_item';
				$data['error'] = validation_errors();
				$this->load->view('includes/template', $data);
			}else{
				$this->load->model('User_model');
				$row = $this->User_model->get('id = '.$id);
				$schoolID = $row->school_id;
				$row = $this->User_model->getAlt('id = '.$id);
				$username = $row->username;
				$name = $row->name;
			
				if($name == ""){
					$name = $username;
				}	
						
				$item_name = $this->input->post('name');	
				$this->load->model('Item_model');
				$itemid = $this->Item_model->saveItem($id, $schoolID, $username, $name);
				$this->Item_model->do_upload($itemid);
				//handle images
				//redirect('shop');//with facebook
				$this->share($itemid, $item_name);
			}
			
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
	}
	
	function share($id, $name) {
		//<a href="http://www.facebook.com/sharer.php?u=http://www.google.com">Share This Link on Facebook</a>
		//<a name="fb_share" type="button" href="http://www.facebook.com/sharer.php">Share</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
		
		$name = str_replace(" ", "%20", $name);
		$name = str_replace("&", "and", $name);
		
		redirect('https://www.facebook.com/dialog/feed?app_id=575560985812134&link=http://collegecanvas.org/item/listing/'.$id.'&picture=http://collegecanvas.org/images/item'.$id.'A.jpg&name='.$name.'&caption=on%20CollegeCanvas&description=Check%20out%20my%20new%20item!&redirect_uri=http://collegecanvas.org/shop');
  
	}
	
	function save_group() {
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		if($id){	
		
		
			$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[56]|xss_clean');//required, length
			$this->form_validation->set_rules('about', 'About', 'trim|required|min_length[5]|xss_clean');//required length
			$this->form_validation->set_rules('price', 'Price', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('shipping_cost', 'Shipping Cost', 'trim|required|numeric|xss_clean');
			$this->form_validation->set_rules('size', 'Size', 'trim|xss_clean');
			$this->form_validation->set_rules('dimensions', 'Dimensions', 'trim|xss_clean');
			$this->form_validation->set_rules('color', 'Color', 'trim|xss_clean');
			$this->form_validation->set_rules('material', 'Material', 'trim|xss_clean');
			$this->form_validation->set_rules('tags', 'Tags', 'trim|xss_clean');
			$this->form_validation->set_rules('how_it_is_made', 'How it\'s made', 'trim|xss_clean');
			//validate
			if ($this->form_validation->run()==FALSE){
				$g_id = $this->input->post('g_id');
				$data['id']=$g_id;
				$data['signedin']="1";
				$data['error'] = validation_errors();
				$data['main_content'] = 'group_add_item';
				$this->load->view('includes/template', $data);
			}else{
				$this->load->model('User_model');
				$row = $this->User_model->get('id = '.$id);
				$schoolID = $row->school_id;
				$row = $this->User_model->getAlt('id = '.$id);
				$username = $row->username;
			
				$g_id = $this->input->post('g_id');
				$this->load->model('Group_model');
				$group = $this->Group_model->get("id = ".$g_id);
			
				$name = $group->name;//name of group
			
						
				$this->load->model('Item_model');
				$itemid = $this->Item_model->saveItemGroup($g_id, $schoolID, $username, $name);
				$this->Item_model->do_upload($itemid);
				//handle images
				redirect('group/page/'.$g_id);
			}
			
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
	}
	
	
}