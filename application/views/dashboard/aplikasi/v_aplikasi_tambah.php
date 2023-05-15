<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Aplikasi
			<small>Tambah Aplikasi</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url() . 'dashboard/aplikasi'; ?>" class="btn btn-sm btn-primary">Kembali</a>

				<br />
				<br />

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Aplikasi</h3>
					</div>
					<div class="card-body">


						<form method="post" action="<?php echo base_url('dashboard/aplikasi_aksi') ?>">
							<div class="card-body">
								<div class="form-group">
									<label>Nama Aplikasi</label>
									<input type="text" name="aplikasi" class="form-control" placeholder="Masukkan nama aplikasi ..">
									<?php echo form_error('aplikasi'); ?>
								</div>
								<div class="form-group">
									<label>Link Aplikasi</label>
									<input type="text" name="link" class="form-control" placeholder="Masukkan link aplikasi ..">
									<?php echo form_error('link'); ?>
								</div>
								<div class="form-group">
									<label>Sub</label>
									<select class="form-control" name="kategori">
										<option value="">- Pilih Kategori</option>
										<?php foreach ($kategori as $k) { ?>
											<option <?php if (set_value('kategori') == $k->id) {
														echo "selected='selected'";
													} ?> value="<?php echo $k->id ?>"><?php echo $k->nama_kategori; ?></option>
										<?php } ?>
									</select>
									<br />
									<?php echo form_error('kategori'); ?>
								</div>
							</div>

							<div class="card-footer">
								<input type="submit" class="btn btn-success" value="Simpan">
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>