<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Polsek
			<small>Manajemen Polsek</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				<a href="<?php echo base_url() . 'dashboard/polsek_tambah'; ?>" class="btn btn-sm btn-primary">Buat polsek baru</a>

				<br />
				<br />

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Polsek</h3>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Polsek</th>
										<th>Alamat</th>
										<th>Map</th>
										<th width="10%">Gambar</th>
										<th width="15%">OPSI</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($polsek as $a) {
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td>
												<?php echo $a->nama_polsek; ?>
												<br />
												<small class="text-muted">
													<?php echo base_url() . 'polsek/' . $a->slug_polsek; ?>
												</small>
											</td>
											<td><?php echo $a->alamat_polsek; ?></td>
											<td><?php echo $a->map_polsek; ?></td>
											<td><img width="100%" class="img-responsive" src="<?php echo base_url() . '/gambar/polsek/' . $a->sampul_polsek; ?>"></td>
											<td>
												<a target="_blank" href="<?php echo base_url() . 'polsek/' . $a->slug_polsek; ?>" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i> </a>
												<?php
												// cek apakah penggun yang login adalah penulis
												if ($this->session->userdata('level') == "penulis") {
													// jika penulis, maka cek apakah penulis polsek ini adalah si pengguna atau bukan
													if ($this->session->userdata('id') == $a->pengguna_polsek) {
												?>
														<a href="<?php echo base_url() . 'dashboard/polsek_edit/' . $a->id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
														<a href="<?php echo base_url() . 'dashboard/polsek_hapus/' . $a->id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
													<?php
													}
												} else {
													// jika yang login adalah admin
													?>
													<a href="<?php echo base_url() . 'dashboard/polsek_edit/' . $a->id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
													<a href="<?php echo base_url() . 'dashboard/polsek_hapus/' . $a->id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
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