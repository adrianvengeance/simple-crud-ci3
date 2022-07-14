<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=$judul;?></title>
    <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
	<script type="text/javascript" src="<?=base_url('assets/sweetalert/dist/sweetalert2.min.js');?>"></script> 
	<link rel="stylesheet" href="<?=base_url('assets/sweetalert/dist/sweetalert2.css');?>" type="text/css">

  </head>
  <body>
	<div class="container-fluid">
		<div class="row">
		  <div class="col-md-4"></div>
		  <div class="col-md-4">
			<h1 class="text-center">Halaman Login</h1>
			<form method="post" action="<?=base_url();?>login/masuk_login">
			  <div class="form-group">
				<label for="exampleInputEmail1">Username</label>
				<input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Masukkan Username">
			  </div>
			  <div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder=" Masukkan Password">
			  </div>
			  <button type="submit" class="btn btn-default">Login</button>
			</form>
			<?php echo $this->session->flashdata('pesan');?>
			<p class="text-right"><a href="<?=base_url();?>pendaftaran">Belum Mempunyai Akun? Klik untuk daftar</a></p>
		  </div>
		  <div class="col-md-4"></div>
		</div>
	</div>
   
    <script src="<?=base_url();?>assets/js/jquery-1.12.4.min.js"></script>
    <script src="<?=base_url();?>assets/js/bootstrap.min.js"></script>
  </body>
</html>