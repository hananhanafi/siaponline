<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_kecamatan extends CI_Model {
	
	var $table = 'tbl_wkecamatan';
	var $column_order = array(null, 'tbl_wkecamatan.kode','tbl_wkecamatan.nama_kec'); //set column field database for datatable orderable
	var $column_search = array('tbl_wkecamatan.kode','tbl_wkecamatan.nama_kec'); //set column field database for datatable searchable 
	var $order = array('tbl_wkecamatan.id_kec' => 'desc'); // default order 
	

	
	public function select_all() {
		$this->db->select('*');
		$this->db->from('tbl_wkecamatan');
		$this->db->order_by('id_kec', 'desc');

		$data = $this->db->get();

		return $data->result();
	}

	public function get_list_kecamatan()
	{
		$this->db->select('*');
		$this->db->from($this->table);
		if ($this->session->userdata('id_kecamatan')) {
			$this->db->where("id_kec", $this->session->userdata('id_kecamatan'));
		}
		$this->db->order_by('tbl_wkecamatan.nama_kec','asc');
		$query = $this->db->get();
		$result = $query->result();

		$countries = array();
		foreach ($result as $row) 
		{
			$countries[$row->id_kec] = $row->nama_kec;
		}
		return $countries;
	}

	public function select_by_id($id) {
		$sql = "SELECT * FROM tbl_wkecamatan WHERE id_kec = '{$id}'";

		$data = $this->db->query($sql);

		return $data->row();
	}


	public function insert($data) {
		$sql = "INSERT INTO tbl_wkecamatan VALUES('','" .$data['nama_kecamatan'] ."')";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function insert_batch($data) {
		$this->db->insert_batch('tbl_wkecamatan', $data);
		
		return $this->db->affected_rows();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete($id) {
		$sql = "DELETE FROM tbl_wkecamatan WHERE id_kec='" .$id ."'";

		$this->db->query($sql);

		return $this->db->affected_rows();
	}

	public function check_nama($nama) {
		$this->db->where('nama_kec', $nama);
		$data = $this->db->get('tbl_wkecamatan');

		return $data->num_rows();
	}

	public function total_rows() {
		$data = $this->db->get('tbl_wkecamatan');

		return $data->num_rows();
	}

	public function select_by_wil() {

		$sql1 = "SELECT DISTINCT nama_kec FROM tbl_wkecamatan ";

		$data = $this->db->query($sql1);

		return $data->result();
	}

	// Get Kecamatan
	function getWil(){

		$response = array();

		// Select record
		$this->db->select('*');
		$this->db->order_by('nama');
		$q = $this->db->get('tbl_wilayah_pemilihan');
		$response = $q->result_array();

		return $response;
	}
	
	private function _get_datatables_query()
	{
		$this->db->select('tbl_wkecamatan.id_kec, tbl_wkecamatan.kode, tbl_wkecamatan.nama_kec');
		
		//add custom filter here
		if($this->input->post('nama_kec'))
		{
			$this->db->like('tbl_wkecamatan.nama_kec', $this->input->post('nama_kec'));
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

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_kec',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id_kec', $id);
		$this->db->delete($this->table);
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

}

/* End of file M_kecamatan.php */
/* Location: ./application/models/M_kecamatan.php */