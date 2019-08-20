<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PolyDokter extends CI_Controller {

	function __construct() {
   	parent::__construct();
  	if (!isset($this->session->userdata['id_user'])) {
  	redirect(base_url("login"));
  	}
	$this->load->library('upload');
  	$this->load->model('Model_PolyDokter','polydokter');
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

//PolyDokter	
	public function tampil()
	{	
		
		$this->session->set_userdata("judul","Data Master");
		$ba = [
		'judul' => "Data Master",
		'subjudul' => "PolyDokter",
		];
		$d = [
		'dokter' => $this->polydokter->get_dokter(),
		'poly' => $this->polydokter->get_poly(),
		];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('polydokter', $d);
		$this->load->view('background_bawah');
	}
	
	public function ajax_list_polydokter()
	{
		$list = $this->polydokter->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $polydokter) {		
			$no++;
			$dokter = $this->polydokter->caridokter($polydokter->pdk_dok_id);
			$poly = $this->polydokter->caripoly($polydokter->pdk_ply_id);
			$row = array();
			$row[] = $no;
			$row[] = $dokter->dok_nama;
			$row[] = $poly->ply_nama;
			$row[] = "<a href='#' onClick='ubah_polydokter(".$polydokter->pdk_id.")' class='btn btn-info' title='Ubah data PolyDokter'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;&nbsp;&nbsp; <a href='#' onClick='hapus_polydokter(".$polydokter->pdk_id.")' class='btn btn-danger' title='Hapus data PolyDokter'><i class='fa fa-remove'></i></a>";
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->polydokter->count_all(),
						"recordsFiltered" => $this->polydokter->count_filtered(),
						"data" => $data,
						"query" => $this->polydokter->getlastquery(),
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function cari()
	{
		$id = $this->input->post('pdk_id');
		$data = $this->polydokter->get_polydokter($id);
		echo json_encode($data);
	}
	public function simpan()
	{
		$id = $this->input->post('pdk_id');
		$dok_id = $this->input->post('pdk_dok_id');
		$pdk_ply_id = $this->input->post('pdk_ply_id');
		$data = array(
			'pdk_dok_id' => $dok_id,
			'pdk_ply_id' => $pdk_ply_id,
		);
		if ($id == 0)
		{
			$insert = $this->polydokter->simpan("srk_polydokter", $data);
		}
		else 
		{
			$insert = $this->polydokter->update("srk_polydokter", array('pdk_id' => $id), $data);	
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
		$delete = $this->polydokter->delete('srk_polydokter', 'pdk_id', $id);
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