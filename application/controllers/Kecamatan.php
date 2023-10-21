<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(FCPATH.'vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Kecamatan extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_kecamatan','kecamatan');
	}

	public function index() {

		$this->load->helper('url');
		$this->load->helper('form');

		$data['userdata'] 		= $this->userdata;
		$data['page'] 			= "Data Dapil";
		$data['judul'] 			= "Data Dapil";
		$data['deskripsi'] 		= "Daftar Kecamatan di Dapil";
		$this->template->views('kecamatan/home', $data);
	}

	public function ajax_list()
	{
		$list = $this->kecamatan->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $kecamatan) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $kecamatan->kode;
			$row[] = $kecamatan->nama_kec;

				$row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_kecamatan('."'".$kecamatan->id_kec."'".')"><i class="glyphicon glyphicon-pencil"></i></a>';

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->kecamatan->count_all(),
						"recordsFiltered" => $this->kecamatan->count_filtered(),
						"data" => $data,
				);

				echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->kecamatan->get_by_id($id);

		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
				'kode' => $this->input->post('kode'),
				'nama_kec' => $this->input->post('nama_kec'),
			);
			
		$insert = $this->kecamatan->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'kode' => $this->input->post('kode'),
				'nama_kec' => $this->input->post('nama_kec'),
			);

		$this->kecamatan->update(array('id_kec' => $this->input->post('id_kec')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$person = $this->kecamatan->get_by_id($id);
		
		$this->kecamatan->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('kode') == '')
		{
			$data['inputerror'][] = 'kode';
			$data['error_string'][] = 'Kode Dapil tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_kec') == '')
		{
			$data['inputerror'][] = 'nama_kec';
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
		
		$data = $this->kecamatan->select_all();
		
		$spreadsheet  = new Spreadsheet();
		$spreadsheet->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$spreadsheet->getActiveSheet()->SetCellValue('A'.$rowCount, "NO");
		$spreadsheet->getActiveSheet()->SetCellValue('B'.$rowCount, "WILAYAH");
		$spreadsheet->getActiveSheet()->SetCellValue('C'.$rowCount, "KECAMATAN");
		$rowCount++;

		foreach($data as $value){
		    $spreadsheet->getActiveSheet()->SetCellValue('A'.$rowCount, $rowCount-1); 
		    $spreadsheet->getActiveSheet()->SetCellValue('B'.$rowCount, $value->kode); 
		    $spreadsheet->getActiveSheet()->SetCellValue('C'.$rowCount, $value->nama_kec); 
		    $rowCount++; 
		} 

		$writer = new Xlsx($spreadsheet);
		$filename = 'data_kecamatan_'.date('YmdHis').'_all.xlsx';
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'. $filename ); 
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}


	
}

/* End of file Penyelenggara.php */
/* Location: ./application/controllers/Penyelenggara.php */