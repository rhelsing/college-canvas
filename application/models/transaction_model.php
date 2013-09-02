<?php

class Transaction_model extends CI_Model {

	protected $table;
	public $obj;
 
	function __construct(){
		parent::__construct();
		$this->table = "transactions";
	}
 
        // insert a row - pass in an object to $o and it will insert
	public function insert($o){
		$this->db->insert($this->table, $o);
		$id = $this->db->insert_id();
 
		$query = $this->db->where($this->table.".id", $id)->get($this->table);
		$this->obj = $query->row();
	}
 
        // update - set the model's obj variable to be the updated object
        // then run this function. Assumes your primary key column is id
	public function update($data, $id){
		$this->db->where('id', $id);
        $this->db->update($this->table, $data);
	}
	
 
        // get all the records with where clause if necessary
        // returns array of objects
	public function get_all($where = false){
		if($where){
			$this->db->where($where);
		}
		$query = $this->db->get($this->table);
		return $query->result();
	}
 
        // get a single record with where clause if necessary
        // returns object
	public function get($where = false){
		if($where){
			$this->db->where($where);
		}
		$query = $this->db->get($this->table, 1);
		return $query->row();
	}
	

}