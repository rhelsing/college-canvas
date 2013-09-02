<?php

class Admin extends CI_Controller {

	function __construct() {
	
		parent::__construct();
	}
	
	function index() {
	
		$this->load->library('session');
		$loged = $this->session->userdata('yusdhds');
		if($loged == "lgd5657383"){
			$signedin = TRUE;
		}else{
			$signedin = FALSE;
		}
		
		if($signedin){
			$this->load->model('Request_model');
		
			//get all
			$data=array();
		
			if($query = $this->Request_model->getall()){
				$data['records'] = $query;
			}
		
			//$this->load->view('admin_main', $data);
			$data['main_content'] = 'admin_main';
			$this->load->view('includes/template', $data);
		}else{
			$data['main_content'] = 'admin_login';
			$this->load->view('includes/template', $data);
		}
		
	}
	
	function test() {
		$config = Array(
		'protocol' => 'smtp',
    	'smtp_host' => 'ssl://smtp.googlemail.com',
    	'smtp_port' => 465,
    	'smtp_user' => 'ryanhelsing@gmail.com',
    	'smtp_pass' => 'mailman!',
    	'mailtype'  => 'html', 
    	'charset'   => 'iso-8859-1'
    );
	$this->load->library('email', $config);
	$this->email->set_newline("\r\n");

	// Set to, from, message, etc.
        
		$result = $this->email->send(); 

        $this->email->from('collegecanvas.org@gmail.com', 'invoice');
        $this->email->to('ryanhelsing@gmail.com');
        $this->email->subject('Invoice');
        $this->email->message('Test');

        $result = $this->email->send(); 
	
	}
	
	function adminLogin() {
		$username=$this->input->post('user');
		$password=$this->input->post('pass');
		if($username == "rcbadmin"){
			if($password == "creativecampus"){
				//set logged in
				$this->load->library('session');
				$this->session->set_userdata('yusdhds', "lgd5657383");
			}
		}
		redirect('admin');
	
	}
	
	function handpicked() {
		$this->load->library('session');
		$loged = $this->session->userdata('yusdhds');
		if($loged == "lgd5657383"){
			$signedin = TRUE;
		}else{
			$signedin = FALSE;
		}
		
		if($signedin){
		$data['main_content'] = 'admin_handpicked';
		$this->load->view('includes/template', $data);
		}else{
			$data['main_content'] = 'admin_login';
			$this->load->view('includes/template', $data);
		}
	}
	
	function edit_handpicked($id) {
	$this->load->library('session');
		$loged = $this->session->userdata('yusdhds');
		if($loged == "lgd5657383"){
			$signedin = TRUE;
		}else{
			$signedin = FALSE;
		}
		
		if($signedin){
		$data['current_id']= $id;
		$data['main_content'] = 'edit_handpicked';
		$this->load->view('includes/template', $data);
	}else{
			$data['main_content'] = 'admin_login';
			$this->load->view('includes/template', $data);
		}
	}
	
	function save_handpicked($id) {
	$this->load->library('session');
		$loged = $this->session->userdata('yusdhds');
		if($loged == "lgd5657383"){
			$signedin = TRUE;
		}else{
			$signedin = FALSE;
		}
		
		if($signedin){
		//both fields are required and item and pic must exist
		$itemid=$this->input->post('item');
		$picture=$this->input->post('picture');
		
		//store txt file with link to item
		$myFile = "lists/".$id.".txt";
        $fh = fopen($myFile, 'w') or die("can't open file");
        $stringData = $itemid;
	    fwrite($fh, $stringData);
	    fclose($fh);
	
		//write product image to $id image
		 $this->load->spark('wideimage/11.02.19');
         $this->wideimage->load(base_url().'images/item'.$itemid.$picture.'.jpg')->saveToFile('images/handpicked'.$id.'.jpg');
		
		//special cases for certain id's?
		redirect('admin/handpicked');
	}else{
			$data['main_content'] = 'admin_login';
			$this->load->view('includes/template', $data);
		}
	}
	
	function edit_category($id) {
	$this->load->library('session');
		$loged = $this->session->userdata('yusdhds');
		if($loged == "lgd5657383"){
			$signedin = TRUE;
		}else{
			$signedin = FALSE;
		}
		
		if($signedin){
		//edit school
		$this->load->model('Category_model');
		$data['row'] = $this->Category_model->get('id = '.$id);
		
		//update include
		
		$data['main_content'] = 'edit_category';
		$this->load->view('includes/template', $data);
	}else{
			$data['main_content'] = 'admin_login';
			$this->load->view('includes/template', $data);
		}
	}
	
	function delete_category($id) {
	$this->load->library('session');
		$loged = $this->session->userdata('yusdhds');
		if($loged == "lgd5657383"){
			$signedin = TRUE;
		}else{
			$signedin = FALSE;
		}
		
		if($signedin){
		$this->load->model('Category_model');
		$this->Category_model->delete($id);
		
		$data = $this->Category_model->get_all();
		$this->buildCategories($data);
		
		redirect('admin/categories');
		}else{
			$data['main_content'] = 'admin_login';
			$this->load->view('includes/template', $data);
		}
	}
	
	private function buildCategories($data) {
	
        $myFile = "lists/categories.txt";
        $myFile2 = "lists/categoriesOptions.txt";
        $fh = fopen($myFile, 'w') or die("can't open file");
        $fh2 = fopen($myFile2, 'w') or die("can't open file");
        foreach($data as $row){
        	$stringData = '<li><a href="'.base_url().'browse/category/'.$row->id.'">'.$row->name.'</a></li>';
	        fwrite($fh, $stringData);
	        
	        $stringData = '<option value="'.$row->id.'">'.$row->name.'</option>';
	        fwrite($fh2, $stringData);
        }
       fclose($fh);
	}
	
	private function buildSchools($data) {
        $myFile = "lists/schools.txt";
        $myFile2 = "lists/schoolsOptions.txt";
        $fh = fopen($myFile, 'w') or die("can't open file");
        $fh2 = fopen($myFile2, 'w') or die("can't open file");
        foreach($data as $row){
        	$stringData = '<li><a href="'.base_url().'browse/school/'.$row->id.'">'.$row->name.'</a></li>';
	        fwrite($fh, $stringData);
	        
	        $stringData = '<option value="'.$row->name.'**'.$row->id.'">'.$row->name.'</option>';
	        fwrite($fh2, $stringData);
        }
       fclose($fh);
	}
	
	function update_category($id) {
	$this->load->library('session');
		$loged = $this->session->userdata('yusdhds');
		if($loged == "lgd5657383"){
			$signedin = TRUE;
		}else{
			$signedin = FALSE;
		}
		
		if($signedin){
	$data = array(
				'name' => $this->input->post('name'),
				'about' => $this->input->post('about'),
            );
	
	$this->load->model('Category_model');
	$this->Category_model->update($data, $id);
	
	$data = $this->Category_model->get_all();
	$this->buildCategories($data);
	
	redirect('admin/categories');
	}else{
			$data['main_content'] = 'admin_login';
			$this->load->view('includes/template', $data);
		}
	}
	
	function categories($id = "none") {
	$this->load->library('session');
		$loged = $this->session->userdata('yusdhds');
		if($loged == "lgd5657383"){
			$signedin = TRUE;
		}else{
			$signedin = FALSE;
		}
		
		if($signedin){
	$this->load->model('Category_model');
	
	if($id=='insert'){
		//perform insert
		$data = array(
				'name' => $this->input->post('name'),
				'about' => $this->input->post('about'),
				'date_c' => date("Y-m-d H:i:s")
            );
		$this->Category_model->insert($data);
		
		$data = $this->Category_model->get_all();
		$this->buildCategories($data);
		
		redirect('admin/categories');
	}
	
		
		//get all
		$data=array();
		
		if($query = $this->Category_model->get_all()){
			$data['records'] = $query;
		}
	
		//load schools and list
	
		$data['main_content'] = 'admin_categories';
		$this->load->view('includes/template', $data);
	}else{
			$data['main_content'] = 'admin_login';
			$this->load->view('includes/template', $data);
		}
	}
	
	function edit_school($id) {
	$this->load->library('session');
		$loged = $this->session->userdata('yusdhds');
		if($loged == "lgd5657383"){
			$signedin = TRUE;
		}else{
			$signedin = FALSE;
		}
		
		if($signedin){
		//edit school
		$this->load->model('School_model');
		$data['row'] = $this->School_model->get('id = '.$id);
		
		$data['main_content'] = 'edit_school';
		$this->load->view('includes/template', $data);
	}else{
			$data['main_content'] = 'admin_login';
			$this->load->view('includes/template', $data);
		}
	}
	
	function update_school($id) {
	$this->load->library('session');
		$loged = $this->session->userdata('yusdhds');
		if($loged == "lgd5657383"){
			$signedin = TRUE;
		}else{
			$signedin = FALSE;
		}
		
		if($signedin){
	$data = array(
				'name' => $this->input->post('name'),
				'about' => $this->input->post('about'),
				'ext' => $this->input->post('ext')
            );
	
	$this->load->model('School_model');
	$this->School_model->update($data, $id);
	
	$data = $this->School_model->get_all();
	$this->buildSchools($data);
	
	redirect('admin/schools');
	}else{
			$data['main_content'] = 'admin_login';
			$this->load->view('includes/template', $data);
		}
	}
	
	function schools($id = "none") {
	$this->load->library('session');
		$loged = $this->session->userdata('yusdhds');
		if($loged == "lgd5657383"){
			$signedin = TRUE;
		}else{
			$signedin = FALSE;
		}
		
		if($signedin){
	$this->load->model('School_model');
	
	if($id=='insert'){
		//perform insert
		$data = array(
				'name' => $this->input->post('name'),
				'about' => $this->input->post('about'),
				'ext' => $this->input->post('ext'),
				'date_c' => date("Y-m-d H:i:s")
            );
		$this->School_model->insert($data);
		
		$data = $this->School_model->get_all();
		$this->buildSchools($data);
		
		redirect('admin/schools');
	}
	
		
		//get all
		$data=array();
		
		if($query = $this->School_model->get_all()){
			$data['records'] = $query;
		}
	
		//load schools and list
	
		$data['main_content'] = 'admin_schools';
		$this->load->view('includes/template', $data);
	}else{
			$data['main_content'] = 'admin_login';
			$this->load->view('includes/template', $data);
		}
	}
	
	function approve($id) {
	$this->load->library('session');
		$loged = $this->session->userdata('yusdhds');
		if($loged == "lgd5657383"){
			$signedin = TRUE;
		}else{
			$signedin = FALSE;
		}
		
		if($signedin){
		//set id to approved
		$this->load->model('Request_model');
		$email = $this->Request_model->approve($id);
		//send email to this address with link to sign up!
		
		//generate signup link
		$this->load->library('encrypt');
		$hash = $this->encrypt->sha1($email);
		
		$url = base_url().'signup/seller/'.$hash;
		

		$this->load->library('email');
		$this->email->set_newline("\r\n");

		$this->email->from('collegecanvas.org@gmail.com');
		$this->email->to($email); 

		$this->email->subject('Welcome to College Canvas');
		$message = 'Hey there! 

Welcome to College Canvas. You have been approved to begin listing and selling items. Create your shop by following this link…

'.$url.'

Currently we are limiting the launch to the University of Georgia for sellers. (But anyone can purchase your art!) We will continue to expand to campuses across the country. College Canvas wants to support students throughout their education, and thus we will always be available for students at no charge. That means no listing fees, no commissions- just money in your pocket! 

Please email me at rebecca@collegecanvas.org if you have any questions about the site or if you would like to refer friends as initial sellers. 

Thank you,

Rebecca Bowden';

		$this->email->message($message);

		$this->email->send();
		
		
		$this->index();
		
	}else{
			$data['main_content'] = 'admin_login';
			$this->load->view('includes/template', $data);
		}
	}
	
	function deny($id) {
	$this->load->library('session');
		$loged = $this->session->userdata('yusdhds');
		if($loged == "lgd5657383"){
			$signedin = TRUE;
		}else{
			$signedin = FALSE;
		}
		
		if($signedin){
		$this->load->model('Request_model');
		$result = $this->Request_model->deny($id);
		
		
		//back to page
		$this->index();
		}else{
			$data['main_content'] = 'admin_login';
			$this->load->view('includes/template', $data);
		}
	
	}
}