<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<!-- BEGIN HEAD -->
<head>
     <meta charset="UTF-8" />
    <title>Login | <?= $this->session->userdata("judul");?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
     <!-- PAGE LEVEL STYLES -->
         <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?= base_url("assets/");?>assets/bootstrap/css/bootstrap.css">
	<!-- Custom Checkbox -->
    <link rel="stylesheet" href="<?= base_url("assets/");?>assets/css/rch.css">
    <link rel="stylesheet" href="<?= base_url("assets/");?>assets/css/login.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url("assets/");?>assets/css/font-awesome-min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= base_url("assets/");?>assets/css/ionicons-min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url("assets/");?>assets/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?= base_url("assets/");?>assets/dist/css/skins/_all-skins.min.css">
     <!-- END PAGE LEVEL STYLES -->
   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
<body >

   <!-- PAGE CONTENT --> 
    <div class="container">
	
    <div class="text-center">
		<img src="<?= base_url("assets/");?>assets/dist/img/logo.png" class="logo-login">
	</div>
    <div class="text-center">
        <h3>LOGIN SISTEM REGISTRASI RAWAT JALAN</h3>
    </div>
    <div class="tab-content">
        <div id="login" class="tab-pane active">
			<form action="<?php echo base_url('login/proses'); ?>" method="post" class="form-signin">
                <p class="text-muted text-center btn-block btn btn-primary btn-rect">
                    Enter your username and password
                </p>
                <input type="text" placeholder="Username" class="form-control" name="username" />
                <input type="password" placeholder="Password" class="form-control" name="password" />
                <button class="btn text-muted text-center btn-danger" type="submit">Sign in</button>
      					<?php if (validation_errors() || $this->session->flashdata('result_login')) { ?> 
            			<div class="alert alert-danger animated fadeInDown" role="alert" id="infoAlert">
                		<button type="button" class="close" data-dismiss="alert" id="btnInfoAlert">&times;</button>
                		<strong>Peringatan!</strong>
                		<?php echo validation_errors(); ?>
                		<?php echo $this->session->flashdata('result_login'); ?>
            			</div>
      					<?php } ?>
            </form>
        </div>
    </div>


</div>

	  <!--END PAGE CONTENT -->     
	      
      <!-- PAGE LEVEL SCRIPTS -->
    <!-- jQuery 2.1.4 -->
    <script src="<?= base_url("assets/");?>assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?= base_url("assets/");?>assets/bootstrap/js/bootstrap.js"></script>
   <script src="<?= base_url("assets/"); ?>assets/js/login.js"></script>
      <!--END PAGE LEVEL SCRIPTS -->

</body>
    <!-- END BODY -->
</html>
