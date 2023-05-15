<div class="content-wrapper">
	<section class="content-header">
    <?php foreach ($penetapan as $a) { ?>
		<h1>
			Pengaturan/Penetapan <?php echo $a->penetapan_judul; ?>
			<small>Tambah Form</small>
		</h1>
        
		<?php } ?>
	</section>

	<section class="content">

		<a href="<?php echo base_url() . 'spmi/penetapan'; ?>" class="btn btn-sm btn-primary">Kembali</a>

		<br />
		<br />
		<?php foreach ($penetapan as $a) { ?>
			<form method="post" action="<?php echo base_url('spmi/penetapan_aksi_form') ?>" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-9">
						<div class="col-lg-6">
							<div class="card">
								<div class="card-body">
									<div class="form-group">
										<label>File Form</label>
										<p>(Upload File Doc)</p>
                                        <input type="hidden" name="id" value="<?php echo $a->penetapan_id; ?>">
										<input type="hidden" name="judul" class="form-control" placeholder="Masukkan Nama Peraturan.." value="<?php echo $a->penetapan_judul; ?>">
										
										<input type="file" name="form">

										<br />
										<?php
										if (isset($gambar_error)) {
											echo $gambar_error;
										}
										?>
										<?php echo form_error('form'); ?>
									</div>
                                    <input type="submit" value="Simpan" class="btn btn-success btn-block">
								</div>
							</div>
						</div>
					</div>

				</div>
			</form>
		<?php } ?>
	</section>

</div>