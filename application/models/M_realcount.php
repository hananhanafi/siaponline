<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_realcount extends CI_Model {


	var $table = 'tbl_realcount';
	var $column_order = array(null, 'tbl_realcount.path_plano','tbl_realcount.path_form_c1','tbl_realcount.id_rt','tbl_realcount.id_tps','tbl_realcount.result'); //set column field database for datatable orderable
	var $column_search = array('tbl_realcount.path_plano','tbl_realcount.path_form_c1','tbl_realcount.id_rt','tbl_realcount.id_tps','tbl_realcount.result'); //set column field database for datatable searchable 
	var $order = array('tbl_realcount.id_realcount' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}

	private function _get_datatables_query()
	{
		$this->db->select("tbl_realcount.*, tbl_user.first_name");
		$this->db->from($this->table);
		$this->db->join('tbl_user','tbl_realcount.id_saksi = tbl_user.id','left');
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
	
	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_realcount',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id_realcount', $id);
		$this->db->delete($this->table);
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function select($id = '') {
		$this->db->select('*');
		$this->db->from('tbl_user');
		
		if ($id != '') {
			$this->db->where('id', $id);
		}
		$data = $this->db->get();

		return $data->row();
	}


	public function select_aktif_slider() {
		$this->db->select('*');
		$this->db->from('tbl_slider');
		$this->db->order_by('nama_slider', 'asc');

		$data = $this->db->get();

		return $data->result();
	}
}


/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */