<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Fakultas
			<small>Tambah Fakutlas</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-6">
				<a href="<?php echo base_url() . 'dashboard/fakultas'; ?>" class="btn btn-sm btn-primary">Kembali</a>

				<br />
				<br />

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Fakultas</h3>
					</div>
					<div class="card-body">


						<form method="post" action="<?php echo base_url('dashboard/fakultas_aksi') ?>">
							<div class="card-body">
								<div class="form-group">
									<label>Nama Fakultas</label>
									<input type="text" name="fakultas" class="form-control" placeholder="Masukkan nama Fakultas ..">
									<?php echo form_error('fakultas'); ?>
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