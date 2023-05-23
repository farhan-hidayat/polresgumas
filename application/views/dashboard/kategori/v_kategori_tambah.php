<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Kategori
			<small>Tambah Kategori</small>
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


						<form method="post" action="<?php echo base_url('dashboard/kategori_aksi') ?>">
							<div class="card-body">
								<div class="form-group">
									<label>Nama Kategori</label>
									<input type="text" name="kategori" class="form-control" placeholder="Masukkan nama kategori ..">
									<?php echo form_error('kategori'); ?>
								</div>
								<div class="form-group">
									<label>Sub</label>
									<select class="form-control" name="ket">
										<option value="">- Pilih Sub</option>
										<option value="Berita">Berita</option>
										<option value="Galeri">Galeri</option>
										<option value="Aplikasi">Aplikasi</option>
									</select>
									<br />
									<?php echo form_error('sub'); ?>
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