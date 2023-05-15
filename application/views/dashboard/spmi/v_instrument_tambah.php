<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Instrument
            <small>Tambah Instrument Baru</small>
        </h1>
    </section>

    <section class="content">

        <a href="<?php echo base_url() . 'spmi/evaluasi'; ?>" class="btn btn-sm btn-primary">Kembali</a>

        <br />
        <br />

        <form method="post" action="<?php echo base_url('spmi/instrument_aksi') ?>" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-9">
                    <div class="card">
                        <div class="box-body">
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Nama Pengaturan</label>
                                    <input type="text" name="judul" class="form-control" placeholder="Masukkan Nama Peraturan.." value="<?php echo set_value('judul'); ?>">
                                    <br />
                                    <?php echo form_error('judul'); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label>File Pengaturan</label>
                                        <p>(Upload File PDF)</p>

                                        <input type="file" name="file">

                                        <br />
                                        <?php
                                        if (isset($gambar_error)) {
                                            echo $gambar_error;
                                        }
                                        ?>
                                        <?php echo form_error('file'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="card">
                        <div class="box-body">

                            <input type="submit" value="Simpan" class="btn btn-success btn-block">

                        </div>
                    </div>

                </div>
            </div>
        </form>

    </section>

</div>