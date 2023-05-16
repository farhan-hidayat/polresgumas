<!-- Footer-->
<footer>
  <div class="container">
    <div class="row">
      <div class="col-12 text-center">
        <p class="pt-4 pb-2">2022 Copyright Store. All Rights Reserved</p>
      </div>
    </div>
  </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.slim.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<script src="/vendor/vue/vue.js"></script>
<script>
  var gallery = new Vue({
    el: "#gallery",
    mounted() {
      AOS.init();
    },
    data: {
      activePhoto: 0,
      photos: [{
          id: 1,
          url: "/images/product-details-1.jpg",
        },
        {
          id: 2,
          url: "/images/product-details-2.jpg",
        },
        {
          id: 3,
          url: "/images/product-details-3.jpg",
        },
        {
          id: 4,
          url: "/images/product-details-4.jpg",
        },
      ],
    },
    methods: {
      changeActive(id) {
        this.activePhoto = id;
      },
    },
  });
</script>
<script src="<?php echo base_url(); ?>assets/script/navbar-scroll.js"></script>
<!-- Script Page-->
<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor');
</script>
</body>

</html>