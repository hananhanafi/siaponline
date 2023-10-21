<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_rekap extends CI_Model {

	var $table = 'tbl_target';
	var $column_order = array(null,'b.first_name','c.name','e.nama_kec','f.nama_desa','g.nama_rw','b.id_rw',null,null); //set column field database for datatable orderable
	var $column_search = array('b.first_name','c.name','e.nama_kec','f.nama_desa','g.nama_rw','b.id_rw'); //set column field database for datatable searchable 
	var $order = array('c.id, b.id' => 'asc'); // default order 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	private function _get_datatables_query()
	{
		$this->db->select('tbl_target.id_target, b.first_name as nama, c.name as peran, e.nama_kec as kecamatan, f.nama_desa as kelurahan, g.nama_rw as rw, b.id_rt as rt, tbl_target.tps_target, COUNT(DISTINCT d.id) as SUARA, tbl_target.target as TARGET');

		$this->db->join('tbl_user AS b','tbl_target.id_user = b.id', 'left');
		$this->db->join('tbl_role AS c','b.id_role = c.id', 'left');
		$this->db->join('tbl_pemilih AS d','b.id = d.kd_ketua_tim', 'left');
		$this->db->join('tbl_wkecamatan AS e','b.id_kecamatan = e.id_kec', 'left');
		$this->db->join('tbl_wdesa AS f','b.id_desa = f.id_desa', 'left');
		$this->db->join('tbl_wrw AS g','b.id_rw = g.id_rw', 'left');

		
		
		$this->db->where_not_in('b.id_role', array("0" => "1"));
		

		$this->db->from($this->table);
		$this->db->group_by('id_target');

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function gettarget_by_id($id)
	{
		$this->db->select('tbl_target.target');
		$this->db->from('tbl_target');
		$this->db->where('id_user',$id);

		$query = $this->db->get();
		return $query->row();
	}

	public function getkec_by_kode($kode)
	{
		$this->db->select('*');
		$this->db->from('tbl_wkecamatan');
		$this->db->where('id_kec',$kode);

		$query = $this->db->get();

		return $query->row();
	}

	public function getdesa_by_kode($kode)
	{
		$this->db->select('*');
		$this->db->from('tbl_wdesa');
		$this->db->where('id_desa',$kode);

		$query = $this->db->get();

		return $query->row();
	}

	public function select_detail() {

		$sql = "SELECT a.nama_desa as nama_desa, d.nama_kec as nama_kecamatan, COUNT(DISTINCT c.id) as SUARA ";
		$sql = $sql." FROM tbl_wdesa AS a ";
		$sql = $sql." LEFT JOIN tbl_pemilih AS c ON a.id_desa = c.kd_kelurahan ";
		$sql = $sql." LEFT JOIN tbl_wkecamatan AS d ON a.id_kec = d.id_kec ";
		$sql = $sql." GROUP BY a.id_desa ";
		
		$data = $this->db->query($sql);

		return $data->result();
	}


	public function select_detail_kec($kc) {
		if ($this->session->userdata('id_role') == 3){

			$sql = "SELECT a.kdkec,a.kddesa,c.nama_desa,a.suratsuara, ";
			$sql = $sql."	(SELECT SUM(dpt_l) FROM tbl_desa_penyelenggara AS a WHERE a.thn_pemilihan = '". $this->session->userdata('thn_data')."' AND a.kdkec = c.kode_wilayah AND a.kddesa = c.id_desa) AS DPTL, ";
			$sql = $sql."	(SELECT SUM(dpt_p) FROM tbl_desa_penyelenggara AS a WHERE a.thn_pemilihan = '". $this->session->userdata('thn_data')."' AND a.kdkec = c.kode_wilayah AND a.kddesa = c.id_desa) AS DPTP, ";
			$sql = $sql."	(SELECT SUM(s_hasil) FROM tbl_calon AS b WHERE b.thn_pemilihan = '". $this->session->userdata('thn_data')."' AND b.kdkec = c.kode_wilayah AND b.kddesa = a.kddesa) AS SUARA ";
			$sql = $sql."	FROM tbl_desa_penyelenggara AS a ";
			$sql = $sql."LEFT JOIN tbl_wdesa AS c ON c.id_desa = a.kddesa ";
			$sql = $sql."WHERE a.thn_pemilihan = '". $this->session->userdata('thn_data')."' ";
			$sql = $sql."AND a.kdkec LIKE '". $kc."' ";
		} else {

		$sql = "SELECT a.kdkec,a.kddesa,c.nama_desa,a.suratsuara, ";
			$sql = $sql."	(SELECT SUM(dpt_l) FROM tbl_desa_penyelenggara AS a WHERE a.thn_pemilihan = '". $this->session->userdata('thn_data')."' AND a.kdkec = c.kode_wilayah AND a.kddesa = c.id_desa) AS DPTL, ";
			$sql = $sql."	(SELECT SUM(dpt_p) FROM tbl_desa_penyelenggara AS a WHERE a.thn_pemilihan = '". $this->session->userdata('thn_data')."' AND a.kdkec = c.kode_wilayah AND a.kddesa = c.id_desa) AS DPTP, ";
			$sql = $sql."	(SELECT SUM(s_hasil) FROM tbl_calon AS b WHERE b.thn_pemilihan = '". $this->session->userdata('thn_data')."' AND b.kdkec = c.kode_wilayah AND b.kddesa = a.kddesa) AS SUARA ";
			$sql = $sql."	FROM tbl_desa_penyelenggara AS a ";
			$sql = $sql."LEFT JOIN tbl_wdesa AS c ON c.id_desa = a.kddesa ";
			$sql = $sql."WHERE a.thn_pemilihan = '". $this->session->userdata('thn_data')."' ";
			$sql = $sql."AND a.kdkec LIKE '". $kc."' ";
		}

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_detail_desa($ds) {

			$sql = "SELECT a.kdkec,a.kddesa,a.nama,a.nourut,a.s_hasil,(b.dpt_l + b.dpt_p) AS jml_pemilih, ";
			$sql = $sql."(SELECT SUM(s_hasil) FROM tbl_calon WHERE a.thn_pemilihan = '". $this->session->userdata('thn_data')."' AND tbl_calon.kddesa LIKE b.kddesa) AS totalsuaramasuk ";
			$sql = $sql."FROM tbl_calon AS a ";
			$sql = $sql."LEFT JOIN tbl_desa_penyelenggara AS b ON b.kddesa = a.kddesa ";
			$sql = $sql."WHERE a.thn_pemilihan = '". $this->session->userdata('thn_data')."' ";
			$sql = $sql."AND a.kddesa LIKE '". $ds."' ";
			$sql = $sql."ORDER BY a.nourut ASC";

		$data = $this->db->query($sql);

		return $data->result();
	}


	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->join("tbl_user","tbl_target.id_user = tbl_user.id","LEFT");
		$this->db->join("tbl_role","tbl_user.id_role = tbl_role.id","LEFT");
		$this->db->join("tbl_wkecamatan","tbl_user.id_kecamatan = tbl_wkecamatan.id_kec","LEFT");
		$this->db->join("tbl_wdesa","tbl_user.id_desa = tbl_wdesa.id_desa","LEFT");
		$this->db->join("tbl_wrw","tbl_user.id_rw = tbl_wrw.id_rw","LEFT");
		$this->db->where('id_target',$id);
		$query = $this->db->get();

		return $query->row();
	}


	public function insert($data)
    {
        $this->db->insert('tbl_target', $data);
        return $this->db->affected_rows();
    }

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

}

/* End of file M_rekap.php */
/* Location: ./application/models/M_rekap.php */