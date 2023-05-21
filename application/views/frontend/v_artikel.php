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
              <a href="<?php echo base_url() . 'artikel/kategori/' . $a->slug_kategori; ?>" class="component-categories d-block">
                <div class="categories-image">
                  <!-- <img src="/images/categories-gadgets.svg" alt="" class="w-100" /> -->
                  <p class="categories-text"><?= $a->nama_kategori; ?></p>
                </div>
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
          <h5>Semua Artikel</h5>
        </div>
      </div>
      <div class="row">
        <?php if ($jumlah_artikel == 0) { ?>
          <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
            Tidak ada artikel ditemukan
          </div>
        <?php } else { ?>
          <?php
          foreach ($artikel as $a) {
          ?>
            <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="100">
              <a href="<?php echo base_url() . 'artikel/' . $a->slug_artikel; ?>" class="component-products d-block">
                <div class="products-thumbnail">
                  <div class="products-image" style="
                      background-image: url('<?= base_url() . '/gambar/artikel/' . $a->sampul_artikel; ?>');
                    "></div>
                </div>
                <div class="products-text"><?= $a->judul_artikel; ?></div>
                <div class="products-user"><?= $a->nama; ?></div>
                <div class="products-price"><?= $a->tanggal_artikel; ?></div>
              </a>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </section>
</div>