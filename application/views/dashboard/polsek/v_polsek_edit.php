<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Polsek
			<small>Edit Polsek Baru</small>
		</h1>
	</section>

	<section class="content">

		<a href="<?php echo base_url() . 'dashboard/polsek'; ?>" class="btn btn-sm btn-primary">Kembali</a>

		<br />
		<br />

		<?php foreach ($polsek as $a) { ?>

			<form method="post" action="<?php echo base_url('dashboard/polsek_update') ?>" enctype="multipart/form-data">
				<div class="row">
					<div class="col-lg-9">

						<div class="card">
							<div class="card-body">
								<div class="card-body">
									<div class="form-group">
										<label>Nama Polsek</label>
										<input type="hidden" name="id" value="<?php echo $a->id; ?>">
										<input type="text" name="nama" class="form-control" placeholder="Masukkan nama polsek.." value="<?php echo $a->nama_polsek; ?>">
										<?php echo form_error('nama'); ?>
									</div>
								</div>
								<div class="card-body">
									<div class="form-group">
										<label>Alamat</label>
										<input type="text" name="alamat" class="form-control" placeholder="Masukkan alamat polsek.." value="<?php echo $a->alamat_polsek; ?>">
										<?php echo form_error('alamat'); ?>
									</div>
								</div>
								<div class="card-body">
									<div class="form-group">
										<label>Map</label>
										<!-- <input type="text" name="map" class="form-control" placeholder="Masukkan map polsek.." value="<?php echo $a->map_polsek; ?>"> -->
										<textarea class="form-control" name="map"><?php echo $a->map_polsek; ?></textarea>
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

								<input type="submit" value="Simpan" class="btn btn-success btn-block">

							</div>
						</div>

					</div>
				</div>
			</form>
		<?php } ?>

	</section>

</div>