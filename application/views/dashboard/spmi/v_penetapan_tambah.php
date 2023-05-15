<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pengaturan/Penetapan
			<small>Tambah Pangaturan Baru</small>
		</h1>
	</section>

	<section class="content">

		<a href="<?php echo base_url() . 'spmi/penetapan'; ?>" class="btn btn-sm btn-primary">Kembali</a>

		<br />
		<br />

		<form method="post" action="<?php echo base_url('spmi/penetapan_aksi') ?>" enctype="multipart/form-data">
			<div class="row">
				<div class="col-lg-9">
					<div class="card">
						<div class="box-body">
							<div class="box-body">
								<div class="form-group">
									<label>Nama Pengaturan</label>
									<input type="text" name="judul" class="form-control" placeholder="Masukkan Nama Peraturan.." value="<?php echo set_value('judul'); ?>">
									<br />
									<?php echo form_error('judul'); ?>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6">
							<div class="card">
								<div class="box-body">
									<div class="form-group">
										<label>File Pengaturan</label>
										<p>(Upload File PDF)</p>
	
										<input type="file" name="file">
	
										<br />
										<?php
										if (isset($gambar_error)) {
											echo $gambar_error;
										}
										?>
										<?php echo form_error('file'); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="card">
								<div class="box-body">
									<div class="form-group">
										<label>File Form</label>
										<p>(Upload File Doc)</p>
	
										<input type="file" name="form">
	
										<br />
										<?php
										if (isset($gambar_error)) {
											echo $gambar_error;
										}
										?>
										<?php echo form_error('form'); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-3">
					<div class="card">
						<div class="box-body">
							<div class="form-group">
								<label>Sub</label>
								<select class="form-control" name="sub">
									<option value="">- Pilih Kategori</option>
									<option value="Nasional">Standar Nasional</option>
									<option value="Institusi">Standar Institusi</option>
								</select>
								<br />
								<?php echo form_error('sub'); ?>
							</div>
							<div class="form-group">
								<label>Kategori</label>
								<select class="form-control" name="kategori">
									<option value="">- Pilih Kategori</option>
									<?php foreach ($kategori as $k) { ?>
										<option <?php if (set_value('kategori') == $k->kategori_id) {
													echo "selected='selected'";
												} ?> value="<?php echo $k->kategori_id ?>"><?php echo $k->kategori_nama; ?></option>
									<?php } ?>
								</select>
								<br />
								<?php echo form_error('kategori'); ?>
							</div>

							<input type="submit" value="Simpan" class="btn btn-success btn-block">

						</div>
					</div>

				</div>
			</div>
		</form>

	</section>

</div>