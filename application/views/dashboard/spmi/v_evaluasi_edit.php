<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Evaluasi
            <small>Upload Form</small>
        </h1>
    </section>

    <section class="content">

        <a href="<?php echo base_url() . 'spmi/evaluasi'; ?>" class="btn btn-sm btn-primary">Kembali</a>

        <br />
        <br />
        <?php foreach ($evaluasi as $a) { ?>
            <form method="post" action="<?php echo base_url('spmi/evaluasi_update') ?>" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama Pengaturan</label>
                                        <input type="hidden" name="id" value="<?php echo $a->evaluasi_id; ?>">
                                        <input type="text" name="judul" class="form-control" placeholder="Masukkan Nama Peraturan.." value="<?php echo $a->evaluasi_judul; ?>">
                                        <br />

                                        <?php echo form_error('judul'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Link Dokumen</label>
                                        <input type="text" name="file" class="form-control" placeholder="Masukkan Link Dokumen.." value="<?php echo $a->evaluasi_file; ?>">
                                        <br />

                                        <?php echo form_error('file'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select class="form-control" name="kategori">
                                        <option value="">- Pilih Kategori</option>
                                        <?php foreach ($kategori as $k) { ?>
                                            <option <?php if ($a->instrument == $k->instrument_id) {
                                                        echo "selected='selected'";
                                                    } ?> value="<?php echo $k->instrument_id ?>"><?php echo $k->instrument_nama; ?></option>
                                        <?php } ?>
                                    </select>
                                    <br />
                                    <?php echo form_error('kategori'); ?>
                                </div>
                                <input type="submit" value="Simpan" class="btn btn-success btn-block">

                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php } ?>
    </section>

</div>