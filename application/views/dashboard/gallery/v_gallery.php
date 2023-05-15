<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Galeri
			<small>Manajemen Galeri</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">

				<a href="<?php echo base_url() . 'dashboard/gallery_tambah'; ?>" class="btn btn-sm btn-primary">Tambah Foto Baru</a>

				<br />
				<br />

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Galeri</h3>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table id="example2" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Tanggal</th>
										<th>Judul</th>
										<th>Author</th>
										<th>Kategori</th>
										<th width="10%">Foto</th>
										<th>Status</th>
										<th width="15%">OPSI</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($gallery as $a) {
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo date('d/m/Y H:i', strtotime($a->tanggal_gallery)); ?></td>
											<td><?php echo $a->judul_gallery; ?></td>
											<td><?php echo $a->nama; ?></td>
											<td><?php echo $a->nama_kategori; ?></td>
											<td><img width="100%" class="img-responsive" src="<?php echo base_url() . '/gambar/gallery/' . $a->sampul_gallery; ?>"></td>
											<td>
												<?php
												if ($a->status_gallery == "Publish") {
													echo "<span class='label label-success'>Publish</span>";
												} else {
													echo "<span class='label label-danger'>Draft</span>";
												}
												?>

											</td>
											<td>
												<?php
												// cek apakah penggun yang login adalah penulis
												if ($this->session->userdata('level') == "penulis") {
													// jika penulis, maka cek apakah penulis artikel ini adalah si pengguna atau bukan
													if ($this->session->userdata('id') == $a->author) {
												?>
														<a href="<?php echo base_url() . 'dashboard/gallery_edit/' . $a->id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
														<a href="<?php echo base_url() . 'dashboard/gallery_hapus/' . $a->id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
													<?php
													}
												} else {
													// jika yang login adalah admin
													?>
													<a href="<?php echo base_url() . 'dashboard/gallery_edit/' . $a->id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
													<a href="<?php echo base_url() . 'dashboard/gallery_hapus/' . $a->id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
												<?php
												}
												?>
											</td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>

					</div>
				</div>

			</div>
		</div>

	</section>

</div>