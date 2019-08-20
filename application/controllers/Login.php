<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
    parent::__construct();
  	$this->load->model('Model_Login');
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
		if ($this->session->userdata('id_user')) {
		  redirect(base_url('dashboard'));
		}
		else 
		{
			$this->session->set_userdata("judul","Home");
			$this->load->view('login');			
		}
	}
	
	public function proses() {
    $this->form_validation->set_rules('username', 'Username', 'required|trim|xss_clean',  array('required' => '%s tidak boleh kosong.'));
    $this->form_validation->set_rules('password', 'Password', 'required|trim|xss_clean', array('required' => '%s tidak boleh kosong.'));
    if ($this->form_validation->run() == FALSE) {
        
		$this->load->view('login');
    } else {
      $usr = $this->input->post('username');
      $psw = $this->input->post('password');
      $u = $usr;
      $p = $psw;
      $cek = $this->Model_Login->cek($u, $p);
      if ($cek->num_rows() > 0) {
        //login berhasil, buat session
        foreach ($cek->result() as $qad) {
		  $sess_data['id_user'] = $qad->log_id;
		  $sess_data['username'] = $qad->log_user;
		  $sess_data['password'] = $qad->log_pass;
		  $sess_data['nama'] = $qad->log_nama;
		  $sess_data['level'] = $qad->log_level;
		  $sess_data['fotokecil'] = base_url("assets/assets/dist/img/logo.png");
		  $sess_data['foto'] = base_url("assets/assets/dist/img/logo.png");
          $this->session->set_userdata($sess_data);
        }
        $this->session->set_flashdata('success', 'Login Berhasil !');
        redirect(base_url('dashboard'));
      } else {
        $this->session->set_flashdata('result_login', '
Username atau Password yang anda masukkan salah.'.$u.'-'.$p);
        redirect(base_url('login'));
      }
    }
  }
  
  public function ubah_pass()
	{
		$this->form_validation->set_rules('log_pass', 'Password Lama', 'required|trim|xss_clean',  array('required' => '%s tidak boleh kosong.'));
		$this->form_validation->set_rules('log_passBaru', 'Password Baru', 'required|trim|xss_clean', array('required' => '%s tidak boleh kosong.'));
		$this->form_validation->set_rules('log_passBaru2', 'Konfirmasi Password Baru', 'required|trim|xss_clean', array('required' => '%s tidak boleh kosong.'));
		if ($this->form_validation->run() == FALSE) 
		{
			$up_data['status'] = FALSE;
			$up_data['pesan'] = validation_errors();
		} 
		else 
		{
			$u = $this->session->userdata("username");
			$p = $this->input->post('log_pass');
			$cek = $this->Model_Login->cek($u, $p, $this->session->userdata("level"));
			if ($cek->num_rows() > 0)
			{
				$data = array(
						'log_pass' => md5($this->input->post('log_passBaru'))
					);
				$this->Model_Login->update('srk_login', array('log_user' => $u, 'log_pass' => md5($p)), $data);
				$up_data['status'] = TRUE;
				$up_data['pesan'] = "Password berhasil diubah";
			}
			else 
			{
				$up_data['status'] = FALSE;
				$up_data['pesan'] = "Password lama salah";
			}
		}
		echo json_encode($up_data);
		// die($cek);
	}
	
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url("login"));
	}
	
}