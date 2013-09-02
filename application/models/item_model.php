<?php

class Item_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	function saleMade($id) {
		$this->db->where('id', $id);
		$this->db->set('quantity', 'quantity-1', FALSE);
		$this->db->update('items');
	}
	
	function search($string) {
		//split into array and search not array first
		$this->db->select('*');
		$this->db->from('items');
		foreach($terms as $term){
			$this->db->like('name', $term);
		}
		$result = $this->db->get();
	}
	
	function deleteItem($id) {
		$this->db->delete('items', array('id' => $id)); 
	}

	function saveItem($id, $schoolID, $username, $name) {
		$data = array(
				'date_c' => date("Y-m-d H:i:s"),
				'name' => $this->input->post('name'),
				'about' => $this->input->post('about'),
				'price' => $this->input->post('price'),
				'tags' => $this->input->post('tags'),
				'seller_or_group' => '0', //seller
				'id_sg' => $id,
				'username' => $username,
				'name_user' => $name,
				'quantity' => $this->input->post('quantity'),
				'school_id' => $schoolID,
				'category_id' => $this->input->post('category'),
				'material' => $this->input->post('material'),
				'how_it_is_made' => $this->input->post('how_it_is_made'),
				'size' => $this->input->post('size'),
				'dimensions' => $this->input->post('dimensions'),
				'shipping_cost' => $this->input->post('shipping_cost'),
				'color' => $this->input->post('color')
            );
            
            
           $this->db->insert('items', $data);
           
           return $this->db->insert_id();
        
	}
	
	function saveItemGroup($g_id, $schoolID, $username, $name) {
		$data = array(
				'date_c' => date("Y-m-d H:i:s"),
				'name' => $this->input->post('name'),
				'about' => $this->input->post('about'),
				'price' => $this->input->post('price'),
				'tags' => $this->input->post('tags'),
				'seller_or_group' => '1', //group
				'id_sg' => $g_id,
				'username' => $username,
				'name_user' => $name,
				'quantity' => $this->input->post('quantity'),
				'school_id' => $schoolID,
				'category_id' => $this->input->post('category'),
				'material' => $this->input->post('material'),
				'how_it_is_made' => $this->input->post('how_it_is_made'),
				'size' => $this->input->post('size'),
				'dimensions' => $this->input->post('dimensions'),
				'shipping_cost' => $this->input->post('shipping_cost'),
				'color' => $this->input->post('color')
            );
            
            
           $this->db->insert('items', $data);
           
           return $this->db->insert_id();
        
	}
	
	
	function updateItem($itemid, $username, $name) {
		$data = array(
				'name' => $this->input->post('name'),
				'about' => $this->input->post('about'),
				'price' => $this->input->post('price'),
				'tags' => $this->input->post('tags'),
				'seller_or_group' => '0', //seller
				'username' => $username,
				'name_user' => $name,
				'quantity' => $this->input->post('quantity'),
				'category_id' => $this->input->post('category'),
				'material' => $this->input->post('material'),
				'how_it_is_made' => $this->input->post('how_it_is_made'),
				'size' => $this->input->post('size'),
				'dimensions' => $this->input->post('dimensions'),
				'shipping_cost' => $this->input->post('shipping_cost'),
				'color' => $this->input->post('color')
            );
            
           
           $this->db->where('id', $itemid);
           $this->db->update('items', $data);
           
        
	}
	
	function updateItemGroup($itemid) {
		$data = array(
				'name' => $this->input->post('name'),
				'about' => $this->input->post('about'),
				'price' => $this->input->post('price'),
				'tags' => $this->input->post('tags'),
				'seller_or_group' => '1', //seller
				'quantity' => $this->input->post('quantity'),
				'category_id' => $this->input->post('category'),
				'material' => $this->input->post('material'),
				'how_it_is_made' => $this->input->post('how_it_is_made'),
				'size' => $this->input->post('size'),
				'dimensions' => $this->input->post('dimensions'),
				'shipping_cost' => $this->input->post('shipping_cost'),
				'color' => $this->input->post('color')
            );
            
           
           $this->db->where('id', $itemid);
           $this->db->update('items', $data);
           
        
	}
	
	function getItems($id) {
            
        $query = $this->db->get_where('items', 'seller_or_group = 0 && id_sg ='.$id);
		return $query->result();
	}
	
	function getItemsGroup($g_id) {
            
        $query = $this->db->get_where('items', 'seller_or_group = 1 && id_sg ='.$g_id);
		return $query->result();
	}
	
	function getSearchItems($string) {
        //search
        $cats = explode("-", $string);
        //explode into array
        $this->db->select('*');
        $this->db->from('items');
 		foreach($cats as $cat){
    		$this->db->or_like('name', $cat);
    		//also check description and other???
    	}
 		$query = $this->db->get();
		return $query->result();
	}
	
	function getFromCategory($id, $limit, $offset) {
            
        $query = $this->db->get_where('items', 'category_id ='.$id, $limit, $offset); 
		return $query->result();
	}
	
	
	function getFromSchool($id, $limit, $offset) {
            
        $query = $this->db->get_where('items', 'school_id ='.$id, $limit, $offset);
		return $query->result();
	}
	
	function item($where = false) {
		if($where){
			$this->db->where($where);
		}
		$query = $this->db->get('items', 1);
		return $query->row();
	}
	
	function getItem($item) {
		$this->db->where('id ='.$item);
		$query = $this->db->get_where('items', 'id ='.$item); //show only item
		$row = $query->row_array();
		return $row;
	}
	
	function do_upload($id){
		
		$this->load->library('upload');
		
		foreach ($_FILES as $key => $value){
			 if ($key['name']=='a'){
			 	$config = array(
                		'file_name' => 'item'.$id.'A',
                		'allowed_types' => 'jpeg|jpg|gif|png',
                		'overwrite' => TRUE,
                		'upload_path' => realpath(APPPATH.'../images')
                	);
                	
                $this->upload->initialize($config);
                if($this->upload->do_upload($key)){
                	$image_data = $this->upload->data();
	                
	                
	                $this->load->spark('wideimage/11.02.19');
	                
                   $this->wideimage->load(base_url().'images/'.$image_data['file_name'].'')->resize(600)->saveToFile('images/'.$config['file_name'].'.jpg');
                   $this->wideimage->load(base_url().'images/'.$image_data['file_name'].'')->resize(null, 200)->crop('center', 'center', 158, 130)->saveToFile('images/'.$config['file_name'].'Small.jpg');
                   $this->wideimage->load(base_url().'images/'.$image_data['file_name'].'')->resize(215, null)->saveToFile('images/'.$config['file_name'].'Pin.jpg');
	             }
			 }
			 if ($key['name']=='b'){
			 	$config = array(
                		'file_name' => 'item'.$id.'B',
                		'allowed_types' => 'jpeg|jpg|gif|png',
                		'overwrite' => TRUE,
                		'upload_path' => realpath(APPPATH.'../images')
                	);
                	
                $this->upload->initialize($config);
                if($this->upload->do_upload($key)){
                	$image_data = $this->upload->data();
	                
	                
	                
	                $this->load->spark('wideimage/11.02.19');
                   $this->wideimage->load(base_url().'images/'.$image_data['file_name'].'')->resize(600)->saveToFile('images/'.$config['file_name'].'.jpg');
                   $this->wideimage->load(base_url().'images/'.$image_data['file_name'].'')->resize(null, 131)->crop('center', 'center', 158, 130)->saveToFile('images/'.$config['file_name'].'Small.jpg'); 
	               
	             }
			 }
			 if ($key['name']=='c'){
			  	$config = array(
                		'file_name' => 'item'.$id.'C',
                		'allowed_types' => 'jpeg|jpg|gif|png',
                		'overwrite' => TRUE,
                		'upload_path' => realpath(APPPATH.'../images')
                	);
                	
                $this->upload->initialize($config);
                if($this->upload->do_upload($key)){
                	//upload
	                $image_data = $this->upload->data();
	                
	                
	
	                
	                $this->load->spark('wideimage/11.02.19');
                   $this->wideimage->load(base_url().'images/'.$image_data['file_name'].'')->resize(600)->saveToFile('images/'.$config['file_name'].'.jpg');
                   $this->wideimage->load(base_url().'images/'.$image_data['file_name'].'')->resize(null, 131)->crop('center', 'center', 158, 130)->saveToFile('images/'.$config['file_name'].'Small.jpg');
	             }
			 }
			 if ($key['name']=='d'){
			  	$config = array(
                		'file_name' => 'item'.$id.'D',
                		'allowed_types' => 'jpeg|jpg|gif|png',
                		'overwrite' => TRUE,
                		'upload_path' => realpath(APPPATH.'../images')
                	);
                	
                $this->upload->initialize($config);
                if($this->upload->do_upload($key)){
                	//upload
	                $image_data = $this->upload->data();
	                
	      
	         
	                
	                $this->load->spark('wideimage/11.02.19');
                   $this->wideimage->load(base_url().'images/'.$image_data['file_name'].'')->resize(600)->saveToFile('images/'.$config['file_name'].'.jpg');
                   $this->wideimage->load(base_url().'images/'.$image_data['file_name'].'')->resize(null, 131)->crop('center', 'center', 158, 130)->saveToFile('images/'.$config['file_name'].'Small.jpg');
	             }
			 }
			 if ($key['name']=='e'){
			  	$config = array(
                		'file_name' => 'item'.$id.'E',
                		'allowed_types' => 'jpeg|jpg|gif|png',
                		'overwrite' => TRUE,
                		'upload_path' => realpath(APPPATH.'../images')
                	);
                	
                $this->upload->initialize($config);
                if($this->upload->do_upload($key)){
                	//upload
	                $image_data = $this->upload->data();
	                

	                
	                $this->load->spark('wideimage/11.02.19');
                   $this->wideimage->load(base_url().'images/'.$image_data['file_name'].'')->resize(600)->saveToFile('images/'.$config['file_name'].'.jpg');
                   $this->wideimage->load(base_url().'images/'.$image_data['file_name'].'')->resize(null, 131)->crop('center', 'center', 158, 130)->saveToFile('images/'.$config['file_name'].'Small.jpg');
	             }
			 }
		}
		return "yes";
		
	}

}