<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(FCPATH.'vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Kelurahan extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_kelurahan','kelurahan');
	}

	public function index() {

		$this->load->helper('url');
		$this->load->helper('form');


		$data['kecamatan'] 		= $this->kelurahan->getKec();
		$data['userdata'] 		= $this->userdata;
		$data['page'] 			= "Data Kecamatan";
		$data['judul'] 			= "Data Kecamatan";
		$data['deskripsi'] 		= "Daftar Kelurahan di Kecamatan";
		$this->template->views('kelurahan/home', $data);
	}

	public function ajax_list()
	{
		$list = $this->kelurahan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kelurahan) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kelurahan->kode;
			$row[] = $kelurahan->nama_kec;
			$row[] = $kelurahan->nama_desa;

			$row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_kelurahan('."'".$kelurahan->id_desa."'".')"><i class="glyphicon glyphicon-pencil"></i></a>';
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->kelurahan->count_all(),
			"recordsFiltered" => $this->kelurahan->count_filtered(),
			"data" => $data,
		);

		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->kelurahan->get_by_id($id);

		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
			'id_kec' => $this->input->post('id_kec'),
			'nama_desa' => $this->input->post('nama_desa'),
		);

		$insert = $this->kelurahan->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			'id_kec' => $this->input->post('id_kec'),
			'nama_desa' => $this->input->post('nama_desa'),
		);

		$this->kelurahan->update(array('id_desa' => $this->input->post('id_desa')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$person = $this->kelurahan->get_by_id($id);
		
		$this->kelurahan->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('id_kec') == '')
		{
			$data['inputerror'][] = 'id_kec';
			$data['error_string'][] = 'Kecamatan tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_desa') == '')
		{
			$data['inputerror'][] = 'nama_desa';
			$data['error_string'][] = 'Nama Kelurahan tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	public function export() {

		$data = $this->kelurahan->select_export();
		
		$spreadsheet  = new Spreadsheet();
		$spreadsheet->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$spreadsheet->getActiveSheet()->SetCellValue('A'.$rowCount, "NO");
		$spreadsheet->getActiveSheet()->SetCellValue('B'.$rowCount, "WILAYAH");
		$spreadsheet->getActiveSheet()->SetCellValue('C'.$rowCount, "KECAMATAN");
		$spreadsheet->getActiveSheet()->SetCellValue('D'.$rowCount, "KELURAHAN");
		$rowCount++;

		foreach($data as $value){
		    $spreadsheet->getActiveSheet()->SetCellValue('A'.$rowCount, $rowCount-1); 
		    $spreadsheet->getActiveSheet()->SetCellValue('B'.$rowCount, $value->kode); 
		    $spreadsheet->getActiveSheet()->SetCellValue('C'.$rowCount, $value->nama_kec); 
		    $spreadsheet->getActiveSheet()->SetCellValue('D'.$rowCount, $value->nama_desa); 
		    $rowCount++; 
		} 

		$writer = new Xlsx($spreadsheet);
		$filename = 'data_kelurahan_'.date('YmdHis').'_all.xlsx';
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'. $filename ); 
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

	
}

/* End of file Penyelenggara.php */
/* Location: ./application/controllers/Penyelenggara.php */