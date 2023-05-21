<!-- Page Content-->
<div class="page-content page-home">
  <section class="store-trand-categories">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>Semua Kategori</h5>
        </div>
      </div>
      <div class="row">
        <?php if ($jumlah_kategori == 0) { ?>
          <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
            Tidak ada kategori ditemukan
          </div>
        <?php } else { ?>
          <?php
          foreach ($kategori as $a) {
          ?>
            <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="100">
              <a href="<?php echo base_url() . 'gallery/' . $a->slug_kategori; ?>" class="component-categories d-block">
                <p class="categories-text"><?= $a->nama_kategori; ?></p>
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
          <h5>Semua Gallery</h5>
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
              <a href="<?= base_url() . 'gambar/gallery/' . $a->sampul_gallery; ?>" class="component-products d-block" data-lightbox="gallery-mf">
                <div class="products-thumbnail">
                  <div class="products-image" style="
                      background-image: url('<?= base_url() . 'gambar/gallery/' . $a->sampul_gallery; ?>');
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
</div>