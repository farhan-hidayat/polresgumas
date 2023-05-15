<div class="intro intro-single route bg-image" style="background-image: url(img/overlay-bg.jpg)">
  <div class="overlay-mf"></div>
  <div class="intro-content display-table">
    <div class="table-cell">
      <div class="container">
        <h2 class="intro-title mb-4">Galeri</h2>
        <ol class="breadcrumb d-flex justify-content-center">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url(); ?>">Home</a>
          </li>
          <li class="breadcrumb-item">
            <a href="<?php echo base_url('gallery'); ?>">Galeri</a>
          </li>
        </ol>
      </div>
    </div>
  </div>
</div>
<!--/ Intro Skew End /-->

<!--/ Section Blog-Single Star /-->

<section id="work" class="portfolio-mf sect-pt4 route" id='blog'>
  <div class="container">
    <div class="row">
      <?php foreach ($gallery as $a) { ?>
        <div class="col-md-4">
          <div class="work-box">
            <a href="<?php echo base_url(); ?>gambar/gallery/<?php echo $a->sampul ?>" data-lightbox="gallery-mf">
              <div class="work-img">
                <img src="<?php echo base_url(); ?>gambar/gallery/<?php echo $a->sampul ?>" width="200px" alt="" class="img-fluid">
              </div>
              <div class="work-content">
                <div class="row">
                  <div class="col-sm-8">
                    <h2 class="w-title"><?php echo $a->judul ?></h2>
                    <div class="w-more">
                      <span class="w-ctegory"><?php echo $a->kategori_nama ?></span> / <span class="ion-ios-clock-outline"><?php echo date('d-M-Y', strtotime($a->tanggal)); ?></span>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="w-like">
                      <span class="ion-ios-plus-outline"></span>
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>
      <?php } ?>
    </div>
    <?php echo $this->pagination->create_links(); ?>
  </div>
</section>
<!--/ Section Portfolio End /-->