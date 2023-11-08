<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(FCPATH.'vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RW extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_kecamatan','kecamatan');
		$this->load->model('M_kelurahan','kelurahan');
		$this->load->model('M_rw','rw');
	}

	public function index() {

		$this->load->helper('url');
		$this->load->helper('form');


		$data['kecamatan'] 		= $this->rw->getKec();
		$data['desa']   		= $this->rw->getKel();
		$data['rw']   			= $this->rw->select_by_wil();
		$data['userdata'] 		= $this->userdata;
		$data['page'] 			= "Data Kelurahan";
		$data['judul'] 			= "Data Kelurahan";
		$data['deskripsi'] 		= "Daftar RW di Kelurahan";
		$this->template->views('rw/home', $data);
	}

	public function ajax_list()
	{
		$list = $this->rw->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $rw) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $rw->kode;
			$row[] = $rw->nama_kec;
			$row[] = $rw->nama_desa;
			$row[] = $rw->nama_rw;

			$row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_rw('."'".$rw->id_rw."'".')"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;<a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Edit" onclick="delete_per_rw('."'".$rw->id_rw."'".')"><i class="glyphicon glyphicon-trash"></i></a>';

			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->rw->count_all(),
			"recordsFiltered" => $this->rw->count_filtered(),
			"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->rw->get_by_id($id);

		echo json_encode($data);
	}

	public function ajax_get_kelurahan($id)
	{
		$data = $this->kelurahan->get_by_kecamatan($id);

		echo json_encode($data);
	}


	public function ajax_getall_kelurahan()
	{
		$data = $this->rw->getKel();

		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
			'id_kec' => $this->input->post('id_kec'),
			'id_desa' => $this->input->post('id_desa'),
			'nama_rw' => $this->input->post('nama_rw'),
		);

		$insert = $this->rw->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
			'id_kec' => $this->input->post('id_kec'),
			'id_desa' => $this->input->post('id_desa'),
			'nama_rw' => $this->input->post('nama_rw'),
		);

		$this->rw->update(array('id_rw' => $this->input->post('id_rw')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_deleteById($id)
	{
		$this->rw->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	public function ajax_delete($id)
	{
		$person = $this->rw->get_by_id($id);
		
		$this->rw->delete_by_id($id);
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

		if($this->input->post('id_desa') == '')
		{
			$data['inputerror'][] = 'id_desa';
			$data['error_string'][] = 'Kelurahan tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_rw') == '')
		{
			$data['inputerror'][] = 'nama_desa';
			$data['error_string'][] = 'RW tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}


	public function export() {

		$data = $this->rw->select_export();
		
		$spreadsheet  = new Spreadsheet();
		$spreadsheet->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$spreadsheet->getActiveSheet()->SetCellValue('A'.$rowCount, "NO");
		$spreadsheet->getActiveSheet()->SetCellValue('B'.$rowCount, "WILAYAH");
		$spreadsheet->getActiveSheet()->SetCellValue('C'.$rowCount, "KECAMATAN");
		$spreadsheet->getActiveSheet()->SetCellValue('D'.$rowCount, "KELURAHAN");
		$spreadsheet->getActiveSheet()->SetCellValue('E'.$rowCount, "RW");
		$rowCount++;

		foreach($data as $value){
		    $spreadsheet->getActiveSheet()->SetCellValue('A'.$rowCount, $rowCount-1); 
		    $spreadsheet->getActiveSheet()->SetCellValue('B'.$rowCount, $value->kode); 
		    $spreadsheet->getActiveSheet()->SetCellValue('C'.$rowCount, $value->nama_kec); 
		    $spreadsheet->getActiveSheet()->SetCellValue('D'.$rowCount, $value->nama_desa); 
		    $spreadsheet->getActiveSheet()->SetCellValue('E'.$rowCount, $value->nama_rw); 
		    $rowCount++; 
		} 

		$writer = new Xlsx($spreadsheet);
		$filename = 'data_rw_'.date('YmdHis').'_all.xlsx';
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'. $filename ); 
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

	
}

/* End of file Penyelenggara.php */
/* Location: ./application/controllers/Penyelenggara.php */