<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Splash extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('splash');
	}
	
	public function add() {
	
		$this->load->library('form_validation');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|min_length[4]|max_length[255]');
		
		if($this->form_validation->run() == FALSE){
		
		
			$data['popup'] = '<h1 style="margin-left:17px; margin-bottom:-20px;">Oops!</h1><p>Please enter a valid email address. <a href="#" class="avgrund-close">Try again</a>?</p>';
			$this->load->view('splash', $data);
			
		}else{

			$this->load->model('Splash_model');
		
			$insert = $this->Splash_model->insert($this->input->post('email'));
			
			//load with result
			if($insert){
				$data['popup'] = '<p>Thanks for signing up! If you want to learn more about our project, head over to <a href="http://blog.collegecanvas.org">our blog</a>.</p>';
			}else{
				$data['popup'] = '<h1 style="margin-left:17px; margin-bottom:-20px;">Oops!</h1><p>Something went wrong! We are working on it!</p>';
			}
	
			$this->load->view('splash', $data);
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */