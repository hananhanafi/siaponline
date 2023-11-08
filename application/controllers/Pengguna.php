<?php

require_once(FCPATH.'vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_pengguna');
		$this->load->model('M_kecamatan');
		$this->load->model('M_rw');
		$this->load->model('M_rt');
		$this->load->model('M_tps');
		$this->load->model('M_kelurahan');
		$this->load->model('M_rekap');
	}

	public function index() {

		if (($this->session->userdata('id_role') == 1) || ($this->session->userdata('id_role') == 2) || ($this->session->userdata('id_role') == 3)) {
			$data['userdata'] = $this->userdata;
			$data['dataPengguna'] = $this->M_pengguna->select_all();
			$data['dataKecamatan'] = $this->M_kecamatan->select_all();
			$data['dataKelurahan'] = $this->M_kelurahan->select_all();
			$data['dataRW'] = $this->M_rw->select_all();
			$data['dataRT'] = $this->M_rt->select_all();
			$data['dataTps'] = $this->M_tps->select_all();
			$data['dataRole'] = $this->M_pengguna->select_all_role();
			$data['page'] = "pengguna";
			$data['judul'] = "Data Tim";
			$data['deskripsi'] = "Kelola Data Tim";

			$data['modal_tambah_pengguna'] = show_my_modal('modals/modal_tambah_pengguna', 'tambah-pengguna', $data);

			$this->template->views('pengguna/home', $data);
		} else {
			$data['userdata'] = $this->userdata;
			
			$data['page'] = "error";
			$data['judul'] = "Error 401";
			$data['deskripsi'] = "Unauthorized Access";

			$this->template->views('galat/home', $data);
		}
	}

	public function tampil() {
		$data['dataPengguna'] = $this->M_pengguna->select_all();
		$this->load->view('pengguna/list_data', $data);
	}

	public function prosesTambah() {
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('first_name', 'Nama Depan', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		//$data = $this->input->post();
		$data1 = array(
		'username' => $this->input->post('username',TRUE),
		'password' => md5($this->input->post('password',TRUE)),
		'first_name' => $this->input->post('first_name',TRUE),
		'id_role' => $this->input->post('id_role',TRUE),
		'email' => $this->input->post('email',TRUE),
		'phone' => $this->input->post('phone',TRUE),
		'id_desa' => $this->input->post('id_desa',TRUE),
		'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
		'id_rw' => $this->input->post('id_rw',TRUE),
		'id_rt' => $this->input->post('id_rt',TRUE),
	    );
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_pengguna->insert($data1);

			if ($result > 0) {

				$data2 = array(
					"id_user" => $this->db->insert_id(),
					"tps_target" => '-',
					"target" => 0
			    );
				$result2 = $this->M_rekap->insert($data2);

				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pengguna Berhasil ditambahkan', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_err_msg('Data Pengguna Gagal ditambahkan', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}

	public function update() {
		$id = trim($_POST['id']);

		$data['dataPengguna'] = $this->M_pengguna->select_by_id($id);
		$data['dataKecamatan'] = $this->M_kecamatan->select_all();
		$data['dataKelurahan'] = $this->M_kelurahan->select_all();
		$data['dataRW'] = $this->M_rw->select_all();
		$data['dataRT'] = $this->M_rt->select_all();
		$data['dataTps'] = $this->M_tps->select_all();
		$data['dataRole'] = $this->M_pengguna->select_all_role();
		$data['userdata'] = $this->userdata;

		echo show_my_modal('modals/modal_update_pengguna', 'update-pengguna', $data);
	}

	public function prosesUpdate() {
		$this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('first_name', 'Nama Depan', 'trim|required');


		//$data = $this->input->post();
		if ($this->input->post('password') == '') {
			$data1 = array(
			'id' => $this->input->post('id',TRUE),
			'username' => $this->input->post('username',TRUE),
			'first_name' => $this->input->post('first_name',TRUE),
			'id_role' => $this->input->post('id_role',TRUE),
			'email' => $this->input->post('email',TRUE),
			'phone' => $this->input->post('phone',TRUE),
			'id_desa' => $this->input->post('id_desa',TRUE),
    		'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
    		'id_rw' => $this->input->post('id_rw',TRUE),
    		'id_rt' => $this->input->post('id_rt',TRUE),
			'active' => $this->input->post('statuser',TRUE),
		    );
		} else {
			$data1 = array(
			'id' => $this->input->post('id',TRUE),
			'username' => $this->input->post('username',TRUE),
			'password' => md5($this->input->post('password',TRUE)),
			'first_name' => $this->input->post('first_name',TRUE),
			'id_role' => $this->input->post('id_role',TRUE),
			'email' => $this->input->post('email',TRUE),
			'phone' => $this->input->post('phone',TRUE),
			'id_desa' => $this->input->post('id_desa',TRUE),
    		'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
    		'id_rw' => $this->input->post('id_rw',TRUE),
			'id_rt' => $this->input->post('id_rt',TRUE),
			'active' => $this->input->post('statuser',TRUE),
		    );
		}
		if ($this->form_validation->run() == TRUE) {
			$result = $this->M_pengguna->update($data1);

			if ($result > 0) {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pengguna Berhasil diupdate', '20px');
			} else {
				$out['status'] = '';
				$out['msg'] = show_succ_msg('Data Pengguna Gagal diupdate', '20px');
			}
		} else {
			$out['status'] = 'form';
			$out['msg'] = show_err_msg(validation_errors());
		}

		echo json_encode($out);
	}


	public function ajax_delete($id)
	{
		$this->M_pengguna->delete($id);
		echo json_encode(array("status" => TRUE));
	}

	public function delete() {
		$id = $_POST['id'];
		$result = $this->M_pengguna->delete($id);

		if ($result > 0) {
			echo show_succ_msg('Data Pengguna Berhasil dihapus', '20px');
		} else {
			echo show_err_msg('Data Pengguna Gagal dihapus', '20px');
		}
	}

	public function export() {
		error_reporting(E_ALL);

		$data = $this->M_pengguna->select_all();

		$spreadsheet  = new Spreadsheet();
		$spreadsheet->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$spreadsheet->getActiveSheet()->SetCellValue('A'.$rowCount, "NAMA");
		$spreadsheet->getActiveSheet()->SetCellValue('B'.$rowCount, "UNIT WILAYAH");
		$spreadsheet->getActiveSheet()->SetCellValue('C'.$rowCount, "UNIT KECAMATAN");
		$spreadsheet->getActiveSheet()->SetCellValue('D'.$rowCount, "UNIT KELURAHAN");
		$spreadsheet->getActiveSheet()->SetCellValue('E'.$rowCount, "UNIT RW");
		$spreadsheet->getActiveSheet()->SetCellValue('F'.$rowCount, "UNIT RT");
		$spreadsheet->getActiveSheet()->SetCellValue('G'.$rowCount, "NOMOR HANDPHONE");
		$spreadsheet->getActiveSheet()->SetCellValue('H'.$rowCount, "PERAN");
		$spreadsheet->getActiveSheet()->SetCellValue('I'.$rowCount, "AKTIF?");
		$rowCount++;

		foreach($data as $value){
		    $spreadsheet->getActiveSheet()->SetCellValue('A'.$rowCount, $rowCount-1); 
		    $spreadsheet->getActiveSheet()->SetCellValue('B'.$rowCount, $value->first_name); 
		    $spreadsheet->getActiveSheet()->SetCellValue('C'.$rowCount, $value->nama_wilayah); 
			$spreadsheet->getActiveSheet()->SetCellValue('D'.$rowCount, $value->nama_kecamatan);
			$spreadsheet->getActiveSheet()->SetCellValue('E'.$rowCount, $value->nama_desa);
			$spreadsheet->getActiveSheet()->SetCellValue('F'.$rowCount, $value->nama_rw);
			$spreadsheet->getActiveSheet()->SetCellValue('G'.$rowCount, $value->nama_rt);
			$spreadsheet->getActiveSheet()->SetCellValue('H'.$rowCount, $value->phone);
			$spreadsheet->getActiveSheet()->SetCellValue('I'.$rowCount, $value->nama_role);		
			$spreadsheet->getActiveSheet()->SetCellValue('I'.$rowCount, $value->active);		    
			$rowCount++; 
		} 

		$writer = new Xlsx($spreadsheet);
		$filename = 'data_pengguna_all.xlsx';

		// header('Content-Type: application/vnd.ms-excel');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'. $filename ); 
		header('Cache-Control: max-age=0');
		$writer->save('php://output');

	}

}

/* End of file Pengguna.php */
/* Location: ./application/controllers/Pengguna.php */