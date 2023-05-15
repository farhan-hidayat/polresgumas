<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pengaduan
			<small>Tanggapi Pengaduan</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url() . 'dashboard/pengaduan'; ?>" class="btn btn-sm btn-primary">Kembali</a>

				<br />
				<br />

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Pengaduan</h3>
					</div>
					<div class="card-body">

						<?php foreach ($pengaduan as $k) { ?>

							<form method="post" action="<?php echo base_url('dashboard/pengaduan_update') ?>">
								<div class="card-body">
									<div class="form-group">
										<label>Nama Pengadu</label>
										<input type="hidden" name="id" value="<?php echo $k->id; ?>">
										<input type="text" name="pengaduan" class="form-control" placeholder="Masukkan nama pengaduan .." value="<?php echo $k->nama_pengadu; ?>">
										<?php echo form_error('pengaduan'); ?>
									</div>
									<div class="form-group">
										<label>Email Pengadu</label>
										<input type="text" name="pengaduan" class="form-control" placeholder="Masukkan nama pengaduan .." value="<?php echo $k->email_pengadu; ?>" disabled>
									</div>
									<div class="card-body">
										<div class="form-group">
											<label>Balasan</label>
											<?php echo form_error('balasan'); ?>
											<br />
											<textarea class="form-control" id="summernote" name="balasan"> <?php echo set_value('balasan'); ?> </textarea>
										</div>
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