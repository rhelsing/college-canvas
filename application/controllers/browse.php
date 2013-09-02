<?php

class Browse extends CI_Controller {

	function __construct() {
	
		parent::__construct();
	}
	
	function index() {
		//all or default to category
		
	}
	
	function category($id, $page=0) {
	
		$this->load->library('session');
		$idu = $this->session->userdata('user_id');
		
		if($idu){
			$data['signedin']="1";
		}
		
		$this->load->model('Item_model');
		$this->load->model('Category_model');
		
		$this->db->where('id',$id);
		$query = $this->db->get('categories');	
		if($query->num_rows() == 0){//does not exist
			redirect('pagenotfound');
		}
		

		$config['total_rows'] = $this->db->get_where('items', 'category_id ='.$id)->num_rows();
		$config['per_page'] = 60;
		//$config['full_tag_open'] = '<div id="pagination">';
		//$config['full_tag_close'] = '</div>';
		//$data['pgs'] = ceil($config['per_page']/$config['total_rows']);
		$data['pgs'] = ceil($config['total_rows']/$config['per_page']);
		$data['prev']=$page-$config['per_page'];
		$data['current']=floor($page/$config['per_page'])+1;
		$data['next']=$page+$config['per_page'];
		$data['id']=$id;
		
		$row = $this->Category_model->get('id = '.$id);
		$data['cat_name'] = $row->name;
		
		
		if($page < 0){
			$page = 0;
			$data['current'] =1;
			//set url correct
			
		}
		if($data['current'] > $data['pgs']){
			$page = ($data['pgs']-1)*$config['per_page'];
			$data['current']=$data['pgs'];
		}
		$data['hideprev'] = "";
		if($page == 0){
			//disable
			$data['hideprev'] = "onclick=\"return false\"";	
		}
		$data['hidenext'] = "";
		if($data['current'] == $data['pgs']){
			$data['hidenext'] = "onclick=\"return false\"";
		}
		
		//disable when out of bounds
		
		if($config['total_rows'] > 0){
			$items = array();
			$items = $this->Item_model->getFromCategory($id, $config['per_page'], $page);
			//shuffle
			shuffle($items);
			$data['items'] = $items;
		}
		
		
		$data['main_content'] = 'browse_category';
		$this->load->view('includes/template', $data);
	}
	
	function school($id, $page=0) {
	
		$this->load->library('session');
		$idu = $this->session->userdata('user_id');
		
		if($idu){
			$data['signedin']="1";
		}
	
		$this->load->model('Item_model');
		$this->load->model('School_model');
		
		$this->db->where('id',$id);
		$query = $this->db->get('schools');	
		if($query->num_rows() == 0){//does not exist
			redirect('pagenotfound');
		}
		

		$config['total_rows'] = $this->db->get_where('items', 'school_id ='.$id)->num_rows();
		$config['per_page'] = 60;
		//$config['full_tag_open'] = '<div id="pagination">';
		//$config['full_tag_close'] = '</div>';
		//$data['pgs'] = ceil($config['per_page']/$config['total_rows']);
		$data['pgs'] = ceil($config['total_rows']/$config['per_page']);
		$data['prev']=$page-$config['per_page'];
		$data['current']=floor($page/$config['per_page'])+1;
		$data['next']=$page+$config['per_page'];
		$data['id']=$id;
		
		$row = $this->School_model->get('id = '.$id);
		$data['school_name'] = $row->name;
		
		
		if($page < 0){
			$page = 0;
			$data['current'] =1;
			//set url correct
			
		}
		if($data['current'] > $data['pgs']){
			$page = ($data['pgs']-1)*$config['per_page'];
			$data['current']=$data['pgs'];
		}
		$data['hideprev'] = "";
		if($page == 0){
			//disable
			$data['hideprev'] = "onclick=\"return false\"";	
		}
		$data['hidenext'] = "";
		if($data['current'] == $data['pgs']){
			$data['hidenext'] = "onclick=\"return false\"";
		}
		
		//disable when out of bounds
		
		if($config['total_rows'] > 0){
			$items = array();
			$items = $this->Item_model->getFromSchool($id, $config['per_page'], $page);
			shuffle($items);
			$data['items'] = $items;
		}
		
		
		$data['main_content'] = 'browse_school';
		$this->load->view('includes/template', $data);
	
	}
}