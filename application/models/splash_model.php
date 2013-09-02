<?php

class Splash_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	
	function insert($email) {
	
		//insert into db
		$new_email = array(
			'email' => $email
		);
		
		$insert = $this->db->insert('splash_emails', $new_email);
		
		return $insert;
	}

	

}