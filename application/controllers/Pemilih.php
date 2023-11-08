<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pemilih extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_pemilih','pemilih');
		$this->load->model('M_desa','desa');
		$this->load->model('M_kelurahan','kelurahan');
		$this->load->model('M_kecamatan','kecamatan');
		$this->load->model('M_rw','rw');
		$this->load->model('M_rt','rt');
		
		$this->load->helper('url', 'form');
	}

	public function index() {


		$kecamatan = $this->kecamatan->get_list_kecamatan();
		$optkec = array('' => '-- Pilih Kecamatan --');
		foreach ($kecamatan as $kec =>$val) {
			$optkec[$kec] = $val;
		}


		$kelurahan = $this->kelurahan->get_list_kelurahan();
		$opt1 = array('' => '-- Pilih Kelurahan --');

		$rw = $this->rw->get_list_rw();
		$optrw = array('' => '-- Pilih RW --');

		$rt = $this->rt->get_list_rt();
		$optrt = array('' => '-- Pilih RT --');

		if ($this->session->userdata('id_kecamatan')) {
			$data['form_kec'] 		= form_dropdown('',$optkec,array("0" => $this->session->userdata('id_kecamatan')),'id="nama_kec" name="nama_kec" class="form-control" disabled');
		} else {
			$data['form_kec'] 		= form_dropdown('',$optkec,'','id="nama_kec" name="nama_kec" class="form-control"');
		}
		
		if ($this->session->userdata('id_desa')) {
			$data['form_kel'] 		= form_dropdown('',$opt1,array("0" => $this->session->userdata('id_desa')),'id="nama_kel" name="nama_kel" class="form-control" disabled');
		} else {
			$data['form_kel'] 		= form_dropdown('',$opt1,'','id="nama_kel" name="nama_kel" class="form-control"');
		}
		
		
		
		if ($this->session->userdata('id_rw')) {
			$data['form_rw'] 		= form_dropdown('',$optrw,array("0" => $this->session->userdata('id_rw')),'id="nama_rw" name="nama_rw" class="form-control" disabled');
		} else {
			$data['form_rw'] 		= form_dropdown('',$optrw,'','id="nama_rw" name="nama_rw" class="form-control"');
		}
		
		
		if ($this->session->userdata('id_rt')) {
			$data['form_rt'] 		= form_dropdown('',$optrt,array("0" => $this->session->userdata('id_rt')),'id="nama_rt" name="nama_rt" class="form-control" disabled');
		} else {
			$data['form_rt'] 		= form_dropdown('',$optrt,'','id="nama_rt" name="nama_rt" class="form-control"');
		}

		$data['userdata'] 		= $this->userdata;
		
		$data['page'] 			= "Calon Pemilih";
		$data['judul'] 			= "Calon Pemilih";
		$data['deskripsi'] 		= "Calon Pemilih Caleg ";

		$this->template->views('pemilih/home', $data);
	}

	public function ajax_list()
	{
		$this->load->helper('url');

		$list = $this->pemilih->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pemilih) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $pemilih->nama;
			$row[] = $pemilih->nik;
			$row[] = $pemilih->alamat;
			$row[] = $pemilih->no_hp;
			$row[] = $pemilih->wilayah;
			$row[] = $pemilih->kecamatan;
			$row[] = $pemilih->kelurahan;
			$row[] = $pemilih->rw;
			$row[] = $pemilih->rt;
			$row[] = $pemilih->tps;
			$row[] = $pemilih->first_name;

			$row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_pemilih('."'".$pemilih->id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;<a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Edit" onclick="delete_pemilih('."'".$pemilih->id."'".')"><i class="glyphicon glyphicon-trash"></i></a>';		    
	  		
			$data[] = $row;

		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->pemilih->count_all(),
						"recordsFiltered" => $this->pemilih->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->pemilih->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		date_default_timezone_set("Asia/Jakarta");
		$data = array(
				'nama' => $this->input->post('nama'),
				'nik' => $this->input->post('nik'),
				'alamat' => $this->input->post('alamat'),
				'no_hp' => $this->input->post('no_handphone'),
				'kd_kecamatan' => $this->input->post('nama_kec'),
				'kd_kelurahan' => $this->input->post('nama_kel'),
				'kd_rw' => $this->input->post('nama_rw'),
				'kd_rt' => $this->input->post('nama_rt'),
				'kd_tps' => $this->input->post('nama_tps'),
				'kd_ketua_tim' => $this->session->userdata('id'),
				'tanggal' => date("Y-m-d H:i:s")
				
			);

		$insert = $this->pemilih->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		date_default_timezone_set("Asia/Jakarta");
		$data = array(
				'nama' => $this->input->post('nama'),
				'nik' => $this->input->post('nik'),
				'alamat' => $this->input->post('alamat'),
				'no_hp' => $this->input->post('no_handphone'),
				'kd_kecamatan' => $this->input->post('nama_kec'),
				'kd_kelurahan' => $this->input->post('nama_kel'),
				'kd_rw' => $this->input->post('nama_rw'),
				'kd_rt' => $this->input->post('nama_rt'),
				'kd_tps' => $this->input->post('nama_tps'),
				'kd_ketua_tim' => $this->session->userdata('id'),
				'tanggal' => date("Y-m-d H:i:s")
			);


		$this->pemilih->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		//delete file
		// $calon = $this->pemilih->get_by_id($id);
		
		$this->pemilih->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	public function ajax_all_delete()
	{
		
		$this->pemilih->delete_all();
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload()
	{
		$nmft1 = preg_replace("/[^a-zA-Z]/", "_", $this->input->post('nama'));
		$nmft2 = $this->session->userdata('thn_data');
		$nmft3 = $this->input->post('kddesa');
		$nmft4 = $this->input->post('nourut');
	
		$config['upload_path']          = 'upload/';
        $config['allowed_types']        = 'gif|jpg|png|bmp';
        $config['max_size']             = 2048; 
		$config['overwrite']			= true;
    
		$config['file_name']            = strtoupper($nmft1).'-'.$nmft2.'_'.$nmft3.'_'.$nmft4;

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('photo')) 
        {
            $data['inputerror'][] = 'photo';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); 
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		
		$gbr = $this->upload->data();
		$this->_create_thumbs($gbr['file_name']);

		return $this->upload->data('file_name');
	}

	function _create_thumbs($file_name){
 
		$config = array(

            array(
                'image_library' => 'GD2',
                'source_image'  => 'upload/'.$file_name,
                'maintain_ratio'=> FALSE,
                'width'         => 300,
                'height'        => 400,
                'new_image'     => 'upload/medium/'.$file_name
                ),
    
            array(
                'image_library' => 'GD2',
                'source_image'  => 'upload/'.$file_name,
                'maintain_ratio'=> FALSE,
                'width'         => 90,
                'height'        => 120,
                'new_image'     => 'upload/small/'.$file_name
            ));
 
        $this->load->library('image_lib', $config[0]);
        foreach ($config as $item){
            $this->image_lib->initialize($item);
            if(!$this->image_lib->resize()){
                return false;
            }
            $this->image_lib->clear();
        }
    }

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama_kec') == '')
		{
			$data['inputerror'][] = 'nama_kec';
			$data['error_string'][] = 'Kecamatan tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_kel') == '')
		{
			$data['inputerror'][] = 'nama_kel';
			$data['error_string'][] = 'Kelurahan tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_rw') == '')
		{
			$data['inputerror'][] = 'nama_rw';
			$data['error_string'][] = 'RW tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_rt') == '')
		{
			$data['inputerror'][] = 'nama_rt';
			$data['error_string'][] = 'RT tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama_tps') == '')
		{
			$data['inputerror'][] = 'nama_tps';
			$data['error_string'][] = 'TPS tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nama') == '')
		{
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('nik') == '')
		{
			$data['inputerror'][] = 'nik';
			$data['error_string'][] = 'NIK tidak boleh kosong';
			$data['status'] = FALSE;
		} else if(strlen($this->input->post('nik')) > 16 )
		{
			$data['inputerror'][] = 'nik';
			$data['error_string'][] = 'NIK tidak valid, Nik harus 16 digit';
			$data['status'] = FALSE;
		} else if(strlen($this->input->post('nik')) < 16 )
		{
			$data['inputerror'][] = 'nik';
			$data['error_string'][] = 'NIK tidak valid, Nik harus 16 digit';
			$data['status'] = FALSE;
		} else {

			if ($this->input->post('id') == '') {
				$datanik = $this->pemilih->check_nik($this->input->post('nik'));
				
				if($datanik > 0)
				{
					$data['inputerror'][] = 'nik';
					$data['error_string'][] = 'NIK Sudah Terdaftar';
					$data['status'] = FALSE;
				}
			} else {
				$datawas = $this->pemilih->get_by_id($this->input->post('id'));
				if ($datawas->nik != $this->input->post('nik')) {
					$datanik = $this->pemilih->check_nik($this->input->post('nik'));
					
					if($datanik > 0)
					{
						$data['inputerror'][] = 'nik';
						$data['error_string'][] = 'NIK Sudah Terdaftar';
						$data['status'] = FALSE;
					}
				}
			}

		}

		if($this->input->post('no_handphone') == '')
		{
			$data['inputerror'][] = 'no_handphone';
			$data['error_string'][] = 'No Handphone tidak boleh kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('alamat') == '')
		{
			$data['inputerror'][] = 'alamat';
			$data['error_string'][] = 'Alamat tidak boleh kosong';
			$data['status'] = FALSE;
		}


		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	public function export() {
	
		$data = $this->pemilih->get_data_export();
		
		$spreadsheet  = new Spreadsheet();
		$spreadsheet->setActiveSheetIndex(0); 
		$rowCount = 1; 

		$spreadsheet->getActiveSheet()->SetCellValue('A'.$rowCount, "NO");
		$spreadsheet->getActiveSheet()->SetCellValue('B'.$rowCount, "NAMA");
		$spreadsheet->getActiveSheet()->SetCellValue('C'.$rowCount, "NIK");
		$spreadsheet->getActiveSheet()->SetCellValue('E'.$rowCount, "ALAMAT");
		$spreadsheet->getActiveSheet()->SetCellValue('D'.$rowCount, "NO. HP");
		$spreadsheet->getActiveSheet()->SetCellValue('F'.$rowCount, "WILAYAH");
		$spreadsheet->getActiveSheet()->SetCellValue('G'.$rowCount, "KECAMATAN");
		$spreadsheet->getActiveSheet()->SetCellValue('H'.$rowCount, "KELURAHAN");
		$spreadsheet->getActiveSheet()->SetCellValue('I'.$rowCount, "RW");
		$spreadsheet->getActiveSheet()->SetCellValue('J'.$rowCount, "RT");
		$spreadsheet->getActiveSheet()->SetCellValue('K'.$rowCount, "TIM");
		$spreadsheet->getActiveSheet()->SetCellValue('L'.$rowCount, "TANGGAL");

		$rowCount++;

		foreach($data as $value){
		    $spreadsheet->getActiveSheet()->SetCellValue('A'.$rowCount, $rowCount-1); 
		    $spreadsheet->getActiveSheet()->SetCellValue('B'.$rowCount, $value->nama); 
		    $spreadsheet->getActiveSheet()->SetCellValue('C'.$rowCount, $value->nik); 
		    $spreadsheet->getActiveSheet()->SetCellValue('E'.$rowCount, $value->alamat); 
		    $spreadsheet->getActiveSheet()->SetCellValue('D'.$rowCount, $value->no_hp); 
		    $spreadsheet->getActiveSheet()->SetCellValue('F'.$rowCount, $value->wilayah); 
		    $spreadsheet->getActiveSheet()->SetCellValue('G'.$rowCount, $value->kecamatan); 
		    $spreadsheet->getActiveSheet()->SetCellValue('H'.$rowCount, $value->kelurahan); 
		    $spreadsheet->getActiveSheet()->SetCellValue('I'.$rowCount, $value->rw); 
		    $spreadsheet->getActiveSheet()->SetCellValue('J'.$rowCount, $value->rt); 
		    $spreadsheet->getActiveSheet()->SetCellValue('K'.$rowCount, $value->first_name); 
		    $spreadsheet->getActiveSheet()->SetCellValue('L'.$rowCount, $value->tanggal); 
		    $rowCount++; 
		} 

		$writer = new Xlsx($spreadsheet);

		$filename = 'data_calon_pemilih_'.date('YmdHis').'.xlsx';
		
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'. $filename ); 
		header('Cache-Control: max-age=0');
		$writer->save('php://output');

	}

	function add_ajax_desa($id_kec){
	    $query = $this->db->get_where('tbl_wdesa',array('kecamatan_id'=>$id_kec));
	    
	    foreach ($query->result() as $value) {
	        $data .= "<option value='".$value->id_desa."'>".$value->nama_desa."</option>";
	    }
	    echo $data;
	}

	public function ajax_get_kelurahan($id)
	{
		$data = $this->kelurahan->get_by_kecamatan($id);

		echo json_encode($data);
	}


	public function ajax_getall_kelurahan()
	{
		$data = $this->kelurahan->get_all_kelurahan();;

		echo json_encode($data);
	}

	public function ajax_get_rw($id)
	{
		$data = $this->rw->get_by_kelurahan($id);

		echo json_encode($data);
	}


	public function ajax_getall_rw()
	{
		$data = $this->rw->get_all_rw();

		echo json_encode($data);
	}

	public function ajax_get_rt($id)
	{
		$data = $this->rt->get_by_rw($id);

		echo json_encode($data);
	}


	public function ajax_getall_rt()
	{
		$data = $this->rt->get_all_rt();

		echo json_encode($data);
	}

	public function ajax_get_tps($id)
	{
		$data = $this->tps->get_by_rt($id);

		echo json_encode($data);
	}


	public function ajax_getall_tps()
	{
		$data = $this->tps->get_all_tps();

		echo json_encode($data);
	}
	
}

/* End of file Calon.php */
/* Location: ./application/controllers/Calon.php */