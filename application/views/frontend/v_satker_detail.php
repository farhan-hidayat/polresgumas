<div class="page-content page-details">
  <section class="store-gallery" id="gallery">
    <div class="container">
      <div class="row">
        <div class="col-lg-8" data-aos="zoom-in">
          <transition name="slide-fade" mode="out-in">
            <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" class="w-100 main-image" alt="" />
          </transition>
        </div>
        <div class="col-lg-2">
          <div class="row">
            <div class="col-3 col-lg-12 mt-2 mt-lg-0" v-for="(photo, index) in photos" :key="photo.id" data-aos="zoom-in" data-aos-delay="100">
              <a href="#" @click="changeActive(index)">
                <img :src="photo.url" class="w-100 thumbnail-image" :class="{ active: index == activePhoto }" alt="" />
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <div class="store-details-container" data-aos="fade-up">
    <section class="store-heading">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <h1><?= $satker->nama_satker ?></h1>
          </div>
        </div>
    </section>
    <section class="store-description">
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-8">
            <?= $satker->ket_satker; ?>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/vendor/vue/vue.js"></script>
<script>
  var gallery = new Vue({
    el: "#gallery",
    mounted() {
      AOS.init();
    },
    data: {
      activePhoto: 0,
      photos: [
        <?php
        $id = 1;
        foreach ($gallery as $a) { ?> {
            id: <?= $id++; ?>,
            url: "<?php echo base_url() . '/gambar/satker/' . $a->foto_satker; ?>",
          },
        <?php } ?>
      ],
    },
    methods: {
      changeActive(id) {
        this.activePhoto = id;
      },
    },
  });
</script>