<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

	function __Construct() {
		parent::__Construct();
		$this->load->helper('url'); // Allows Redirect
	}
	
	//Gets name, gets posts from that user and if you follow them, loads
	//viewmessages view with this information
	public function view($name = "") {
		$this->load->model('Messages_model'); // load models
		$this->load->model('Users_model');
		$data['posts'] = $this->Messages_model->getMessagesByPoster($name);
		if($this->session->userdata("username")) {
			$data['following'] = $this->Users_model->isFollowing($this->session->userdata("username"), $name);
		}
		$this->load->view('view_viewmessages',$data);
	}
	
	//Loads login view
	public function login() {
		$this->load->view('view_login');
	}
	
	//Attempts login, if successful redirect to their messages and set session
	//Else reload login with error message
	public function dologin() {
		$this->load->model('Users_model');
		$username = $_POST['username'];
		if($this->Users_model->checkLogin($username, sha1($_POST['password']))) {
			$this->session->set_userdata("username",$username); // Initializing session
			redirect('user/view/'.$username, 'refresh'); // Redirect
		} else {
			$data['attempted'] = true;
			$this->load->view('view_login', $data);
		}
	}
	// Remove session variable and redirect to login page
	public function logout() {
		if($this->session->userdata("username"))
			$this->session->unset_userdata('username');
		redirect('user/login', 'refresh');
	}
	// Gets all messages from everyone $name follows and displays in viewmessages
	public function feed($name) {
		$this->load->model('Messages_model');
		$data['posts'] = $this->Messages_model->getFollowedMessages($name);
		$data['following'] = true;
		$this->load->view('view_viewmessages',$data);
	}
	
	// Adds a row to the User_Follows table with the currently logged in user
	// following $name
	public function follow($name) {
		$this->load->model('Users_model');
		$this->Users_model->follow($name);
		redirect('user/view/'.$name, 'refresh'); // Redirect
	}
}