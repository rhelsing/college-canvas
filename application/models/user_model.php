<?php

class User_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}

	function check($hash) {
	
		$hash = "'".$hash."'";
		//if $hash is in db and if that user signup = 0
		$query = $this->db->get_where('users', 'confirmation = '.$hash);
		if($query->num_rows()) {
        	// Query returned results
        	foreach($query->result() as $row) { 
            	$signedup = $row->signedup;
            	$id = $row->id;
            }
            if($signedup=='0'){
	            //good
	            return $id;
            }else{
	            return false;
            }
         }else{
	         return false;
         }
	
	}
	
	function checkUser($user) {
	
		//if $hash is in db and if that user signup = 0
		$query = $this->db->get_where('users', 'username = "'.$user.'"');
		if($query->num_rows()) {
		//already in
        	return true;
         }else{
	         return false;
         }
	
	}
	
	function signin($username, $password) {
	
		$this->db->select('password'); #Because I need the value
	
		//check if email address
		if (strpos($username,'@') !== false) {
			//email
			$this->db->where('email', $username);
    	}else{
	    	$this->db->where('username', $username);
    	}
		
		//look up user and compare sha1 password#Because I need the variable column
		$query = $this->db->get('users'); #From the settings table
		$row = $query->row_array(); // get the row
		if(isset($row['password'])){
			$compare = $row['password'];
		}else{
			return false;
		}
		
		$this->load->library('encrypt');
		$hash = $this->encrypt->sha1($password);
		
		if($compare == $hash){
			return true;
		}else{
			return false;
		}
		
		//return true or false
	}
	
	function getid($username) {
	
		$this->db->select('id'); #Because I need the value
		if (strpos($username,'@') !== false) {
			//email
			$this->db->where('email', $username);
    	}else{
	    	$this->db->where('username', $username);
    	}
		$query = $this->db->get('users'); #From the settings table
		$row = $query->row_array();
		return $row['id'];
	
	}
	
	function getUsername($id) {
	
		$this->db->select('username'); #Because I need the value
		$this->db->where('id', $id); #Because I need the variable column
		$query = $this->db->get('users'); #From the settings table
		$row = $query->row_array();
		return $row['username'];
	
	}
	
	function getidfromE($email) {
	
		$this->db->select('id'); #Because I need the value
		$this->db->where('email', $email); #Because I need the variable column
		$query = $this->db->get('users'); #From the settings table
		$row = $query->row_array();
		if(isset($row['id'])){
			return $row['id'];
		}else{
			return false;
		}
	
	}
	
	function getUser($id) {
		$this->db->where('id', $id); #Because I need the variable column
		$query = $this->db->get('users'); #From the settings table
		$row = $query->row_array();
		return $row;
	}
	function getSeller($id) {
		$this->db->where('id', $id); #Because I need the variable column
		$query = $this->db->get('sellers'); #From the settings table
		$row = $query->row_array();
		return $row;
	}
	
	public function get($where = false){
		if($where){
			$this->db->where($where);
		}
		$query = $this->db->get('sellers', 1);
		return $query->row();
	}
	public function getAlt($where = false){
		if($where){
			$this->db->where($where);
		}
		$query = $this->db->get('users', 1);
		return $query->row();
	}
	
	function signup() {
	
		$id = $this->input->post('id');
		$username = $this->input->post('username');
		$password = $this->input->post('pw1');
		$pieces = explode("**", $this->input->post('school'));
		$school_name = $pieces[0];
		$school = $pieces[1];
		$major = $this->input->post('major');
		
		
		$this->load->library('encrypt');
		$hash = $this->encrypt->sha1($password);
		
		
		//update original
		$data = array(
				'username' => $username,
				'password' => $hash,
				'signedup' => 1
            );

        $this->db->where('id', $id);
        $this->db->update('users', $data); 
		
		//insert into new seller table
		
		$new_seller = array(
			'id' => $id,
			'school_id' => $school,
			'school' => $school_name,
			'major' => $major
		);
		
		$insert = $this->db->insert('sellers', $new_seller);
		
		return $insert;
		
	
	}
	
	function saveProfile($id) {
	
	
		$data = array(
				'hometown' => $this->input->post('hometown'),
				'about' => $this->input->post('about'),
				'shop_name' => $this->input->post('shop_name'),
				'school' => $this->input->post('school'),
				'year' => $this->input->post('year'),
				'facebook' => $this->input->post('facebook'),
				'twitter' => $this->input->post('twitter'),
				'pinterest' => $this->input->post('pinterest'),
				'blog' => $this->input->post('blog')
            );
            
        if($this->input->post('remove')=='on'){
			$data['shop_banner']= '';
		}
            
        $data2 = array(
			'name' => $this->input->post('name')
         );
            

        $this->db->where('id', $id);
        $this->db->update('sellers', $data); 
        
        $this->db->where('id', $id);
        $this->db->update('users', $data2); 
        
	
	}
	
	function do_upload(){
		
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
	
		
		$this->load->library('upload');
	
		foreach ($_FILES as $key => $value){
                if ($key['name']=='x'){
                	$config4 = array(
                		'file_name' => 'profile'.$id,
                		'allowed_types' => 'jpeg|jpg|gif|png',
                		'overwrite' => TRUE,
                		'upload_path' => realpath(APPPATH.'../images')
                	);
                	
                    $this->upload->initialize($config4);
                    if($this->upload->do_upload($key)){
	                    $image_data = $this->upload->data();
                    
                    //modify file to proper size
		
                   $this->load->spark('wideimage/11.02.19');
                   $this->wideimage->load(base_url().'images/'.$image_data['file_name'].'')->resize(160)->saveToFile('images/thumb'.$id.'.jpg');
                   
                   //delete temp
                    
                    //put path in db
                    $propic = "thumb".$id.".jpg";
                     $data = array(
                    	'picture' => $propic
                    );
         
                    $this->db->where('id', $id);
                    $this->db->update('sellers', $data);
                    }
                    
                 
                    
                }
                if ($key['name']=='z'){
                	$config3 = array(
                		'file_name' => 'banner'.$id,
                		'allowed_types' => 'jpeg|jpg|gif|png',
                		'overwrite' => TRUE,
                		'upload_path' => realpath(APPPATH.'../images')
                	);
                    $this->upload->initialize($config3);
                    if($this->upload->do_upload($key)){
	                    $image_data = $this->upload->data();
                    
                   $this->load->spark('wideimage/11.02.19');
                   $this->wideimage->load(base_url().'images/'.$image_data['file_name'].'')->resize(720)->resizeCanvas('100%', '100', 0, 'center')->saveToFile('images/banner'.$id.'.jpg');
                    $this->wideimage->load(base_url().'images/banner'.$id.'.jpg')->resize(500)->saveToFile('images/bannerSmall'.$id.'.jpg');
                    
                    $banner = 'banner'.$id.'.jpg';
                    
                    $data = array(
                    	'shop_banner' => $banner
                    );
         
                    $this->db->where('id', $id);
                    $this->db->update('sellers', $data);
                    } 
                    
                    
                }
            }
             
		
		
		
	}

}