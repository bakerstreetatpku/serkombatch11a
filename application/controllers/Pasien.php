<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {

	function __construct() {
   	parent::__construct();
  	if (!isset($this->session->userdata['id_user'])) {
  	redirect(base_url("login"));
  	}
	$this->load->library('upload');
  	$this->load->model('Model_Pasien','pasien');
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

//Pasien	
	public function tampil()
	{	
		
		$this->session->set_userdata("judul","Data Master");
		$ba = [
		'judul' => "Data Master",
		'subjudul' => "Pasien",
		];
		$d = [
		'gelar' => $this->pasien->get_enum("srk_pasien", "psn_gelar"),
		'jk' => $this->pasien->get_enum("srk_pasien", "psn_jk"),
		'jkitas' => $this->pasien->get_enum("srk_pasien", "psn_jkitas"),
		];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('pasien',$d);
		$this->load->view('background_bawah');
	}
	
	public function ajax_list_pasien()
	{
		$list = $this->pasien->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pasien) {		
			$no++;
			if (file_exists('assets/images/pasien/thumbs/'.$pasien->psn_foto))
			{
				$foto = base_url('assets/images/pasien/thumbs/'.$pasien->psn_foto)."?".microtime(true);
			}
			else 
			{
				$foto = base_url('assets/assets/dist/img/user-blank.png');
			}
			
			$row = array();
			$row[] = $no;
			$row[] = "<img src='".$foto."' width='50' height='50'> &nbsp;&nbsp;";
			$row[] = $pasien->psn_nama.", ".$pasien->psn_gelar;
			$row[] = $pasien->psn_telp;
			$row[] = $pasien->psn_tempat_lahir.", ".date("d M Y", strtotime($pasien->psn_tgl_lahir));
			$row[] = $pasien->psn_jk;
			$row[] = $pasien->psn_jkitas." - ".$pasien->psn_nokitas;
			$row[] = "<a href='#' onClick='ubah_pasien(".$pasien->psn_id.")' class='btn btn-info' title='Ubah data Pasien'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;&nbsp;&nbsp; <a href='#' onClick='hapus_pasien(".$pasien->psn_id.",\"".$pasien->psn_foto."\")' class='btn btn-danger' title='Hapus data Pasien'><i class='fa fa-remove'></i></a>";
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->pasien->count_all(),
						"recordsFiltered" => $this->pasien->count_filtered(),
						"data" => $data,
						"query" => $this->pasien->getlastquery(),
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function cari()
	{
		$id = $this->input->post('psn_id');
		$data = $this->pasien->get_pasien($id);
		echo json_encode($data);
	}
	public function simpan()
	{
		$id = $this->input->post('psn_id');
		$nama = $this->input->post('psn_nama');
		$gelar = $this->input->post('psn_gelar');
		$tempat_lahir = $this->input->post('psn_tempat_lahir');
		$tgls = explode("/",$this->input->post('psn_tgl_lahir'));
		$tgl_lahir = date("Y-m-d", strtotime($tgls[2]."-".$tgls[1]."-".$tgls[0]));
		$jk = $this->input->post('psn_jk');
		$jkitas = $this->input->post('psn_jkitas');
		$alamat = $this->input->post('psn_alamat');
		$nokitas = $this->input->post('psn_nokitas');
		$psn_telp = $this->input->post('psn_telp');
		$psn_pekerjaan = $this->input->post('psn_pekerjaan');
		$filename = $_FILES['psn_foto']['name'];
		$arrName = explode(".",$filename);
		$idxName = count($arrName);
		$ext = $arrName[$idxName-1];
		
		$config['upload_path'] = 'assets/images/pasien/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpsn|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload
		$config['overwrite'] = TRUE; //Enkripsi nama yang terupload
		$config['file_name'] = $gelar.".".$ext; //ganti nama file

		$this->upload->initialize($config);
		if(!empty($_FILES['psn_foto']['name'])){
			if ($this->upload->do_upload('psn_foto')){
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library']='gd2';
				$config['source_image']='assets/images/pasien/'.$gbr['file_name'];
				$config['create_thumb']= FALSE;
				$config['maintain_ratio']= FALSE;
				$config['quality']= '50%';
				$config['width']= 150;
				$config['height']= 150;
				$config['new_image']= 'assets/images/pasien/thumbs/'.$gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$foto=$gbr['file_name'];
			}
			else
			{
				die($this->upload->display_errors());
			}
			$data = array(
				'psn_nama' => $nama,
				'psn_gelar' => $gelar,
				'psn_tempat_lahir' => $tempat_lahir,
				'psn_tgl_lahir' => $tgl_lahir,
				'psn_jk' => $jk,
				'psn_jkitas' => $jkitas,
				'psn_nokitas' => $nokitas,
				'psn_alamat' => $alamat,
				'psn_nokitas' => $nokitas,
				'psn_telp' => $psn_telp,
				'psn_pekerjaan' => $psn_pekerjaan,
				'psn_foto' => $foto,
			);
		}		
		else
		{
			$data = array(
				'psn_nama' => $nama,
				'psn_gelar' => $gelar,
				'psn_tempat_lahir' => $tempat_lahir,
				'psn_tgl_lahir' => $tgl_lahir,
				'psn_jk' => $jk,
				'psn_jkitas' => $jkitas,
				'psn_nokitas' => $nokitas,
				'psn_alamat' => $alamat,
				'psn_nokitas' => $nokitas,
				'psn_telp' => $psn_telp,
				'psn_pekerjaan' => $psn_pekerjaan,
			);
		}
		if ($id == 0)
		{
			$insert = $this->pasien->simpan("srk_pasien", $data);
		}
		else 
		{
			$insert = $this->pasien->update("srk_pasien", array('psn_id' => $id), $data);	
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
	
	
	public function hapus($id, $foto)
	{	
		$delete = $this->pasien->delete('srk_pasien', 'psn_id', $id);
		unlink('assets/images/pasien/'.$foto);
		unlink('assets/images/pasien/thumbs/'.$foto);
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