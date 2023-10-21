<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Slider extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_slider','slider');
	}

	public function index() {
		$data['userdata'] 		= $this->userdata;
		
		$data['page'] 			= "Foto Beranda";
		$data['judul'] 			= "Foto Beranda";
		$data['deskripsi'] 		= "Pengaturan Foto Beranda";
		$this->template->views('slider/home', $data);
	}

	public function ajax_list()
	{
		$list = $this->slider->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $slider) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $slider->nama_slider;
			$row[] = $slider->path_slider;
			$row[] = ($slider->status?"Aktif":"Tidak Aktif");

			$row[] = '<a class="btn btn-xs btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_slider('."'".$slider->id_slider."'".')"><i class="glyphicon glyphicon-pencil"></i></a>
			    <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_slider('."'".$slider->id_slider."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
		

			$data[] = $row;
		}

		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->slider->count_all(),
				"recordsFiltered" => $this->slider->count_filtered(),
				"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	public function ajax_add(){
		$input = array();
		$data = $this->input->post();
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		
		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload('path_foto')){
			$error = array('error' => $this->upload->display_errors());
		}
		else{
			$data_foto = $this->upload->data();
			$input['path_slider'] = $data_foto['file_name'];
		}
		$input['nama_slider'] = $data['nama_foto'];
		$input['status'] = $data['status'];

		$insert = $this->slider->save($input);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{

		$input = array();
		$data = $this->input->post();
		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'jpg|png';
		
		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload('path_foto')){
			$error = array('error' => $this->upload->display_errors());
		}
		else{
			$data_foto = $this->upload->data();
			
			$input['path_slider'] = $data_foto['file_name'];
		}
		$input['nama_slider'] = $data['nama_foto'];
		$input['status'] = $data['status'];



		$this->slider->update(array('id_slider' => $this->input->post('id_slider')), $input);
		echo json_encode(array("status" => TRUE));
	}

	public function update() {
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|max_length[25]');
		$this->form_validation->set_rules('first_name', 'Nama', 'trim|required');

		$id = $this->session->userdata('id');

		$data = $this->input->post();
		if ($this->form_validation->run() == TRUE) {
			$config['upload_path'] = './assets/img/';
			$config['allowed_types'] = 'jpg|png';
			
			$this->load->library('upload', $config);
			
			if (!$this->upload->do_upload('photo')){
				$error = array('error' => $this->upload->display_errors());
			}
			else{
				$data_foto = $this->upload->data();
				$data['photo'] = $data_foto['file_name'];
			}

			$result = $this->M_admin->update($data, $id);
			if ($result > 0) {
				$this->updateProfil();
				$this->session->set_flashdata('msg', show_succ_msg('<b style="font-size: 20px">BERHASIL</b><br>Data Profile Berhasil diubah'));
				redirect('Profile');
			} else {
				$this->session->set_flashdata('msg', show_err_msg('<b style="font-size: 20px">GAGAL</b><br>Data Profile Gagal diubah'));
				redirect('Profile');
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('Profile');
		}
	}


	public function ajax_edit($id)
	{
		$data = $this->slider->get_by_id($id);

		echo json_encode($data);
	}

	public function ajax_delete($id)
	{
		//delete file
		$slider = $this->slider->get_by_id($id);
		
		$this->slider->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}


	public function ubah_password() {
		$this->form_validation->set_rules('passLama', 'Password Lama', 'trim|required');
		$this->form_validation->set_rules('passBaru', 'Password Baru', 'trim|required');
		$this->form_validation->set_rules('passKonf', 'Password Konfirmasi', 'trim|required');

		$id = $this->session->userdata('id');
		if ($this->form_validation->run() == TRUE) {
			if (md5($this->input->post('passLama')) == $this->session->userdata('password')) {
				if ($this->input->post('passBaru') != $this->input->post('passKonf')) {
					$this->session->set_flashdata('msg', show_err_msg('<b style="font-size: 20px">GAGAL</b><br>Password Baru dan Konfirmasi Password harus sama'));
					redirect('Profile');
				} else {
					$data = [
						'password' => md5($this->input->post('passBaru'))
					];

					$result = $this->M_admin->update($data, $id);
					if ($result > 0) {
						$this->updateProfil();
						$this->session->set_flashdata('msg', show_succ_msg('<b style="font-size: 20px">BERHASIL</b><br>Password Berhasil diubah'));
						redirect('Profile');
					} else {
						$this->session->set_flashdata('msg', show_err_msg('<b style="font-size: 20px">GAGAL</b><br>Password Gagal diubah'));
						redirect('Profile');
					}
				}
			} else {
				$this->session->set_flashdata('msg', show_err_msg('<b style="font-size: 20px">GAGAL</b><br>Password Salah'));
				redirect('Profile');
			}
		} else {
			$this->session->set_flashdata('msg', show_err_msg(validation_errors()));
			redirect('Profile');
		}
	}

}

/* End of file Profile.php */
/* Location: ./application/controllers/Profile.php */