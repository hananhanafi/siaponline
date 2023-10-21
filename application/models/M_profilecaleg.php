<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_profilecaleg extends CI_Model {

	var $table = 'profile_caleg';
	var $column_order = array(null,'profile_caleg.value',null); //set column field database for datatable orderable
	var $column_search = array('profile_caleg.value'); 
	var $order = array('profile_caleg.id_profile' => 'asc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_prestasi_query()
	{
		
		$this->db->from($this->table);

		$this->db->where('profile_caleg.tipe','Prestasi');

		
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

	function get_datatables_prestasi()
	{
		$this->_get_prestasi_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered_prestasi()
	{
		$this->_get_prestasi_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_prestasi()
	{
		$this->db->from($this->table);
		$this->db->where('profile_caleg.tipe','Prestasi');
		
		return $this->db->count_all_results();
	}

	private function _get_program_query()
	{
		
		$this->db->from($this->table);
		$this->db->where('profile_caleg.tipe','Program');

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

	function get_datatables_program()
	{
		$this->_get_program_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();

		return $query->result();
	}

	function count_filtered_program()
	{
		$this->_get_program_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all_program()
	{
		$this->db->from($this->table);
		$this->db->where('profile_caleg.tipe','Program');
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('profile_caleg');
		$this->db->where('profile_caleg.id_profile',$id);

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
		$this->db->where('id_profile', $id);
		$this->db->delete($this->table);
	}

	public function select_jml_calon($kc) {
		if ($this->session->userdata('id_role') == '3') {
			$sql = "SELECT COUNT(*) AS jmlcalon, SUM(s_hasil) AS jmlsuara FROM tbl_calon WHERE kdkec LIKE {$kc} AND thn_pemilihan = ".$this->session->userdata('thn_data');
		} else {
			$sql = "SELECT COUNT(*) AS jmlcalon, SUM(s_hasil) AS jmlsuara FROM tbl_calon WHERE thn_pemilihan = ".$this->session->userdata('thn_data');
		}

		$data = $this->db->query($sql);

		return $data->row();
	}

	public function select_by_kec()
	{
		$this->db->select('*');
		$this->db->from('tbl_calon');
		$this->db->join('tbl_pendidikan', 'tbl_pendidikan.id_pendidikan = tbl_calon.id_pendidikan', 'left');
		$this->db->join('tbl_pekerjaan','tbl_pekerjaan.id_pekerjaan=tbl_calon.id_pekerjaan', 'left');
		$this->db->join('tbl_wkecamatan','tbl_wkecamatan.id_kec=tbl_calon.kdkec', 'left');
		$this->db->join('tbl_wdesa','tbl_wdesa.id_desa=tbl_calon.kddesa', 'left');
		$this->db->where('tbl_calon.thn_pemilihan',$this->session->userdata('thn_data'));
		if ($this->session->userdata('id_role') == '3') {
			$this->db->where('tbl_calon.kdkec',$this->session->userdata('id_kec'));
		}
		
		$query = $this->db->get();

		return $query->result();
	}

	public function select_by_desa($desa)
	{
		$this->db->select('*');
		$this->db->from('tbl_calon');
		$this->db->join('tbl_pendidikan', 'tbl_pendidikan.id_pendidikan = tbl_calon.id_pendidikan', 'left');
		$this->db->join('tbl_pekerjaan','tbl_pekerjaan.id_pekerjaan=tbl_calon.id_pekerjaan', 'left');
		$this->db->join('tbl_wkecamatan','tbl_wkecamatan.id_kec=tbl_calon.kdkec', 'left');
		$this->db->join('tbl_wdesa','tbl_wdesa.id_desa=tbl_calon.kddesa', 'left');
		$this->db->where('tbl_calon.thn_pemilihan',$this->session->userdata('thn_data'));
		if ($this->session->userdata('id_role') == '3') {
			$this->db->where('tbl_calon.kddesa',$desa);
		}
		
		$query = $this->db->get();

		return $query->result();
	}

	public function select_all() {
		$this->db->select('*');
		$this->db->from('profile_caleg');

		$result = array();

		$data = $this->db->get();
		foreach($data->result_array() as $res){
			$result[$res['tipe']][] = $res['value'];
		}
		return $result;
	}

	public function select_data() {
		$this->db->select('*');
		$this->db->from('profile_caleg');

		$result = array();

		$data = $this->db->get();
		foreach($data->result_array() as $res){
			$result[$res['tipe']]['values'][] = $res['value'];
			$result[$res['tipe']]['id'][] = $res['id_profile'];
		}
		return $result;
	}

	function load_data($ds)
	{
		$this->db->order_by('nourut', 'ASC');
		$this->db->where('kddesa',$ds);
		$this->db->where('tbl_calon.thn_pemilihan',$this->session->userdata('thn_data'));
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	function update_hasil($data, $id)
	{
		$this->db->where('id', $id);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}

}

/* End of file M_calon.php */
/* Location: ./application/models/M_calon.php */