<?php
  class Model_Merk extends CI_Model {
  
  	var $table = 'njkb_dm_merk';
	var $column_order = array('nm_merk','kd_negara',null); //set column field database for datatable orderable
	var $column_search = array('nm_merk','kd_negara'); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('nm_merk' => 'asc'); // default order 
 	private $db_sts;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->db_sts = $this->load->database('sts_dipenda', TRUE);
	}
	
	
	private function _get_datatables_query()
	{
		
		$this->db_sts->from($this->table);
		//$this->db->where("kodegolongan", 1);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db_sts->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db_sts->like($item, $_POST['search']['value']);
				}
				else
				{
					$this->db_sts->or_like($item, $_POST['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db_sts->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_POST['order'])) // here order processing
		{
			$this->db_sts->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db_sts->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db_sts->limit($_POST['length'], $_POST['start']);
		$query = $this->db_sts->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db_sts->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db_sts->from($this->table);
		return $this->db_sts->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db_sts->from($this->table);
		$this->db_sts->where('kodemerk',$id);
		$query = $this->db_sts->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db_sts->insert($this->table, $data);
		return $this->db_sts->insert_id();
	}

	public function update($where, $data)
	{
		$this->db_sts->update($this->table, $data, $where);
		return $this->db_sts->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db_sts->where('kodemerk', $id);
		$this->db_sts->delete($this->table);
	}
	
	public function carinegara($id)
	{
		$this->db->from("dm_negara");
		$this->db->where('kd_negara',$id);
		$query = $this->db->get();

		return $query->row();
	}


  }
?>