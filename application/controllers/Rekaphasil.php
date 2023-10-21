<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekaphasil extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_rekaphasil','rekaphasil');
		$this->load->model('M_kecamatan','kecamatan');
		$this->load->model('M_kelurahan','kelurahan');
		$this->load->model('M_rw','rw');
		$this->load->model('M_tps','tps');
	}

	public function index() {

		$this->load->helper('url');
		$this->load->helper('form');



		$data['kecamatan']   	= $this->kecamatan->select_all();
		$data['desa']   		= $this->kelurahan->select_all();
		$data['rw']   			= $this->rw->select_all();
		$data['tps']   			= $this->tps->select_all();

		$data['userdata'] 		= $this->userdata;
		$data['page'] 			= "Rekap Hasil";
		$data['judul'] 			= "Rekapitulasi";
		$data['deskripsi'] 		= "Rekapitulasi Hasil Pemilihan";
		
		$this->template->views('rekaphasil/home', $data);
	}



	public function get_chart() {


		$rekapbygroup = $this->rekaphasil->select_by_group($this->input->post('group'), $this->input->post('filter_id_kec'), $this->input->post('filter_id_kel'), $this->input->post('filter_id_rw'), $this->input->post('filter_id_tps'));
		foreach ($rekapbygroup as $rekap) {
			if ($this->input->post('group') == "groupwilayah") {
				$data['label'][] = $rekap->namawilayah;
			} else if ($this->input->post('group') == "groupkecamatan") {
				$data['label'][] = $rekap->namakecamatan;
			} else if ($this->input->post('group') == "groupkelurahan") {
				$data['label'][] = $rekap->namakelurahan;
			} else if ($this->input->post('group') == "grouprw") {
				$data['label'][] = $rekap->namarw;
			} else if ($this->input->post('group') == "grouptps") {
				$data['label'][] = $rekap->namatps;
			}
			$data['data'][] = $rekap->total;
		}

		echo json_encode($data);
		
	}

	
}

/* End of file Rekaphasil.php */
/* Location: ./application/controllers/Rekaphasil.php */