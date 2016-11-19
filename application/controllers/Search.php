<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

	function __Construct() {
		parent::__Construct();
		$this->load->model('Messages_model'); // load model
	}

	//Displays the Search
	public function index() {
		$this->load->view('view_search');
	}
	
	//Gets value of search from get and displays messages
	public function doSearch() {
		$data['posts'] = $this->Messages_model->searchMessages($this->input->get('query'));
		$this->load->view('view_viewmessages',$data);
	}
}