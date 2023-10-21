<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_rekaphasil extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function select_by_group($group = null, $kec = null, $kel = null, $rw = null, $tps = null) {
		if ($group == "groupwilayah") {
			$this->db->select('COUNT(DISTINCT tbl_pemilih.id) as total, tbl_wilayah_pemilihan.nama as namawilayah');
			$this->db->from('tbl_wilayah_pemilihan');
			$this->db->join('tbl_pemilih','tbl_wilayah_pemilihan.id = tbl_pemilih.kd_wilayah', 'LEFT');
			$this->db->where('tbl_wilayah_pemilihan.nama IS NOT NULL');

			if ($kec) {
				$this->db->where('tbl_pemilih.kd_kecamatan', $kec);
			}
			if ($kel) {
				$this->db->where('tbl_pemilih.kd_kelurahan', $kel);
			}
			if ($rw) {
				$this->db->where('tbl_pemilih.kd_rw', $rw);
			}
			if ($tps) {
				$this->db->where('tbl_pemilih.kd_tps', $tps);
			}

			$this->db->group_by('tbl_wilayah_pemilihan.id');
		} else if ($group == "groupkecamatan") {
			$this->db->select('COUNT(DISTINCT tbl_pemilih.id) as total, tbl_wkecamatan.nama_kec as namakecamatan');
			$this->db->from('tbl_wkecamatan');
			$this->db->join('tbl_pemilih','tbl_wkecamatan.id_kec = tbl_pemilih.kd_kecamatan', 'LEFT');
			$this->db->where('tbl_wkecamatan.nama_kec IS NOT NULL');

			if ($kec) {
				$this->db->where('tbl_wkecamatan.id_kec', $kec);
			}
			$this->db->group_by('tbl_wkecamatan.id_kec');
		} else if ($group == "groupkelurahan") {
			$this->db->select('COUNT(DISTINCT tbl_pemilih.id) as total,tbl_wdesa.nama_desa as namakelurahan');
			$this->db->from('tbl_wdesa');
			$this->db->join('tbl_pemilih','tbl_wdesa.id_desa = tbl_pemilih.kd_kelurahan', 'LEFT');
			$this->db->where('tbl_wdesa.nama_desa IS NOT NULL');

			if ($kec) {
				$this->db->where('tbl_wdesa.id_kec', $kec);
			}
			if ($kel) {
				$this->db->where('tbl_wdesa.id_desa', $kel);
			}
			$this->db->group_by('tbl_wdesa.id_desa');
		} else if ($group == "grouprw") {
			$this->db->select('COUNT(DISTINCT tbl_pemilih.id) as total,tbl_wrw.nama_rw as namarw');
			$this->db->from('tbl_wrw');
			$this->db->join('tbl_pemilih','tbl_wrw.id_rw = tbl_pemilih.kd_rw', 'LEFT');
			$this->db->where('tbl_wrw.nama_rw IS NOT NULL');

			if ($kec) {
				$this->db->where('tbl_wrw.id_kec', $kec);
			}
			if ($kel) {
				$this->db->where('tbl_wrw.id_desa', $kel);
			}
			if ($rw) {
				$this->db->where('tbl_wrw.id_rw', $rw);
			}
			$this->db->group_by('tbl_wrw.id_rw');
		} else if ($group == "grouptps") {
			$this->db->select('COUNT(DISTINCT tbl_pemilih.id) as total,tbl_tps.nama_tps as namatps');
			$this->db->from('tbl_tps');
			$this->db->join('tbl_pemilih','tbl_tps.id = tbl_pemilih.kd_tps', 'LEFT');
			$this->db->where('tbl_tps.nama_tps IS NOT NULL');

			if ($kec) {
				$this->db->where('tbl_tps.id_kec', $kec);
			}
			if ($kel) {
				$this->db->where('tbl_tps.id_desa', $kel);
			}
			if ($rw) {
				$this->db->where('tbl_tps.id_rw', $rw);
			}
			if ($tps) {
				$this->db->where('tbl_tps.id', $tps);
			}
			$this->db->group_by('tbl_tps.id');
		}

		$data = $this->db->get();

		return $data->result();
	}

}

/* End of file M_rekaphasil.php */
/* Location: ./application/models/M_rekaphasil.php */