<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Rekap extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_rekap','rekap');
	}

	public function index() {

		$this->load->helper('url');
		$this->load->helper('form');


		$rekapsatu = $this->rekap->select_detail();
		$data['rekapsatu'] 		= $rekapsatu;

		$data['userdata'] 		= $this->userdata;
		$data['page'] 			= "Target Pencapaian";
		$data['judul'] 			= "Target Pencapaian";
		$data['deskripsi'] 		= "Target Pencapaian";
		
		$this->template->views('rekap/home', $data);
	}

	public function detailkec($kec) {

		$rekapkec = $this->rekap->select_detail_kec($kec);
		$data['rekapkec'] 		= $rekapkec;

		$nama_kec = $this->rekap->getkec_by_kode($kec);
		$data['nama_kec']		= $nama_kec->nama_kec;

		$data['userdata'] 		= $this->userdata;
		$data['page'] 			= "Rekapitulasi";
		$data['judul'] 			= "Rekapitulasi";
		$data['deskripsi'] 		= "Rekapitulasi Hasil Pemilihan Kepala Desa";

		$this->template->views('rekap/detailkec', $data);
	}

	public function detaildesa($desa) {

		$rekapdesa = $this->rekap->select_detail_desa($desa);
		$data['rekapdesa'] 		= $rekapdesa;

		$nama_desa= $this->rekap->getdesa_by_kode($desa);
		$data['nama_desa']		= $nama_desa->nama_desa;

		$data['userdata'] 		= $this->userdata;
		$data['page'] 			= "Rekapitulasi";
		$data['judul'] 			= "Rekapitulasi";
		$data['deskripsi'] 		= "Rekapitulasi Hasil Pemilihan Kepala Desa";

		$this->template->views('rekap/detaildesa', $data);
	}

	public function ajax_list()
	{
		$this->load->helper('url');

		$list = $this->rekap->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $rekap) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $rekap->nama;
			$row[] = $rekap->peran;
			$row[] = $rekap->kecamatan;
			$row[] = $rekap->kelurahan;
			$row[] = $rekap->rw;
			$row[] = $rekap->rt;
			$row[] = $rekap->tps_target;
			$row[] = $rekap->SUARA."/".$rekap->TARGET;
			$row[] = ($rekap->SUARA>0?($rekap->TARGET>0?strval( round(intval($rekap->SUARA) / intval($rekap->TARGET) )*100 )."%": "0%") : "0%");
            if($this->session->userdata('id_role') == 1){
				$row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_target('."'".$rekap->id_target."'".')"><i class="glyphicon glyphicon-pencil"></i></a>';
			}
			$data[] = $row;

		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->rekap->count_all(),
			"recordsFiltered" => $this->rekap->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	
	public function ajax_edit($id)
	{
		$data = $this->rekap->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_update()
	{
		$data = array(
			'target' => $this->input->post('target'),
			'tps_target' => $this->input->post('tps_target')
		);


		$this->rekap->update(array('id_target' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}
}

/* End of file Rekap.php */
/* Location: ./application/controllers/Rekap.php */