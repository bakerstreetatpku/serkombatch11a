<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD-->
<head>
   
     <meta charset="UTF-8" />
    <title><?= $this->session->userdata("username")." | ".$this->session->userdata("judul");?></title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <!-- GLOBAL STYLES -->
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?= base_url("assets/");?>assets/bootstrap/css/bootstrap.css">
	<!-- Custom Checkbox -->
    <link rel="stylesheet" href="<?= base_url("assets/");?>assets/css/rch.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url("assets/");?>assets/css/font-awesome-min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url("assets/");?>assets/css/ionicons-min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url("assets/");?>assets/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?= base_url("assets/");?>assets/dist/css/skins/_all-skins.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url("assets/"); ?>assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url("assets/"); ?>assets/plugins/datatables/buttons.dataTables.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url("assets/"); ?>assets/plugins/datatables/dataTables.bootstrap.css">
    <!-- Daterange picker --
    <link rel="stylesheet" href="<?= base_url("assets/"); ?>assets/plugins/datatables/jquery.dataTables.css">
    <!--END GLOBAL STYLES -->
    <!-- PAGE LEVEL STYLES -->
    <!-- jQuery 2.1.4 -->
    <script src="<?= base_url("assets/");?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?= base_url("assets/");?>assets/bootstrap/js/bootstrap.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url("assets/");?>assets/dist/js/app.js"></script>
    <!-- Custom JS -->
    <script src="<?= base_url("assets/");?>assets/js/rch.js"></script>
    <!-- AdminLTE for demo purposes --
    <script src="<?= base_url("assets/");?>assets/dist/js/demo.js"></script>
    <!-- END PAGE LEVEL  STYLES -->
       <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
    <!-- END  HEAD-->
    <!-- BEGIN BODY-->
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><img src="<?= base_url("assets/");?>assets/dist/img/logo.png" class="logo-atas"></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SI REG</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">	
          </a>
		  <a href="#" class="" style="margin-left:10px;background-width:10%;"></a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
			
              <li class="">
				<a  href=""><i class="glyphicon glyphicon-refresh"></i> </a>
			  </li>
            
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?= $this->session->userdata("foto");?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?= $this->session->userdata("username");?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?= $this->session->userdata("foto");?>" class="img-circle" alt="User Image">
                    <p>
                      <?= $this->session->userdata("nama");?>
                      <small></small>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#"></a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#"></a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#"></a>
                    </div>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <button data-target="#ubah_pass" data-toggle="modal" class="btn btn-primary btn-flat">Ubah Password</button>
                    </div>
                    <div class="pull-right">
                      <button data-target="#konfirm_logout" data-toggle="modal" class="btn btn-danger btn-flat">Logout</button>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
         
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
          <!-- sidebar menu: : style can be found in sidebar.less -->
            <li class="header">HOME</li>
			<li class="active"><a href="<?= base_url("dashboard");?>"><i class="fa fa-home"></i> <span>Home</span></a></li>
			
            <li class="header">MENU UTAMA</li>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <!-- hide menu -->
			<li class="treeview" nm="Data Master">
              <a href="#">
                <i class="fa fa-th"></i> <span>Data Master</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
					<li class="active"><a href="<?= base_url("pasien/tampil");?>"><i class="fa fa-angle-double-right"></i> <span>Pasien</span></a></li>
					<li><a href="<?= base_url("dokter/tampil");?>"><i class="fa fa-angle-double-right"></i> <span>Dokter</span></a></li>
					<li><a href="<?= base_url("poly/tampil");?>"><i class="fa fa-angle-double-right"></i> <span>Polyklinik</span></a></li>
					<li><a href="<?= base_url("spesialis/tampil");?>"><i class="fa fa-angle-double-right"></i> <span>Spesialis</span></a></li>
					<li><a href="<?= base_url("polydokter/tampil");?>"><i class="fa fa-angle-double-right"></i> <span>Poly - Dokter</span></a></li>
					<li><a href="<?= base_url("spesialisdokter/tampil");?>"><i class="fa fa-angle-double-right"></i> <span>Spesialis - Dokter</span></a></li>
					<!-- hide menu --
					<li class="active"><a href="<?= base_url("tetapbelumbayar/tampil");?>"><i class="fa fa-tag"></i> <span>Satuan</span></a></li>
					<!-- hide menu -->
              </ul>
            </li>
          <!-- hide menu -->
			<li class="treeview" nm="Proses">
              <a href="#">
                <i class="fa fa-cog"></i> <span>Proses</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
					<li><a href="<?= base_url("registrasi/tampil");?>"><i class="fa fa-file"></i> <span>Registrasi Rawat Jalan</span></a></li>
              </ul>
            </li>
          <!-- sidebar menu: : style can be found in sidebar.less -->
            <li class="header">LINK TERKAIT</li>
            <li><a href="https://bnsp.go.id/" target="_blank"><i class="fa fa-angle-right text-aqua"></i> <span>BNSP</span></a></li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            <label id="jdl"><?= $judul;?></label>
            <small id="submn"><?= $subjudul;?></small>
          </h1>
		  <div class="col-md-12">
		  <ol class="breadcrumb">
            <li style="width:100%;"><a href="#">
				<marquee style="background:white;border-radius:5px; color:black; "scrolldelay="1" scrollamount="3" direction="left">Sistem Informasi Penilaian Prestasi Kerja <b>Pegawai Yayasan Pembangunan Rokan Hulu (YPRH), Universitas Pasir Pangaraian</b> [copyright &copy; 2019] </marquee>
			</a></li>
          </ol>
		  </div>
        </section>
		

	<!-- Modal Informasi Tutup -->
		<div class="modal fade" id="info_tutup" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-info-circle"></i> Informasi</h4>
			  </div>
			  <div class="modal-body" id="pesan_info_tutup">
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="tutup_info_tutup">Tutup <b style="font-size:18px;">(غطاء)</b></button>
			  </div>
			</div>
		  </div>
		</div>
		
		
	<!-- Modal Informasi OK -->
		<div class="modal fade" id="info_ok" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-info-circle"></i> Informasi</h4>
			  </div>
			  <div class="modal-body" id="pesan_info_ok">
			  </div>
			  <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" id="ok_info_ok">OK <b style="font-size:18px;">(حسناً)</b></button>
			  </div>
			</div>
		  </div>
		</div>
		
		

	<!-- Bootstrap modal -->
	<div class="modal fade" id="konfirm_logout" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title"><i class="glyphicon glyphicon-info"></i> Konfirmasi Logout</h3>
				</div>
				<div class="modal-body form">
					<form action="#" id="form" class="form-horizontal">
						<div class="form-body">
							Yakin ingin logout sistem ?
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<a type="button" href="<?= base_url("login/logout");?>" class="btn btn-primary">Ya</a>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Tidak</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<!-- Bootstrap modal -->
	<div class="modal fade" id="ubah_pass" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title"><i class="glyphicon glyphicon-info"></i> Ubah Password</h3>
				</div>
				<form role="form  col-lg-6" name="ubahPass" id="frm_ubahpass">
				<div class="modal-body form">
						<input type="hidden" name="pgnID" value="<?php $this->session->userdata("id_user");?>">
						<div class="form-group">
							<label>Password Lama</label>
							<div class="input-group">
								<input type="text" class="form-control infonya" name="log_pass" id="log_pass" placeholder="Password Lama" value="">
								<div class="input-group-addon" data-toggle="tooltip" title="asd" id="up_passlama" nama="password">
									<i class="fa fa-info-circle text-danger"></i>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Password Baru</label>
							<div class="input-group">
								<input type="text" class="form-control infonya" name="log_passBaru" id="log_passBaru" placeholder="Password Baru" value="">
								<div class="input-group-addon " id="up_passbaru" nama="password baru">
									<i class="fa fa-info-circle text-danger"></i>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label>Konfirmasi Password Baru</label>
							<div class="input-group">
								<input type="text" class="form-control infonya" name="log_passBaru2" id="log_passBaru2" placeholder="Konfirmasi Password Baru" value="">
								<div class="input-group-addon " id="up_passbaru" nama="konfirmasi password baru">
									<i class="fa fa-info-circle text-danger"></i>
								</div>
							</div>
						</div>
						<div class="alert alert-danger animated fadeInDown" role="alert" id="up_infoalert">
							<button type="button" class="close" data-dismiss="alert">&times;</button>
							<div id="up_pesan"></div>
            			</div>
				</div>
				<div class="modal-footer">
					<button type="button" id="up_simpan" class="btn btn-primary">Simpan</a>
					<button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
				</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
		<!-- Modal Konfirmasi Ya Tidak -->	
	<div class="modal fade" id="frmKonfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="jdlKonfirm">Konfirmasi Pembatalan Verifikasi</h4>
		  </div>
		  <div class="modal-body">
			<div id="isiKonfirm"></div>
			<input type="hidden" name="idSts" id="idSts">
			<input type="hidden" name="hapusfoto" id="hapusfoto">
			<input type="hidden" name="modeKonfirm" id="modeKonfirm">
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn utama btn-primary" data-dismiss="modal" id="yaKonfirm">Ya <b style="font-size:18px;">(نعم)</b></button>
			<button type="button" class="btn utama btn-danger" data-dismiss="modal" id="tidakKonfirm">Tidak <b style="font-size:18px;">(لا)</b></button>
			<a href="" class="btn btn-success cadangan" id="okKonfirm" style="display:none;">OK <b style="font-size:18px;">(حسناً)</b></a>
		  </div>
		</div>
	  </div>
	</div>
	
	<!-- Modal Konfirmasi Ya Tidak -->	
	<div class="modal fade" id="frmKonfirm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h4 class="modal-title" id="jdlKonfirm2">Konfirmasi Pembatalan Verifikasi</h4>
		  </div>
		  <div class="modal-body">
			<div id="isiKonfirm2"></div>
			<input type="hidden" name="idSts" id="idSts">
			<input type="hidden" name="modeKonfirm2" id="modeKonfirm2">
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn utama btn-primary" data-dismiss="modal" id="yaKonfirm2">Ya <b style="font-size:18px;">(نعم)</b></button>
			<a href="" class="btn utama btn-danger" id="tidakKonfirm2">Tidak <b style="font-size:18px;">(لا)</b></a>
		  </div>
		</div>
	  </div>
	</div>

	<!-- Modal Informasi OK -->
		<div class="modal fade" id="frmOK" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h4 class="modal-title" id="jdlOK">Hasil Hapus Data</h4>
			  </div>
			  <div class="modal-body" id="isiOK">
			  </div>
			  <div class="modal-footer">
				<a href="" class="btn btn-default" id="okOK">OK <b style="font-size:18px;">(حسناً)</b></a>
			  </div>
			</div>
		  </div>
		</div>
		
	<script src="<?= base_url("assets/");?>assets/js/ubah_pass.js"></script>