<?php
  class Model_Dashboard extends CI_Model {
  
  	var $table = 'log_siveri';
	var $column_order = array('log_tgl',null); //set column field database for datatable orderable
	var $column_search = array(null); //set column field database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('log_tgl' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();

	}
	
	public function get_log()
	{
		$this->db->from("log_siveri");
		$this->db->order_by("log_tgl","desc");
		$this->db->limit(10);
		$query = $this->db->get();

		return $query->result();
	}
	
	public function cari_mdl($id)
	{
		$this->db_sts->from("dm_model");
		$this->db_sts->where('KodeModelKendaraan',$id);
		$query = $this->db_sts->get();

		return $query->row();
	}
	
	public function cari_nik($npl)
	{
		$nopol = explode("%20",$npl);
		$this->db_sts->select("NoKTP");
		$this->db_sts->from("dm_kendaraan");
		$this->db_sts->where("SeriWilayah", $nopol[0]);
		$this->db_sts->where("Nopol", $nopol[1]);
		$this->db_sts->where("Seri", $nopol[2]);
		$this->db_sts->limit(1);
		$query = $this->db_sts->get();

		return $query->row();
	}
	
	public function get_sts()
	{
		$this->db->from("dt_siveri_sts");
		$query = $this->db->get();

		return $query->num_rows();
	}
	
	public function get_bbm()
	{
		$this->db->from("dm_siveri_jenisbahanbakar");
		$query = $this->db->get();

		return $query->num_rows();
	}
	
	public function get_wp($untuk)
	{
		$this->db->from("dm_siveri_wp");
		$this->db->where("wp_peruntukan", $untuk);
		$query = $this->db->get();

		return $query->num_rows();
	}
	
	public function get_pengguna($apps)
	{
		$this->db->from("tgk_login");
		$this->db->where("logApps", $apps);
		$this->db->where("logLevel > 1");
		$query = $this->db->get();

		return $query->num_rows();
	}
	
	public function get_total_penetapan_per_nopol($npl)
	{
		$nopol = explode("%20",$npl);
		$this->db_sts->from("dpd_penetapan");
		$this->db_sts->where("SeriWilayah", $nopol[0]);
		$this->db_sts->where("Nopol", $nopol[1]);
		$this->db_sts->where("Seri", $nopol[2]);
		$query = $this->db_sts->get();

		return $query->num_rows();
	}
	
	public function get_data_kendaraan($npl)
	{
		// echo $npl;
		$nopol = explode("%20",$npl);
		$this->db_master->select("KodeWilayah, NoKTP, PenerbitBPKB, NoRegisterBPKB, KodeLokasiDaftar, TglFiskal, TglFaktur, NamaPemilik, Alamat, Merk, Type, NoMesin, NoRangka, TahunPembuatan, IsiCylinder, NoBPKB, NoSTNK, NoSKPD, NoFaktur, KodeTNKB, KodeModel, TglPKBLalu, TglPKB, TglSTNK, TglSTNKLalu, TglCetakBPKB, TglCetakSTNK, TglBayarPKB, TglUPD, KodeJenisPendaftaran, KodeKeterangan, KodeFungsi");
		$this->db_master->from("dm_kendaraan");
		$this->db_master->where("SeriWilayah", $nopol[0]);
		$this->db_master->where("NoPol", $nopol[1]);
		$this->db_master->where("Seri", $nopol[2]);
		$query = $this->db_master->get();
		// echo $query = str_replace( array("\r", "\n", "\t"), '', trim($this->db_master->last_query()) );
		return $query->row();
	}
	
	public function get_pembayaran_terakhir($npl, $start)
	{
		// echo $npl;
		$nopol = explode("%20",$npl);
		$this->db_samsat->select("KodeWilayah, KodeFungsi, TglSTNK, TglSTNKlalu, PetugasPenetapan, TglDaftar, TglTetap, TglFiskal, TglFaktur, NamaPemilik, Alamat, Merk, Type, NoMesin, Norangka, TahunPembuatan, IsiCylinder, KodeTNKB, KodeModel, TglCetakSKPD, TglPKBLalu, TglPKB, NoSKPD, NoValidasi, KodeLokasiBayar, KodeJenisPendaftaran, KodeJenisKendaraan, KodeKeteranganPendaftaran, NopolLama, SeriLama, NamaPemilikLama, AlamatLama, KodeModelLama,KodeTNKBLama, Koding, NilaiLelang, RubahBentuk, NilaiJual, Bobot, DasarPKB, PokokBBN, DendaBBN, PokokPKB, DendaPKB, PokokSWDK, DendaSWDK, PokokBBNT1, PokokBBNT2, PokokBBNT3, PokokBBNT4, PokokBBNT5, DendaBBNT1, DendaBBNT2, DendaBBNT3, DendaBBNT4, DendaBBNT5, PokokPKBT1, PokokPKBT2, PokokPKBT3, PokokPKBT4, PokokPKBT5, DendaPKBT1, DendaPKBT2, DendaPKBT3, DendaPKBT4, DendaPKBT5, PokokSWDKT1, PokokSWDKT2, PokokSWDKT3, PokokSWDKT4, PokokSWDKT5, DendaSWDKT1, DendaSWDKT2, DendaSWDKT3, DendaSWDKT4, DendaSWDKT5, DendaKasBBN, DendaKasPKB, Total");
		$this->db_samsat->from("penetapan");
		$this->db_samsat->where("SeriWilayah", $nopol[0]);
		$this->db_samsat->where("Nopol", $nopol[1]);
		$this->db_samsat->where("Seri", $nopol[2]);
		$this->db_samsat->order_by("TglCetakSKPD", "desc");
		$this->db_samsat->limit(1, $start);
		$query = $this->db_samsat->get();
		// echo $query = str_replace( array("\r", "\n", "\t"), '', trim($this->db_samsat->last_query()) );
		return $query->row();
	}
	
	public function get_list_nopol($kdwil)
	{
		if ($kdwil > 0) {
			$limit = 0;
			$filkdwil = "and KodeLokasiBayar = $kdwil";
		} else {
			$limit = 1;
			$filkdwil = "";
		}
		$this->db_sts->select("NamaUPTUP AS Wilayah, CONCAT(SeriWilayah, ' ',Nopol, ' ',Seri) AS Nopol, RIGHT(TglCetakSKPD, 8) AS Jam");
		$this->db_sts->from("dpd_penetapan a");
		$this->db_sts->join("dm_wilayahsamsat b", "a.KodeLokasiBayar = b.KodeWilayah");
		$this->db_sts->where("TglCetakSKPD >= CONCAT(CURDATE(), ' 00:00:00') AND TglCetakSKPD <= CONCAT(CURDATE(), ' 23:59:59') $filkdwil");
		$this->db_sts->order_by("TglCetakSKPD", "desc");
		if ($limit == 1)
		{
			$this->db_sts->limit(100,0);
		}
		$query = $this->db_sts->get();

		return $query->result();
	}
	
	
	
	public function gettotal($tgl1, $uptnya)
	{
		$tgls = explode("%20-%20", $tgl1);
		$this->db_samsat->select("COUNT(*) AS jml, SUM(PokokSWDK) AS pokokswdk, SUM(DendaSWDK) AS dendaswdk, SUM(PokokSWDKT1 + PokokSWDKT2 + PokokSWDKT3 + PokokSWDKT4 + PokokSWDKT5) AS pokoktgkswdk, SUM(DendaSWDKT1 + DendaSWDKT2 + DendaSWDKT3 + DendaSWDKT4 + DendaSWDKT5) AS dendatgkswdk, SUM(Prorata) AS prorata");
		$this->db_samsat->from($this->table);
		$this->db_samsat->where("TglCetakSKPD >=", $tgls[0]." 00:00:00");
		$this->db_samsat->where("TglCetakSKPD <=", $tgls[1]." 23:59:59");
		if ($uptnya > 0)
		{
			$this->db_samsat->where("KodeLokasiBayar =", $uptnya);
		}
		$query = $this->db_samsat->get();

		return $query->row();
	}
	
	public function gethari($tgl1, $uptnya)
	{
		$tgls = explode("%20-%20", $tgl1);
		// $this->db_samsat->distinct("TglCetakSKPD");
		$this->db_samsat->from($this->table);
		$this->db_samsat->where("TglCetakSKPD >=", $tgls[0]." 00:00:00");
		$this->db_samsat->where("TglCetakSKPD <=", $tgls[1]." 23:59:59");
		if ($uptnya > 0)
		{
			$this->db_samsat->where("KodeLokasiBayar =", $uptnya);
		}
		$this->db_samsat->group_by("DATE(TglCetakSKPD)");
		$query = $this->db_samsat->get();

		return $query->num_rows();
	}
	
	public function getupt()
	{
		$this->db_sts->from("dm_wilayahsamsat");
		$query = $this->db_sts->get();

		return $query->result();
	}
	
	public function cariupt($id)
	{
		$this->db_sts->from("dm_wilayahsamsat");
		$this->db_sts->where('KodeWilayah',$id);
		$query = $this->db_sts->get();

		return $query->row();
	}
	
  }
?>