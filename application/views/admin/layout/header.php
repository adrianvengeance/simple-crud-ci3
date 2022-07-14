<nav class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Brand</a>
		</div>
		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="#">Ujian</a></li>
				<li><a href="#">Nilai</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Master Data <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="<?= base_url(); ?>welcome">Fakultas</a></li>
						<li><a href="<?= base_url(); ?>prodi">Program Studi</a></li>
						<li><a href="<?= base_url(); ?>mahasiswa">Mahasiswa</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#">Link</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $this->session->userdata('nama_user'); ?> <span class="caret"></span></a>
					<ul class="dropdown-menu">
						<li><a href="#">Profil</a></li>
						<li><a href="<?= base_url(); ?>login/keluar">Keluar</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>