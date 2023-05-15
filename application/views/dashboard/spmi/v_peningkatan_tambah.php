<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Peningkatan
            <small>Upload Form</small>
        </h1>
    </section>

    <section class="content">

        <a href="<?php echo base_url() . 'spmi/pengendalian'; ?>" class="btn btn-sm btn-primary">Kembali</a>

        <br />
        <br />

        <form method="post" action="<?php echo base_url('spmi/peningkatan_aksi') ?>" enctype="multipart/form-data">
            <?php foreach ($pengendalian as $a) { ?>
                <div class="row">
                    <div class="col-lg-9">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama Pengaturan</label>

                                        <input type="hidden" name="id" value="<?php echo $this->uri->segment(3); ?>">
                                        <input type="text" name="" class="form-control" placeholder="Masukkan Nama Peraturan.." value="<?php echo $a->pengendalian_judul; ?>" disabled>
                                        <input type="hidden" name="judul" class="form-control" placeholder="Masukkan Nama Peraturan.." value="<?php echo $a->pengendalian_judul; ?>">
                                        <br />

                                        <?php echo form_error('judul'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Penetapan</label>
                                    <select class="form-control" name="" disabled>
                                        <option value="">- Pilih Kategori</option>
                                        <?php foreach ($kategori as $k) { ?>
                                            <option <?php if ($k->penetapan == $k->penetapan_id) {
                                                        echo "selected='selected'";
                                                    } ?> value="<?php echo $k->penetapan_id ?>"><?php echo $k->penetapan_judul; ?></option>
                                        <?php } ?>
                                        <input type="hidden" name="kategori" class="form-control" placeholder="Masukkan Nama Peraturan.." value="<?php echo $k->penetapan_id; ?>">
                                    </select>
                                    <br />
                                    <?php echo form_error('kategori'); ?>
                                </div>

                                <div class="form-group">
                                    <label>File</label>

                                    <input type="file" name="file">

                                    <br />
                                    <?php
                                    if (isset($gambar_error)) {
                                        echo $gambar_error;
                                    }
                                    ?>
                                    <?php echo form_error('file'); ?>
                                </div>
                                <input type="submit" value="Simpan" class="btn btn-success btn-block">

                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </form>

    </section>

</div>