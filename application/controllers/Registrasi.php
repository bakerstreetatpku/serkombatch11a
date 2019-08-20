<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registrasi extends CI_Controller {

	function __construct() {
   	parent::__construct();
  	if (!isset($this->session->userdata['id_user'])) {
  	redirect(base_url("login"));
  	}
	$this->load->library('upload');
  	$this->load->model('Model_Registrasi','registrasi');
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

//Registrasi	
	public function tampil()
	{	
		
		$this->session->set_userdata("judul","Data Master");
		$ba = [
		'judul' => "Data Master",
		'subjudul' => "Registrasi",
		];
		$d = [
		'jenis' => $this->registrasi->get_enum("srk_registrasi", "reg_jenis"),
		'pasien' => $this->registrasi->get_pasien(),
		'dokter' => $this->registrasi->get_dokter(),
		'poly' => $this->registrasi->get_poly(),
		];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('registrasi', $d);
		$this->load->view('background_bawah');
	}
	
	public function ajax_list_registrasi()
	{
		$list = $this->registrasi->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $registrasi) {		
			$no++;
			$pasien = $this->registrasi->caripasien($registrasi->reg_psn_id);
			$dokter = $this->registrasi->caridokter($registrasi->reg_dok_id);
			$poly = $this->registrasi->caripoly($registrasi->reg_ply_id);
			$row = array();
			$row[] = $no;
			$row[] = $registrasi->reg_tgl;
			$row[] = $registrasi->reg_urut;
			$row[] = $registrasi->reg_jenis;
			$row[] = $pasien->psn_nama;
			$row[] = $dokter->dok_nama;
			$row[] = $poly->ply_nama;
			$row[] = "<a href='#' onClick='ubah_registrasi(".$registrasi->reg_id.")' class='btn btn-info' title='Ubah data Registrasi'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;&nbsp;&nbsp; <a href='#' onClick='hapus_registrasi(".$registrasi->reg_id.")' class='btn btn-danger' title='Hapus data Registrasi'><i class='fa fa-remove'></i></a>";
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->registrasi->count_all(),
						"recordsFiltered" => $this->registrasi->count_filtered(),
						"data" => $data,
						"query" => $this->registrasi->getlastquery(),
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function cari()
	{
		$id = $this->input->post('reg_id');
		$data = $this->registrasi->get_registrasi($id);
		echo json_encode($data);
	}
	public function simpan()
	{
		$id = $this->input->post('reg_id');
		$tgls = explode("/",$this->input->post('reg_tgl'));
		$tgl = date("Y-m-d", strtotime($tgls[2]."-".$tgls[1]."-".$tgls[0]));
		$jenis = $this->input->post('reg_jenis');
		$psn_id = $this->input->post('reg_psn_id');
		$dok_id = $this->input->post('reg_dok_id');
		$ply_id = $this->input->post('reg_ply_id');
		
		$urut = $this->registrasi->geturut($tgl, $ply_id, $dok_id);
		
		
		$data = array(
			'reg_urut' => $urut,
			'reg_tgl' => $tgl,
			'reg_jenis' => $jenis,
			'reg_psn_id' => $psn_id,
			'reg_dok_id' => $dok_id,
			'reg_ply_id' => $ply_id,
		);
		if ($id == 0)
		{
			$insert = $this->registrasi->simpan("srk_registrasi", $data);
		}
		else 
		{
			$insert = $this->registrasi->update("srk_registrasi", array('reg_id' => $id), $data);	
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
		$delete = $this->registrasi->delete('srk_registrasi', 'reg_id', $id);
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