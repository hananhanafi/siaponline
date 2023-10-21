<?php

defined('BASEPATH') OR exit('No direct script access allowed');


require_once(FCPATH.'vendor/autoload.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Saksi extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_saksi','saksi');
		$this->load->model('M_desa','desa');
		$this->load->model('M_kelurahan','kelurahan');
		$this->load->model('M_kecamatan','kecamatan');
		$this->load->model('M_rw','rw');
		
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
		foreach ($kelurahan as $kel => $vals) {
			$opt1[$kel] = $vals;
		}

		$rw = $this->rw->get_list_rw();
		$optrw = array('' => '-- Pilih RW --');
		foreach ($rw as $r => $vals) {
			$optrw[$r] = $vals;
		}


		if ($this->session->userdata('id_kec')) {
			$data['form_kec'] 		= form_dropdown('',$optkec,array("0" => $this->session->userdata('id_kec')),'id="nama_kec" name="nama_kec" class="form-control" disabled');
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

		$data['userdata'] 		= $this->userdata;
		
		$data['page'] 			= "Saksi";
		$data['judul'] 			= "Daftar Saksi";
		$data['deskripsi'] 		= "Data Saksi ";

		$this->template->views('saksi/home', $data);
	}

	public function ajax_list()
	{
		$this->load->helper('url');

		$list = $this->saksi->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $saksi) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $saksi->nama;
			$row[] = $saksi->nik;
			$row[] = $saksi->alamat;
			$row[] = $saksi->no_hp;
			$row[] = $saksi->wilayah;
			$row[] = $saksi->kecamatan;
			$row[] = $saksi->kelurahan;
			$row[] = $saksi->rw;
			$row[] = $saksi->rt;
			$row[] = $saksi->first_name;


			$row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_saksi('."'".$saksi->id."'".')"><i class="glyphicon glyphicon-pencil"></i></a>';
		    
	  		
			$data[] = $row;

		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->saksi->count_all(),
						"recordsFiltered" => $this->saksi->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->saksi->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
				'nama' => $this->input->post('nama'),
				'nik' => $this->input->post('nik'),
				'alamat' => $this->input->post('alamat'),
				'no_hp' => $this->input->post('no_handphone'),
				// 'kd_wilayah' => $this->input->post('nama_wil'),
				'kd_kecamatan' => $this->input->post('nama_kec'),
				'kd_kelurahan' => $this->input->post('nama_kel'),
				'kd_rw' => $this->input->post('nama_rw'),
				'kd_rt' => $this->input->post('nama_rt'),
				// 'kd_tps' => $this->input->post('nama_tps'),
				'kd_ketua_tim' => $this->session->userdata('id')
				
			);

		$insert = $this->saksi->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'nama' => $this->input->post('nama'),
				'nik' => $this->input->post('nik'),
				'alamat' => $this->input->post('alamat'),
				'no_hp' => $this->input->post('no_handphone'),
				// 'kd_wilayah' => $this->input->post('nama_wil'),
				'kd_kecamatan' => $this->input->post('nama_kec'),
				'kd_kelurahan' => $this->input->post('nama_kel'),
				'kd_rw' => $this->input->post('nama_rw'),
				'kd_rt' => $this->input->post('nama_rt'),
				// 'kd_tps' => $this->input->post('nama_tps'),
				'kd_ketua_tim' => $this->session->userdata('id')
			);


		$this->saksi->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		//delete file
		$calon = $this->saksi->get_by_id($id);
		
		$this->saksi->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload()
	{
		$nmft1 = preg_replace("/[^a-zA-Z]/", "_", $this->input->post('nama'));
		$nmft2 = $this->session->userdata('thn_data');
		$nmft3 = $this->input->post('kddesa');
		$nmft4 = $this->input->post('nourut');
		//$nmft5 = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

		$config['upload_path']          = 'upload/';
        $config['allowed_types']        = 'gif|jpg|png|bmp';
        $config['max_size']             = 2048; //set max size allowed in Kilobyte
		$config['overwrite']			= true;
        //$config['encrypt_name'] 		  = true; //enkripsi nama file
        //$config['max_width']            = 1000; // set max width image allowed
        //$config['max_height']           = 1000; // set max height allowed
        //$config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name
        //$config['file_name']            = strtoupper($nmft1).'-'.$nmft2.'_'.$nmft3.'_'.$nmft4.'_'.$nmft5;
		$config['file_name']            = strtoupper($nmft1).'-'.$nmft2.'_'.$nmft3.'_'.$nmft4;

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		
		// begin marker
		$gbr = $this->upload->data();
		$this->_create_thumbs($gbr['file_name']);
		//end marker

		return $this->upload->data('file_name');
	}

	function _create_thumbs($file_name){
        // Image resizing config
        $config = array(
            // Image Large
            //array(
            //    'image_library' => 'GD2',
            //    'source_image'  => 'upload/'.$file_name,
            //    'maintain_ratio'=> FALSE,
            //    'width'         => 600,
            //    'height'        => 800,
            //    'new_image'     => 'upload/large/'.$file_name
            //    ),
            // image Medium
            array(
                'image_library' => 'GD2',
                'source_image'  => 'upload/'.$file_name,
                'maintain_ratio'=> FALSE,
                'width'         => 300,
                'height'        => 400,
                'new_image'     => 'upload/medium/'.$file_name
                ),
            // Image Small
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

		// if($this->input->post('nama_tps') == '')
		// {
		// 	$data['inputerror'][] = 'nama_tps';
		// 	$data['error_string'][] = 'TPS tidak boleh kosong';
		// 	$data['status'] = FALSE;
		// }

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
	
		// error_reporting(E_ALL);

		$data = $this->saksi->get_data_export();
		
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
		    $rowCount++; 
		} 

		$writer = new Xlsx($spreadsheet);

		$filename = 'data_saksi_'.date('YmdHis').'.xlsx';
		
		//header('Content-Type: application/vnd.ms-excel');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'. $filename ); 
		header('Cache-Control: max-age=0');
		$writer->save('php://output');

	}

	function add_ajax_desa($id_kec){
	    $query = $this->db->get_where('tbl_wdesa',array('kecamatan_id'=>$id_kec));
	    //$data = "<option value=''> - Pilih Desa - </option>";
	    
	    foreach ($query->result() as $value) {
	        $data .= "<option value='".$value->id_desa."'>".$value->nama_desa."</option>";
	    }
	    echo $data;
	}
	
}

/* End of file Calon.php */
/* Location: ./application/controllers/Calon.php */