<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spesialis extends CI_Controller {

	function __construct() {
   	parent::__construct();
  	if (!isset($this->session->userdata['id_user'])) {
  	redirect(base_url("login"));
  	}
	$this->load->library('upload');
  	$this->load->model('Model_Spesialis','spesialis');
	date_default_timezone_set('Asia/Jakarta');
    }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

//Spesialis	
	public function tampil()
	{	
		
		$this->session->set_userdata("judul","Data Master");
		$ba = [
		'judul' => "Data Master",
		'subjudul' => "Spesialis",
		];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('spesialis');
		$this->load->view('background_bawah');
	}
	
	public function ajax_list_spesialis()
	{
		$list = $this->spesialis->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $spesialis) {		
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $spesialis->sps_nama;
			$row[] = $spesialis->sps_gelar;
			$row[] = "<a href='#' onClick='ubah_spesialis(".$spesialis->sps_id.")' class='btn btn-info' title='Ubah data Spesialis'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;&nbsp;&nbsp; <a href='#' onClick='hapus_spesialis(".$spesialis->sps_id.")' class='btn btn-danger' title='Hapus data Spesialis'><i class='fa fa-remove'></i></a>";
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->spesialis->count_all(),
						"recordsFiltered" => $this->spesialis->count_filtered(),
						"data" => $data,
						"query" => $this->spesialis->getlastquery(),
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function cari()
	{
		$id = $this->input->post('sps_id');
		$data = $this->spesialis->get_spesialis($id);
		echo json_encode($data);
	}
	public function simpan()
	{
		$id = $this->input->post('sps_id');
		$nama = $this->input->post('sps_nama');
		$sps_gelar = $this->input->post('sps_gelar');
		$data = array(
			'sps_nama' => $nama,
			'sps_gelar' => $sps_gelar,
		);
		if ($id == 0)
		{
			$insert = $this->spesialis->simpan("srk_spesialis", $data);
		}
		else 
		{
			$insert = $this->spesialis->update("srk_spesialis", array('sps_id' => $id), $data);	
		}
		$error = $this->db->error();
		if (!empty($error))
		{
			$err = $error['message'];
		}
		else 
		{
			$err = "";
		}
		if ($insert)
		{
			$resp['status'] = 1;
			$resp['desc'] = "Berhasil menyimpan data";
		}
		else 
		{
			$resp['status'] = 0;
			$resp['desc'] = "Ada kesalahan dalam penyimpanan!";
			$resp['error'] = $err;
		}
		echo json_encode($resp);
	}
	
	
	public function hapus($id)
	{	
		$delete = $this->spesialis->delete('srk_spesialis', 'sps_id', $id);
		// $err = $this->db->error();
		// if ($err)
		// {
			$resp['status'] = 1;
			$resp['desc'] = "Berhasil menghapus data";
		// }
		// else 
		// {
			// $resp['status'] = 0;
			// $resp['desc'] = "Ada kesalahan dalam penghapusan data $id";
			// $resp['error'] = $err;
		// }
		echo json_encode($resp);
	}
}