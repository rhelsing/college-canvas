<?php

class Spark extends CI_Controller {

	function __construct() {
	
		parent::__construct();
	}
	
	function index() {
	
	$this->load->spark('wideimage/11.02.19');
	$this->wideimage->load(base_url().'images/banner17.png')->resize(500, 500, 'outside')->saveToFile('images/thumb.jpg');
		
	}
}