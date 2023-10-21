<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kelurahan extends CI_Model {

	var $table = 'tbl_wdesa';
	var $column_order = array(null, 'tbl_wdesa.nama_desa','tbl_wkecamatan.nama_kec','tbl_wkecamatan.kode', null); //set column field database for datatable orderable
	var $column_search = array('tbl_wdesa.nama_desa','tbl_wkecamatan.nama_kec','tbl_wkecamatan.kode'); //set column field database for datatable searchable 
	var $order = array('tbl_wdesa.id_desa' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}

	public function select_export() {
		$this->db->select('*');
		$this->db->from('tbl_wdesa');
		$this->db->join('tbl_wkecamatan','tbl_wkecamatan.id_kec=tbl_wdesa.id_kec', 'left');
		$this->db->order_by('id_desa', 'desc');
		$data = $this->db->get();
		return $data->result();
	}

	public function select_all() {
		$this->db->select('*');
		$this->db->from('tbl_wdesa');
		$this->db->order_by('id_desa', 'desc');

		$data = $this->db->get();

		return $data->result();
	}

	private function _get_datatables_query()
	{
		$this->db->select('tbl_wdesa.id_desa, tbl_wkecamatan.kode, tbl_wkecamatan.nama_kec, tbl_wdesa.nama_desa');
		
		$this->db->join('tbl_wkecamatan','tbl_wkecamatan.id_kec=tbl_wdesa.id_kec', 'left');

		if($this->input->post('nama_desa'))
		{
			$this->db->like('tbl_wdesa.nama_desa', $this->input->post('nama_desa'));
		}
		
		if ($this->session->userdata('id_role') == 3){
			$this->db->like('tbl_wdesa.id_kec', $this->session->userdata('id_kecamatan'));
		}

		if($this->input->post('id_kec'))
		{
			$this->db->like('tbl_wdesa.id_kec', $this->input->post('id_kec'));
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
		$this->db->select('tbl_wilayah_pemilihan.kode,tbl_wilayah_pemilihan.nama');
		$this->db->join('tbl_wilayah_pemilihan','tbl_wilayah_pemilihan.kode=tbl_tps.kode_wilayah', 'left');
		
		$this->db->from($this->table);
		$this->db->order_by('tbl_wilayah_pemilihan.nama','asc');
		$query = $this->db->get();
		$result = $query->result();

		$countries = array();
		foreach ($result as $row) 
		{
			$countries[] = $row->nama;
		}
		return $countries;
	}

	public function get_list_kelurahan()
	{
		$this->db->select('tbl_wdesa.id_desa, tbl_wdesa.nama_desa');
		
		$this->db->from($this->table);
		if ($this->session->userdata('id_kecamatan')) {
			$this->db->where("id_kec", $this->session->userdata('id_kecamatan'));
		}
		$this->db->order_by('tbl_wdesa.nama_desa','asc');
		$query = $this->db->get();
		$result = $query->result();

		$countries = array();
		foreach ($result as $row) 
		{
			$countries[$row->id_desa] = $row->nama_desa;
		}
		return $countries;
	}

	public function get_list_tps()
	{
		$this->db->select('tbl_tps.id,tbl_tps.nama_tps');
		
		$this->db->from($this->table);
		$this->db->order_by('tbl_tps.nama_tps','asc');
		$query = $this->db->get();
		$result = $query->result();

		$countries = array();
		foreach ($result as $row) 
		{
			$countries[$row->id] = $row->nama_tps;
		}
		return $countries;
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_desa',$id);
		$query = $this->db->get();

		return $query->row();
	}


	public function get_by_kecamatan($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_kec',$id);
		$query = $this->db->get();

		return $query->result();
	}


	public function get_all_kelurahan()
	{
		$this->db->from($this->table);
		$query = $this->db->get();

		return $query->result();
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
		$this->db->where('id_desa', $id);
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

	public function select_by_wil() {

		$sql1 = "SELECT DISTINCT nama_tps FROM tbl_tps ";

		$data = $this->db->query($sql1);

		return $data->result();
	}

	// Get Wilayah
	function getWil(){

		$response = array();

		// Select record
		$this->db->select('*');
		$this->db->order_by('nama');
		$q = $this->db->get('tbl_wilayah_pemilihan');
		$response = $q->result_array();

		return $response;
	}

	// Get Kecamatan
	function getKec(){

		$response = array();

		// Select record
		$this->db->select('*');
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
		if ($this->session->userdata('id_role') == '3') {
			$sql = "SELECT SUM(dpt_l+dpt_p) AS jmlpilih, SUM(suratsuara) AS jmlss FROM tbl_desa_penyelenggara WHERE kdkec LIKE {$kc} AND thn_pemilihan = '".$this->session->userdata('thn_data')."'";
		} else {
			$sql = "SELECT SUM(dpt_l+dpt_p) AS jmlpilih, SUM(suratsuara) AS jmlss FROM tbl_desa_penyelenggara WHERE thn_pemilihan = '".$this->session->userdata('thn_data')."'";
		}

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