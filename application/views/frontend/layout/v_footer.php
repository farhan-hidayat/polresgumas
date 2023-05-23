<!-- Footer-->
<footer>
  <div class="container">
    <div class="row text-center">
      <div class="col-md-12" style="margin-top: 20px;">
        <a href="<?= $pengaturan->link_fb ?>" target="_blank">
          <img src="<?= base_url(); ?>assets/images/fb.png" alt="" width="50px" />
        </a>
        <img src="<?= base_url(); ?>assets/images/tw.png" alt="" width="50px" />
        </a>
        <img src="<?= base_url(); ?>assets/images/ig.png" alt="" width="50px" />
        </a>
        <img src="<?= base_url(); ?>assets/images/yt.png" alt="" width="50px" />
        </a>
      </div>
      <div class="col-12 text-center">
        <p class="pt-4 pb-2">2022 Copyright Store. All Rights Reserved</p>
      </div>
    </div>
  </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="<?php echo base_url(); ?>assets_frontend/lib/lightbox/js/lightbox.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.slim.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<script src="<?php echo base_url(); ?>assets/script/navbar-scroll.js"></script>
<!-- Script Page-->
<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
<script>
  CKEDITOR.replace('editor');
</script>
</body>

</html>