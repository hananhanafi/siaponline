<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_saksi extends CI_Model {

	var $table = 'tbl_saksi';
	var $column_order = array(null, 'tbl_saksi.nama','tbl_saksi.nik','tbl_saksi.alamat','tbl_saksi.no_hp','tbl_wkecamatan.kode','tbl_wkecamatan.nama_kec','tbl_wdesa.nama_desa','tbl_wrw.nama_rw','tbl_tps.nama_tps','tbl_user.first_name',null); //set column field database for datatable orderable
	var $column_search = array('tbl_saksi.nama','tbl_saksi.nik','tbl_saksi.alamat','tbl_saksi.no_hp','tbl_wkecamatan.kode','tbl_wkecamatan.nama_kec','tbl_wdesa.nama_desa','tbl_wrw.nama_rw','tbl_tps.nama_tps','tbl_user.first_name'); //set column field database for datatable searchable 
	var $order = array('tbl_saksi.id' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}

		private function _get_export_query()
	{

		$this->db->select('tbl_saksi.*, tbl_wkecamatan.kode as wilayah , tbl_wkecamatan.nama_kec as kecamatan , tbl_wdesa.nama_desa as kelurahan, tbl_wrw.nama_rw as rw, tbl_tps.nama_tps as tps,tbl_user.first_name, tbl_saksi.kd_rt as rt');

		//table join
		$this->db->join('tbl_wkecamatan','tbl_wkecamatan.id_kec=tbl_saksi.kd_kecamatan', 'left');
		$this->db->join('tbl_wdesa','tbl_wdesa.id_desa=tbl_saksi.kd_kelurahan', 'left');
		$this->db->join('tbl_wrw','tbl_wrw.id_rw=tbl_saksi.kd_rw', 'left');
		$this->db->join('tbl_wrt','tbl_wrt.id_rt=tbl_saksi.kd_rt', 'left');
		$this->db->join('tbl_tps','tbl_tps.id=tbl_saksi.kd_tps', 'left');
		$this->db->join('tbl_user','tbl_user.id=tbl_saksi.kd_ketua_tim', 'left');

		$this->db->from($this->table);
		$i = 0;
	

	}

	public function get_data_export()
	{
		$this->_get_export_query();
		$query = $this->db->get();
		return $query->result();
	}


	private function _get_datatables_query()
	{
		$this->db->select('tbl_saksi.*, tbl_wkecamatan.kode as wilayah , tbl_wkecamatan.nama_kec as kecamatan , tbl_wdesa.nama_desa as kelurahan, tbl_wrw.nama_rw as rw, tbl_saksi.kd_tps as tps,tbl_user.first_name, tbl_saksi.kd_rt as rt');

		//table join
		$this->db->join('tbl_wkecamatan','tbl_wkecamatan.id_kec=tbl_saksi.kd_kecamatan', 'left');
		$this->db->join('tbl_wdesa','tbl_wdesa.id_desa=tbl_saksi.kd_kelurahan', 'left');
		$this->db->join('tbl_wrw','tbl_wrw.id_rw=tbl_saksi.kd_rw', 'left');
		$this->db->join('tbl_user','tbl_user.id=tbl_saksi.kd_ketua_tim', 'left');

		//filter tahun pelaksanaan

		//filter by role
		if ($this->session->userdata('id_role') == 4){
			$this->db->like('tbl_saksi.kd_ketua_tim', $this->session->userdata('id'));
		}
		if ($this->session->userdata('id_role') == 3){
			$this->db->like('tbl_saksi.kd_kelurahan', $this->session->userdata('id_desa'));
		}
		if ($this->session->userdata('id_role') == 2){
			$this->db->like('tbl_saksi.kd_wilayah', $this->session->userdata('id_wilayah'));
		}
		

		$this->db->from($this->table);
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

	public function get_list_kec()
	{
		$this->db->select('tbl_desa_penyelenggara.kdkec,tbl_wkecamatan.nama_kec');
		$this->db->join('tbl_wkecamatan','tbl_wkecamatan.id_kec=tbl_desa_penyelenggara.kdkec', 'left');
		//filter tahun penlaksanaan
		$this->db->where('tbl_desa_penyelenggara.thn_pemilihan', $this->session->userdata('thn_data'));

		if ($this->session->userdata('id_role') == 3){
			$this->db->where('tbl_desa_penyelenggara.kdkec', $this->session->userdata('id_kec'));
		}
		
		$this->db->from($this->table);
		$this->db->order_by('tbl_wkecamatan.nama_kec','asc');
		$query = $this->db->get();
		$result = $query->result();

		$countries = array();
		foreach ($result as $row) 
		{
			$countries[] = $row->nama_kec;
		}
		return $countries;
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

	public function select_by_kategori2()
	{
		$this->db->select('tbl_wkecamatan.nama_kec,tbl_wdesa.nama_desa,tbl_desa_penyelenggara.dpt_l,tbl_desa_penyelenggara.dpt_p,tbl_desa_penyelenggara.suratsuara');
		$this->db->join('tbl_wkecamatan','tbl_wkecamatan.id_kec=tbl_desa_penyelenggara.kdkec', 'left');
		$this->db->join('tbl_wdesa','tbl_wdesa.id_desa=tbl_desa_penyelenggara.kddesa', 'left');
		//filter tahun penlaksanaan
		$this->db->where('tbl_desa_penyelenggara.thn_pemilihan', $this->session->userdata('thn_data'));

		if ($this->session->userdata('id_role') == 3){
			$this->db->where('tbl_desa_penyelenggara.kdkec', $this->session->userdata('id_kec'));
		}
		
		$this->db->from($this->table);
		$this->db->order_by('tbl_wkecamatan.nama_kec','asc');
		$query = $this->db->get();
		$result = $query->result();

		$countries = array();
		foreach ($result as $row) 
		{
			$countries[] = $row->nama_kec;
		}
		return $countries;
	}

	public function select_by_kategori() {
		if ($this->session->userdata('id_role') == 3){
		$sql = "SELECT * FROM tbl_desa_penyelenggara 
			LEFT JOIN tbl_wkecamatan ON tbl_wkecamatan.id_kec = tbl_desa_penyelenggara.kdkec
			LEFT JOIN tbl_wdesa ON tbl_wdesa.id_desa = tbl_desa_penyelenggara.kddesa
			WHERE tbl_desa_penyelenggara.thn_pemilihan = '". $this->session->userdata('thn_data')."'
			AND tbl_desa_penyelenggara.kdkec = '". $this->session->userdata('id_kec')."'";
		} else {
			$sql = "SELECT * FROM tbl_desa_penyelenggara 
			LEFT JOIN tbl_wkecamatan ON tbl_wkecamatan.id_kec = tbl_desa_penyelenggara.kdkec
			LEFT JOIN tbl_wdesa ON tbl_wdesa.id_desa = tbl_desa_penyelenggara.kddesa
			WHERE tbl_desa_penyelenggara.thn_pemilihan = '". $this->session->userdata('thn_data')."'";
		}

		$data = $this->db->query($sql);

		return $data->result();
	}

	public function select_by_kec() {
		$sql = "SELECT DISTINCT tbl_desa_penyelenggara.kddesa,tbl_wdesa.nama_desa FROM tbl_desa_penyelenggara 
			LEFT JOIN tbl_wdesa ON tbl_wdesa.id_desa = tbl_desa_penyelenggara.kddesa
			WHERE tbl_desa_penyelenggara.thn_pemilihan = '". $this->session->userdata('thn_data')."'";

		$sql1 = "SELECT DISTINCT kddesa FROM tbl_desa_penyelenggara 
			WHERE tbl_desa_penyelenggara.thn_pemilihan = '". $this->session->userdata('thn_data')."'";

		$data = $this->db->query($sql);

		return $data->result();
	}

	// Get Kecamatan
	function getKec(){

		$response = array();

		// Select record
		$this->db->select('*');
		if ($this->session->userdata('id_role') == '3') {
			$this->db->where('id_kec', $this->session->userdata('id_kec'));
		} 
		$this->db->order_by('nama_kec');
		$q = $this->db->get('tbl_wkecamatan');
		$response = $q->result_array();

		return $response;
	}

	// Get Desa
  function getDesa($postData){
    $response = array();
 
    // Select record
    $this->db->select('id_desa,nama_desa');
    $q = $this->db->get('tbl_wdesa');
    $response = $q->result_array();

    return $response;
  }

  public function select_jml_pemilih($kc) {
			$sql = "SELECT SUM(dpt_l+dpt_p) AS jmlpilih FROM tbl_wilayah_pemilihan ";

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_jml_desa() {
		if ($this->session->userdata('id_role') == '3') {
			$sql = "SELECT COUNT(DISTINCT(kddesa)) AS jmldesa FROM tbl_desa_penyelenggara WHERE thn_pemilihan = '".$this->session->userdata('thn_data')."' AND kdkec = '".$this->session->userdata('id_kec')."'";
		} else {
			$sql = "SELECT COUNT(DISTINCT(kddesa)) AS jmldesa FROM tbl_desa_penyelenggara WHERE thn_pemilihan = '".$this->session->userdata('thn_data')."'";
		}

		$data = $this->db->query($sql);

		return $data->row();
	}
}

/* End of file M_penyelenggara.php */
/* Location: ./application/models/M_penyelenggara.php */