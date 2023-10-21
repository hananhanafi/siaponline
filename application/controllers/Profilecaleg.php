<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profilecaleg extends AUTH_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('M_profilecaleg', 'profilecaleg');
		$this->load->model('M_admin');
	}

	public function index() {
		$data['userdata'] 		= $this->userdata;
		
		$data['page'] 			= "Profile Caleg";
		$data['judul'] 			= "Profile Caleg";
		$data['deskripsi'] 		= "Setting Profile Caleg";
		$data['profile'] = $this->profilecaleg->select_data();
		$this->template->views('profilecaleg/home', $data);
	}

	public function list_prestasi()
	{
		$list = $this->profilecaleg->get_datatables_prestasi();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $profilecaleg) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $profilecaleg->value;
			$row[] = '
			    <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_prestasi('."'".$profilecaleg->id_profile."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->profilecaleg->count_all_prestasi(),
						"recordsFiltered" => $this->profilecaleg->count_filtered_prestasi(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function delete_prestasi($id)
	{
		//delete file
		$person = $this->profilecaleg->get_by_id($id);
		
		$this->profilecaleg->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	public function delete_program($id)
	{
		//delete file
		$person = $this->profilecaleg->get_by_id($id);
		
		$this->profilecaleg->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	public function update_profile()
	{

		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		
		$this->load->library('upload', $config);
		
		if (!$this->upload->do_upload('photo')){
			$error = array('error' => $this->upload->display_errors());
		}
		else{
			$data_foto = $this->upload->data();
			$foto = array();
			$foto['photo'] = $data_foto['file_name'];
			$databanner = array(
					'value' => $foto['photo'],
				);
			$this->profilecaleg->update(array('id_profile' => $this->input->post('id_banner')), $databanner);
		}

		$config['upload_path'] = './assets/img/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('photobg')){
			$error = array('error' => $this->upload->display_errors());
		}
		else{
			$data_foto_bg = $this->upload->data();
			$fotobg = array();
			$fotobg['photobg'] = $data_foto_bg['file_name'];
			$databg = array(
					'value' => $fotobg['photobg'],
				);
			$this->profilecaleg->update(array('id_profile' => $this->input->post('id_background')), $databg);
		}

		$data = array(
				'value' => $this->input->post('profil_value'),
			);
		$this->profilecaleg->update(array('id_profile' => $this->input->post('id_profil')), $data);
		


		$data['userdata'] 		= $this->userdata;
		
		$data['page'] 			= "Profile Caleg";
		$data['judul'] 			= "Profile Caleg";
		$data['deskripsi'] 		= "Setting Profile Caleg";
		$data['profile'] = $this->profilecaleg->select_data();
		$this->template->views('profilecaleg/home', $data);
		
	}

	public function update_visimisi()
	{
		$data = array(
				'value' => $this->input->post('profil_visi'),
			);

		$this->profilecaleg->update(array('id_profile' => $this->input->post('id_visi')), $data);

		$data = array(
				'value' => $this->input->post('profil_misi'),
			);

		$this->profilecaleg->update(array('id_profile' => $this->input->post('id_misi')), $data);
		
		$data['userdata'] 		= $this->userdata;
		
		$data['page'] 			= "Profile Caleg";
		$data['judul'] 			= "Profile Caleg";
		$data['deskripsi'] 		= "Setting Profile Caleg";
		$data['profile'] = $this->profilecaleg->select_data();
		$this->template->views('profilecaleg/home', $data);
	}


	public function update_pendidikan()
	{
		$data = array(
				'value' => $this->input->post('profil_education'),
			);

		$this->profilecaleg->update(array('id_profile' => $this->input->post('id_pendidikan')), $data);

		$data['userdata'] 		= $this->userdata;
		
		$data['page'] 			= "Profile Caleg";
		$data['judul'] 			= "Profile Caleg";
		$data['deskripsi'] 		= "Setting Profile Caleg";
		$data['profile'] = $this->profilecaleg->select_data();
		$this->template->views('profilecaleg/home', $data);
	}

	public function update_prestasi()
	{
		$data = array(
				'tipe' => $this->input->post('tipe'),
				'value' => $this->input->post('prestasi_value'),
			);

		$this->profilecaleg->save($data);

		$data['userdata'] 		= $this->userdata;
		
		$data['page'] 			= "Profile Caleg";
		$data['judul'] 			= "Profile Caleg";
		$data['deskripsi'] 		= "Setting Profile Caleg";
		$data['profile'] = $this->profilecaleg->select_data();
		$this->template->views('profilecaleg/home', $data);
	}

	public function update_program()
	{
		$data = array(
				'tipe' => $this->input->post('tipe'),
				'value' => $this->input->post('program_value'),
			);

		$this->profilecaleg->save($data);

		$data['userdata'] 		= $this->userdata;
		
		$data['page'] 			= "Profile Caleg";
		$data['judul'] 			= "Profile Caleg";
		$data['deskripsi'] 		= "Setting Profile Caleg";
		$data['profile'] = $this->profilecaleg->select_data();
		$this->template->views('profilecaleg/home', $data);
	}

	public function list_program()
	{
		$list = $this->profilecaleg->get_datatables_program();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $profilecaleg) {
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $profilecaleg->value;
			$row[] = '
			    <a class="btn btn-xs btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_program('."'".$profilecaleg->id_profile."'".')"><i class="glyphicon glyphicon-trash"></i></a>';
			

			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->profilecaleg->count_all_program(),
						"recordsFiltered" => $this->profilecaleg->count_filtered_program(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
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