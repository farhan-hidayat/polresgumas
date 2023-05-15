<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=2" />
  <title>SPMI UPR | Dashboard</title>
  <?php $pengaturan = $this->m_data->get_data('pengaturan')->row(); ?>
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
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="<?php echo base_url() ?>adm/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60" />
    </div>

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
            <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
            <span class="hidden-xs">HAK AKSES : <b><?php echo $this->session->userdata('level') ?></b></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li class="user-header">
              <img src="<?php echo base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
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
        <span class="brand-text font-weight"><b>SPMI</b> UPR</span>
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
            $id_user = $this->session->userdata('id');
            $user =
              $this->db->query("select * from pengguna where
              pengguna_id='$id_user'")->row(); ?>
            <a><?php echo $user->pengguna_nama; ?></a>
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
              <li class="nav-item">
                <a href="<?php echo base_url() . 'dashboard/kategori' ?>" class="nav-link <?= $this->uri->segment(2) == 'kategori' ? 'active' : '' ?>">
                  <i class="nav-icon fas fa-th"></i>
                  <p>KATEGORI</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() . 'dashboard/fakultas' ?>" class="nav-link <?= $this->uri->segment(2) == 'fakultas' ? 'active' : '' ?>">
                  <i class="nav-icon fas fa-university"></i>
                  <p>Fakultas & Prodi</p>
                </a>
              </li>
            <?php
            }
            ?>
            <?php
            if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "auditee" || $this->session->userdata('level') == "verifikator") {
            ?>
              <li class="nav-item <?= $this->uri->segment(2) == 'penetapan' || $this->uri->segment(2) == 'pelaksanaan' || $this->uri->segment(2) == 'evaluasi' || $this->uri->segment(2) == 'pengendalian' || $this->uri->segment(2) == 'peningkatan' ? 'menu-open' : '' ?>">
                <a href="#" class="nav-link <?= $this->uri->segment(2) == 'penetapan' || $this->uri->segment(2) == 'pelaksanaan' || $this->uri->segment(2) == 'evaluasi' || $this->uri->segment(2) == 'pengendalian' || $this->uri->segment(2) == 'peningkatan' ? 'active' : '' ?>">
                  <i class="nav-icon fas fa-folder"></i>
                  <p>
                    SPMI
                    <i class="fas fa-angle-left right"></i>
                    <?php
                    if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
                    ?>
                      <?php if ($this->fungsi->penetapan() + $this->fungsi->pelaksanaan() + $this->fungsi->evaluasi() + $this->fungsi->pengendalian() + $this->fungsi->peningkatan() == 0) {
                      ?>
                        <span class="badge badge-success right"><?= $this->fungsi->penetapan() + $this->fungsi->pelaksanaan() + $this->fungsi->evaluasi() + $this->fungsi->pengendalian() + $this->fungsi->peningkatan() ?></span>
                      <?php
                      } else {
                      ?>
                        <span class="badge badge-danger right"><?= $this->fungsi->penetapan() + $this->fungsi->pelaksanaan() + $this->fungsi->evaluasi() + $this->fungsi->pengendalian() + $this->fungsi->peningkatan() ?></span>
                      <?php
                      }
                      ?>
                    <?php
                    }
                    ?>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="<?php echo base_url() . 'spmi/penetapan' ?>" class="nav-link <?= $this->uri->segment(2) == 'penetapan' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        PENETAPAN
                        <?php
                        if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
                        ?>
                          <?php if ($this->fungsi->penetapan() == 0) {
                          ?>
                            <span class="badge badge-success right"><?= $this->fungsi->penetapan() ?></span>
                          <?php
                          } else {
                          ?>
                            <span class="badge badge-danger right"><?= $this->fungsi->penetapan() ?></span>
                          <?php
                          }
                          ?>
                        <?php
                        }
                        ?>
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url() . 'spmi/pelaksanaan' ?>" class="nav-link <?= $this->uri->segment(2) == 'pelaksanaan' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        PELAKSANAAN
                        <?php
                        if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
                        ?>
                          <?php if ($this->fungsi->pelaksanaan() == 0) {
                          ?>
                            <span class="badge badge-success right"><?= $this->fungsi->pelaksanaan() ?></span>
                          <?php
                          } else {
                          ?>
                            <span class="badge badge-danger right"><?= $this->fungsi->pelaksanaan() ?></span>
                          <?php
                          }
                          ?>
                        <?php
                        }
                        ?>
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url() . 'spmi/evaluasi' ?>" class="nav-link <?= $this->uri->segment(2) == 'evaluasi' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        EVALUASI
                        <?php
                        if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
                        ?>
                          <?php if ($this->fungsi->evaluasi() == 0) {
                          ?>
                            <span class="badge badge-success right"><?= $this->fungsi->evaluasi() ?></span>
                          <?php
                          } else {
                          ?>
                            <span class="badge badge-danger right"><?= $this->fungsi->evaluasi() ?></span>
                          <?php
                          }
                          ?>
                        <?php
                        }
                        ?>
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url() . 'spmi/pengendalian' ?>" class="nav-link <?= $this->uri->segment(2) == 'pengendalian' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        PENGENDALIAN
                        <?php
                        if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
                        ?>
                          <?php if ($this->fungsi->pengendalian() == 0) {
                          ?>
                            <span class="badge badge-success right"><?= $this->fungsi->pengendalian() ?></span>
                          <?php
                          } else {
                          ?>
                            <span class="badge badge-danger right"><?= $this->fungsi->pengendalian() ?></span>
                          <?php
                          }
                          ?>
                        <?php
                        }
                        ?>
                      </p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url() . 'spmi/peningkatan' ?>" class="nav-link <?= $this->uri->segment(2) == 'peningkatan' ? 'active' : '' ?>">
                      <i class="far fa-circle nav-icon"></i>
                      <p>
                        PENINGKATAN
                        <?php
                        if ($this->session->userdata('level') == "admin" || $this->session->userdata('level') == "auditor" || $this->session->userdata('level') == "verifikator") {
                        ?>
                          <?php if ($this->fungsi->peningkatan() == 0) {
                          ?>
                            <span class="badge badge-success right"><?= $this->fungsi->peningkatan() ?></span>
                          <?php
                          } else {
                          ?>
                            <span class="badge badge-danger right"><?= $this->fungsi->peningkatan() ?></span>
                          <?php
                          }
                          ?>
                        <?php
                        }
                        ?>
                      </p>
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
              <li class="nav-item">
                <a href="<?php echo base_url() . 'dashboard/artikel' ?>" class="nav-link <?= $this->uri->segment(2) == 'artikel' ? 'active' : '' ?>">
                  <i class="nav-icon fas fa-pen"></i>
                  <p>ARTIKEL</p>
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
                <a href="<?php echo base_url() . 'dashboard/pages' ?>" class="nav-link <?= $this->uri->segment(2) == 'pages' ? 'active' : '' ?>">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>PAGES</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() . 'dashboard/tutorial' ?>" class="nav-link <?= $this->uri->segment(2) == 'tutorial' ? 'active' : '' ?>">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>TUTORIAL</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url() . 'dashboard/pengguna' ?>" class="nav-link <?= $this->uri->segment(2) == 'pengguna' ? 'active' : '' ?>">
                  <i class="nav-icon fas fa-users"></i>
                  <p>PENGGUNA & HAK AKSES</p>
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
            <li class="nav-item">
              <a href="<?php echo base_url() . 'dashboard/profil' ?>" class="nav-link <?= $this->uri->segment(2) == 'profil' ? 'active' : '' ?>">
                <i class="nav-icon far fa-user"></i>
                <p>PROFIL</p>
              </a>
            </li>
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