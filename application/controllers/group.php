<?php

class Group extends CI_Controller {

	function __construct() {
	
		parent::__construct();
	}
	
	function index() {
		//show groups apart of and admin if nec
		
		//get id from session
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
		
			//get all groups associated with this user, show admin ones at top
			$this->load->model('Group_members_model');
			$this->load->model('Group_model');
			$groups = $this->Group_members_model->get_all("user_id = ".$id);

			$array = array();
			foreach($groups as $key => $value){
				//get name and put in array with id
				$obj = $this->Group_model->get("id = ".$value->group_id);
				//add obj to array
				$array[] = $obj;
			}
			$data['groups'] = $array;
			
			
			$data['user_id'] = $id;
		
			$data['signedin']="1";
			$data['main_content'] = 'group_home';
			$this->load->view('includes/template', $data);
		
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
		
	}
	
	function create() {
	
		//session verify
		
		//create group page
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
		
			//get all groups associated with this user, show admin ones at top
		
			$data['signedin']="1";
			$data['main_content'] = 'group_create';
			$this->load->view('includes/template', $data);
		
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
	
	}
	
	function createSave() {
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
		
		
			$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[56]|xss_clean');//required, length
			$this->form_validation->set_rules('about', 'About', 'trim|required|min_length[5]|xss_clean');//required length
			//validate
			if ($this->form_validation->run()==FALSE){
				//show create page
				$data['signedin']="1";
				$data['main_content'] = 'group_create';
				$data['error'] = validation_errors();
				$this->load->view('includes/template', $data);
			}else{
				$this->load->model('Group_members_model');
				$this->load->model('Group_model');
				//process all inputs and save in group
				$data = array(
					'name' => $this->input->post('name'),
					'about' => $this->input->post('about'),
					'admin_id' => $id
				);
				$obj = $this->Group_model->insert($data);
            
				//get most recent id
            
            
				$data = array(
					'group_id' => $obj->id,
					'user_id' => $id,
					'role' => 1
				);
				$this->Group_members_model->insert($data);
            
				//handle images!!!
				$this->Group_model->do_upload($obj->id);
		
				redirect('group');
			}
			
		
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
	
	}
	
	function edit($g_id) {
	
		$this->db->where('id',$g_id);
		$query = $this->db->get('groups');	
		if($query->num_rows() == 0){//does not exist
			redirect('pagenotfound');
		}
	
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		//same as create, only preload content
		if($id){
			$this->load->model('Group_model');
			$group = $this->Group_model->get("id = ".$g_id);
			
			if($group->admin_id != $id){
				redirect('pagenotfound');
			}
			
			foreach($group as $field=>$value){
				$data[$field]=$value;
			}
		
			$data['signedin']="1";
			$data['main_content'] = 'group_edit';
			$this->load->view('includes/template', $data);
		
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
	
	}
	
	function editSave($g_id) {
	$this->db->where('id',$g_id);
		$query = $this->db->get('groups');	
		if($query->num_rows() == 0){//does not exist
			redirect('pagenotfound');
		}
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
		
		
			$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[56]|xss_clean');//required, length
			$this->form_validation->set_rules('about', 'About', 'trim|required|min_length[5]|xss_clean');//required length
			//validate
			if ($this->form_validation->run()==FALSE){
				//load with content
				$this->load->model('Group_model');
				$group = $this->Group_model->get("id = ".$g_id);
				foreach($group as $field=>$value){
					$data[$field]=$value;
					}
		
					$data['signedin']="1";
					$data['main_content'] = 'group_edit';
					$data['error'] = validation_errors();
					$this->load->view('includes/template', $data);
			}else{
				$this->load->model('Group_model');
				//process all inputs and save in group
				$data = array(
					'name' => $this->input->post('name'),
					'about' => $this->input->post('about'),
					'admin_id' => $id
				);
				$obj = $this->Group_model->update($data, $g_id);
            
				$this->Group_model->do_upload($g_id);
            
            
				if($this->input->post('remove')=="on"){
	         	   //delete current banner
	         	   unlink("images/groupBanner".$g_id.".jpg");
	         	   unlink("images/groupBannerSmall".$g_id.".jpg");
	         	 }
            
	         	 //handle images!!!
	         	 //do_upload
		
	         	 redirect('group');
			}
		
		
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
	}
	
	function delete($g_id) {
	
		//session verify
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		//same as create, only preload content
		if($id){
			$this->load->model('Group_model');
			$this->load->model('Group_members_model');
			$group = $this->Group_model->get("id = ".$g_id);
			
			if($group->admin_id != $id){
				redirect('group');
			}
			
			//delete all members
			$this->Group_members_model->deleteMembers($g_id);
			//delete group and items and members
			$this->Group_model->delete($g_id);
			
			redirect('group');
		
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
		
	
	}
	
	function manageMembers($g_id) {
	
		$this->db->where('id',$g_id);
		$query = $this->db->get('groups');	
		if($query->num_rows() == 0){//does not exist
			redirect('pagenotfound');
		}
		
		//if invite post then show
		
		//show all members and add new ones
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		//same as create, only preload content
		if($id){
			$this->load->model('Group_model');
			$this->load->model('Group_members_model');
			$this->load->model('User_model');
			$group = $this->Group_model->get("id = ".$g_id);
			
			//make sure in group
			if(!$this->Group_members_model->isMemberInGroup($id, $g_id)){
				redirect('pagenotfound');
			}
			
			if($group->admin_id != $id){
				redirect('pagenotfound');
			}
			
			
			//get all members
			$members = $this->Group_members_model->get_all("group_id = ".$g_id);
			
			//make new array with emails.
			$array = array();
			foreach($members as $key => $value){
				//get name and put in array with id
				$obj = $this->User_model->getAlt("id = ".$value->user_id);
				//add obj to array
				$array[] = $obj;
			}
			$data['members'] = $array;
			
			$data['name'] = $group->name;
			$data['id'] = $id;
			$data['g_id'] = $g_id;
			
		
			$data['signedin']="1";
			$data['main_content'] = 'group_members';
			$this->load->view('includes/template', $data);
		
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}

	}
	
	function addMemberSave() {
		//add user to group
		$g_id = $this->input->post('g_id');
		$this->db->where('id',$g_id);
		$query = $this->db->get('groups');	
		if($query->num_rows() == 0){//does not exist
			redirect('pagenotfound');
		}
		$email = $this->input->post('email');
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|xss_clean');//required length
		//validate
		if ($this->form_validation->run()==FALSE){
			$this->load->model('Group_model');
			$this->load->model('Group_members_model');
			$this->load->model('User_model');
			$group = $this->Group_model->get("id = ".$g_id);
			if($group->admin_id != $id){
				redirect('group');
			}
			$members = $this->Group_members_model->get_all("group_id = ".$g_id);
			
			//make new array with emails.
			$array = array();
			foreach($members as $key => $value){
				//get name and put in array with id
				$obj = $this->User_model->getAlt("id = ".$value->user_id);
				//add obj to array
				$array[] = $obj;
			}
			$data['members'] = $array;
			$data['error'] = validation_errors();
			$data['name'] = $group->name;
			$data['id'] = $id;
			$data['g_id'] = $g_id;
			
		
			$data['signedin']="1";
			$data['main_content'] = 'group_members';
			$this->load->view('includes/template', $data);
		}else{
			$this->load->model('User_model');
			//get id of email address
			if($u_id = $this->User_model->getidfromE($email)){
			
				$user = $this->User_model->getAlt("id = ".$u_id);
			
				if($user->type != 1){
					//not a seller
					redirect('group/manageMembers/'.$g_id);
				}
			
				$this->load->model('Group_model');
				$group = $this->Group_model->get("id = ".$g_id);
				if($u_id == $group->admin_id){
					//admin trying to add himself
					redirect('group/manageMembers/'.$g_id);
				}
			
				//if member already on list, dont add again.
			
				$this->load->model('Group_members_model');
				$data = array(
					'group_id' => $g_id,
					'user_id' => $u_id,
					'role' => 0
				);
				$this->Group_members_model->insert($data);
				//SEND EMAIL TO NEW MEMBER
		
				//insert in group members table
		
				redirect('group/manageMembers/'.$g_id);	
				
			}else{
				$this->load->model('Group_model');
				$this->load->model('Group_members_model');
				$this->load->model('User_model');
				$group = $this->Group_model->get("id = ".$g_id);
				if($group->admin_id != $id){
				redirect('group');
			}
			$members = $this->Group_members_model->get_all("group_id = ".$g_id);
			
			//make new array with emails.
				$array = array();
				foreach($members as $key => $value){
				//get name and put in array with id
				$obj = $this->User_model->getAlt("id = ".$value->user_id);
				//add obj to array
				$array[] = $obj;
			}
				$data['members'] = $array;
				$data['error'] = "The email you entered is not registered with College Canvas.";
				$data['name'] = $group->name;
				$data['id'] = $id;
				$data['g_id'] = $g_id;
			
		
				$data['signedin']="1";
				$data['main_content'] = 'group_members';
				$this->load->view('includes/template', $data);
			}
		
		}
	}
	
	function removeMember($u_id, $g_id) {
		//remove user from group
		//only if has admin rights of this group
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		//same as create, only preload content
		if($id){
			
			$this->load->model('Group_model');
			$group = $this->Group_model->get("id = ".$g_id);
			
			if($group->admin_id != $id){
				redirect('group');
			}
			
			//delete user $u_id
			$this->load->model('Group_members_model');
			$this->Group_members_model->delete($u_id);
			redirect('group/manageMembers/'.$g_id);
			
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
	
	}
	
	function transferAdmin($m_id, $g_id) {
	
		//only admin can call
		
		//swap member with admin
		
		//email of admin is paypal and contact email
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		//same as create, only preload content
		if($id){
			
			$this->load->model('Group_model');
			$group = $this->Group_model->get("id = ".$g_id);
			
			if($group->admin_id != $id){
				redirect('group');
			}
			$this->load->model('Group_members_model');
			//modify records and notify new admin
			
			//update admin
			$data = array(
				'role' => 0
            );
            $this->Group_members_model->update($data, $id);
            
			
			//update member
			$data = array(
				'role' => 1
            );
            $this->Group_members_model->update($data, $m_id);
			
			//update group
			$data = array(
				'admin_id' => $m_id
            );
            $this->Group_model->update($data, $g_id);
			
			redirect('group');
			
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
	
	}
	
	function page($g_id) {
	
		$this->db->where('id',$g_id);
		$query = $this->db->get('groups');	
		if($query->num_rows() == 0){//does not exist
			redirect('pagenotfound');
		}
		$this->load->model('Group_members_model');
		$this->load->model('User_model');
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		//same as create, only preload content
		$data['username']="";
		$data['belongs'] = false;
		if($id){
			$data['signedin']="1";
			if($this->Group_members_model->isMemberInGroup($id, $g_id)){
				$data['belongs'] = true;
			}
			$data['username'] = $this->User_model->getUsername($id);
			
		}
		
		//load members into array
		$members = array();
			//load array of user id's for group //store id as key and name as value
		$m = $this->Group_members_model->get_all("group_id = ".$g_id);
		foreach($m as $u){
			$user = $this->User_model->getUser($u->user_id);
			array_push($members, $user);
		}
		$data['members']= $members;
		//load item
		$this->load->model('Item_model');
		$data['items'] = $this->Item_model->getItemsGroup($g_id);
		//get info for page from db and show like profile
		$this->load->model('Group_model');
		$group = $this->Group_model->get("id = ".$g_id);
		foreach($group as $field=>$value){
				$data[$field]=$value;
		}
		$data['main_content'] = 'group_page';
		$this->load->view('includes/template', $data);
		
	}
	
	function addItem($g_id) {
	
		//add item for group
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
			$this->load->model('Group_members_model');
			//make sure can add item for group
			if($this->Group_members_model->isMemberInGroup($id, $g_id)){
				$data['id']=$g_id;
				$data['signedin']="1";
				$data['main_content'] = 'group_add_item';
				$this->load->view('includes/template', $data);
			}else{
				redirect('group/page/'.$g_id);
			}
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
	
	}
	
	function editItem($g_id, $item_id) {
	
		$this->db->where('id',$item_id);
		$query = $this->db->get('items');	
		if($query->num_rows() == 0){//does not exist
			redirect('pagenotfound');
		}
	
		//add item for group
		$this->load->library('session');
		$id = $this->session->userdata('user_id');
		
		if($id){
			$this->load->model('Group_members_model');
			//make sure can add item for group
			if($this->Group_members_model->isMemberInGroup($id, $g_id)){
			
				
				
				$this->load->model('Item_model');
				$data = $this->Item_model->getItem($item_id);
				
				if($data['seller_or_group'] != 1){
					redirect('pagenotfound');
				}
				
				$data['g_id']=$g_id;
				$data['signedin']="1";
				$data['main_content'] = 'group_edit_item';
				$this->load->view('includes/template', $data);
			}else{
				redirect('group/page/'.$g_id);
			}
		}else{
			$data['error'] = "You need to be signed in to do that.";
			$data['main_content'] = 'signin';
			$this->load->view('includes/template', $data);
		}
	
	}
}