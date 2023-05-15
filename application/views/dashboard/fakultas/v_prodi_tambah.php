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
				<a href="<?php echo base_url() . 'dashboard/fakultas'; ?>" class="btn btn-sm btn-primary">Kembali</a>

				<br />
				<br />

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Kategori</h3>
					</div>
					<div class="card-body">


						<form method="post" action="<?php echo base_url('dashboard/prodi_aksi') ?>">
							<div class="card-body">
								<div class="form-group">
									<label>Nama Prodi</label>
									<input type="text" name="prodi" class="form-control" placeholder="Masukkan nama kategori ..">
									<?php echo form_error('prodi'); ?>
								</div>
								<div class="form-group">
									<label>Fakultas</label>
									<select class="form-control" name="fakultas">
									<option value="">- Pilih Fakultas</option>
									<?php foreach($fakultas as $k){ ?>
										<option <?php if(set_value('fakultas') == $k->fakultas_id){echo "selected='selected'";} ?> value="<?php echo $k->fakultas_id ?>"><?php echo $k->fakultas_nama; ?></option>
									<?php } ?>
								</select>
								<br/>
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