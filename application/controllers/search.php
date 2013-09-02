<?php

class Search extends CI_Controller {

	function __construct() {
	
		parent::__construct();
	}
	
	function index() {
	
		//redirect
		$safeTerm = preg_replace("/[^A-Za-z0-9\s\s+]/","", $this->input->post('search'));
		$term = str_replace(" ", "-", $safeTerm);
		redirect('search/terms/'.$term);
		
	}
	
	function terms($string=" ", $page=0) {
	
		$this->load->library('session');
		$idu = $this->session->userdata('user_id');
		
		if($idu){
			$data['signedin']="1";
		}
		
	
		//get data
		$this->load->model('Item_model');
		$data['items'] =$this->Item_model->getSearchItems($string);
		$data['numResults'] = count($data['items']);
		
		$categories = array();
		$schools = array();
		
		//get name before
		
		foreach($data['items'] as $item){
			if (array_key_exists($item->category_id, $categories)) {
				//increment
				$categories[$item->category_id]++;
			}else{
				//add and set to one
				$categories[$item->category_id]=1;	
			}
		}
		
		foreach($data['items'] as $item){
			if (array_key_exists($item->school_id, $schools)) {
				//increment
				$schools[$item->school_id]++;
			}else{
				//add and set to one
				$schools[$item->school_id]=1;	
			}
		}
		
		$this->load->model('Category_model');
		$this->load->model('School_model');
		
		$mainCats=array();
		$mainSchools=array();
		
		foreach($categories as $category => $value){
			$row = $this->Category_model->get("id = ".$category);
			$mainCats[$row->name] = $value;
		}
		foreach($schools as $school => $value){
			$row = $this->School_model->get("id = ".$school);
			$mainSchools[$row->name] = $value;
		}
		
		
		$data['categories'] = $mainCats;
		$data['schools']=$mainSchools;
		
		
		
		//cycle through items and increment categories
		//cycle through and increment schools
		//display both
		
		$data['searchTerm'] = str_replace("-", " ", $string);
		$data['main_content'] = 'search';
		$this->load->view('includes/template', $data);
		
	}
}