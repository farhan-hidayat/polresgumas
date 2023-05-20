<!-- Page Content-->
<div class="page-content page-cart">
    <form method="post" action="<?php echo base_url('welcome/pengaduan_aksi') ?>" enctype="multipart/form-data">
        <section class="store-cart">
            <div class="container">
                <div class="row" data-aos="fade-up" data-aos-delay="150">
                    <div class="col-12">
                        <hr />
                    </div>
                    <div class="col-12">
                        <h2 class="mb-4">Pengaduan</h2>
                    </div>
                </div>
                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" placeholder="Isikan nama Anda" />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Isikan email Anda" />
                            <?php echo form_error('email'); ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jenis">Jenis Pengaduan</label>
                            <input type="text" class="form-control" name="jenis" placeholder="Isikan jenis pengaduan" />
                            <?php echo form_error('jenis'); ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="pengaduan">Isi Pengaduan</label>
                            <?php echo form_error('pengaduan'); ?>
                            <br />
                            <textarea class="form-control" id="summernote" name="pengaduan"> <?php echo set_value('pengaduan'); ?> </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-8 col-md-3">
                        <input type="submit" class="btn btn-success" value="Kirim">
                    </div>
                </div>
            </div>
        </section>
    </form>
</div>