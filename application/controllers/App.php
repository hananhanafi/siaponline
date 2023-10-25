<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_auth');
		$this->load->model('M_profilecaleg', 'profilecaleg');
	}
	
	public function index() {
		$session = $this->session->userdata('status');
		$data['profile'] = $this->profilecaleg->select_all();
		$this->load->view('landingpage/index', $data);
	}
}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */