<?php
  class Model_Dokter extends CI_Model {
  
  	var $table = 'srk_dokter';
	var $column_order = array('dok_nama','dok_nip', null); //set column field database for datatable orderable
	var $column_search = array('dok_nip', 'dok_nip_det', 'dok_nama', 'dok_jenis', 'dok_tempat_lahir', "dok_telp", null); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('dok_nama' => 'asc'); // default order  	private $db_sts;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	
	private function _get_datatables_query()
	{
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

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
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
	
	public function get_prodi()
	{	$this->db->from("srk_prodi");
		$query = $this->db->get();

		return $query->result();
	}

	public function get_fakultas()
	{	$this->db->from("srk_fakultas");
		$query = $this->db->get();

		return $query->result();
	}

	public function get_jabatan()
	{	$this->db->from("srk_jabatan");
		$this->db->where("jab_jenis","Dokter");
		$query = $this->db->get();

		return $query->result();
	}

	public function cari_fakultas($id)
	{	$this->db->from("srk_fakultas");	
		$this->db->where("fkt_id", $id);
		$query = $this->db->get();

		return $query->row();
	}

	public function cari_prodi($id)
	{	$this->db->from("srk_prodi");	
		$this->db->where("prd_id", $id);
		$query = $this->db->get();

		return $query->row();
	}

	
	public function get_dokter($id)
	{	$this->db->from("srk_dokter");
		$this->db->where("dok_id", $id);
		$query = $this->db->get();

		return $query->row();
	}

	
	
	public function cari_jabatan($id)
	{	$this->db->from("srk_jabatan");
		$this->db->where("telp", $id);
		$query = $this->db->get();

		return $query->row();
	}

	
	public function tanggal($a) {
		$arrBulan = array(1 => "Januari", "Februari", "Maret", "April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
		$tgls = explode("-",$a);
		$tgl = $tgls[2];
		$bln = $arrBulan[(int) $tgls[1]];
		$thn = $tgls[0];
		return "$tgl $bln $thn";
	}
	
	// uang idr
	public function uang($nilai, $koma) {
		$uangnya = number_format($nilai, $koma);
		if ($koma > 0)	 {
			$pisah = explode(".", $uangnya);
			$depan = str_replace(",",".",$pisah[0]);
			$belakang = str_replace(".",",",$pisah[1]);
			$uang = "$depan,$belakang";
		} else {
			$uang = str_replace(",",".",$uangnya);
		}
		return $uang;
	}
	

	public function getlastquery()
	{
		$query = str_replace( array("\r", "\n", "\t"), '', trim($this->db->last_query()) );

		return $query;
	}
	
	public function get_enum($table, $field)
	{
		$q = "show columns from $table like '$field'";
		$row = $this->db->query("show columns from $table like '$field'")->row()->Type;
		$enum_array = explode("(",str_replace(")","",str_replace("'","",$row)));
		$enum_field = explode(",",$enum_array[1]);
		
		foreach ($enum_field as $key=>$value)
		{
			$enums[$value] = $value;
		}
		return $enums;
	}
	
	public function update($table, $where, $data)
	{
		$this->db->update($table, $data, $where);
		return $this->db->affected_rows();
	}

	public function simpan($table, $data)
	{
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	public function delete($table, $field, $id)
	{
		$this->db->where($field, $id);
		$this->db->delete($table);
	}
	
	
  }
?>