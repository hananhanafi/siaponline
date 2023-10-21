<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengguna extends CI_Model {

	public function select_all_pengguna() {
		$sql = "SELECT * FROM tbl_user ";

		if ($this->session->userdata('id_role') == 3){
			
			$sql .= " WHERE tbl_user.id_desa = ".$this->session->userdata('id_desa')." AND tbl_user.id_wilayah = ".$this->session->userdata('id_wilayah');
		}
		if ($this->session->userdata('id_role') == 2){
			$sql .= " WHERE tbl_user.id_wilayah = ".$this->session->userdata('id_wilayah');
		}
		$sql .= " ORDER BY tbl_user.id_role ASC";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_all() {
		$sql = "SELECT tbl_user.id as id, tbl_user.first_name as first_name,tbl_user.phone as phone,
			tbl_user.username as username,tbl_user.email as email,tbl_wkecamatan.kode as nama_wilayah,tbl_wkecamatan.nama_kec as nama_kecamatan,tbl_wdesa.nama_desa as nama_desa,tbl_wrw.nama_rw as nama_rw,tbl_user.id_rt as nama_rt,
			tbl_user.created_on as created_on,tbl_user.last_login as last_login,tbl_user.active as active, tbl_user.id_role as id_role, tbl_role.name as nama_role
			FROM tbl_user 
			LEFT JOIN tbl_role ON tbl_user.id_role = tbl_role.id
			LEFT JOIN tbl_wkecamatan ON tbl_user.id_kecamatan = tbl_wkecamatan.id_kec
			LEFT JOIN tbl_wdesa ON tbl_user.id_desa = tbl_wdesa.id_desa
			LEFT JOIN tbl_wrw ON tbl_user.id_rw = tbl_wrw.id_rw
			LEFT JOIN tbl_wrt ON tbl_user.id_rt = tbl_wrt.id_rt
			LEFT JOIN tbl_tps ON tbl_user.id_tps = tbl_tps.id
			WHERE TRUE";
		if ($this->session->userdata('id_role') == 3){
			
			$sql .= " AND tbl_user.id_desa = ".$this->session->userdata('id_desa')." AND tbl_user.id_wilayah = ".$this->session->userdata('id_wilayah');
		}
		if ($this->session->userdata('id_role') == 2){
			$sql .= " AND tbl_user.id_wilayah = ".$this->session->userdata('id_wilayah');
		}
		$sql .= " AND tbl_user.id_role != 1";
		$sql .= " ORDER BY tbl_user.id_role ASC";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_id($id) {
		$sql = "SELECT tbl_user.id as id, tbl_user.first_name as first_name,tbl_user.phone as phone,
			tbl_user.username as username,tbl_user.email as email,
			tbl_user.created_on as created_on,tbl_user.last_login as last_login,tbl_user.active as active, tbl_user.id_role as id_role, tbl_user.id_wilayah as id_wilayah, tbl_user.id_kecamatan as id_kecamatan, tbl_user.id_desa as id_desa, tbl_user.id_rw as id_rw, tbl_user.id_rt as id_rt 
			FROM tbl_user 
			WHERE tbl_user.id ='{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_all_role() {
		$sql = "SELECT * FROM tbl_role WHERE id <> 1 ORDER BY id ASC";

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_role() {
		$sql = "SELECT * FROM tbl_role ";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function update2($data) {
		$sql = "UPDATE tbl_user SET username='" .$data['username'] ."', phone='" .$data['phone'] ."', id_kota=" .$data['kota'] .", id_kelamin=" .$data['jk'] .", id_posisi=" .$data['posisi'] ." WHERE id='" .$data['id'] ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function update($data)
    {
        $this->db->where('id', $data['id']);
        $this->db->update('tbl_user', $data);

        return $this->db->affected_rows();
    }

	public function delete($id) {
		$sql = "DELETE FROM tbl_user WHERE id='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert2($data) {
		$id = md5(DATE('ymdhms').rand());
		$sql = "INSERT INTO tbl_user VALUES('',
											'" .$data['id_role'] ."',
											'" .$data['username'] ."',
											'" .$data['password'] ."',
											'" .$data['first_name'] ."',
											'" .$data['email'] ."',
											'" .$data['phone'] ."',
											'',
											'',
											'',
											'',
											'',
											'1'
											)";


		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert($data)
    {
        $this->db->insert('tbl_user', $data);
        return $this->db->affected_rows();
    }

	public function insert_batch($data) {
		$this->db->insert_batch('tbl_user', $data);
		
		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('username', $nama);
		$data = $this->db->get('username');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('tbl_user');

		return $data->num_rows();
	}
}

/* End of file M_pegawai.php */
/* Location: ./application/models/M_pegawai.php */