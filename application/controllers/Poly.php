<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poly extends CI_Controller {

	function __construct() {
   	parent::__construct();
  	if (!isset($this->session->userdata['id_user'])) {
  	redirect(base_url("login"));
  	}
	$this->load->library('upload');
  	$this->load->model('Model_Poly','poly');
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

//Poly	
	public function tampil()
	{	
		
		$this->session->set_userdata("judul","Data Master");
		$ba = [
		'judul' => "Data Master",
		'subjudul' => "Poly",
		];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('poly');
		$this->load->view('background_bawah');
	}
	
	public function ajax_list_poly()
	{
		$list = $this->poly->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $poly) {		
			$no++;
			$row = array();
			$row[] = $no;
			$row[] = $poly->ply_nama;
			$row[] = $poly->ply_kode;
			$row[] = "<a href='#' onClick='ubah_poly(".$poly->ply_id.")' class='btn btn-info' title='Ubah data Poly'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;&nbsp;&nbsp; <a href='#' onClick='hapus_poly(".$poly->ply_id.")' class='btn btn-danger' title='Hapus data Poly'><i class='fa fa-remove'></i></a>";
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->poly->count_all(),
						"recordsFiltered" => $this->poly->count_filtered(),
						"data" => $data,
						"query" => $this->poly->getlastquery(),
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function cari()
	{
		$id = $this->input->post('ply_id');
		$data = $this->poly->get_poly($id);
		echo json_encode($data);
	}
	public function simpan()
	{
		$id = $this->input->post('ply_id');
		$nama = $this->input->post('ply_nama');
		$ply_kode = $this->input->post('ply_kode');
		$data = array(
			'ply_nama' => $nama,
			'ply_kode' => $ply_kode,
		);
		if ($id == 0)
		{
			$insert = $this->poly->simpan("srk_poly", $data);
		}
		else 
		{
			$insert = $this->poly->update("srk_poly", array('ply_id' => $id), $data);	
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
		$delete = $this->poly->delete('srk_poly', 'ply_id', $id);
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