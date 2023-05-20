<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pengaturan
			<br>
			<small>Update Pengaturan Website</small>
		</h1>
		<br>
		<?php
		if (isset($_GET['alert'])) {
			if ($_GET['alert'] == "sukses") {
				echo "<div class='alert alert-success'>Pengaturan telah diupdate!</div>";
			}
		}
		?>
	</section>

	<section class="content">
		<div class="container-fluid">
			<div class="card card-default">
				<div class="card-header">
					<h3 class="card-title">Pengaturan</h3>
				</div>
				<div class="card-body">

					<?php foreach ($pengaturan as $p) { ?>

						<form method="post" action="<?php echo base_url('dashboard/pengaturan_update') ?>" enctype="multipart/form-data">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Nama Website</label>
										<input type="text" name="nama" class="form-control" placeholder="Masukkan nama website.." value="<?php echo $p->nama; ?>">
										<?php echo form_error('nama'); ?>
									</div>

									<div class="form-group">
										<label>Deskripsi Website</label>
										<input type="text" name="deskripsi" class="form-control" placeholder="Masukkan deskripsi .." value="<?php echo $p->deskripsi; ?>">
										<?php echo form_error('deskripsi'); ?>
									</div>

									<div class="form-group">
										<div>
											<label>Logo Website</label>
											<input type="file" name="logo">
										</div>
										<small>Kosongkan jika tidak ingin mengubah logo</small>
									</div>
									<div class="form-group">
										<div>
											<label>Background Website</label>
											<input type="file" name="bg">
										</div>
										<small>Kosongkan jika tidak ingin mengubah Background</small>
									</div>
									<div class="form-group">
										<div>
											<label>Struktur Organisasi</label>
											<input type="file" name="struktur">
										</div>
										<small>Kosongkan jika tidak ingin mengubah logo</small>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Link Facebook</label>
										<input type="text" name="link_fb" class="form-control" placeholder="Masukkan Link Facebook .." value="<?php echo $p->link_fb; ?>">
										<?php echo form_error('link_fb'); ?>
									</div>

									<div class="form-group">
										<label>Link Twitter</label>
										<input type="text" name="link_tw" class="form-control" placeholder="Masukkan Link Twiter .." value="<?php echo $p->link_tw; ?>">
										<?php echo form_error('link_tw'); ?>
									</div>

									<div class="form-group">
										<label>Link Instagram</label>
										<input type="text" name="link_ig" class="form-control" placeholder="Masukkan Link Instagram .." value="<?php echo $p->link_ig; ?>">
										<?php echo form_error('link_ig'); ?>
									</div>

									<div class="form-group">
										<label>Link Youtube</label>
										<input type="text" name="link_yt" class="form-control" placeholder="Masukkan Link Youtube .." value="<?php echo $p->link_yt; ?>">
										<?php echo form_error('link_yt'); ?>
									</div>
								</div>
								<div class="col-md-12">
									<hr>
									<div class="card-body">
										<div class="form-group">
											<label>Visi</label>
											<br />
											<textarea class="form-control" id="summernote" name="visi"> <?php echo $p->visi; ?> </textarea>
										</div>

										<div class="form-group">
											<label>Misi</label>
											<br />
											<textarea class="form-control" id="summernote1" name="misi"> <?php echo $p->misi; ?> </textarea>
										</div>

										<hr>
									</div>
									<div class="card-footer">
										<input type="submit" class="btn btn-success" value="Simpan">
									</div>
								</div>
							</div>
						</form>
					<?php } ?>

				</div>

			</div>
		</div>
	</section>
</div>