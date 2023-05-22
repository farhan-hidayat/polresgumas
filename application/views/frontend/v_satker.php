<!-- Page Content-->
<div class="page-content page-home">
  <section class="store-trand-categories">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <h5>Semua Satker</h5>
        </div>
      </div>
      <div class="row">
        <?php if ($jumlah_satker == 0) { ?>
          <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="100">
            Tidak ada satker ditemukan
          </div>
        <?php } else { ?>
          <?php
          foreach ($satker as $a) {
          ?>
            <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="100">
              <a href="<?php echo base_url() . 'satker/' . $a->slug_satker; ?>" class="component-categories d-block">
                <p class="categories-text"><?= $a->nama_satker; ?></p>
              </a>
            </div>
          <?php } ?>
        <?php } ?>
      </div>
    </div>
  </section>
</div>