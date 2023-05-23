<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Kategori
			<small>Kategori Artikel</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url() . 'dashboard/kategori'; ?>" class="btn btn-sm btn-primary">Kembali</a>

				<br />
				<br />

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Kategori</h3>
					</div>
					<div class="card-body">

						<?php foreach ($kategori as $k) { ?>

							<form method="post" action="<?php echo base_url('dashboard/kategori_update') ?>">
								<div class="card-body">
									<div class="form-group">
										<label>Nama Kategori</label>
										<input type="hidden" name="id" value="<?php echo $k->id; ?>">
										<input type="text" name="kategori" class="form-control" placeholder="Masukkan nama kategori .." value="<?php echo $k->nama_kategori; ?>">
										<?php echo form_error('kategori'); ?>
									</div>
									<div class="form-group">
										<label>Sub</label>
										<select class="form-control" name="ket">
											<option value="">- Pilih Sub -</option>
											<option <?php if ($k->ket_kategori == "Berita") {
														echo "selected='selected'";
													} ?> value="Berita">Berita</option>
											<option <?php if ($k->ket_kategori == "Galeri") {
														echo "selected='selected'";
													} ?> value="Galeri">Galeri</option>
											<option <?php if ($k->ket_kategori == "Aplikasi") {
														echo "selected='selected'";
													} ?> value="Aplikasi">Aplikasi</option>
										</select>
										<?php echo form_error('level'); ?>
									</div>
								</div>

								<div class="card-footer">
									<input type="submit" class="btn btn-success" value="Update">
								</div>
							</form>

						<?php } ?>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>