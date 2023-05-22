<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Satker
			<small>Manajemen Satker</small>
		</h1>
	</section>

	<section class="content">

		<div class="row">
			<div class="col-lg-12">
				<a href="<?php echo base_url() . 'dashboard/satker_tambah'; ?>" class="btn btn-sm btn-primary">Buat satker baru</a>

				<br />
				<br />

				<div class="card">
					<div class="card-header">
						<h3 class="card-title">Satker</h3>
					</div>
					<div class="card-body">

						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th width="1%">NO</th>
										<th>Satker</th>
										<th>Keterangan</th>
										<th width="15%">OPSI</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($satker as $a) {
									?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td>
												<?php echo $a->nama_satker; ?>
												<br />
												<small class="text-muted">
													<?php echo base_url() . 'satker/' . $a->slug_satker; ?>
												</small>
											</td>
											<td><?php echo $a->ket_satker; ?></td>
											<td>
												<a target="_blank" href="<?php echo base_url() . 'satker/' . $a->slug_satker; ?>" class="btn btn-success btn-sm"> <i class="fa fa-eye"></i> </a>
												<?php
												// cek apakah penggun yang login adalah penulis
												if ($this->session->userdata('level') == "penulis") {
													// jika penulis, maka cek apakah penulis satker ini adalah si pengguna atau bukan
													if ($this->session->userdata('id') == $a->pengguna_satker) {
												?>
														<a href="<?php echo base_url() . 'dashboard/satker_edit/' . $a->id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
														<a href="<?php echo base_url() . 'dashboard/satker_hapus/' . $a->id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
													<?php
													}
												} else {
													// jika yang login adalah admin
													?>
													<a href="<?php echo base_url() . 'dashboard/satker_edit/' . $a->id; ?>" class="btn btn-warning btn-sm"> <i class="fa fa-pen"></i> </a>
													<a href="<?php echo base_url() . 'dashboard/satker_hapus/' . $a->id; ?>" class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i> </a>
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