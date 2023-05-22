<!-- Page Content-->
<div class="page-content page-details">
  <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="<?php echo base_url() ?>">Home</a>
              </li>
              <li class="breadcrumb-item active">Detail Berita</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>

  <section class="store-gallery" id="gallery">
    <div class="container">
      <div class="row">
        <div class="col-lg-12" data-aos="zoom-in">
          <transition name="slide-fade" mode="out-in">
            <img src="<?= base_url() . '/gambar/berita/' . $berita->sampul_berita; ?>" class="w-100 main-image" alt="" />
          </transition>
        </div>
      </div>
    </div>
  </section>

  <div class="store-details-container" data-aos="fade-up">
    <section class="store-heading">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <h1><?= $berita->judul_berita; ?></h1>
            <div class="owner">By <?= $berita->nama; ?></div>
            <div class="price"><?= $berita->tanggal_berita; ?></div>
          </div>
        </div>
    </section>
    <section class="store-description">
      <div class="container">
        <div class="row">
          <div class="col-12 ">
            <?= $berita->konten_berita; ?>
          </div>
        </div>
      </div>
    </section>
    <!-- <section class="store-review">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-8 mt-3 mb-3">
            <h5>Customer Review (3)</h5>
          </div>
        </div>
        <div class="row">
          <div class="col-12 col-lg-8">
            <ul class="list-unstyled">
              <li class="media">
                <img src="/images/icon-testimonial-1.png" alt="Icon User" class="mr-3 rounded-circle">
                <div class="media-body">
                  <h5 class="mt-2 mb-1">Rizal</h5>
                  Sofa nya bagus banget, mantap!
                </div>
              </li>
              <li class="media">
                <img src="/images/icon-testimonial-2.png" alt="Icon User" class="mr-3 rounded-circle">
                <div class="media-body">
                  <h5 class="mt-2 mb-1">Jerry</h5>
                  Mantap!
              </li>
              <li class="media">
                <img src="/images/icon-testimonial-3.png" alt="Icon User" class="mr-3 rounded-circle">
                <div class="media-body">
                  <h5 class="mt-2 mb-1">Bayu</h5>
                  Good Item
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section> -->
  </div>
</div>