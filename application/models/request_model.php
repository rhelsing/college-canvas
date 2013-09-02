<?php

class Request_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	function seller($email) {
		//insert into 
		
		//dont store duplicates!!!
		$this->load->library('encrypt');
		$hash = $this->encrypt->sha1($email);
		
		$new_request = array(
			'date_c' => date("Y-m-d H:i:s"),
			'type' => 1,
			'email' => $email,
			'approved' => 0,
			'signedup' => 0,
			'confirmation' => $hash
		);
		
		$insert = $this->db->insert('users', $new_request);
		
		return $insert;
	
	}
	
	function getall() {
		$query = $this->db->get_where('users', 'type = 1 && approved = 0'); //show unapproved sellers
		return $query->result();
	}
	
	function approve($id) {
		//set approve = 1
		$data = array(
               'approved' => 1,
            );

            $this->db->where('id', $id);
            $this->db->update('users', $data);  
            
            $query = $this->db->get_where('users', 'id = '.$id);
            foreach ($query->result() as $row)
            {
	            $email = $row->email;
	        }
               
            return $email;
	}
	
	function deny($id) {
		$this->db->delete('users', array('id' => $id)); 
	}

	

}