<?php

class Group_model extends CI_Model {
	
	protected $table;
	public $obj;
 
	function __construct(){
		parent::__construct();
		$this->table = "groups";
	}
 
        // insert a row - pass in an object to $o and it will insert
	public function insert($o){
		$this->db->insert($this->table, $o);
		$id = $this->db->insert_id();
 
		$query = $this->db->where($this->table.".id", $id)->get($this->table);
		$this->obj = $query->row();
		return $query->row();
	}
 
        // update - set the model's obj variable to be the updated object
        // then run this function. Assumes your primary key column is id
	public function update($data, $id){
		$this->db->where('id', $id);
        $this->db->update($this->table, $data);
	}
	
	public function delete($id){
        $this->db->delete($this->table, array('id' => $id)); 
	}
 
        // get all the records with where clause if necessary
        // returns array of objects
	public function get_all($where = false){
		if($where){
			$this->db->where($where);
		}
		$this->db->order_by("name", "asc");
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
	
	
	function do_upload($g_id){
		
	
		
		$this->load->library('upload');
	
		foreach ($_FILES as $key => $value){
                if ($key['name']=='x'){
                	$config4 = array(
                		'file_name' => 'groupMain'.$g_id,
                		'allowed_types' => 'jpeg|jpg|gif|png',
                		'overwrite' => TRUE,
                		'upload_path' => realpath(APPPATH.'../images')
                	);
                	
                    $this->upload->initialize($config4);
                    if($this->upload->do_upload($key)){
	                    $image_data = $this->upload->data();
                    
                    //modify file to proper size
		
                   $this->load->spark('wideimage/11.02.19');
                   $this->wideimage->load(base_url().'images/'.$image_data['file_name'].'')->resize(160)->saveToFile('images/groupMain'.$g_id.'.jpg');
                   
                   //delete temp
                    }
                    
                 
                    
                }
                if ($key['name']=='z'){
                	$config3 = array(
                		'file_name' => 'groupBanner'.$g_id,
                		'allowed_types' => 'jpeg|jpg|gif|png',
                		'overwrite' => TRUE,
                		'upload_path' => realpath(APPPATH.'../images')
                	);
                    $this->upload->initialize($config3);
                    if($this->upload->do_upload($key)){
	                    $image_data = $this->upload->data();
                    
                   $this->load->spark('wideimage/11.02.19');
                   $this->wideimage->load(base_url().'images/'.$image_data['file_name'].'')->resize(720)->resizeCanvas('100%', '100', 0, 'center')->saveToFile('images/groupBanner'.$g_id.'.jpg');
                    $this->wideimage->load(base_url().'images/groupBanner'.$g_id.'.jpg')->resize(500)->saveToFile('images/groupBannerSmall'.$g_id.'.jpg');
                  
                    } 
                    
                    
                }
            }
             
		
		
		
	}
	

}