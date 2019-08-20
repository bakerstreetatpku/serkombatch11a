<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokter extends CI_Controller {

	function __construct() {
   	parent::__construct();
  	if (!isset($this->session->userdata['id_user'])) {
  	redirect(base_url("login"));
  	}
	$this->load->library('upload');
  	$this->load->model('Model_Dokter','dokter');
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

//Dokter	
	public function tampil()
	{	
		
		$this->session->set_userdata("judul","Data Master");
		$ba = [
		'judul' => "Data Master",
		'subjudul' => "Dokter",
		];
		$d = [
		'jenis' => $this->dokter->get_enum("srk_dokter", "dok_jenis"),
		'jk' => $this->dokter->get_enum("srk_dokter", "dok_jk"),
		];
		$this->load->helper('url');
		$this->load->view('background_atas', $ba);
		$this->load->view('dokter',$d);
		$this->load->view('background_bawah');
	}
	
	public function ajax_list_dokter()
	{
		$list = $this->dokter->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $dokter) {		
			$no++;
			if (file_exists('assets/images/dokter/thumbs/'.$dokter->dok_foto))
			{
				$foto = base_url('assets/images/dokter/thumbs/'.$dokter->dok_foto)."?".microtime(true);
			}
			else 
			{
				$foto = base_url('assets/assets/dist/img/user-blank.png');
			}
			
			$row = array();
			$row[] = $no;
			$row[] = "<img src='".$foto."' width='50' height='50'> &nbsp;&nbsp;";
			$row[] = $dokter->dok_nama;
			$row[] = $dokter->dok_nip;
			$row[] = $dokter->dok_telp;
			$row[] = $dokter->dok_tempat_lahir.", ".date("d M Y", strtotime($dokter->dok_tgl_lahir));
			$row[] = $dokter->dok_jk;
			$row[] = "<a href='#' onClick='ubah_dokter(".$dokter->dok_id.")' class='btn btn-info' title='Ubah data Dokter'><i class='fa fa-pencil'></i></a>&nbsp;&nbsp;&nbsp;&nbsp; <a href='#' onClick='hapus_dokter(".$dokter->dok_id.",\"".$dokter->dok_foto."\")' class='btn btn-danger' title='Hapus data Dokter'><i class='fa fa-remove'></i></a>";
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->dokter->count_all(),
						"recordsFiltered" => $this->dokter->count_filtered(),
						"data" => $data,
						"query" => $this->dokter->getlastquery(),
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function cari()
	{
		$id = $this->input->post('dok_id');
		$data = $this->dokter->get_dokter($id);
		echo json_encode($data);
	}
	public function simpan()
	{
		$id = $this->input->post('dok_id');
		$nama = $this->input->post('dok_nama');
		$jenis = $this->input->post('dok_jenis');
		$tempat_lahir = $this->input->post('dok_tempat_lahir');
		$tgls = explode("/",$this->input->post('dok_tgl_lahir'));
		$tgl_lahir = date("Y-m-d", strtotime($tgls[2]."-".$tgls[1]."-".$tgls[0]));
		$jk = $this->input->post('dok_jk');
		$alamat = $this->input->post('dok_alamat');
		$nip = $this->input->post('dok_nip');
		$dok_telp = $this->input->post('dok_telp');
		$filename = $_FILES['dok_foto']['name'];
		$arrName = explode(".",$filename);
		$idxName = count($arrName);
		$ext = $arrName[$idxName-1];
		
		$config['upload_path'] = 'assets/images/dokter/'; //path folder
		$config['allowed_types'] = 'gif|jpg|png|jdok|bmp'; //type yang dapat diakses bisa anda sesuaikan
		$config['encrypt_name'] = FALSE; //Enkripsi nama yang terupload
		$config['overwrite'] = TRUE; //Enkripsi nama yang terupload
		$config['file_name'] = $jenis.".".$ext; //ganti nama file

		$this->upload->initialize($config);
		if(!empty($_FILES['dok_foto']['name'])){
			if ($this->upload->do_upload('dok_foto')){
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library']='gd2';
				$config['source_image']='assets/images/dokter/'.$gbr['file_name'];
				$config['create_thumb']= FALSE;
				$config['maintain_ratio']= FALSE;
				$config['quality']= '50%';
				$config['width']= 150;
				$config['height']= 150;
				$config['new_image']= 'assets/images/dokter/thumbs/'.$gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				$foto=$gbr['file_name'];
			}
			else
			{
				die($this->upload->display_errors());
			}
			$data = array(
				'dok_nama' => $nama,
				'dok_jenis' => $jenis,
				'dok_tempat_lahir' => $tempat_lahir,
				'dok_tgl_lahir' => $tgl_lahir,
				'dok_jk' => $jk,
				'dok_nip' => $nip,
				'dok_alamat' => $alamat,
				'dok_nip' => $nip,
				'dok_telp' => $dok_telp,
				'dok_foto' => $foto,
			);
		}		
		else
		{
			$data = array(
				'dok_nama' => $nama,
				'dok_jenis' => $jenis,
				'dok_tempat_lahir' => $tempat_lahir,
				'dok_tgl_lahir' => $tgl_lahir,
				'dok_jk' => $jk,
				'dok_nip' => $nip,
				'dok_alamat' => $alamat,
				'dok_nip' => $nip,
				'dok_telp' => $dok_telp,
			);
		}
		if ($id == 0)
		{
			$insert = $this->dokter->simpan("srk_dokter", $data);
		}
		else 
		{
			$insert = $this->dokter->update("srk_dokter", array('dok_id' => $id), $data);	
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
		$delete = $this->dokter->delete('srk_dokter', 'dok_id', $id);
		unlink('assets/images/dokter/'.$foto);
		unlink('assets/images/dokter/thumbs/'.$foto);
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