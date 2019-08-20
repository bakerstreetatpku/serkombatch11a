<?php
  class Model_Login extends CI_Model {
	var $table = 'srk_login';
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
    
	
	function cek($username, $password) {
		$this->db->where("log_user", $username);
		$this->db->where("log_pass", md5($password));
		//$this->db->where("status", "Aktif");
		return $this->db->get("srk_login");
      }
	  
	  
	public function update($tbl, $where, $data)
	{
		$this->db->update($tbl, $data, $where);
		return $this->db->affected_rows();
	}

  }
?>