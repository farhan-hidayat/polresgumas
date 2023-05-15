<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Aplikasi
			<small>Ubah Aplikasi</small>
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

						<?php foreach ($aplikasi as $a) { ?>

							<form method="post" action="<?php echo base_url('dashboard/aplikasi_update') ?>">
								<div class="card-body">
									<div class="form-group">
										<label>Nama Aplikasi</label>
										<input type="hidden" name="id" value="<?php echo $a->id; ?>">
										<input type="text" name="aplikasi" class="form-control" placeholder="Masukkan nama aplikasi .." value="<?php echo $a->nama_aplikasi; ?>">
										<?php echo form_error('aplikasi'); ?>
									</div>
									<div class="form-group">
										<label>Link Aplikasi</label>
										<input type="hidden" name="id" value="<?php echo $a->id; ?>">
										<input type="text" name="link" class="form-control" placeholder="Masukkan link aplikasi .." value="<?php echo $a->link_aplikasi; ?>">
										<?php echo form_error('link'); ?>
									</div>
									<div class="form-group">
										<label>Sub</label>
										<select class="form-control" name="kategori">
											<option value="">- Pilih Kategori</option>
											<?php foreach ($kategori as $k) { ?>
												<option <?php if ($a->kategori_aplikasi == $k->id) {
															echo "selected='selected'";
														} ?> value="<?php echo $k->id ?>"><?php echo $k->nama_kategori; ?></option>
											<?php } ?>
										</select>
										<?php echo form_error('katagori'); ?>
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