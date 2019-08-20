<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct() {
   	parent::__construct();
  	if (!isset($this->session->userdata['id_user'])) {
  	redirect(base_url("login"));
  	}
  	$this->load->model('Model_Dashboard','dashboard');
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
	public function index()
	{
		$ba = [
			'judul' => "Dashboard",
			'subjudul' => "",
		];
		$this->load->view('background_atas', $ba);
		$this->load->view('dashboard');
		$this->load->view('background_bawah');
	}
	
	public function get_list_nopol()
	{
		$D = [
		'list' => $this->dashboard->get_list_nopol($this->session->userdata("kdwil")),
		];
		$this->load->view('dashboard_list_nopol', $D);
	}
	
	
	public function get_pembayaran_terakhir($npl, $start)
	{
		$bayar_terakhir = $this->dashboard->get_pembayaran_terakhir($npl, $start);
		$jml_bayar = $this->dashboard->get_total_penetapan_per_nopol($npl);
		$model = $this->dashboard->cari_mdl($bayar_terakhir->KodeModel);
		if(!empty($model))
			{$modelnya=$model->NamaModelKendaraan;} else
			{$modelnya="-";}
		
		$model_lama = $this->dashboard->cari_mdl($bayar_terakhir->KodeModelLama);
		if(!empty($model_lama))
			{$model_lamanya=$model_lama->NamaModelKendaraan;} else
			{$model_lamanya="-";}
		
		$nik = $this->dashboard->cari_nik($npl);
		if(!empty($nik))
			{$niknya=$nik->NoKTP;} else
			{$niknya="-";}
		
		$back = 1;
		$next = 1;
		if ($jml_bayar == $start + 1)
		{
			$back = 0;
		}
		if ($start == 0)
		{
			$next = 0;
		}
		
		$D = [
		'fq' => $bayar_terakhir,
		'back' => $back,
		'next' => $next,
		'start' => $start,
		'nik' => $niknya,
		'model' => $modelnya,
		'model_lama' => $model_lamanya,
		'nopol' => str_replace("%20", " ",$npl),
		];
		$this->load->view('dashboard_pembayaran_terakhir', $D);
	}
	
	public function get_data_kendaraan($npl)
	{
		$dataken = $this->dashboard->get_data_kendaraan($npl);
		$model = $this->dashboard->cari_mdl($dataken->KodeModel);
		if(!empty($model))
			{$modelnya=$model->NamaModelKendaraan;} else
			{$modelnya="-";}
	
		$D = [
		'fq' => $dataken,
		'model' => $modelnya,
		'nopol' => str_replace("%20", " ",$npl),
		];
		$this->load->view('dashboard_data_kendaraan', $D);
	}
	
	
	public function filter_per_upt($id_upt)
	{
		$this->session->set_userdata(array('kdwil' => $id_upt));
	}
	
	public function ajax_list_dashboard($nopol)
	{
		$list = $this->dashboard->get_datatables($nopol);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $dashboard) {		
			$upt = $this->dashboard->cariupt($dashboard->KodeWilayah);
			if(!empty($upt))
			{$nama_upt=$upt->NamaUPTUP;}
			
			$row = array();
			$row[] = $dashboard->TglUPD;
			$row[] = $dashboard->Proses;
			$row[] = $dashboard->Keterangan;
			$row[] = $nama_upt;
			$row[] = $dashboard->UserUPD;
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->dashboard->count_all(),
						"recordsFiltered" => $this->dashboard->count_filtered($nopol),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url("login"));
	}
	
}
