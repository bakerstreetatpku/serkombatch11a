<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SpesialisDokter extends CI_Controller {

	function __construct() {
   	parent::__construct();
  	if (!isset($this->session->userdata['id_user'])) {
  	redirect(base_url("login"));
  	}
	$this->load->library('upload');
  	$this->load->model('Model_SpesialisDokter','spesialisdokter');
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

//SpesialisDokter	
	public function tampil()
	{	
		
		$this->session->set_userdata("judul","Data Master");
		$ba = [
		'judul' => "Data Master",
		'subjudul' => "SpesialisDokter",
		];
		$d = [
		'dokter' => $this->spesialisdokter->get_dokter(),
		'spesialis' => $this->spesialisdokter->get_spesialis(),
		];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('spesialisdokter', $d);
		$this->load->view('background_bawah');
	}
	
	public function ajax_list_spesialisdokter()
	{
		$list = $this->spesialisdokter->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $spesialisdokter) {		
			$no++;
			$dokter = $this->spesialisdokter->caridokter($spesialisdokter->sdk_dok_id);
			$spesialis = $this->spesialisdokter->carispesialis($spesialisdokter->sdk_sps_id);
			$row = array();
			$row[] = $no;
			$row[] = $dokter->dok_nama;
			$row[] = $spesialis->sps_nama;
			$row[] = "<a href='#' onClick='ubah_spesialisdokter(".$spesialisdokter->sdk_id.")' class='btn btn-info' title='Ubah data SpesialisDokter'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;&nbsp;&nbsp; <a href='#' onClick='hapus_spesialisdokter(".$spesialisdokter->sdk_id.")' class='btn btn-danger' title='Hapus data SpesialisDokter'><i class='fa fa-remove'></i></a>";
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->spesialisdokter->count_all(),
						"recordsFiltered" => $this->spesialisdokter->count_filtered(),
						"data" => $data,
						"query" => $this->spesialisdokter->getlastquery(),
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function cari()
	{
		$id = $this->input->post('sdk_id');
		$data = $this->spesialisdokter->get_spesialisdokter($id);
		echo json_encode($data);
	}
	public function simpan()
	{
		$id = $this->input->post('sdk_id');
		$dok_id = $this->input->post('sdk_dok_id');
		$sdk_sps_id = $this->input->post('sdk_sps_id');
		$data = array(
			'sdk_dok_id' => $dok_id,
			'sdk_sps_id' => $sdk_sps_id,
		);
		if ($id == 0)
		{
			$insert = $this->spesialisdokter->simpan("srk_spesialisdokter", $data);
		}
		else 
		{
			$insert = $this->spesialisdokter->update("srk_spesialisdokter", array('sdk_id' => $id), $data);	
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
		$delete = $this->spesialisdokter->delete('srk_spesialisdokter', 'sdk_id', $id);
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