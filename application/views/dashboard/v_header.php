<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>SPMI UPR | Dashboard</title>
	<link href="<?php echo base_url() . '/gambar/website/logo.png' ?>" rel="icon">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/skins/_all-skins.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/morris.js/morris.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/jvectormap/jquery-jvectormap.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bower_components/bootstrap-daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<div class="wrapper">

		<header class="main-header">
			<a href="<?php echo base_url(); ?>" class="logo">
				<span class="logo-mini"><b>SPMI</b></span>
				<span class="logo-lg"><b>SPMI</b> UPR</span>
			</a>

			<nav class="navbar navbar-static-top">

				<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>

				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
								<span class="hidden-xs">HAK AKSES : <b><?php echo $this->session->userdata('level') ?></b></span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header">
									<img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
									<p>
										<?php echo $this->session->userdata('username') ?>
										<small>Hak akses : <?php echo $this->session->userdata('level') ?></small>
									</p>
								</li>

								<li class="user-footer">
									<div class="pull-left">
										<a href="<?php echo base_url() . 'dashboard/profil' ?>" class="btn btn-default btn-flat">Profil</a>
									</div>
									<div class="pull-right">
										<a href="<?php echo base_url() . 'dashboard/keluar' ?>" class="btn btn-default btn-flat">Keluar</a>
									</div>
								</li>
							</ul>
						</li>

					</ul>
				</div>
			</nav>
		</header>
		<aside class="main-sidebar">
			<section class="sidebar">
				<div class="user-panel">
					<div class="pull-left image">
						<img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
					</div>
					<div class="pull-left info">
						<?php
						$id_user = $this->session->userdata('id');
						$user = $this->db->query("select * from pengguna where pengguna_id='$id_user'")->row();
						?>
						<p><?php echo $user->pengguna_nama; ?></p>
						<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
					</div>
				</div>

				<ul class="sidebar-menu" data-widget="tree">
					<li class="header">MAIN NAVIGATION</li>
					<li>
						<a href="<?php echo base_url() . 'dashboard' ?>">
							<i class="fa fa-dashboard"></i>
							<span>DASHBOARD</span>


						</a>
					</li>
					<?php
					if ($this->session->userdata('level') == "admin") {
					?>
						<li>
							<a href="<?php echo base_url() . 'dashboard/kategori' ?>">
								<i class="fa fa-th"></i>
								<span>KATEGORI</span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url() . 'dashboard/fakultas' ?>">
								<i class="fa fa-university"></i>
								<span>Fakultas & Prodi</span>
							</a>
						</li>
					<?php
					}
					?>
					<?php
					if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "auditee" || $this->session->userdata('level') == "verifikator") {
					?>
						<li class="treeview">
							<a href="">
								<i class="fa fa-folder"></i><span>SPMI</span>
								<span class="pull-right-container">
									<i class="fa fa-angle-left pull-right"></i>
								<?php
								if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
								?>
									<?php if ($this->fungsi->penetapan()+$this->fungsi->pelaksanaan()+$this->fungsi->evaluasi()+$this->fungsi->pengendalian()+$this->fungsi->peningkatan() == 0)  { 
									?>
									<span class="pull-right-container">
										<small class="label pull-right bg-green"><?=$this->fungsi->penetapan()+$this->fungsi->pelaksanaan()+$this->fungsi->evaluasi()+$this->fungsi->pengendalian()+$this->fungsi->peningkatan()?></small>
									</span>
									<?php
									} else  { 
										?>
										<span class="pull-right-container">
											<small class="label pull-right bg-red"><?=$this->fungsi->penetapan()+$this->fungsi->pelaksanaan()+$this->fungsi->evaluasi()+$this->fungsi->pengendalian()+$this->fungsi->peningkatan()?></small>
										</span>
										<?php
										}
										?>
								<?php
								}
								?>
								</span>
							</a>
							<ul class="treeview-menu">
								<li><a href="<?php echo base_url() . 'spmi/penetapan' ?>"><i class="fa fa-circle-o"></i> Penetapan
										<?php
										if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
										?>		
											<?php if ($this->fungsi->penetapan() == 0)  { 
											?>
											<span class="pull-right-container">
												<small class="label pull-right bg-green"><?=$this->fungsi->penetapan()?></small>
											</span>
											<?php
											} else  { 
												?>
												<span class="pull-right-container">
													<small class="label pull-right bg-red"><?=$this->fungsi->penetapan()?></small>
												</span>
												<?php
												}
												?>
										<?php
										}
										?>
									</a>
								</li>
								<li><a href="<?php echo base_url() . 'spmi/pelaksanaan' ?>"><i class="fa fa-circle-o"></i> Pelaksanaan
										<?php
										if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
										?>		
											<?php if ($this->fungsi->pelaksanaan() == 0)  { 
											?>
											<span class="pull-right-container">
												<small class="label pull-right bg-green"><?=$this->fungsi->pelaksanaan()?></small>
											</span>
											<?php
											} else  { 
												?>
												<span class="pull-right-container">
													<small class="label pull-right bg-red"><?=$this->fungsi->pelaksanaan()?></small>
												</span>
												<?php
												}
												?>
										<?php
										}
										?>
									</a>
								</li>
								<li><a href="<?php echo base_url() . 'spmi/evaluasi' ?>"><i class="fa fa-circle-o"></i> Evaluasi
										<?php
										if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
										?>	
											<?php if ($this->fungsi->evaluasi() == 0)  { 
											?>
											<span class="pull-right-container">
												<small class="label pull-right bg-green"><?=$this->fungsi->evaluasi()?></small>
											</span>
											<?php
											} else  { 
												?>
												<span class="pull-right-container">
													<small class="label pull-right bg-red"><?=$this->fungsi->evaluasi()?></small>
												</span>
												<?php
												}
												?>
										<?php
										}
										?>
									</a>
								</li>
								<li><a href="<?php echo base_url() . 'spmi/pengendalian' ?>"><i class="fa fa-circle-o"></i> Pengendalian
										<?php
										if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
										?>		
											<?php if ($this->fungsi->pengendalian() == 0)  { 
											?>
											<span class="pull-right-container">
												<small class="label pull-right bg-green"><?=$this->fungsi->pengendalian()?></small>
											</span>
											<?php
											} else  { 
												?>
												<span class="pull-right-container">
													<small class="label pull-right bg-red"><?=$this->fungsi->pengendalian()?></small>
												</span>
												<?php
												}
												?>
										<?php
										}
										?>
									</a>
								</li>
								<li><a href="<?php echo base_url() . 'spmi/peningkatan' ?>"><i class="fa fa-circle-o"></i> Peningkatan
										<?php
										if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
										?>	
											<?php if ($this->fungsi->peningkatan() == 0)  { 
											?>
											<span class="pull-right-container">
												<small class="label pull-right bg-green"><?=$this->fungsi->peningkatan()?></small>
											</span>
											<?php
											} else  { 
												?>
												<span class="pull-right-container">
													<small class="label pull-right bg-red"><?=$this->fungsi->peningkatan()?></small>
												</span>
												<?php
												}
												?>
										<?php
										}
										?>
									</a>
								</li>
							</ul>
						</li>
					<?php
					}
					?>

					<?php
					if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "penulis") {
					?>
						<li>
							<a href="<?php echo base_url() . 'dashboard/artikel' ?>">
								<i class="fa fa-pencil"></i>
								<span>ARTIKEL</span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url() . 'dashboard/gallery' ?>">
								<i class="fa fa-image"></i>
								<span>GALERI</span>
							</a>
						</li>
					<?php
					}
					?>

					<?php
					if ($this->session->userdata('level') == "admin") {
					?>
						<li>
							<a href="<?php echo base_url() . 'dashboard/pages' ?>">
								<i class="fa fa-files-o"></i>
								<span>PAGES</span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url() . 'dashboard/pengguna' ?>">
								<i class="fa fa-users"></i>
								<span>PENGGUNA & HAK AKSES</span>
							</a>
						</li>
						<li>
							<a href="<?php echo base_url() . 'dashboard/pengaturan' ?>">
								<i class="fa fa-edit"></i>
								<span>PENGATURAN WEBSITE</span>
							</a>
						</li>
					<?php
					}
					?>

					<li>
						<a href="<?php echo base_url() . 'dashboard/profil' ?>">
							<i class="fa fa-user"></i>
							<span>PROFIL</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url() . 'dashboard/ganti_password' ?>">
							<i class="fa fa-lock"></i>
							<span>GANTI PASSWORD</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url() . 'dashboard/keluar' ?>">
							<i class="fa fa-share"></i>
							<span>KELUAR</span>
						</a>
					</li>
				</ul>
			</section>
		</aside>