<!-- Page Content-->
<div class="page-content page-home">
  <section class="store-carousel">
    <div class="container">
      <div class="row">
        <div class="col-lg-12" data-aos="zoom-in">
          <div id="storeCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li class="active" data-target="#storeCarousel" data-slide-to="0"></li>
              <li data-target="#storeCarousel" data-slide-to="1"></li>
              <li data-target="#storeCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="<?= base_url() . '/gambar/website/' . $pengaturan->bg; ?>" alt="Carousel Image" class="d-block w-100" />
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="store-new-products">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>Berita Baru</h5>
        </div>
      </div>
      <div class="row">
        <?php if ($jumlah_berita == 0) { ?>
          <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
            Tidak ada berita ditemukan
          </div>
        <?php } else { ?>
          <?php
          foreach ($berita as $a) {
          ?>
            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
              <a href="<?php echo base_url() . 'berita/' . $a->slug_berita; ?>" class="component-products d-block">
                <div class="products-thumbnail">
                  <div class="products-image" style="
                      background-image: url('<?= base_url() . '/gambar/berita/' . $a->sampul_berita; ?>');
                    "></div>
                </div>
                <div class="products-text"><?= $a->judul_berita; ?></div>
                <div class="products-user"><?= $a->nama; ?></div>
                <div class="products-price"><?= $a->tanggal_berita; ?></div>
              </a>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </section>

  <section class="store-new-products">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>Gallery Baru</h5>
        </div>
      </div>
      <div class="row">
        <?php if ($jumlah_gallery == 0) { ?>
          <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
            Tidak ada gallery ditemukan
          </div>
        <?php } else { ?>
          <?php
          foreach ($gallery as $a) {
          ?>
            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
              <a href="#" class="component-products d-block">
                <div class="products-thumbnail">
                  <div class="products-image" style="
                      background-image: url('<?= base_url() . '/gambar/gallery/' . $a->sampul_gallery; ?>');
                    "></div>
                </div>
                <div class="products-text"><?= $a->judul_gallery; ?></div>
                <div class="products-user"><?= $a->nama; ?></div>
                <div class="products-price"><?= $a->tanggal_gallery; ?></div>
              </a>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </section>

  <section class="store-trand-categories">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center" data-aos="fade-up">
          <h5>Sosial Media</h5>
        </div>
      </div>
      <div class="row">
        <div class="col-6 col-md-3 col-lg-3" data-aos="fade-up" data-aos-delay="100">
          <a href="<?= $pengaturan->link_fb ?>" target="_blank" class="component-categories d-block">
            <div class="categories-image">
              <img src="<?= base_url(); ?>assets/images/fb.png" alt="" class="w-100" />
              <p class="categories-text">Facebook</p>
            </div>
          </a>
        </div>
        <div class="col-6 col-md-3 col-lg-3" data-aos="fade-up" data-aos-delay="200">
          <a href="<?= $pengaturan->link_tw ?>" target="_blank" class="component-categories d-block">
            <div class="categories-image">
              <img src="<?= base_url(); ?>assets/images/tw.png" alt="" class="w-100" />
              <p class="categories-text">Twitter</p>
            </div>
          </a>
        </div>
        <div class="col-6 col-md-3 col-lg-3" data-aos="fade-up" data-aos-delay="300">
          <a href="<?= $pengaturan->link_ig ?>" target="_blank" class="component-categories d-block">
            <div class="categories-image">
              <img src="<?= base_url(); ?>assets/images/ig.png" alt="" class="w-100" />
              <p class="categories-text">Instagram</p>
            </div>
          </a>
        </div>
        <div class="col-6 col-md-3 col-lg-3" data-aos="fade-up" data-aos-delay="400">
          <a href="<?= $pengaturan->link_yt ?>" target="_blank" class="component-categories d-block">
            <div class="categories-image">
              <img src="<?= base_url(); ?>assets/images/yt.png" alt="" class="w-100" />
              <p class="categories-text">Youtube</p>
            </div>
          </a>
        </div>
      </div>
    </div>
  </section>

</div>