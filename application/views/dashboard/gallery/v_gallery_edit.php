<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Galeri
			<small>Edit Foto</small>
		</h1>
	</section>

	<section class="content">

		<a href="<?php echo base_url() . 'dashboard/gallery'; ?>" class="btn btn-sm btn-primary">Kembali</a>

		<br />
		<br />

		<?php foreach ($gallery as $a) { ?>

			<form method="post" action="<?php echo base_url('dashboard/gallery_update') ?>" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-9">

						<div class="card">
							<div class="card-body">

								<div class="card-body">
									<div class="form-group">
										<label>Judul</label>
										<input type="hidden" name="id" value="<?php echo $a->id; ?>">
										<input type="text" name="judul" class="form-control" placeholder="Masukkan judul.." value="<?php echo $a->judul_gallery; ?>">
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
											<option <?php if ($a->kategori_gallery == $k->id) {
														echo "selected='selected'";
													} ?> value="<?php echo $k->id ?>"><?php echo $k->nama_kategori; ?></option>
										<?php } ?>
									</select>
									<br />
									<?php echo form_error('kategori'); ?>
								</div>

								<br /><br />

								<div class="form-group">
									<label>Foto</label>

									<input type="file" name="sampul">

									<br />
									<?php
									if (isset($gambar_error)) {
										echo $gambar_error;
									}
									?>
									<?php echo form_error('sampul'); ?>
								</div>

								<br /><br />

								<input type="submit" name="status" value="Draft" class="btn btn-warning btn-block">
								<input type="submit" name="status" value="Publish" class="btn btn-success btn-block">

							</div>
						</div>

					</div>
				</div>
			</form>
		<?php } ?>

	</section>

</div>