<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Message extends CI_Controller {

	function __Construct() {
		parent::__Construct();
		$this->load->helper('url');
	}

	// If user is not logged in, redirect to login
	public function index() {
		if(!$this->session->userdata("username"))
			redirect('user/login', 'refresh');
		$this->load->view('view_post');
	}
	
	//Adds post via post to database and redirects to users view
	public function doPost() {
		$this->load->model('Messages_model');
		$this->Messages_model->insertMessage($this->session->userdata("username"), $this->input->post('post'));
		redirect('/user/view/'.$this->session->userdata("username"), 'refresh');
	}
}