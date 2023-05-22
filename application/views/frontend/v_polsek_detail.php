<!-- Page Content-->
<div class="page-content page-home">
  <section class="store-trand-categories">
    <div class="container">
      <div class="row">
        <div class="col-12" data-aos="fade-up">
          <br>
          <center>
            <h2><b><?= $polsek->nama_polsek; ?></b></h2>
          </center>
          <br>
        </div>
        <center>
          <section class="store-gallery" id="gallery">
            <div class="container">
              <div class="row">
                <div class="col-lg-12" data-aos="zoom-in">
                  <transition name="slide-fade" mode="out-in">
                    <img src="<?= base_url() . '/gambar/polsek/' . $polsek->sampul_polsek; ?>" class="w-100 main-image" alt="" />
                  </transition>
                </div>
              </div>
            </div>
          </section>
          <div class="store-details-container" data-aos="fade-up">
            <section class="store-heading">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <br>
                    <h5>Alamat Kantor:</h5>
                    <div class="owner"><?= $polsek->alamat_polsek; ?></div>
                    <?= $polsek->map_polsek; ?>
                  </div>
                </div>
            </section>
          </div>
        </center>
      </div>
    </div>
  </section>
</div>