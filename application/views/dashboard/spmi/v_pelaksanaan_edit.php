<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Pelaksanaan
            <small>Upload Form</small>
        </h1>
    </section>

    <section class="content">

        <a href="<?php echo base_url() . 'spmi/pelaksanaan'; ?>" class="btn btn-sm btn-primary">Kembali</a>

        <br />
        <br />
        <?php foreach ($pelaksanaan as $a) { ?>
            <form method="post" action="<?php echo base_url('spmi/pelaksanaan_aksi') ?>" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-9">

                        <div class="card">
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Nama Pengaturan</label>
                                        <input type="hidden" name="id" value="<?php echo $a->pelaksanaan_id; ?>">
                                        <input type="text" name="judul" class="form-control" placeholder="Masukkan Nama Peraturan.." value="<?php echo $a->pelaksanaan_judul; ?>">
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
                                    <label>Kategori</label>
                                    <select class="form-control" name="kategori">
                                        <option value="">- Pilih Kategori</option>
                                        <?php foreach ($kategori as $k) { ?>
                                            <option <?php if ($a->penetapan == $k->penetapan_id) {
                                                        echo "selected='selected'";
                                                    } ?> value="<?php echo $k->penetapan_id ?>"><?php echo $k->penetapan_judul; ?></option>
                                        <?php } ?>
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
            </form>
        <?php } ?>
    </section>

</div>