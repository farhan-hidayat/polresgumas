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
              <li class="breadcrumb-item active">Artikel Detail</li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </section>

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
            <h1>Sofa Ternyaman</h1>
            <div class="owner">By Farhan</div>
            <div class="price">$1,410</div>
          </div>
        </div>
    </section>
    <section class="store-description">
      <div class="container">
        <div class="row">
          <div class="col-12 ">
            <p>
              The Nike Air Max 720 SE goes bigger than ever before with
              Nike's tallest Air unit yet for unimaginable, all-day comfort.
              There's super breathable fabrics on the upper, while colours
              add a modern edge.
            </p>
            <p>
              Bring the past into the future with the Nike Air Max 2090, a
              bold look inspired by the DNA of the iconic Air Max 90.
              Brand-new Nike Air cushioning underfoot adds unparalleled
              comfort while transparent mesh and vibrantly coloured details
              on the upper are blended with timeless OG features for an
              edgy, modernised look.
            </p>
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