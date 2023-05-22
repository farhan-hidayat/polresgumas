<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Satker
			<small>Tambah Satker Baru</small>
		</h1>
	</section>

	<section class="content">

		<a href="<?php echo base_url() . 'dashboard/satker'; ?>" class="btn btn-sm btn-primary">Kembali</a>

		<br />
		<br />

		<form method="post" action="<?php echo base_url('dashboard/satker_aksi') ?>" enctype="multipart/form-data">
			<div class="row">
				<div class="col-lg-9">
					<div class="card">
						<div class="card-body">
							<div class="card-body">
								<div class="form-group">
									<label>Nama Satker</label>
									<input type="text" name="nama" class="form-control" placeholder="Masukkan nama satker.." value="<?php echo set_value('nama'); ?>">
									<?php echo form_error('nama'); ?>
								</div>
							</div>
							<div class="card-body">
								<div class="form-group">
									<label>Keterangan</label>
									<?php echo form_error('ket'); ?>
									<br />
									<textarea class="form-control" id="summernote" name="ket"> <?php echo set_value('ket'); ?> </textarea>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="card">
						<div class="card-body">
							<div class="form-group">
								<label>Gambar Sampul</label>

								<input type="file" name="files[]" multiple>

								<br />
								<?php
								if (isset($gambar_error)) {
									echo $gambar_error;
								}
								?>
								<?php echo form_error('file'); ?>
							</div>
							<br /><br />
							<input type="submit" value="Simpan" class="btn btn-success btn-block">

						</div>
					</div>

				</div>
			</div>
		</form>

	</section>

</div>