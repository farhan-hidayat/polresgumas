<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title><?php echo $pengaturan->nama ?></title>
  <link href="<?php echo base_url() . '/gambar/website/' . $pengaturan->logo; ?>" rel="icon">

  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/style/main.css" rel="stylesheet" />
</head>

<body>
  <!-- Navbar-->
  <nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
      <a href="<?php echo base_url(); ?>" class="navbar-brand">
        <img src="<?php echo base_url() . '/gambar/website/' . $pengaturan->logo; ?>" width="50px" class="mr-2" alt="logo" />
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a href="<?php echo base_url(); ?>" class="nav-link">Home</a>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profil</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Visi & Misi</a>
              <a class="dropdown-item" href="#">Tugas & Fungsi</a>
              <a class="dropdown-item" href="#">Struktur Organisasi</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aplikasi Layanan Publik</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="https://skck.polri.go.id" target="_blank">SKCK Online</a>
              <a class="dropdown-item" href="https://www.digitalkorlantas.id" target="_blank">SIM Online</a>
              <a class="dropdown-item" href="https://sp2hp.bareskrim.polri.go.id" target="_blank">SP2HP Online</a>
              <a class="dropdown-item" href="http://lpse.kalteng.polri.go.id/eproc4" target="_blank">LPSE Online</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Informasi Publik</a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="https://www.polri.go.id/" target="_blank">Polri PRESISI</a>
              <a class="dropdown-item" href="https://www.polri.go.id/polisiku" target="_blank">Layanan Polisi</a>
              <a class="dropdown-item" href="https://korlantas.polri.go.id/category/sim-stnk-keliling/" target="_blank">SIM & STNK</a>
              <a class="dropdown-item" href="https://skck.polri.go.id/" target="_blank">SKCK</a>
              <a class="dropdown-item" href="https://sp2hp.bareskrim.polri.go.id/Home/Informasi" target="_blank">Info SP2HP</a>
            </div>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Berita</a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">Pengaduan</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>