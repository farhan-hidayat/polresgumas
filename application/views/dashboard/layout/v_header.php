<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=2" />
  <?php $pengaturan = $this->m_data->get_data('pengaturan')->row(); ?>
  <title><?php echo $pengaturan->nama ?></title>
  <link href="<?php echo base_url() . '/gambar/website/' . $pengaturan->logo; ?>" rel="icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adm/plugins/fontawesome-free/css/all.min.css" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adm/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css" />
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adm/plugins/icheck-bootstrap/icheck-bootstrap.min.css" />
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adm/plugins/jqvmap/jqvmap.min.css" />
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adm/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>adm/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>adm/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adm/dist/css/adminlte.min.css" />
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adm/plugins/overlayScrollbars/css/OverlayScrollbars.min.css" />
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adm/plugins/daterangepicker/daterangepicker.css" />
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adm/plugins/summernote/summernote-bs4.min.css" />
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adm/plugins/sweetalert2/sweetalert2.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="<?php echo base_url() ?>adm/plugins/toastr/toastr.min.css">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?php echo base_url() ?>adm/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60" />
    </div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto dropdown-menu-dark">
        <!-- Notifications Dropdown Menu -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo base_url(); ?>adm/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
            <span class="hidden-xs">HAK AKSES : <b><?php echo $this->session->userdata('level') ?></b></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li class="user-header">
              <img src="<?php echo base_url(); ?>adm/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
              <p>
                <?php echo $this->session->userdata('username') ?>
                <small>Hak akses : <?php echo $this->session->userdata('level') ?></small>
              </p>
            </li>

            <li class="user-footer">
              <div class="float-left">
                <a href="<?php echo base_url() . 'dashboard/profil' ?>" class="btn btn-default btn-flat">Profil</a>
              </div>
              <div class="float-right">
                <a href="<?php echo base_url() . 'dashboard/keluar' ?>" class="btn btn-default btn-flat">Keluar</a>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo base_url() . 'dashboard' ?>" class="brand-link">
        <?php $pengaturan = $this->m_data->get_data('pengaturan')->row(); ?>
        <img src="<?php echo base_url() . '/gambar/website/' . $pengaturan->logo; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight"><b>POLRES GUMAS</b></span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="<?php echo base_url() ?>adm/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" />
          </div>
          <div class="info">
            <?php
            // $id_user = $this->session->userdata('id');
            // $user = $this->db->query("select * from pengguna where id='$id_user'")->row(); 
            ?>
            <a><?php echo $this->session->userdata('nama'); ?></a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search" />
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
              <a href="<?php echo base_url() . 'dashboard' ?>" class="nav-link <?= $this->uri->segment(2) == '' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <?php
            if ($this->session->userdata('level') == "admin") {
            ?>
              <li class="nav-item <?= $this->uri->segment(2) == 'kategori' || $this->uri->segment(2) == 'aplikasi' || $this->uri->segment(2) == 'pengguna' ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link <?= $this->uri->segment(2) == 'kategori' || $this->uri->segment(2) == 'aplikasi' || $this->uri->segment(2) == 'pengguna' ? 'active' : '' ?>">
                  <i class="nav-icon fas fa-folder"></i>
                  <p>
                    Master Data
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url() . 'dashboard/kategori' ?>" class="nav-link <?= $this->uri->segment(2) == 'kategori' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>KATEGORI</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url() . 'dashboard/aplikasi' ?>" class="nav-link <?= $this->uri->segment(2) == 'aplikasi' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>APLIKASI</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url() . 'dashboard/pengguna' ?>" class="nav-link <?= $this->uri->segment(2) == 'pengguna' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>PENGGUNA & HAK AKSES</p>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- <li class="nav-item">
                <a href="<?php echo base_url() . 'dashboard/profil' ?>" class="nav-link <?= $this->uri->segment(2) == 'berita' ? 'active' : '' ?>">
                  <i class="nav-icon fas fa-user"></i>
                  <p>Profil</p>
                </a>
              </li> -->
            <?php
            }
            ?>
            <?php
            if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "penulis") {
            ?>
              <li class="nav-item">
                <a href="<?php echo base_url() . 'dashboard/berita' ?>" class="nav-link <?= $this->uri->segment(2) == 'berita' ? 'active' : '' ?>">
                  <i class="nav-icon fas fa-pen"></i>
                  <p>BERITA</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() . 'dashboard/gallery' ?>" class="nav-link <?= $this->uri->segment(2) == 'gallery' ? 'active' : '' ?>">
                  <i class="nav-icon fas fa-image"></i>
                  <p>GALERI</p>
                </a>
              </li>
            <?php
            }
            ?>
            <?php
            if ($this->session->userdata('level') == "admin") {
            ?>
              <li class="nav-item">
                <a href="<?php echo base_url() . 'dashboard/pengaduan' ?>" class="nav-link <?= $this->uri->segment(2) == 'pengaduan' ? 'active' : '' ?>">
                  <i class="nav-icon fa fa-envelope"></i>
                  <p>PENGADUAN</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() . 'dashboard/pengaturan' ?>" class="nav-link <?= $this->uri->segment(2) == 'pengaturan' ? 'active' : '' ?>">
                  <i class="nav-icon fa fa-cog"></i>
                  <p>PENGATURAN WEBSITE</p>
                </a>
              </li>
            <?php
            }
            ?>
            <!-- <li class="nav-item">
              <a href="<?php echo base_url() . 'dashboard/profil' ?>" class="nav-link <?= $this->uri->segment(2) == 'profil' ? 'active' : '' ?>">
                <i class="nav-icon far fa-user"></i>
                <p>PROFIL</p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="<?php echo base_url() . 'dashboard/ganti_password' ?>" class="nav-link <?= $this->uri->segment(2) == 'ganti_password' ? 'active' : '' ?>">
                <i class="nav-icon fas fa-lock"></i>
                <p>GANTI PASSWORD</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?php echo base_url() . 'dashboard/keluar' ?>" class="nav-link">
                <i class="nav-icon fas fa-share"></i>
                <p>KELUAR</p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>