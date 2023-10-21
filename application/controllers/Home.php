<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_pemilih','pemilih');
		$this->load->model('M_slider','slider');
		$this->load->model('M_rekap','rekap');
	}

	public function index() {

		$jmlpemilih				= $this->pemilih->select_jml_pemilih();
		$jmlpemilihperrole		= $this->pemilih->select_jml_pemilih_per_role();
		$sliders				= $this->slider->select_aktif_slider();
		$target					= $this->rekap->gettarget_by_id($this->session->userdata('id'));

		$data['jmlpemilih']			= $jmlpemilih;
		$data['jmlpemilihperrole']	= $jmlpemilihperrole;
		$data['sliders']			= $sliders;
		$data['target']				= $target;
		$data['userdata'] 			= $this->userdata;
		$data['page'] 				= "Beranda";
		$data['judul'] 				= "Beranda";
		$data['deskripsi'] 			= "";
		$this->template->views('home', $data);
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */